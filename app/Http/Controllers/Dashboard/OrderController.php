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
}
