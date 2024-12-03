<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Designer;
use App\Models\Region;
use App\Notifications\DesignerAssigned;

class OrderController extends Controller
{
    public function index()
    {
        // Check if the user is an Area Manager
        if (auth()->user()->role === 'Area manager') {
            // Get the region of the Area Manager
            $regionId = auth()->user()->region_id;

            // Retrieve only orders within the Area Manager's region
            $orders = Order::with(['user', 'region', 'designer'])
                ->where('region_id', $regionId)
                ->get();
        } else {
            // If not an Area Manager, retrieve all orders
            $orders = Order::with(['user', 'region', 'designer'])->get();
        }

        // Count total orders
        $orderCount = $orders->count();

        // Get list of designers and regions for filtering
        $designers = Designer::withCount('orders')->get(); // Count orders per designer
        $regions = Region::withCount('orders')->get();     // Count orders per region

        $notifications= auth()->user()->unreadNotifications;


        // Pass variables to the view
        return view('dashboard.orders.index', compact('orders', 'orderCount', 'designers', 'regions','notifications'));
    }


    public function filter(Request $request)
    {
        $designerId = $request->input('designer_id');
        $regionId = $request->input('region_id');

        $query = Order::query();

        if ($designerId) {
            $query->where('approved_designer_id', $designerId);
        }

        if ($regionId) {
            $query->where('region_id', $regionId);
        }

        $orders = $query->with(['user', 'region', 'designer'])->get();
        $orderCount = $orders->count();

        // جلب قائمة المصممين والمناطق للفلترة مع حساب عدد الطلبات لكل منهم
        $designers = Designer::withCount('orders')->get();
        $regions = Region::withCount('orders')->get();

        return view('dashboard.orders.index', compact('orders', 'orderCount', 'designers', 'regions'));
    }


    public function show(Order $order, $notificationId)
    {
        // جلب المستخدم الحالي
        $user = auth()->user();
       // $designers=Designer::all();
        $region = $order->region;


        $designers = Designer::whereHas('user.region', function($query) use ($region) {
            $query->where('id', $region->id);
        })->get();



        // جلب الإشعار المحدد بناءً على الـ notificationId وتحديث حالته إلى مقروء
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        // جلب الإشعارات الغير مقروءة
        $notifications = $user->unreadNotifications;

        // عرض صفحة تفاصيل الطلب مع إمكانية القبول أو الرفض
        return view('dashboard.orders.show', [
            'order' => $order,
            'notifications' => $notifications,
            'designers'=> $designers
        ]);
    }

    public function changeDesigner(Request $request, Order $order)
    {

        // التحقق إذا كان الطلب موجودًا والمستخدم لديه الصلاحيات
        $validated = $request->validate([
            'designer_id' => 'required|exists:designers,id', // تحقق من وجود المصمم في قاعدة البيانات
        ]);

        // العثور على المصمم المختار
        $designer = Designer::find($validated['designer_id']);

        // تحديث الـ approved_designer_id في الطلب
        $order->approved_designer_id = $designer->id;
        $order->processing_stage='stage_four';
        $order->order_status='accepted';
        $order->update();

        $designer->notify(new DesignerAssigned($order, $designer));

        // إرجاع إلى صفحة تفاصيل الطلب مع رسالة نجاح
        return redirect()->route('admin.orders.index', $order->id)
            ->with('success', 'تم تغيير المصمم بنجاح!');
    }

}
