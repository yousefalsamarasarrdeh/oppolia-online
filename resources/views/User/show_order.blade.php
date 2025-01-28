@extends('layouts.Frontend.mainlayoutfrontend')
@section('content')

    <!-- عرض رسالة النجاح -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- عرض رسالة الخطأ -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <!-- عرض رسائل التحقق من الأخطاء لكل حقل -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container" dir="rtl">
        <h1>تفاصيل الطلب</h1>
        <table class="table">
            <tr>
                <th>رقم الطلب:</th>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <th>مساحة المطبخ:</th>
                <td>{{ $order->kitchen_area }} متر مربع</td>
            </tr>
            <tr>
                <th>شكل المطبخ:</th>
                <td>{{ $order->kitchen_shape }}</td>
            </tr>
            <tr>
                <th>ستايل المطبخ:</th>
                <td>{{ $order->kitchen_style }}</td>
            </tr>
            <tr>
                <th>التكلفة المتوقعة:</th>
                <td>{{ $order->expected_cost }} ريال</td>
            </tr>
            <tr>
                <th>المدى الزمني:</th>
                <td>{{ $order->time_range }}</td>
            </tr>
            <tr>
                <th>حالة الطلب:</th>
                <td>{{ $order->order_status }}</td>
            </tr>
        </table>

        <h2>تفاصيل المسودات</h2>
        @if ($orderDraft->isNotEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th>رقم المسودة</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                    <th>ملفات الصور</th>
                    <th>ملف PDF</th>
                    @if ($order->processing_stage != 'stage_six')
                        <th>إجراءات</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($orderDraft as $draft)
                    <tr>
                        <td>{{ $draft->id }}</td>
                        <td>{{ $draft->price }} ريال</td>
                        <td>{{ $draft->state }}</td>
                        <td>
                            @if($draft->images)
                                @foreach(json_decode($draft->images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Draft Image" style="width: 100px;">
                                @endforeach
                            @else
                                لا توجد صور
                            @endif
                        </td>
                        <td>
                            @if($draft->pdf)
                                <a href="{{ asset('storage/' . $draft->pdf) }}" target="_blank">عرض PDF</a>
                            @else
                                لا يوجد ملف PDF
                            @endif
                        </td>
                        <td>
                            @if($draft->state === 'finalized')
                                <form action="#" method="POST" style="display:inline;">
                                    @csrf

                                </form>
                            @else
                                @if ($order->processing_stage != 'stage_six')
                                    <form action="{{ route('order.acceptDraft', ['order' => $order->id, 'draft' => $draft->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">قبول التصميم</button>
                                    </form>
                                    <form action="{{ route('order.redesignDraft', ['order' => $order->id, 'draft' => $draft->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">إعادة التصميم</button>
                                    </form>
                                    <form action="{{ route('order.changeDesigner', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">تغيير المصمم</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>لا توجد مسودات مرتبطة بهذا الطلب.</p>
        @endif

    <!-- تفاصيل المبيعات -->
        <h2>تفاصيل المبيعات</h2>
        @if ($order->sale)
            <table class="table">
                <tr>

                </tr>
                <tr>
                    <th>التكلفة الإجمالية:</th>
                    <td>{{ $order->sale->total_cost }} ريال</td>
                </tr>
                <tr>
                    <th>السعر بعد الخصم:</th>
                    <td>{{ $order->sale->price_after_discount }} ريال</td>
                </tr>
                <tr>
                    <th>نسبة الخصم:</th>
                    <td>{{ $order->sale->discount_percentage }}%</td>
                </tr>
                <tr>
                    <th>المبلغ المدفوع:</th>
                    <td>{{ $order->sale->amount_paid }} ريال</td>
                </tr>
                <tr>
                    <th>الحالة:</th>
                    <td>{{ $order->sale->status }}</td>
                </tr>
            </table>

            <!-- تفاصيل الأقساط -->
            <h3>تفاصيل الدفعات</h3>
            @if ($order->sale->installments->isNotEmpty())
                <table class="table">
                    <thead>
                    <tr>
                        <th>المبلغ</th>
                        <th>النسبة</th>
                        <th>تاريخ الاستحقاق</th>
                        <th>الحالة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->sale->installments as $installment)
                        <tr>

                            <td>{{ $installment->installment_amount }} ريال</td>
                            <td>{{ $installment->percentage }}%</td>
                            <td>{{ $installment->due_date }}</td>
                            <td>{{ $installment->status }}</td>

                            @if ($installment->status === 'pending')
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#purchaseModal"
                                        data-installment-id="{{ $installment->id }}"
                                        data-installment-amount="{{ $installment->installment_amount }}"
                                        data-installment-due-date="{{ $installment->due_date }}">
                                        شراء
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else

            @endif
        @else
            <p>لا توجد مبيعات مرتبطة بهذا الطلب.</p>
        @endif
    </div>










    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">شروط وأحكام الشراء</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>لإتمام عملية الشراء، يجب قراءة الشروط والأحكام والموافقة عليها.</p>
                    <p>

                    </p>
                    <a href="" target="_blank">عرض الشروط والأحكام</a>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="agreeCheckbox">
                        <label class="form-check-label" for="agreeCheckbox">
                            أوافق على الشروط والأحكام
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="" method="POST" id="purchaseForm">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="confirmButton" disabled>تأكيد الشراء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
