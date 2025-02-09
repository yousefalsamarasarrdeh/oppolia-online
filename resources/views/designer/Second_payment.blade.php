@extends('layouts.designer.mainlayout')

@section('title', 'استبيان الطلب')

@section('content')
    @php
        $sale = $order->sale;
        $installments = $sale ? $sale->installments : collect();

        // حساب 50% من التكلفة بعد الخصم
        $halfPrice = $sale ? ($sale->price_after_discount * 0.50) : 0;

        // حساب مجموع الأقساط السابقة
        $totalPaidInstallments = $installments->sum('installment_amount');

        // حساب المبلغ الجديد المطلوب ليصل إلى 50% من السعر بعد الخصم
        $remainingAmount = $halfPrice - $totalPaidInstallments;
    @endphp
    <div class="container">
        <h2>تفاصيل الطلب رقم: {{ $order->id }}</h2>

        <div class="card">
            <div class="card-body">
                <h4>تفاصيل المبيعات</h4>
                @if($sale)
                    <p><strong>إجمالي التكلفة </strong> {{ number_format($sale->total_cost, 2) }}</p>
                    <p><strong>إجمالي التكلفة بعد الخصم:</strong> {{ number_format($sale->price_after_discount, 2) }}</p>

                    <p><strong>المبلغ المدفوع بالدفعات السابقة:</strong> {{ number_format($totalPaidInstallments, 2) }}</p>
                @else
                    <p>لم يتم تسجيل عملية بيع لهذا الطلب بعد.</p>
                @endif
            </div>
        </div>

        @if($installments->isNotEmpty())
            <div class="mt-4">
                <h4>الدفعات</h4>
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
            <h4>إضافة دفعة جديد</h4>
            <form action="{{ route('sales.installments.store', $sale->id) }}" method="POST">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">

                <div class="mb-3">
                    <label for="installment_amount" class="form-label">المبلغ (يتم حسابه تلقائيًا)</label>
                    <input type="number" id="installment_amount" name="installment_amount" class="form-control" value="{{ $remainingAmount }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="percentage" class="form-label">النسبة (يتم حسابها تلقائيًا)</label>
                    <input type="number" id="percentage" name="percentage" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">إضافة القسط</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let installmentAmountInput = document.getElementById("installment_amount");
            let percentageInput = document.getElementById("percentage");

            let totalCostAfterDiscount = {{ $sale->price_after_discount }};
            let halfCost = totalCostAfterDiscount * 0.50;
            let totalPaidInstallments = {{ $totalPaidInstallments }};

            let remainingAmount = halfCost - totalPaidInstallments;
            installmentAmountInput.value = remainingAmount.toFixed(2);

            // حساب النسبة الجديدة بناءً على المبلغ المطلوب
            let newPercentage = (remainingAmount / totalCostAfterDiscount) * 100;
            percentageInput.value = newPercentage.toFixed(2);
        });
    </script>
@endsection
