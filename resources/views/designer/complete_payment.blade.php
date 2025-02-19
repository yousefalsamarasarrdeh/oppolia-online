@extends('layouts.designer.mainlayout')

@section('title', 'دفعة الطلب الثالثة')

@section('content')
    @php
        $sale = $order->sale;
        $installments = $sale ? $sale->installments : collect();

        // حساب مجموع الدفعات الأولى والثانية فقط

    @endphp
    <div class="container">
        <h2>تفاصيل الطلب رقم: {{ $sale->order->id }}</h2>

        <div class="card">
            <div class="card-body">
                <h4>تفاصيل المبيعات</h4>
                @if($sale)
                    <p><strong>إجمالي التكلفة:</strong> {{ number_format($sale->total_cost, 2) }}</p>
                    <p><strong>إجمالي التكلفة بعد الخصم:</strong> {{ number_format($sale->price_after_discount, 2) }}</p>
                @else
                    <p>لم يتم تسجيل عملية بيع لهذا الطلب بعد.</p>
                @endif
            </div>
        </div>

        @if($installments->isNotEmpty())
            <div class="mt-4">
                <h4>الدفعات  السابقة</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>المبلغ</th>
                        <th>النسبة</th>
                        <th>تاريخ الاستحقاق</th>
                        <th>الحالة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($installments as $installment)
                        <tr>
                            <td>{{ $installment->installment_number }}</td>
                            <td>{{ number_format($installment->installment_amount, 2) }}</td>
                            <td>{{ $installment->percentage }}%</td>
                            <td>{{ $installment->due_date }}</td>
                            <td>{{ $installment->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>لا توجد أقساط مسجلة حتى الآن.</p>
        @endif

        <div class="mt-4">
            <h4>إنهاء الدفعات وتحديث الحالة</h4>

            <a href="{{ route('sales.completeOrder', $sale->id) }}" class="btn btn-success">
                <i class="fas fa-check"></i> اكتمال العملية
            </a>
        </div>
    </div>


@endsection
