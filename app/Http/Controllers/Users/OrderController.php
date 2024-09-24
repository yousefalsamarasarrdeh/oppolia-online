<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Designer;
use App\Notifications\OrderCreated;

class OrderController extends Controller
{
    public function create()
    {
        return view('user.order_create');
    }

    // حفظ الطلب المقدم
    public function store(Request $request)
    {
        try {
            // التحقق من البيانات
            $request->validate([
                'kitchen_area' => 'required|numeric',
                'kitchen_shape' => 'required|string',
                'kitchen_type' => 'required|in:قديم,جديد',
                'expected_cost' => 'required|numeric',
                'time_range' => 'required|string',
                'kitchen_style' => 'required|string',
                'meeting_time' => 'required|date',
                'length_step' => 'required|numeric',
                'width_step' => 'required|numeric',
            ]);

            // إنشاء الطلب
            $order = Order::create([
                'user_id' => auth()->id(), // id المستخدم الذي طلب الطلب
                'kitchen_area' => $request->kitchen_area,
                'kitchen_shape' => $request->kitchen_shape,
                'kitchen_type' => $request->kitchen_type,
                'expected_cost' => $request->expected_cost,
                'time_range' => $request->time_range,
                'kitchen_style' => $request->kitchen_style,
                'meeting_time' => $request->meeting_time,
                'length_step' => $request->length_step,
                'width_step' => $request->width_step,
                'order_status' => 'pending', // حالة الطلب الافتراضية
                'processing_stage' => 'stage_one',  // مرحلة الطلب الافتراضية
            ]);

            // جلب جميع المصممين
            $designers = Designer::all();

            // إرسال إشعار لكل مصمم
            foreach ($designers as $designer) {
                $designer->notify(new OrderCreated($order, $designer));
            }

            // إعادة التوجيه بعد نجاح الطلب
            return redirect()->route('orders.create')->with('success', 'تم تقديم طلبك بنجاح وتم إرسال إشعار للمصممين!');

        } catch (\Exception $e) {
            // التعامل مع الأخطاء
            return redirect()->route('orders.create')->with('error', 'خطأ: ' . $e->getMessage());
        }
    }

}
