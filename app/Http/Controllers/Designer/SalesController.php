<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PaymentCompletedNotification;
use App\Notifications\PaymentDetailsSentNotificationToAdmin;
use App\Notifications\SecondPaymentToCustomer;
use App\Notifications\ThirdPaymentToCustomer;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Installment;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function storeInstallment(Request $request, Sale $sale)
    {
        // الحصول على الطلب المرتبط بالمبيعات
        $order = $sale->order;

        // الحصول على المصمم الحالي (يفترض أنك تستخدم مصادقة المستخدم)
        $designer = auth()->user()->designer;
        $notifications = $designer->unreadNotifications;


        // التحقق من أن المصمم هو المعتمد لهذا الطلب
        if ($order->approved_designer_id !== $designer->id) {
            dd('sales');
            return redirect()->back()->with('error', 'ليس لديك الصلاحية لإضافة أقساط لهذا الطلب.');
        }

        // التحقق من صحة البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'installment_amount' => 'required|numeric|min:0',
         //   'due_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // حساب عدد الأقساط المسجلة لهذا البيع


        // حساب النسبة بناءً على التكلفة الكلية بعد الخصم
        $percentage = ($request->installment_amount / $sale->price_after_discount) * 100;

        $firstInstallment = $sale->installments()->where('installment_number', 1)->first();

        if ($firstInstallment) {
            // تحديث حالة القسط الأول إلى "paid"
            $firstInstallment->update(['status' => 'paid']);
        }

        // إنشاء القسط الجديد
        $installment = new Installment([
            'sale_id' => $sale->id,
            'installment_amount' => $request->installment_amount,
            'installment_number' => 2,
            'percentage' => $percentage,
           // 'due_date' => $request->due_date,
            'status' => 'pending', // الحالة الافتراضية: قيد الانتظار
        ]);

        $installment->save();

        // إذا كان هذا هو القسط الأول فقط، قم بتحديث بيانات المبيعات

        $sale->update([
                'amount_paid' => $firstInstallment->installment_amount,
                'paid_percentage' => $firstInstallment->percentage,
                'installments_count'=>2,
                'status'=>'first_payment_done', ]);

        $order->update([
            'processing_stage' => 'تم تسديد الدفعة الأولى وإرسال تفاصيل الدفعة الثانية',
        ]);


        $message = "تم ارسال تفاصيل الدفعة الثانية ";

        Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => env('SMS_API_KEY'),
            'username' => env('SMS_USERNAME'),
            'message' => $message,
            'sender' => env('SMS_SENDER'),
            'numbers' => $order->user->phone,
        ]);

        Notification::send($order->user, new SecondPaymentToCustomer($order));

        $reginid = auth()->user()->region_id;


        $regionManager = User::where('role', 'Area manager')
            ->where('region_id', $reginid) // مدير المنطقة حسب منطقة المصمم
            ->first();


        if ($regionManager) {

            $regionManager->notify(new PaymentDetailsSentNotificationToAdmin($order, $designer, $installment));
        }
        $salesManager = User::where('role', 'Sales manager')->first(); // الحصول على مدير المبيعات

        if ($salesManager) {

            $salesManager->notify(new PaymentDetailsSentNotificationToAdmin($order, $designer, $installment));
        }


        return redirect()->route('designer.approved.orders')
            ->with('success', 'تم إنشاء مسودة الطلب النهائية بنجاح وتم تحديث مرحلة معالجة الطلب.')
            ->with('notifications', $notifications);

    }


    public function storeThirdInstallment(Request $request, Sale $sale)
    {
        // الحصول على الطلب المرتبط بالمبيعات
        $order = $sale->order;

        // الحصول على المصمم الحالي (يفترض أنك تستخدم مصادقة المستخدم)
        $designer = auth()->user()->designer;
        $notifications = $designer->unreadNotifications;

        // التحقق من أن المصمم المعتمد هو الذي يضيف الدفعة الثالثة
        if ($order->approved_designer_id !== $designer->id) {
            return redirect()->back()->with('error', 'ليس لديك الصلاحية لإضافة الدفعة الثالثة لهذا الطلب.');
        }

        // التحقق مما إذا كانت الدفعة الثالثة مضافة بالفعل
        if ($sale->installments()->where('installment_number', 3)->exists()) {
            return redirect()->back()->with('error', 'تمت إضافة الدفعة الثالثة مسبقًا.');
        }

        // حساب مجموع الدفعتين الأولى والثانية
        $totalFirstAndSecondPayments = $sale->installments()
            ->whereIn('installment_number', [1, 2])
            ->sum('installment_amount');

        // حساب قيمة الدفعة الثالثة
        $thirdPaymentAmount = $sale->price_after_discount - $totalFirstAndSecondPayments;

        if ($thirdPaymentAmount <= 0) {
            return redirect()->back()->with('error', 'القيمة المتبقية للدفعة الثالثة غير صحيحة.');
        }

        // حساب نسبة الدفعة الثالثة
        $percentage = ($thirdPaymentAmount / $sale->price_after_discount) * 100;

        // إنشاء القسط الثالث
        $installment = Installment::create([
            'sale_id' => $sale->id,
            'installment_amount' => $thirdPaymentAmount,
            'installment_number' => 3,
            'percentage' => $percentage,
            'status' => 'pending',
        ]);

        // تحديث بيانات المبيعات بعد الدفعة الثالثة
        $sale->update([
            'amount_paid' => $totalFirstAndSecondPayments,
            'paid_percentage' => ($totalFirstAndSecondPayments/ $sale->price_after_discount) * 100,
            'installments_count' => 3,
            'status' => 'second_payment_done',
        ]);

        // تحديث مرحلة الطلب
        $order->update(['processing_stage' => 'تم استلام الدفعة الثانية وإرسال تفاصيل الدفعة الثالثة']);

        $SecondInstallment = $sale->installments()->where('installment_number', 2)->first();

        if ($SecondInstallment) {
            // تحديث حالة القسط الأول إلى "paid"
            $SecondInstallment->update(['status' => 'paid']);
        }

        // إرسال إشعار للمستخدم
        Notification::send($order->user, new ThirdPaymentToCustomer($order));

        $reginid = auth()->user()->region_id;


        $regionManager = User::where('role', 'Area manager')
            ->where('region_id', $reginid) // مدير المنطقة حسب منطقة المصمم
            ->first();


        if ($regionManager) {

            $regionManager->notify(new PaymentDetailsSentNotificationToAdmin($order, $designer, $installment));
        }
        $salesManager = User::where('role', 'Sales manager')->first(); // الحصول على مدير المبيعات

        if ($salesManager) {

            $salesManager->notify(new PaymentDetailsSentNotificationToAdmin($order, $designer, $installment));
        }


        // إرسال رسالة نصية للمستخدم
        Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => env('SMS_API_KEY'),
            'username' => env('SMS_USERNAME'),
            'message' => "تم إرسال تفاصيل الدفعة الثالثة.",
            'sender' => env('SMS_SENDER'),
            'numbers' => $order->user->phone,
        ]);

        return redirect()->route('designer.approved.orders')
            ->with('success', 'تمت إضافة الدفعة الثالثة بنجاح وتحديث مرحلة الطلب.')
            ->with('notifications', $notifications);
    }


    public function completeOrder (Request $request, Sale $sale) {

        $order = $sale->order;
        $designer = auth()->user()->designer;
        $notifications = $designer->unreadNotifications;
        if ($order->approved_designer_id !== $designer->id) {
            return redirect()->back()->with('error', 'ليس لديك الصلاحية لإضافة الدفعة الثالثة لهذا الطلب.');
        }
        $totalPayments = $sale->installments()
            ->whereIn('installment_number', [1, 2,3])
            ->sum('installment_amount');

        $sale->update([
            'amount_paid' => $totalPayments,
            'paid_percentage' => ($totalPayments/ $sale->price_after_discount) * 100,

            'status' => 'completed',
        ]);

        $thirdInstallment = $sale->installments()->where('installment_number', 3)->first();

        if ($thirdInstallment) {
            // تحديث حالة القسط الأول إلى "paid"
            $thirdInstallment->update(['status' => 'paid']);
        }

        $order->update([
            'processing_stage' => 'تم تسديد الدفعة الثالثة',
           // 'order_status'=>'closed'
        ]);

        $reginid = auth()->user()->region_id;


        $regionManager = User::where('role', 'Area manager')
            ->where('region_id', $reginid) // مدير المنطقة حسب منطقة المصمم
            ->first();


        if ($regionManager) {

            $regionManager->notify(new PaymentCompletedNotification($order));
        }
        $salesManager = User::where('role', 'Sales manager')->first(); // الحصول على مدير المبيعات

        if ($salesManager) {

            $salesManager->notify(new PaymentCompletedNotification($order));
        }


        return redirect()->route('designer.approved.orders')
            ->with('success', 'تمت انهاء الدفع .')
            ->with('notifications', $notifications);

    }

}
