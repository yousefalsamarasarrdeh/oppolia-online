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
use Illuminate\Support\Facades\DB;

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

        $notifications = auth()->user()->unreadNotifications;

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
        if (!$request->ajax()) {
            abort(404);
        }

        // جلب الطلبات مع العلاقات
        $data = Order::with(['user', 'region', 'subRegion', 'designer.user'])
            ->select('orders.*')
            ->orderBy('created_at', 'desc');

        // إذا كان المستخدم مدير منطقة، يتم تصفية الطلبات بناءً على منطقته
        if (auth()->user()->role === 'Area manager') {
            $regionId = auth()->user()->region_id;
            $data->where('region_id', $regionId);
        }

        return DataTables::of($data)
            // ✅ فلترة مخصصة لتفعيل البحث على الأعمدة المحسوبة والعلاقات
            ->filter(function ($query) use ($request) {
                $search = $request->input('search.value');
                if (!$search) {
                    return;
                }

                $search = trim($search);

                $query->where(function ($q) use ($search) {
                    // حقول من جدول orders
                    $q->where('orders.id', 'like', "%{$search}%")
                        ->orWhere('orders.geocode_string', 'like', "%{$search}%")
                        ->orWhere('orders.processing_stage', 'like', "%{$search}%");

                    // دعم البحث بالعربي/الإنجليزي لحالة الطلب
                    $statusMap = [
                        'قيد' => 'pending',
                        'الانتظار' => 'pending',
                        'pending' => 'pending',
                        'مقبول' => 'accepted',
                        'accepted' => 'accepted',
                        'مرفوض' => 'rejected',
                        'rejected' => 'rejected',
                        'مغلق' => 'closed',
                        'closed' => 'closed',
                    ];
                    foreach ($statusMap as $needle => $status) {
                        if (mb_stripos($search, $needle) !== false) {
                            $q->orWhere('orders.order_status', $status);
                            break;
                        }
                    }

                    // علاقات: user / region / subRegion / designer.user
                    $q->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    })
                        ->orWhereHas('region', function ($rq) use ($search) {
                            $rq->where('name_ar', 'like', "%{$search}%");
                        })
                        ->orWhereHas('subRegion', function ($sq) use ($search) {
                            $sq->where('name_ar', 'like', "%{$search}%");
                        })
                        ->orWhereHas('designer.user', function ($dq) use ($search) {
                            $dq->where('name', 'like', "%{$search}%");
                        });
                });
            })

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
                    'pending'  => 'قيد الانتظار',
                    'accepted' => 'مقبول',
                    'rejected' => 'مرفوض',
                    'closed'   => 'مغلق',
                ];
                return $statusLabels[$row->order_status] ?? 'غير معروف';
            })
            ->addColumn('action', function ($row) {
                // روابط وأيقونات
                $showUrl    = route('admin.order.show', $row->id);       // عدّل إن لزم
                $deleteUrl  = route('admin.orders.destroy', $row->id);    // عدّل إن لزم
                $viewIcon   = asset('Dashboard/assets/images/view.png');
                $deleteIcon = asset('Dashboard/assets/images/delete.png'); // أيقونة الحذف

                // زر العرض (أيقونة)
                $html = '
                <a href="' . e($showUrl) . '" class="btn btn-sm" title="عرض">
                    <button type="button" class="btn btn-info bg-transparent border-0">
                        <img src="' . e($viewIcon) . '" alt="View">
                    </button>
                </a>
            ';

                // زر الحذف يظهر فقط للـ admin و Sales manager
                $role = strtolower(trim(auth()->user()->role));
                if (in_array($role, ['admin', 'sales manager', 'sales_manager'])) {
                    $html .= '
                    <form action="' . e($deleteUrl) . '" method="POST" class="d-inline-block js-delete-form" data-order-id="' . e($row->id) . '">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn bg-transparent border-0 js-delete-btn" title="حذف">
                            <img src="' . e($deleteIcon) . '" alt="Delete">
                        </button>
                    </form>
                ';
                }

                return $html;
            })
            ->rawColumns(['action']) // تفعيل HTML في عمود "خيارات"
            ->make(true);
    }





    public function destroy(Order $order)
    {
        // تحقّق الصلاحية: فقط admin أو sales manager
        $role = strtolower(trim(auth()->user()->role));
        if (! in_array($role, ['admin', 'sales manager', 'sales_manager'])) {
            abort(403, 'ليس لديك صلاحية الحذف.');
        }

        DB::transaction(function () use ($order) {
            // 1) حذف العلاقات التابعة
            optional($order->designerMeeting)->forceDelete();
            optional($order->surveyQuestion)->forceDelete();

            foreach ($order->orderDraft as $draft) {
                $draft->forceDelete();
            }

            optional($order->sale)->forceDelete();

            // 2) حذف الإشعارات المرتبطة بالطلب (بالاعتماد على وجود order_id داخل data)
            // هذا يحذف أي Notification محفوظ في جدول notifications يحمل data->order_id == $order->id
            DB::table('notifications')
                ->whereJsonContains('data->order_id', (int) $order->id)
                ->delete();

            // ملاحظة: لو عندك أنواع إشعارات مختلفة وما كلها فيها order_id،
            // إمّا توحّد الـ payload على "order_id"، أو تضيف شروط إضافية حسب "type".

            // 3) حذف الطلب نفسه حذف نهائي
            $order->forceDelete();
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'تم حذف الطلب وكل ما يرتبط به (بما في ذلك الإشعارات) بنجاح.');
    }


}
