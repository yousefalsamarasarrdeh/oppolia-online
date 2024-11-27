<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // جلب جميع الإشعارات الخاصة بالمستخدم الذي قام بتسجيل الدخول
        $notifications1 = auth()->user()->notifications;
        $notifications= auth()->user()->unreadNotifications;

        // تمرير الإشعارات إلى الـ View
        return view('User.notifications.index', compact('notifications','notifications1'));
    }
}
