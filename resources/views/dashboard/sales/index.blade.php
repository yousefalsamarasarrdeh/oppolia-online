@extends('layouts.Dashboard.mainlayout')

@section('title', 'Sale Management')
@section('css')

    <style>
        /* زيادة حجم رأس الجدول */
        th {
            padding: 12px; /* مسافة داخلية أكبر */
            font-size: 16px; /* تكبير الخط */
            text-align: center; /* توسيط النص */
        }

        /* ضبط عرض الأعمدة */
        .mysize {
            min-width: 150px; /* عرض أعمدة مناسب */
        }

        /* جعل الجدول يحتوي على تمرير أفقي */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* منع النصوص من الانكسار داخل الجدول */
        table {
            min-width: 1200px; /* ضمان تمرير أفقي عند الحاجة */
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">📊 قائمة المبيعات</h2>

        <!-- إحصائيات -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">📊 إجمالي المبيعات</h5>
                <p class="card-text"><strong>{{ $saleCount }}</strong> مبيعات</p>
            </div>
        </div>

        <!-- جدول المبيعات -->
        <div class="table-responsive">
            <table class=" table-bordered table-hover table datatable">
                <thead >
                <tr>
                    <th class="mysize">#</th>
                    <th class="mysize">رقم الطلب</th>
                    <th class="mysize">اسم العميل</th>
                    <th class="mysize">المنطقة</th>
                    <th class="mysize">المصمم</th>
                    <th class="mysize">التكلفة الإجمالية</th>
                    <th class="mysize">السعر بعد الخصم</th>
                    <th class="mysize">المبلغ المدفوع</th>
                    <th class="mysize">عدد الدفعات</th>
                    <th class="mysize">نسبة الدفع</th>
                    <th class="mysize">نسبة الخصم</th>

                    <th>حالة البيع</th>
                    <th>تاريخ الإنشاء</th>
                    <th>تاريخ التحديث</th>
                    <th>الإجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->order->id ?? 'غير متوفر' }}</td>
                        <td>{{ $sale->order->user->name ?? 'غير متوفر' }}</td>
                        <td>{{ $sale->order->region->name_ar ?? 'غير متوفر' }}</td>
                        <td>{{ $sale->order->designer->user->name ?? 'غير متوفر' }}</td>
                        <td>{{ number_format($sale->total_cost, 2) }} ريال</td>
                        <td>{{ number_format($sale->price_after_discount, 2) }} ريال </td>
                        <td>{{ number_format($sale->amount_paid, 2) }} ريال</td>
                        <td>{{ $sale->installments_count }}</td>
                        <td>{{ $sale->paid_percentage }}%</td>
                        <td>{{ $sale->discount_percentage }}%</td>

                        <td>
                                <span class="badge
                                    @if($sale->status == 'pending') bg-warning
                                    @elseif($sale->status == 'completed') bg-success
                                    @elseif($sale->status == 'canceled') bg-danger
                                    @else bg-secondary @endif">
                                    {{ __($sale->status) }}
                                </span>
                        </td>
                        <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                        <td>{{ $sale->updated_at->format('Y-m-d') }}

                        <td>
                            <a href="{{ route('dashboard.sales.edit', $sale->id) }}" class="btn btn-primary btn-sm">
                                ✏️ تعديل الأسعار
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- زرار التنقل بين الصفحات -->

    </div>
@endsection
