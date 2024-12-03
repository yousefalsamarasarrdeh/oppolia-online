<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Models\Region;
use App\Models\Designer;
use Illuminate\Support\Str;


class AdminUserManagement extends Controller
{

    public function index_Datatabel(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.users.index');
    }

    public function main_index()
    {
        // Check if the logged-in user is an Area Manager
        if (auth()->user()->role === 'Area manager') {
            // جلب المنطقة للمستخدم الحالي
            $userRegionId = auth()->user()->region_id;

            // جلب المستخدمين والمصممين الذين ينتمون إلى نفس المنطقة، مع الأخذ في الاعتبار وجود منطقة أو عدمها
            $users = User::whereIn('role', ['user', 'designer'])  // تحديد الأدوار المطلوبة
            ->where(function($query) use ($userRegionId) {
                // إذا كان للمستخدم منطقة محددة
                $query->where('region_id', $userRegionId)
                    // أو إذا كانت المنطقة null، يمكن إضافة شرط لجلبهم
                    ->orWhereNull('region_id');
            })
                ->get();
        }

        elseif (auth()->user()->role === 'Sales manager')
        {
            $users = User::whereNotIn('role', ['admin', ])->get();
        }

        else {
            // If the logged-in user is not an Area Manager, retrieve all users
            $users = User::all();
        }

        // Retrieve unread notifications for the authenticated user
        $notifications = auth()->user()->unreadNotifications;

        // Pass variables to the view
        return view('dashboard.users.index_main', compact('users', 'notifications'));
    }


    /**
     * عرض صفحة المستخدمين.
     */
    public function show()
    {   $notifications= auth()->user()->unreadNotifications;
        return view('dashboard.users',compact('notifications')); // عرض صفحة users.blade.php
    }


    public function edit($id)
    {    $regions = Region::all();
        $user = User::findOrFail($id); // يجلب المستخدم أو يرجع خطأ إذا لم يتم العثور عليه
        $notifications= auth()->user()->unreadNotifications;
        return view('dashboard.users.edit', compact('user','regions','notifications')); // يعرض نموذج التعديل للمستخدم
    }



    public function update(Request $request, $id)
    {
        try {
            // العثور على المستخدم بناءً على الـ id
            $user = User::findOrFail($id);

            // التحقق من صحة البيانات الخاصة بالمستخدم فقط
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'required|string|max:20|unique:users,phone,' . $id,
                'role' => 'required|in:admin,designer,user,Sales manager,Area manager',
                'region_id' => 'nullable|exists:regions,id',
            ]);

            // تحديث بيانات المستخدم
            $user->update($request->only(['name', 'email', 'phone', 'role', 'region_id']));

            // إذا كان الدور هو "designer"، قم بتحديث بيانات المصمم
            if ($user->role === 'designer') {
                // تحقق من صحة البيانات الخاصة بالمصمم فقط إذا كان الدور "designer"
                $request->validate([
                    'profile_image' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'experience_years' => 'sometimes|integer|min:0',
                    'description' => 'sometimes|string',
                    'description_ar' => 'sometimes|string|regex:/^[\p{Arabic}0-9\s]+$/u',
                    'portfolio_images.*' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
                ]);

                // جلب المصمم المرتبط بالمستخدم إن وجد أو إنشاء نموذج جديد
                $designer = $user->designer ?? new Designer(['user_id' => $user->id]);

                // توليد كود المصمم بشكل عشوائي إذا لم يكن موجودًا
                if (!$request->has('designer_code') || empty($request->input('designer_code'))) {
                    do {
                        $designerCode = Str::random(8); // توليد كود عشوائي بطول 8 أحرف
                    } while (Designer::where('designer_code', $designerCode)->exists()); // التحقق من عدم تكرار الكود

                    $designer->designer_code = $designerCode;
                } else {
                    $designer->designer_code = $request->input('designer_code');
                }

                // تحميل الصورة الشخصية إذا كانت موجودة
                if ($request->hasFile('profile_image')) {
                    $designer->profile_image = $request->file('profile_image')->store('profile_images', 'public');
                }
                $portfolioImages = [];
                if ($request->hasFile('portfolio_images')) {
                    foreach ($request->file('portfolio_images') as $image) {
                        $portfolioImages[] = $image->store('portfolio_images', 'public');
                    }
                }
                // تحميل الصور المتعددة إذا كانت موجودة
               $portfolioImages = $designer->portfolio_images ?? [];
                if ($request->hasFile('portfolio_images')) {
                    foreach ($request->file('portfolio_images') as $image) {
                        $portfolioImages[] = $image->store('portfolio_images', 'public');
                    }
                }

                // تحديث أو إنشاء بيانات المصمم
                $designer->fill([
                    'experience_years' => $request->input('experience_years', $designer->experience_years),
                    'description' => $request->input('description', $designer->description),
                    'description_ar' => $request->input('description_ar', $designer->description_ar),
                    'portfolio_images' => json_encode($portfolioImages), // هنا يتم تحويل المصفوفة إلى JSON
                ]);
                $designer->save();
            } else {
                // إذا لم يكن الدور "designer"، حذف بيانات المصمم إذا كانت موجودة
                if ($user->designer) {
                    $user->designer->delete();
                }
            }

            // إعادة توجيه المستخدم بعد النجاح
            return redirect()->route('admin.users.index.main')->with('success', ' updated successfully.');
        } catch (\Exception $e) {
            // في حال حدوث خطأ، سيتم التقاطه هنا
            return redirect()->back()->with('error', 'An error occurred while updating the user and designer: ' . $e->getMessage());
        }
    }




    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // يقوم بحذف المستخدم
        return redirect()->route('admin.users.index.main')->with('success', 'The user has been deleted successfully');
    }
}
