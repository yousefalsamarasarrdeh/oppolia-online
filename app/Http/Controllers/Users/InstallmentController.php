<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Installment;

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



        if ($order->processing_stage === 'stage_seven') {
            $order->processing_stage = 'stage_eight';
            $order->save();
        }
        if ($order->processing_stage === 'stage_nine') {
            $order->processing_stage = 'stage_ten';
            $order->save();
        }
        if ($order->processing_stage === 'stage_eleven') {
            $order->processing_stage = 'stage_twelve';
            $order->save();
        }



        // تحديث حالة القسط إلى "awaiting_customer_payment"
        $installment->status = 'awaiting_customer_payment';
        $installment->save();

        return response()->json(['success' => 'تم تحديث حالة القسط بنجاح']);
    }

}
