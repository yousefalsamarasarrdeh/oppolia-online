<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;


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

    public function main_index(){
        $users = User::all(); // Retrieve all users

        return view('dashboard.users.index_main', compact('users'));

    }

    /**
     * عرض صفحة المستخدمين.
     */
    public function show()
    {
        return view('dashboard.users'); // عرض صفحة users.blade.php
    }


    public function edit($id)
    {
        $user = User::findOrFail($id); // يجلب المستخدم أو يرجع خطأ إذا لم يتم العثور عليه
        return view('dashboard.users.edit', compact('user')); // يعرض نموذج التعديل للمستخدم
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all()); // يقوم بتحديث بيانات المستخدم
        return redirect()->route('admin.users.index.main')->with('success', 'The user has been updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // يقوم بحذف المستخدم
        return redirect()->route('admin.users.index.main')->with('success', 'The user has been deleted successfully');
    }
}
