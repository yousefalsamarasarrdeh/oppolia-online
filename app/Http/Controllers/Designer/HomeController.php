<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class HomeController extends Controller
{
    public function index()
    {
        // جلب المصمم الحالي
        $designer = auth()->user()->designer;

        // جلب كل الإشعارات الخاصة بالمصمم
        $notifications = $designer->notifications;

        return view('designer.index', compact('notifications'));



    }
    public function show(Order $order, $notificationId)
    {
        // تأكد أن المستخدم هو المصمم الموافق على الطلب أو لديه الصلاحيات اللازمة

        $designer = auth()->user()->designer;
        // جلب الإشعار المحدد بناءً على الـ notificationId وتحديث حالته إلى مقروء
        $notification =$designer->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }
        $notifications = $designer->notifications;

        // عرض صفحة تفاصيل الطلب مع إمكانية القبول أو الرفض
        return view('designer.order_show', [
            'order' => $order,
            'notifications'=>$notifications,
        ]);
    }

}
