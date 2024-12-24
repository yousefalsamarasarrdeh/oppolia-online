<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Designer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DesignerController extends Controller
{
    public function index()
    {
        // جلب الإشعارات غير المقروءة
        $notifications = auth()->user()->unreadNotifications;

        // التحقق إذا كان المستخدم الحالي هو "مدير منطقة"
        if (auth()->user()->role === 'Area manager') {
            // جلب المصممين الذين ينتمون إلى نفس المنطقة الخاصة بمدير المنطقة
            $user = User::with('designer')
                ->where('role', 'designer')
                ->where('region_id', auth()->user()->region_id) // فلترة بناءً على region_id للمستخدم الحالي
                ->orderBy('created_at', 'desc') // ترتيب حسب الأحدث
                ->get();
        } else {
            // جلب جميع المصممين إذا لم يكن المستخدم "مدير منطقة"
            $user = User::with('designer')
                ->where('role', 'designer')
                ->orderBy('created_at', 'desc') // ترتيب حسب الأحدث
                ->get();
        }

        return view('dashboard.Designer.index', compact('user', 'notifications'));
    }

    public function showEditForm(User $user)
    {
        // جلب المصمم المرتبط بهذا المستخدم، أو إنشاء مصمم جديد فارغ إذا لم يكن موجودًا
        $designer = Designer::firstOrNew(['user_id' => $user->id]);
        $notifications= auth()->user()->unreadNotifications;

        // عرض الواجهة مع تمرير نموذج المصمم إليها
        return view('dashboard.designer.edit', compact('designer','notifications'));
    }

    public function update(Request $request, User $user)
    {
        try {
            // التأكد من أن المستخدم لديه مصمم مرتبط به
            $designer = $user->designer;

            if (!$designer) {
                return redirect()->back()->with('error', 'Designer not found for this user.');
            }

            // التحقق من صحة البيانات
            $request->validate([
                'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'experience_years' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'description_ar' => 'nullable|string|regex:/^[\p{Arabic}0-9\s]+$/u', // التحقق من صحة الحقل للتأكد من الأحرف العربية والأرقام فقط
                'portfolio_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // تحقق من صحة كل صورة
            ]);

            // حذف الصورة الشخصية القديمة إذا تم تحميل صورة جديدة
            if ($request->hasFile('profile_image')) {
                if ($designer->profile_image) {
                    // حذف الصورة القديمة من التخزين
                    Storage::disk('public')->delete($designer->profile_image);
                }
                // تخزين الصورة الجديدة
                $path = $request->file('profile_image')->store('profile_images', 'public');
            } else {
                // الاحتفاظ بالصورة القديمة إذا لم يتم تحميل صورة جديدة
                $path = $designer->profile_image;
            }

            // تحميل الصور المتعددة وحذف القديمة في حال وجود صور جديدة
            $portfolioImages = json_decode($designer->portfolio_images, true) ?? [];
            if ($request->hasFile('portfolio_images')) {
                // حذف الصور القديمة من التخزين
                foreach ($portfolioImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
                // تحميل الصور الجديدة وتخزين المسارات
                $portfolioImages = [];
                foreach ($request->file('portfolio_images') as $image) {
                    $portfolioImages[] = $image->store('portfolio_images', 'public');
                }
            }

            // تحديث بيانات المصمم
            $designer->update([
                'profile_image' => $path,
                'experience_years' => $request->experience_years,
                'description' => $request->description,
                'description_ar' => $request->description_ar,
                'portfolio_images' => json_encode($portfolioImages), // تخزين المصفوفة كـ JSON
            ]);

            // إعادة توجيه المستخدم بعد النجاح
            return redirect()->route('designer.showEditForm', $user->id)->with('success', 'Designer details updated successfully.');
        } catch (\Exception $e) {
            // في حال حدوث خطأ، يتم التقاطه هنا وإرجاع رسالة خطأ للمستخدم
            return redirect()->back()->with('error', 'An error occurred while updating the designer details: ' . $e->getMessage());
        }
    }


    public function showDesigner(User $user)
    {
        // جلب المصمم المرتبط بالمستخدم
        $designer = Designer::where('user_id', $user->id)->firstOrFail();
        $notifications= auth()->user()->unreadNotifications;

        // عرض الواجهة مع تمرير نموذج المصمم إليها
        return view('dashboard.designer.show', compact('designer','notifications'));
    }
}
