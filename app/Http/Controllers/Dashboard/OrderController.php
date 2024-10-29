<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Designer;
use App\Models\Region;

class OrderController extends Controller
{
    public function index()
    {
        // استرجاع جميع الطلبات مع علاقاتها
        $orders = Order::with(['user', 'region', 'designer'])->get();
        $orderCount = Order::count();

        // جلب قائمة المصممين والمناطق للفلترة
        $designers = Designer::withCount('orders')->get(); // حساب عدد الطلبات لكل مصمم
        $regions = Region::withCount('orders')->get();     // حساب عدد الطلبات لكل منطقة

        // تمرير المتغيرات إلى الفيو
        return view('dashboard.orders.index', compact('orders', 'orderCount', 'designers', 'regions'));
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
}
