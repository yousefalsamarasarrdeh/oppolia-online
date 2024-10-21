<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Designer;
use App\Notifications\OrderCreated;
use App\Models\Region;
use Illuminate\Support\Facades\Auth; // استدعاء Auth
use Illuminate\Support\Facades\Log;  // استدعاء Log



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
                'geocode_string' => 'required|string',
            ]);

            // جلب المنطقة بناءً على الاسم الإنجليزي
            $region = Region::where('name_en', $request->region_name)->first();

            if (!$region) {
                return redirect()->route('orders.create')->with('error', 'لم يتم العثور على المنطقة المطلوبة.');
            }

            // إنشاء الطلب
            $order = Order::create([
                'user_id' => auth()->id(), // id المستخدم الذي طلب الطلب
                'region_id' => $region->id,
                'kitchen_area' => $request->kitchen_area,
                'kitchen_shape' => $request->kitchen_shape,
                'kitchen_type' => $request->kitchen_type,
                'expected_cost' => $request->expected_cost,
                'time_range' => $request->time_range,
                'kitchen_style' => $request->kitchen_style,
                'meeting_time' => $request->meeting_time,
                'length_step' => $request->length_step,
                'width_step' => $request->width_step,
                'geocode_string' => $request->geocode_string, // إضافة geocode_string هنا
                'order_status' => 'pending', // حالة الطلب الافتراضية
                'processing_stage' => 'stage_one',  // مرحلة الطلب الافتراضية
            ]);

            // جلب جميع المصممين في نفس المنطقة
            $designers = Designer::join('users', 'designers.user_id', '=', 'users.id')
                ->where('users.region_id', $region->id)
                ->select('designers.*')
                ->get();



            // إرسال إشعار لكل مصمم في نفس المنطقة
            foreach ($designers as $designer) {
                $designer->notify(new OrderCreated($order, $designer));
            }

            // إعادة التوجيه بعد نجاح الطلب
            return redirect()->route('orders.create')->with('success', 'تم تقديم طلبك بنجاح وتم إرسال إشعار للمصممين في نفس المنطقة!');

        } catch (\Exception $e) {
            // التعامل مع الأخطاء
            return redirect()->route('orders.create')->with('error', 'خطأ: ' . $e->getMessage());
        }
    }


    public function myOrders()
    {
    try {
        // Get the current authenticated user
        $user = Auth::user();

        // Get all orders for the current user
        $orders = Order::where('user_id', $user->id)->get();

        // Return the view with the orders
        return view('User.my_orders', compact('orders'));
     } catch (\Exception $e) {
        // Log the error for debugging purposes
        Log::error('Error fetching user orders: '.$e->getMessage());

        // Return a view with an error message
        return back()->with('error', 'حدث خطأ أثناء محاولة جلب طلباتك، يرجى المحاولة لاحقاً.');
      }
    }

    public function show($orderId)
    {
        // جلب الطلب بناءً على الـ ID
        $order = Order::with('orderDraft')->findOrFail($orderId);

        // تحقق ما إذا كانت هناك مسودة مرتبطة بالطلب
        $orderDraft = $order->orderDraft;

        return view('User.show_order', compact('order', 'orderDraft'));
    }



}
