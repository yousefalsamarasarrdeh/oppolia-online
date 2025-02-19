<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Notifications\ManufactureAndInstallationNotification;
use App\Models\User;
Use App\Notifications\OrderCompletedNotification;


class ManufactureAndInstallationController extends Controller
{

    public function startManufacture(Request $request, $orderId)
    {
        try {
            // البحث عن الطلب
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')
                    ->with('error', '❌ ليس لديك صلاحية لتحديث حالة هذا الطلب.');
            }

            // تحديث حالة الطلب
            $order->update([
                'processing_stage' => 'تم بدء التصنيع',
            ]);

            // إرسال رسالة SMS
            $message = "تم البدء بعملية التصنيع";
            Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone,
            ]);

            // إرسال إشعار للمستخدم
            $customMessage = "تم بدء التصنيع  لطلبك رقم " . $order->id . ". يمكنك متابعة التفاصيل من حسابك.";
            $order->user->notify(new ManufactureAndInstallationNotification($order, $customMessage));

            return redirect()->route('designer.approved.orders')
                ->with('success', 'تم إنشاء مرحلة بدء التصنيع')
                ->with('notifications', $notifications);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', '❌ الطلب غير موجود.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->with('error', '⚠ فشل في إرسال SMS: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠ حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }
    }

    public function finishManufacture(Request $request, $orderId)
    {

        try {
            // البحث عن الطلب
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')
                    ->with('error', '❌ ليس لديك صلاحية لتحديث حالة هذا الطلب.');
            }

            // تحديث حالة الطلب
            $order->update([
                'processing_stage' => 'تم إنهاء التصنيع',
            ]);

            // إرسال رسالة SMS
            $message = "تم أنهاء عملية التصنيع";
            Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone,
            ]);

            // إرسال إشعار للمستخدم
            $customMessage = "تم انهاء تصنيع المطبخ  لطلبك رقم " . $order->id . ". يمكنك متابعة التفاصيل من حسابك.";
            $order->user->notify(new ManufactureAndInstallationNotification($order, $customMessage));

            return redirect()->route('designer.approved.orders')
                ->with('success', 'تم انها  مرحلة التصنيع بنجاح')
                ->with('notifications', $notifications);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', '❌ الطلب غير موجود.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->with('error', '⚠ فشل في إرسال SMS: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠ حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }

    }

    public function confirmArrival(Request $request, $orderId)
    {
        try {
            // البحث عن الطلب
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')
                    ->with('error', '❌ ليس لديك صلاحية لتحديث حالة هذا الطلب.');
            }

            // تحديث حالة الطلب
            $order->update([
                'processing_stage' => 'تم توصيل الطلب إلى المملكة العربية السعودية',
            ]);

            // إرسال رسالة SMS
            $message = "لقد وصل الطلب الي المملكة العربية السعودية";
            Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone,
            ]);

            // إرسال إشعار للمستخدم
            $customMessage = "لقد وصل طلبك الي المملكة العربية السعودية رقم" . $order->id . ". يمكنك متابعة التفاصيل من حسابك.";
            $order->user->notify(new ManufactureAndInstallationNotification($order, $customMessage));

            return redirect()->route('designer.approved.orders')
                ->with('success', 'تم وصول المطبخ الى المملكة العربية السعودية')
                ->with('notifications', $notifications);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', '❌ الطلب غير موجود.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->with('error', '⚠ فشل في إرسال SMS: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠ حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }
    }


    public function startInstallation(Request $request, $orderId)
    {

        try {
            // البحث عن الطلب
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')
                    ->with('error', '❌ ليس لديك صلاحية لتحديث حالة هذا الطلب.');
            }

            // تحديث حالة الطلب
            $order->update([
                'processing_stage' => 'تم بدء التركيب',
            ]);

            // إرسال رسالة SMS
            $message = "تم البدء بعملية التركيب";
            Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone,
            ]);

            // إرسال إشعار للمستخدم
            $customMessage = "تم بدء التركيب لطلبك رقم " . $order->id . ". يمكنك متابعة التفاصيل من حسابك.";
            $order->user->notify(new ManufactureAndInstallationNotification($order, $customMessage));

            return redirect()->route('designer.approved.orders')
                ->with('success', 'تم إنشاء مرحلة بدء التركيب')
                ->with('notifications', $notifications);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', '❌ الطلب غير موجود.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->with('error', '⚠ فشل في إرسال SMS: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠ حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }

    }

    public function completeInstallation(Request $request, $orderId)
    {

        try {
            // البحث عن الطلب
            $order = Order::findOrFail($orderId);

            // جلب المصمم الحالي
            $designer = auth()->user()->designer;
            $notifications = $designer->unreadNotifications;

            // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
            if ($order->approved_designer_id != $designer->id) {
                return redirect()->route('designer.approved.orders')
                    ->with('error', '❌ ليس لديك صلاحية لتحديث حالة هذا الطلب.');
            }

            // تحديث حالة الطلب
            $order->update([
                'processing_stage' => 'اكتمل الطلب',
                'order_status'=>'closed'
            ]);

            // إرسال رسالة SMS
            $message = "تم التركيب شكرا لك";
            Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone,
            ]);


            $reginid = auth()->user()->region_id;


            $regionManager = User::where('role', 'Area manager')
                ->where('region_id', $reginid) // مدير المنطقة حسب منطقة المصمم
                ->first();


            if ($regionManager) {

                $regionManager->notify(new OrderCompletedNotification($order));
            }
            $salesManager = User::where('role', 'Sales manager')->first(); // الحصول على مدير المبيعات

            if ($salesManager) {

                $salesManager->notify(new OrderCompletedNotification($order));
            }
            $order->user->notify(new OrderCompletedNotification($order ));

            return redirect()->route('designer.approved.orders')
                ->with('success', 'تمت انهاء الطلب .')
                ->with('notifications', $notifications);



        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', '❌ الطلب غير موجود.');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return redirect()->back()->with('error', '⚠ فشل في إرسال SMS: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '⚠ حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }

    }





}
