<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class SurveyQuestionController extends Controller
{

    public function store(Request $request, $orderId)
    {
        try {
            // جلب الطلب باستخدام $orderId
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')->with('error', 'You do not have permission to submit a survey for this order.');
            }

            // التحقق من المدخلات بناءً على الحقول الجديدة
            $validated = $request->validate([
                'hear_about_oppolia' => 'nullable|string',
                'expected_delivery_time' => 'nullable|string',
                'client_budget' => 'nullable|numeric',
                'kitchen_room_size' => 'nullable|string',
                'kitchen_use' => 'nullable|string',
                'kitchen_style_preference' => 'nullable|string',
                'appliances_needed' => 'nullable|string',
                'sink_type' => 'nullable|string',
                'worktop_preference' => 'nullable|string',
                'general_info' => 'nullable|string',
                'customer_concerns' => 'nullable|string',
                'next_steps_strategy' => 'nullable|string',
                'reminder_details' => 'nullable|date',
                'deal_closing_likelihood' => 'nullable|integer|min:1|max:10',
                'measurements_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // التحقق من الصور
            ]);

            $measurementsImagesPaths = [];
            if ($request->hasFile('measurements_images')) {
                foreach ($request->file('measurements_images') as $measurementImage) {
                    $path = $measurementImage->store('measurements_images', 'public'); // تخزين الصورة في مجلد measurements_images
                    $measurementsImagesPaths[] = $path;
                }
            }


            // إنشاء استبيان جديد في جدول survey_questions مع الحقول الجديدة
            \App\Models\SurveyQuestion::create([
                'order_id' => $order->id,
                'hear_about_oppolia' => $validated['hear_about_oppolia'],
                'expected_delivery_time' => $validated['expected_delivery_time'],
                'client_budget' => $validated['client_budget'],
                'kitchen_room_size' => $validated['kitchen_room_size'],
                'kitchen_use' => $validated['kitchen_use'],
                'kitchen_style_preference' => $validated['kitchen_style_preference'],
                'appliances_needed' => $validated['appliances_needed'],
                'sink_type' => $validated['sink_type'],
                'worktop_preference' => $validated['worktop_preference'],
                'general_info' => $validated['general_info'],
                'customer_concerns' => $validated['customer_concerns'],
                'next_steps_strategy' => $validated['next_steps_strategy'],
                'reminder_details' => $validated['reminder_details'],
                'deal_closing_likelihood' => $validated['deal_closing_likelihood'],
                'measurements_images' => json_encode($measurementsImagesPaths),
            ]);

            // تحديث مرحلة المعالجة إلى "stage_four" أو المرحلة المطلوبة
            $order->update([
                'processing_stage' => 'stage_four',
            ]);

            // إعادة التوجيه مع رسالة نجاح والإشعارات
            return redirect()->route('designer.approved.orders')
                ->with('success', 'Survey submitted and order processing stage updated successfully.')
                ->with('notifications', $notifications);

        } catch (\Exception $e) {
            // التعامل مع الخطأ
            return redirect()->route('designer.approved.orders')
                ->with('error', 'An error occurred while submitting the survey: ' . $e->getMessage());
        }
    }

}
