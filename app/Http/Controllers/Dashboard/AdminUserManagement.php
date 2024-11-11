<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Models\Region;


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
            // Retrieve only users who are not Sales Managers, Admins, or other Area Managers
            $users = User::whereNotIn('role', ['Sales manager', 'admin', 'Area manager'])->get();
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

            // تحديث بيانات المستخدم
            $user->update($request->all());

            // إرجاع رسالة نجاح في حال نجاح العملية
            return redirect()->route('admin.users.index.main')->with('success', 'The user has been updated successfully');
        } catch (\Exception $e) {
            // في حال حدوث خطأ، سيتم التقاطه هنا

            // يمكنك تسجيل الخطأ إذا أردت مثلًا: Log::error($e->getMessage());

            // إرجاع رسالة خطأ للمستخدم
            return redirect()->back()->with('error', 'An error occurred while updating the user: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // يقوم بحذف المستخدم
        return redirect()->route('admin.users.index.main')->with('success', 'The user has been deleted successfully');
    }
}
