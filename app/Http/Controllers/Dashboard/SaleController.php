<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Installment;

class SaleController extends Controller
{


    public function index()
    {
        // جلب المستخدم الحالي
        $user = auth()->user();

        // التحقق مما إذا كان المستخدم "مدير منطقة"
        if ($user->role === 'Area manager') {
            $regionId = $user->region_id;

            // جلب كل المبيعات المرتبطة بالطلبات التي تقع ضمن منطقته
            $sales = Sale::with(['order.user', 'order.region', 'order.designer', 'installments'])
                ->whereHas('order', function ($query) use ($regionId) {
                    $query->where('region_id', $regionId);
                })
                ->orderBy('created_at', 'desc') // ✅ ترتيب تنازلي حسب الأحدث
                ->get();
        } else {
            // جلب جميع المبيعات بدون تصفية مع الترتيب التنازلي
            $sales = Sale::with(['order.user', 'order.region', 'order.designer', 'installments'])
                ->orderBy('created_at', 'desc') // ✅ ترتيب تنازلي حسب الأحدث
                ->get();
        }

        // حساب إجمالي عدد المبيعات
        $saleCount = $sales->count();

        // جلب الإشعارات غير المقروءة للمستخدم
        $notifications = $user->unreadNotifications;

        // تمرير البيانات إلى واجهة المستخدم
        return view('dashboard.sales.index', compact('sales', 'saleCount', 'notifications'));
    }



    public function edit(Sale $sale)
    {    $user = auth()->user();
        $notifications = $user->unreadNotifications;


        if ($user->role === 'Area manager' && $user->region_id !== $sale->order->region_id) {
            abort(403, 'غير مسموح لك بالوصول إلى هذا الطلب.');
        }
        return view('dashboard.sales.edit', compact('sale','notifications'));
    }

    public function update(Request $request, Sale $sale)
    {
        try {
            // منع التعديل عند اكتمال البيع
            if ($sale->status == 'completed') {
                return redirect()->route('dashboard.sales.index')->with('error', '🚫 لا يمكن تعديل هذه المبيعات لأنها مكتملة.');
            }
            $user = auth()->user();
            $notifications = $user->unreadNotifications;


            if ($user->role === 'Area manager' && $user->region_id !== $sale->order->region_id) {
                abort(403, 'غير مسموح لك بالوصول إلى هذا الطلب.');
            }

            // التحقق من صحة البيانات المدخلة
            $request->validate([
                'total_cost' => 'required|numeric',
                'price_after_discount' => 'required|numeric',
                'discount_percentage' => 'required|numeric',
                'installments.*.installment_amount' => 'required|numeric',
                'installments.*.percentage' => 'required|numeric',
                'installments.*.due_date' => 'nullable|date',
                'installments.*.status' => 'required|string|in:pending,paid,overdue,awaiting_customer_payment,receipt_uploaded',
            ]);

            // تحديث بيانات المبيع
            $sale->update([
                'total_cost' => $request->total_cost,
                'price_after_discount' => $request->price_after_discount,
                'discount_percentage' => ($request->total_cost > 0)
                    ? (($request->total_cost - $request->price_after_discount) / $request->total_cost) * 100
                    : 0,
            ]);

            // تحديث بيانات الأقساط المرتبطة
            foreach ($request->installments as $installmentId => $installmentData) {
                $installment = Installment::find($installmentId);
                if ($installment) {
                    $installment->update([
                        'installment_amount' => $installmentData['installment_amount'],
                        'percentage' => ($request->price_after_discount > 0)
                            ? ($installmentData['installment_amount'] / $request->price_after_discount) * 100
                            : 0,
                        'due_date' => $installmentData['due_date'],
                        'status' => $installmentData['status'],
                    ]);
                }
            }

            return redirect()->route('dashboard.sales.index')->with('success', '✅ تم تحديث بيانات المبيع والدفعات بنجاح!');

        } catch (\Exception $e) {
            return redirect()->route('dashboard.sales.edit', ['sale' => $sale->id])
                ->with('error', '❌ حدث خطأ أثناء تحديث المبيع: ' . $e->getMessage());

        }
    }






}
