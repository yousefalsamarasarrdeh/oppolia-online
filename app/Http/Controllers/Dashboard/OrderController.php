<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Designer;
use App\Models\Region;
use App\Notifications\DesignerAssigned;
use Yajra\DataTables\DataTables;

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


    public function show(Order $order, $notificationId = null)
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
        $order->processing_stage='تم إرسال أسئلة الاستبيان';
        $order->order_status='accepted';
        $order->update();

        $designer->notify(new DesignerAssigned($order, $designer));

        // إرجاع إلى صفحة تفاصيل الطلب مع رسالة نجاح
        return redirect()->route('admin.orders.index', $order->id)
            ->with('success', 'تم تغيير المصمم بنجاح!');
    }


    public function getOrders(Request $request)
    {
        if ($request->ajax()) {
            // جلب الطلبات مع العلاقات
            $data = Order::with(['user', 'region', 'subRegion', 'designer'])
            ->select('orders.*')
            ->orderBy('created_at', 'desc');

            // إذا كان المستخدم مدير منطقة، يتم تصفية الطلبات بناءً على منطقته
            if (auth()->user()->role === 'Area manager') {
                $regionId = auth()->user()->region_id;
                $data = $data->where('region_id', $regionId);
            }

            return DataTables::of($data)
                ->addIndexColumn() // إضافة عمود الترقيم
                ->addColumn('user_name', function ($row) {
                    return $row->user ? $row->user->name : 'N/A'; // جلب اسم المستخدم
                })
                ->addColumn('region_name', function ($row) {
                    return $row->region ? $row->region->name_ar : 'N/A'; // اسم المنطقة
                })
                ->addColumn('sub_region_name', function ($row) {
                    return $row->subRegion ? $row->subRegion->name_ar : 'N/A'; // اسم المنطقة الفرعية
                })
                ->addColumn('designer_name', function ($row) {
                    // الوصول إلى اسم المستخدم الخاص بالمصمم
                    return $row->designer && $row->designer->user
                        ? $row->designer->user->name
                        : 'N/A';
                })
                ->addColumn('order_status_label', function ($row) {
                    $statusLabels = [
                        'pending' => 'قيد الانتظار',
                        'accepted' => 'مقبول',
                        'rejected' => 'مرفوض',
                        'closed' => 'مغلق',
                    ];
                    return $statusLabels[$row->order_status] ?? 'غير معروف';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.order.show', $row->id);

                    return "
                <a href='$editUrl' class='btn btn-sm btn-primary'>عرض</a>
                ";
                })
                ->rawColumns(['action']) // تفعيل HTML في عمود "خيارات"
                ->make(true);
        }
    }



}
