<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminUserManagement extends Controller
{
    public function index()
    {
        // جلب جميع المستخدمين من قاعدة البيانات
        $users = User::all();

        // عرض البيانات (يمكنك استبدال هذا بالكود الذي تحتاجه لعرض البيانات)
        return view('dashboard.users.index', compact('users'));
    }
}
