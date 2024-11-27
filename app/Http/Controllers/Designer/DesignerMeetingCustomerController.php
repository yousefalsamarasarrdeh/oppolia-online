<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Notifications\DesignerMeetingNotification;


class DesignerMeetingCustomerController extends Controller
{


    public function UpdateMeeting(Request $request, $orderId)
    {
        try {
            // جلب الطلب باستخدام $orderId
            $order = Order::findOrFail($orderId);
            $regionId = auth()->user()->region_id;
            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')->with('error', 'You do not have permission to create a meeting for this order.');
            }

            // التحقق من المدخلات
            $validated = $request->validate([
                'is_verified' => 'required|boolean',
                'meeting_time' => 'required|date',
            ]);

            // إنشاء لقاء جديد في جدول designer_meeting_customers
            \App\Models\DesignerMeetingCustomer::create([
                'order_id' => $order->id,
                'is_verified' => $validated['is_verified'],
                'meeting_time' => $validated['meeting_time'],
            ]);

            // تحديث مرحلة المعالجة إلى "stage_three"
            $order->update([
                'processing_stage' => 'stage_three',
            ]);
            $regionManager = User::where('role', 'Area manager')
                ->where('region_id', $regionId) // مدير المنطقة حسب منطقة المصمم
                ->first();

            // إرسال إشعار إلى مدير المنطقة إذا كان موجودًا
            if ($regionManager) {

                $regionManager->notify(new DesignerMeetingNotification($order, $designer, $validated['meeting_time']));
            }


            // إعادة التوجيه مع رسالة نجاح والإشعارات
            return redirect()->route('designer.approved.orders')
                ->with('success', 'تم إنشاء الاجتماع وتحديث مرحلة معالجة الطلب بنجاح.')
                ->with('notifications', $notifications);

        } catch (\Exception $e) {
            // التعامل مع الخطأ
            return redirect()->route('designer.approved.orders')
                ->with('error', 'An error occurred while creating the meeting: ' . $e->getMessage());
        }
    }



}
