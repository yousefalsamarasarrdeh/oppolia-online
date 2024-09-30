<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class DesignerMeetingCustomerController extends Controller
{


    public function UpdateMeeting(Request $request, $orderId)
    {
        try {
            // جلب الطلب باستخدام $orderId
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')->with('error', 'You do not have permission to create a meeting for this order.');
            }

            // التحقق مما إذا كان اللقاء قد تم إنشاؤه مسبقًا
            $existingMeeting = \App\Models\DesignerMeetingCustomer::where('order_id', $order->id)->first();

            if ($existingMeeting) {
                return redirect()->route('designer.approved.orders')->with('error', 'A meeting for this order has already been created.');
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

            // إعادة التوجيه مع رسالة نجاح والإشعارات
            return redirect()->route('designer.approved.orders')
                ->with('success', 'Meeting created and order processing stage updated successfully.')
                ->with('notifications', $notifications);

        } catch (\Exception $e) {
            // التعامل مع الخطأ
            return redirect()->route('designer.approved.orders')
                ->with('error', 'An error occurred while creating the meeting: ' . $e->getMessage());
        }
    }



}
