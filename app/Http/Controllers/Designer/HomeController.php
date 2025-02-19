<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use App\Notifications\OrderAcceptedByDesignerNotification;
use App\Models\User;



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
            $reginid = auth()->user()->region_id;


            // تحديث الطلب بالمعلومات الجديدة
            $order->update([
                'approved_designer_id' => $designer->id, // تعيين معرف المصمم الحالي
                'processing_stage' => 'stage_two', // تعيين المرحلة التالية
                'order_status' => 'accepted' // تعيين حالة الطلب
            ]);

            // رسالة SMS للمستخدم
            $smsMessage = "لقد وافق أحد المصممين على طلبك رقم {$order->id}.";

            // إرسال الـ SMS
            Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
                'api_key' => env('SMS_API_KEY'),
                'username' => env('SMS_USERNAME'),
                'message' => $smsMessage,
                'sender' => env('SMS_SENDER'),
                'numbers' => $order->user->phone // رقم المستخدم
            ]);

            // إرسال الإشعار للمستخدم
            $userNotificationMessage = "تمت الموافقة على طلبك رقم {$order->id} من قبل المصمم {$designer->user->name}.";
            $order->user->notify(new OrderAcceptedByDesignerNotification($order, $designer, $userNotificationMessage));

            // إرسال الإشعار لمدير المنطقة
            $regionManager = User::where('role', 'Area manager')
                ->where('region_id', $reginid) // مدير المنطقة حسب منطقة المصمم
                ->first();


            if ($regionManager) {
                $regionManagerNotificationMessage = "المصمم {$designer->user->name} وافق على الطلب رقم {$order->id} الخاص بمنطقته.";
                $regionManager->notify(new OrderAcceptedByDesignerNotification($order, $designer, $regionManagerNotificationMessage));
            }

            // إرسال الإشعار لمدير المبيعات
            $salesManager = User::where('role', 'Sales manager')->first(); // الحصول على مدير المبيعات
            if ($salesManager) {
                $salesManagerNotificationMessage = "تمت الموافقة على الطلب رقم {$order->id} من قبل المصمم {$designer->user->name}.";
                $salesManager->notify(new OrderAcceptedByDesignerNotification($order, $designer, $salesManagerNotificationMessage));
            }

            // إعادة توجيه مع رسالة نجاح
            return redirect()->back()->with('success', 'تمت الموافقة على الطلب وتم إرسال الإشعارات.');

        } catch (\Exception $e) {
            // التعامل مع أي أخطاء تحدث أثناء عملية التحديث
            return redirect()->back()->with('error', 'حدث خطأ أثناء الموافقة على الطلب: ' . $e->getMessage());
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

            return redirect()->back()->with('success', 'تم رفض الطلب بنجاح.');
        }

        return redirect()->back()->with('error', 'لا يحق لك رفض هذا الطلب.');
    }

    public function approvedOrders()
    {
        // الحصول على المصمم الحالي
        $designer = auth()->user()->designer;

        // تحقق مما إذا كان المصمم موجودًا
        if (!$designer) {
            // إذا لم يكن المصمم موجودًا، قم بإعادة توجيه المستخدم أو عرض رسالة
            return redirect()->route('designer.notification')->withErrors('غير مصرح لك بالدخول إلى هذه الصفحة.');
        }

        // استرجاع الطلبات التي وافق عليها المصمم الحالي
        $approvedOrders = Order::where('approved_designer_id', $designer->id)
        //    ->where('order_status', 'accepted')
            ->orderBy('created_at', 'desc') // ترتيب من الأحدث إلى الأقدم
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
            return redirect()->route('designer.approved.orders')->with('error', 'ليس لديك الإذن لعرض هذا الطلب.');
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
                return redirect()->route('designer.approved.orders')->with('error', 'لا يمكن تقديم التصميم النهائي إلا بعد موافقة المستخدم على التصميم.');
            } elseif ($order->processing_stage == 'stage_six') {
                // توجيه إلى واجهة ملء بيانات order draft
                $approvedDrafts = $order->orderDraft()->where('state', 'approved')->get();
                return view('designer.order_draft_finalized', compact('order', 'notifications','approvedDrafts'));
            }  elseif ($order->processing_stage == 'stage_seven') {
            return redirect()->route('designer.approved.orders')->with('error', 'لم يحصل الزبون بعد على تفاصيل الشراء');
            }   elseif ($order->processing_stage == 'stage_eight') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.Second_payment', compact('order', 'notifications'));
            }    elseif ($order->processing_stage == 'stage_nine') {
            return redirect()->route('designer.approved.orders')->with('error', ' لم يحصل بعد الزبون على تفاصيل الشراء للدفعة الثانية');
        }   elseif ($order->processing_stage == 'stage_ten') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.third_payment', compact('order', 'notifications'));
            } elseif ($order->processing_stage == 'stage_eleven') {
                return redirect()->route('designer.approved.orders')->with('error', ' لم يحصل بعد الزبون على تفاصيل الشراء للدفعة الثالثة');
            }
            elseif ($order->processing_stage == 'stage_twelve') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.complete_payment', compact('order', 'notifications'));
            }
            elseif ($order->processing_stage == 'stage_thirteen') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.manufacturing_began', compact('order', 'notifications'));
            }
            elseif ($order->processing_stage == 'stage_fourteen') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.manufacturing_ending', compact('order', 'notifications'));
            }

            elseif ($order->processing_stage == 'stage_fifteen') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.order_arrived', compact('order', 'notifications'));
            }
            elseif ($order->processing_stage == 'stage_sixteen') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.installation_start', compact('order', 'notifications'));
            }

            elseif ($order->processing_stage == 'stage_seventeen') {
                // توجيه إلى واجهة ملء بيانات order draft
                return view('designer.installation_end_and_complete', compact('order', 'notifications'));
            }





        } else {
            return redirect()->route('designer.approved.orders')->with('error', ' ');
        }
    }



}
