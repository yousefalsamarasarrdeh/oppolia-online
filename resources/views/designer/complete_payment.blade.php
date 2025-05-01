@extends('layouts.designer.mainlayout')

@section('title', 'دفعة الطلب الثالثة')

@section('content')
    @php
        $sale = $order->sale;
        $installments = $sale ? $sale->installments : collect();
        $installment3=$installments->firstWhere('installment_number', 3)

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
                <div style="overflow-x: auto; width: 100%;">
                <table class="table table-bordered" style="min-width: 800px;">
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
            </div>
        @else
            <p>لا توجد أقساط مسجلة حتى الآن.</p>
        @endif

        @if($installments->isNotEmpty() && $installments->firstWhere('installment_number', 3) && $installments->firstWhere('installment_number', 3)->status == 'receipt_uploaded')
            <div class="card mt-4">
                <div class="card-body">
                    <h4>مراجعة دفعة الثالثة</h4>
                    <p>تم تحميل إيصال الدفع. انظر الإيصال أدناه:</p>
                    <!-- Display the payment receipt if available -->
                    @php
                        $installmentThree = $installments->firstWhere('installment_number', 3);
                    @endphp
                    @if ($installmentThree && $installmentThree->payment_receipt)
                        @php
                            $filePath = 'storage/' . $installmentThree->payment_receipt;
                            $extension = strtolower(pathinfo($installmentThree->payment_receipt, PATHINFO_EXTENSION));
                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                            $isPDF = $extension === 'pdf';
                        @endphp

                        <div class="document-preview mb-4">
                        @if($isImage)
                            <!-- عرض الصورة مع تفاعلية التكبير -->
                                <div class="image-preview-container text-center">
                                    <img src="{{ asset($filePath) }}"
                                         alt="إيصال الدفع"
                                         class="preview-image img-thumbnail"
                                         data-bs-toggle="modal"
                                         data-bs-target="#receiptModal-{{ $installmentThree->id }}">
                                    <p class="text-muted mt-2">انقر على الصورة للمعاينة الكاملة</p>

                                    <!-- Modal للعرض الكامل -->
                                    <div class="modal fade" id="receiptModal-{{ $installmentThree->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">إيصال الدفع</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset($filePath) }}" class="img-fluid" alt="إيصال الدفع">
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ asset($filePath) }}" download class="btn btn-primary">
                                                        <i class="fas fa-download"></i> تنزيل الصورة
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @elseif($isPDF)
                            <!-- عرض PDF مع خيارات متقدمة -->
                                <div class="pdf-preview-container">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5><i class="fas fa-file-pdf text-danger"></i> مستند PDF</h5>

                                    </div>
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ asset($filePath) }}#toolbar=0&navpanes=0"
                                                class="border rounded"
                                                allowfullscreen>
                                            المتصفح الخاص بك لا يدعم معاينة PDF.
                                        </iframe>
                                    </div>
                                </div>
                        @else
                            <!-- عرض ملفات أخرى -->
                                <div class="file-download-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-alt fa-2x text-secondary"></i>
                                                    <span class="ms-2">ملف مرفق (.{{ $extension }})</span>
                                                </div>
                                                <a href="{{ asset($filePath) }}" download class="btn btn-primary">
                                                    <i class="fas fa-download"></i> تنزيل الملف
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="row m-2">
                        <div class="col-md-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn  btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                رفض
                            </button>
                        </div>
                        <div class="col-md-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn button_Green " data-bs-toggle="modal" data-bs-target="#acceptModal">
                                قبول
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($installments->isNotEmpty() && $installments->firstWhere('installment_number', 3) && $installments->firstWhere('installment_number', 3)->status == 'paid')
        <div class="mt-4">
            <h4>إنهاء الدفعات وتحديث الحالة</h4>

            <a href="{{ route('sales.completeOrder', $sale->id) }}" class="btn btn-success">
                <i class="fas fa-check"></i> اكتمال العملية
            </a>
        </div>
        @endif
    </div>


    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">تأكيد الرفض</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد رفض هذه الدفعة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('installments.update.status', [$installment3->id, 'awaiting_customer_payment']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="awaiting_customer_payment">
                        <button type="submit" class="btn  btn-outline-danger">تأكيد الرفض</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Accept Modal -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptModalLabel">تأكيد القبول</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد قبول هذه الدفعة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('installments.update.status', [$installment3->id, 'paid']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="btn button_Green ">تأكيد القبول</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
