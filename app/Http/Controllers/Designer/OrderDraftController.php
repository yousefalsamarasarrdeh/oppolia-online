<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDraft;
use Illuminate\Support\Facades\Http;

class OrderDraftController extends Controller
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
                return redirect()->route('designer.approved.orders')->with('error', 'You do not have permission to create an order draft for this order.');
            }

            // التحقق من المدخلات
            $validated = $request->validate([
                'price' => 'required|numeric',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // التحقق من الصور

                'pdf' => 'required|mimes:pdf|max:10240', // التحقق من PDF
                'state' => 'required|in:draft,finalized,approved,rejected',
            ]);

            // رفع الصور وتخزين المسارات
            $imagesPaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('order_draft_images', 'public'); // تخزين الصورة في مجلد order_draft_images
                    $imagesPaths[] = $path;
                }
            }

            // رفع صور القياسات وتخزين المسارات


            // رفع PDF وتخزين المسار
            $pdfPath = null;
            if ($request->hasFile('pdf')) {
                $pdfPath = $request->file('pdf')->store('order_draft_pdfs', 'public'); // تخزين الـ PDF في مجلد order_draft_pdfs
            }

            // إنشاء OrderDraft جديد
            \App\Models\OrderDraft::create([
                'order_id' => $order->id,
                'price' => $validated['price'],
                'images' => json_encode($imagesPaths), // تخزين المسارات كـ JSON

                'pdf' => $pdfPath, // تخزين مسار PDF
                'state' => $validated['state'],
            ]);

            // تحديث مرحلة المعالجة إلى المرحلة المطلوبة
            $order->update([
                'processing_stage' => 'stage_five', // يمكنك تغيير المرحلة كما هو مطلوب
            ]);

            $message = "أرسل أحد المصممين تصميمًا خاصًا لطلبك. يرجى  الدخول إلى موقعنا لمشاهدة التصميم";

            // إرسال الـ SMS باستخدام رقم هاتف المستخدم المرتبط بالطلب
            $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone // الوصول إلى رقم هاتف المستخدم
            ]);

            // إعادة التوجيه مع رسالة نجاح والإشعارات
            return redirect()->route('designer.approved.orders')
                ->with('success', 'Order draft created successfully and order processing stage updated.')
                ->with('notifications', $notifications);

        } catch (\Exception $e) {
            // التعامل مع الخطأ
            return redirect()->route('designer.approved.orders')
                ->with('error', 'An error occurred while creating the order draft: ' . $e->getMessage());
        }
    }


}
