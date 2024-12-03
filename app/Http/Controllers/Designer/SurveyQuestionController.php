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
                'hear_about_oppolia' => 'required|string',  // أصبح مطلوبًا
                'expected_delivery_time' => 'required|string',  // أصبح مطلوبًا
                'client_budget' => 'required|numeric',  // أصبح مطلوبًا
                'kitchen_room_size' => 'required|string',  // أصبح مطلوبًا
                'kitchen_use' => 'required|array',  // أصبح مطلوبًا ويجب أن يكون مصفوفة
                'kitchen_style_preference' => 'required|string',  // أصبح مطلوبًا
                'appliances_needed' => 'required|array',  // أصبح مطلوبًا ويجب أن يكون مصفوفة
                'sink_type' => 'required|string',  // أصبح مطلوبًا
                'worktop_preference' => 'required|string',  // أصبح مطلوبًا
                'general_info' => 'required|string',  // أصبح مطلوبًا
                'customer_concerns' => 'required|string',  // أصبح مطلوبًا
                'next_steps_strategy' => 'required|string',  // أصبح مطلوبًا
                'reminder_details' => 'required|date',  // أصبح مطلوبًا ويجب أن يكون تاريخ
                'deal_closing_likelihood' => 'required|integer|min:1|max:10',  // أصبح مطلوبًا ويجب أن يكون عددًا صحيحًا
                'measurements_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',  // أصبح مطلوبًا ويجب أن تكون صور
            ]);
            // إذا كان هناك صور للقياسات، نقوم بتخزينها
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
                'kitchen_use' => json_encode($validated['kitchen_use']), // تخزين كـ JSON
                'kitchen_style_preference' => $validated['kitchen_style_preference'],
                'appliances_needed' => json_encode($validated['appliances_needed']), // تخزين كـ JSON
                'sink_type' => $validated['sink_type'],
                'worktop_preference' => $validated['worktop_preference'],
                'general_info' => $validated['general_info'],
                'customer_concerns' => $validated['customer_concerns'],
                'next_steps_strategy' => $validated['next_steps_strategy'],
                'reminder_details' => $validated['reminder_details'],
                'deal_closing_likelihood' => $validated['deal_closing_likelihood'],
                'measurements_images' => json_encode($measurementsImagesPaths), // تخزين مسارات الصور كـ JSON
            ]);

            // تحديث مرحلة المعالجة إلى "stage_four" أو المرحلة المطلوبة
            $order->update([
                'processing_stage' => 'stage_four',
            ]);

            // إعادة التوجيه مع رسالة نجاح والإشعارات
            return redirect()->route('designer.approved.orders')
                ->with('success', 'تم إرسال الاستبيان وتم تحديث مرحلة معالجة الطلب بنجاح.')
                ->with('notifications', $notifications);

        } catch (\Exception $e) {
            // التعامل مع الخطأ
            return redirect()->route('designer.approved.orders')
                ->with('error', 'An error occurred while submitting the survey: ' . $e->getMessage());
        }
    }


}
