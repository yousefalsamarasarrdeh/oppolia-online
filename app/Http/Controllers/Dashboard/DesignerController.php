<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Designer;
use Illuminate\Http\Request;
use App\Models\User;

class DesignerController extends Controller
{
    public function index()
    {
        $user = User::with('designer') // تحميل البيانات المرتبطة من جدول designers
        ->where('role', 'designer') // فلترة البيانات بناءً على الدور
        ->get();
        $notifications= auth()->user()->unreadNotifications;

        return view('dashboard.Designer.index', compact('user','notifications'));
    }

    public function showEditForm(User $user)
    {
        // جلب المصمم المرتبط بهذا المستخدم، أو إنشاء مصمم جديد فارغ إذا لم يكن موجودًا
        $designer = Designer::firstOrNew(['user_id' => $user->id]);
        $notifications= auth()->user()->unreadNotifications;

        // عرض الواجهة مع تمرير نموذج المصمم إليها
        return view('dashboard.designer.edit', compact('designer','notifications'));
    }

    public function storeOrUpdateDesigner(Request $request, User $user)
    {
        // جلب المصمم المرتبط بالمستخدم إن وجد
        $designer = $user->designer;

        // التحقق من صحة البيانات
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'experience_years' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string', // التحقق من صحة الحقل الجديد
            'portfolio_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // تحقق من صحة كل صورة
            'designer_code' => 'required|string|unique:designers,designer_code,' . ($designer ? $designer->id : ''),
        ]);

        // تحميل الصورة الشخصية إذا كانت موجودة
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
        }

        // تحميل الصور المتعددة إذا كانت موجودة
        $portfolioImages = [];
        if ($request->hasFile('portfolio_images')) {
            foreach ($request->file('portfolio_images') as $image) {
                $portfolioImages[] = $image->store('portfolio_images', 'public');
            }
        }

        // تحديث أو إنشاء نموذج المصمم
        $designer = Designer::updateOrCreate(
            ['user_id' => $user->id],
            [

                'profile_image' => $path ?? $user->designer->profile_image ?? null,
                'experience_years' => $request->experience_years,
                'description' => $request->description,
                'description_ar' => $request->description_ar, // حفظ الحقل الجديد
                'portfolio_images' => json_encode($portfolioImages),
                'designer_code' => $request->designer_code,
            ]

        );


        // إعادة توجيه المستخدم بعد النجاح
        return redirect()->route('designer.showEditForm', $user->id)->with('success', 'Designer details updated successfully.');
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
