<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index()
    {
        // جلب المصمم الحالي
        $designer = auth()->user()->designer;

        // تحقق مما إذا كان المصمم موجودًا
        if ($designer) {
            // جلب كل الإشعارات الخاصة بالمصمم
            $notifications = $designer->unreadNotifications;
            $notifications1 = $designer->notifications;
        } else {
            // إذا لم يكن هناك مصمم مرتبط بالمستخدم
            $notifications = collect(); // مجموعة فارغة
            $notifications1 = collect(); // مجموعة فارغة
        }

        return view('designer.index', compact('notifications1', 'notifications'));
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
        $notifications = $designer->unreadNotifications;

        // عرض صفحة تفاصيل الطلب مع إمكانية القبول أو الرفض
        return view('designer.order_show', [
            'order' => $order,
            'notifications'=>$notifications,
        ]);
    }

    public function accept(Order $order)
    {
        try {
            // الحصول على المصمم الحالي
            $designer = auth()->user()->designer;

            // تحديث الطلب بالمعلومات الجديدة
            $order->update([
                'approved_designer_id' => $designer->id, // تعيين معرف المصمم الحالي
                'processing_stage' => 'stage_two', // تعيين المرحلة التالية
                'order_status' => 'accepted' // تعيين حالة الطلب
            ]);
            $message = "One of the designers has approved your request";

            // إرسال الـ SMS باستخدام رقم هاتف المستخدم المرتبط بالطلب
            $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $message,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone // الوصول إلى رقم هاتف المستخدم
            ]);


            // إعادة توجيه مع رسالة نجاح
            return redirect()->back()->with('success', 'Order accepted successfully.');

        } catch (\Exception $e) {
            // التعامل مع أي أخطاء تحدث أثناء عملية التحديث
            return redirect()->back()->with('error', 'There was an error accepting the order: ' . $e->getMessage());
        }
    }

    // رفض الطلب
    public function reject(Order $order)
    {
        // تحقق من أن المصمم هو المعتمد لهذا الطلب
        $designer = auth()->user()->designer;

        if ($designer && $designer->id === $order->approved_designer_id) {
            $order->update([
                'order_status' => 'rejected'
            ]);

            return redirect()->back()->with('success', 'Order rejected successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to reject this order.');
    }

    public function approvedOrders()
    {
        // الحصول على المصمم الحالي
        $designer = auth()->user()->designer;

        // تحقق مما إذا كان المصمم موجودًا
        if (!$designer) {
            // إذا لم يكن المصمم موجودًا، قم بإعادة توجيه المستخدم أو عرض رسالة
            return redirect()->route('designer.notification')->withErrors('You are not authorized to access this page.');
        }

        // استرجاع الطلبات التي وافق عليها المصمم الحالي
        $approvedOrders = Order::where('approved_designer_id', $designer->id)
            ->where('order_status', 'accepted')
            ->get();

        // استرجاع الإشعارات غير المقروءة
        $notifications = $designer->unreadNotifications;

        // إعادة توجيه البيانات إلى صفحة العرض
        return view('designer.order_list_approved', compact('approvedOrders', 'notifications'));
    }


    public function showWithoutNotification($orderId)
    {
        // جلب المصمم الحالي
        $designer = auth()->user()->designer;

        // جلب كل الإشعارات الخاصة بالمصمم
        $notifications = $designer->unreadNotifications;

        // جلب الطلب بناءً على الـ orderId
        $order = Order::findOrFail($orderId);

        // التحقق مما إذا كان المصمم الموافق على الطلب هو المصمم الحالي
        if ($order->approved_designer_id == $designer->id) {
            // إذا كان المصمم هو الذي وافق على الطلب، اعرض واجهة الطلب
            return view('designer.order_show', [
                'order' => $order,
                'notifications'=>$notifications,
            ]);
        } else {
            // إذا لم يكن المصمم هو الموافق، اعرض رسالة خطأ أو وجهه إلى صفحة "لا تملك الصلاحية"
            return redirect()->route('designer.approved.orders')->with('error', 'You do not have permission to view this order.');
        }
    }

    public function processing($orderId)
    {
        $designer = auth()->user()->designer;
        $order = Order::findOrFail($orderId);
        $notifications = $designer->unreadNotifications;

        // التحقق مما إذا كان المصمم هو الذي وافق على الطلب
        if ($order->approved_designer_id == $designer->id) {
            // التحقق من stage الطلب
            if ($order->processing_stage == 'stage_two') {
                return view('designer.create_meeting', compact('order', 'notifications'));
            } elseif ($order->processing_stage == 'stage_three') {

                return view('designer.survey_question', compact('order', 'notifications'));
            } elseif ($order->processing_stage == 'stage_four') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.order_draft', compact('order', 'notifications'));
            } elseif ($order->processing_stage == 'stage_five') {
                return redirect()->route('designer.approved.orders')->with('error', 'The final design cannot be submitted unless the user approves the design.');
            }


        } else {
            return redirect()->route('designer.approved.orders')->with('error', 'You do not have permission to process this order.');
        }
    }



}
