<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DesignerRating;
use App\Models\Designer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DesignerRatingController extends Controller
{
    public function store(Request $request)
    {
        try {
            // التحقق من صحة البيانات المدخلة
            $request->validate([
                'designer_id' => 'required|exists:designers,id',
                'order_id' => 'required|exists:orders,id',
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'required|string|max:255',
            ]);

            // جلب الطلب للتحقق
            $order = Order::findOrFail($request->order_id);

            // ✅ التحقق من أن الطلب لديه مصمم معين
            if (is_null($order->approved_designer_id)) {
                return redirect()->back()->with('error', 'لم يتم تعيين مصمم لهذا الطلب بعد.');
            }

            // ✅ التحقق من أن المستخدم الحالي هو صاحب الطلب
            if ($order->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'لا يمكنك تقييم هذا الطلب، لأنك لست صاحب الطلب.');
            }

            // ✅ التحقق من أن المصمم هو المصمم المعتمد للطلب (مع تحويل إلى int)
            if ((int) $order->approved_designer_id !== (int) $request->designer_id) {
                return redirect()->back()->with('error', 'لا يمكنك تقييم هذا المصمم، لأنه لم يتم تعيينه لهذا الطلب.');
            }

            // ✅ التحقق مما إذا كان المستخدم قد قيّم المصمم لهذا الطلب مسبقًا
            $existingRating = DesignerRating::where('user_id', auth()->id())
                ->where('designer_id', $request->designer_id)
                ->where('order_id', $request->order_id)
                ->first();

            if ($existingRating) {
                return redirect()->back()->with('error', 'لقد قمت بتقييم هذا المصمم مسبقًا.');
            }

            // ✅ إنشاء تقييم جديد
            DesignerRating::create([
                'user_id' => auth()->id(),
                'designer_id' => $request->designer_id,
                'order_id' => $request->order_id,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return redirect()->back()->with('success', 'تم إرسال تقييمك بنجاح!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إرسال التقييم: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // التحقق من صحة البيانات المدخلة
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'required|string|max:255',
            ]);

            // جلب التقييم للتحقق من أن المستخدم هو المالك
            $rating = DesignerRating::findOrFail($id);

            // ✅ التحقق من أن المستخدم هو صاحب التقييم
            if ($rating->user_id !== Auth::id()) {
                return redirect()->back()->with('error', 'لا يمكنك تعديل تقييم شخص آخر.');
            }

            // ✅ تحديث التقييم
            $rating->update([
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return redirect()->back()->with('success', 'تم تحديث التقييم بنجاح!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث التقييم: ' . $e->getMessage());
        }
    }



}
