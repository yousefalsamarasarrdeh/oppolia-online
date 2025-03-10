<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Installment;
use App\Notifications\PaymentReceiptUploaded;

class InstallmentController extends Controller
{

    public function updateStatus(Request $request)
    {
        // جلب القسط بناءً على الـ ID المرسل
        $installment = Installment::find($request->installment_id);

        // التحقق مما إذا كان القسط موجودًا
        if (!$installment) {
            return response()->json(['error' => 'القسط غير موجود'], 404);
        }

        // جلب الطلب المرتبط بهذا القسط
        $order = $installment->sale->order;

        // التحقق مما إذا كان المستخدم الحالي هو صاحب الطلب
        if (auth()->id() !== $order->user_id) {
            return response()->json(['error' => 'غير مصرح لك بتعديل هذا القسط'], 403);
        }


     /*
        if ($order->processing_stage === 'تم إرسال التصميم النهائي مع العقد وتفاصيل الدفعة الأولى') {
            $order->processing_stage = 'تم الاطلاع على تفاصيل الدفعة الأولى من قبل الزبون';
            $order->save();
        }
        if ($order->processing_stage === 'تم تسديد الدفعة الأولى وإرسال تفاصيل الدفعة الثانية') {
            $order->processing_stage = 'تم الاطلاع على تفاصيل الدفعة الثانية من قبل الزبون';
            $order->save();
        }
        if ($order->processing_stage === 'تم استلام الدفعة الثانية وإرسال تفاصيل الدفعة الثالثة') {
            $order->processing_stage = 'تم الاطلاع على تفاصيل الدفعة الثالثة من قبل الزبون';
            $order->save();
        }
     */



        // تحديث حالة القسط إلى "awaiting_customer_payment"
        $installment->status = 'awaiting_customer_payment';
        $installment->save();

        return response()->json(['success' => 'تم تحديث حالة القسط بنجاح']);
    }



    public function uploadReceipt(Request $request, $id)
    {

        try {

            $installment = Installment::find($id);
            $designer = $installment->sale->order->designer ;
            $order = $installment->sale->order;

            // التحقق مما إذا كان القسط موجودًا
            if (!$installment) {
                return redirect()->back()->with('error', 'القسط غير موجود');
            }

            // جلب الطلب المرتبط بهذا القسط


            // التحقق مما إذا كان المستخدم الحالي هو صاحب الطلب
            if (auth()->id() !== $order->user_id) {
                return redirect()->back()->with('error', 'غير مصرح لك بتعديل هذا القسط');
            }

            // التحقق من وجود الملف وصلاحيته
            $request->validate([
                'payment_receipt' => 'required|file|mimes:jpeg,png,pdf,webp,jpg'
            ]);

            // تخزين الملف
            $path = $request->file('payment_receipt')->store('payment_receipts', 'public');
            $installment->payment_receipt = $path;

            // تحديث الحالة
            if ($installment->status === 'awaiting_customer_payment') {
                $installment->status = 'receipt_uploaded';
                $installment->save();

            }
            if ($order->processing_stage === 'تم إرسال التصميم النهائي مع العقد وتفاصيل الدفعة الأولى') {
                $order->processing_stage = 'تم إرسال إيصال الدفعة الأولى من قبل الزبون';
                $order->save();
            }
            if ($order->processing_stage === 'تم تسديد الدفعة الأولى وإرسال تفاصيل الدفعة الثانية') {
                $order->processing_stage = 'تم إرسال إيصال الدفعة الثانية من قبل الزبون';
                $order->save();
            }
            if ($order->processing_stage === 'تم استلام الدفعة الثانية وإرسال تفاصيل الدفعة الثالثة') {
                $order->processing_stage = 'تم إرسال إيصال الدفعة الثالثة من قبل الزبون';
                $order->save();
            }
            $designer->notify(new PaymentReceiptUploaded($order, $installment, $designer));


            return redirect()->back()->with('success', ' تم تحديث الحالة بنجاح.');

        } catch (\Exception $e) {
            // التعامل مع الاستثناءات
            return redirect()->back()->with('error', 'حدث خطأ غير متوقع: ' . $e->getMessage());
        }
    }

}
