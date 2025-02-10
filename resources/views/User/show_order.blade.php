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


        @if ($orderDraft->isNotEmpty())
            <h2>تقييم المصمم</h2>

            @php
                // التحقق مما إذا كان المستخدم قد قيّم المصمم سابقًا
                $existingRating = \App\Models\DesignerRating::where('user_id', auth()->id())
                    ->where('designer_id', $order->approved_designer_id)
                    ->where('order_id', $order->id)
                    ->first();
            @endphp

            @if ($existingRating)
            <!-- عرض التقييم السابق -->
                <p><strong>تقييمك:</strong> {{ $existingRating->rating }} ⭐</p>
                <p><strong>تعليقك:</strong> {{ $existingRating->review }}</p>

                <!-- زر تعديل التقييم -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editRatingModal">
                    تعديل التقييم
                </button>

                <!-- مودال تعديل التقييم -->
                <div class="modal fade" id="editRatingModal" tabindex="-1" aria-labelledby="editRatingModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editRatingModalLabel">تعديل التقييم</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('update.designer.rating', $existingRating->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <label for="rating">التقييم (من 1 إلى 5):</label>
                                    <select name="rating" id="rating" required>
                                        <option value="1" {{ $existingRating->rating == 1 ? 'selected' : '' }}>⭐</option>
                                        <option value="2" {{ $existingRating->rating == 2 ? 'selected' : '' }}>⭐⭐</option>
                                        <option value="3" {{ $existingRating->rating == 3 ? 'selected' : '' }}>⭐⭐⭐</option>
                                        <option value="4" {{ $existingRating->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                        <option value="5" {{ $existingRating->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                    </select>

                                    <label for="review">التعليق:</label>
                                    <textarea name="review" id="review" required>{{ $existingRating->review }}</textarea>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <!-- إذا لم يُقيّم المصمم، عرض نموذج التقييم -->
                <form action="{{ route('rate.designer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="designer_id" value="{{ $order->approved_designer_id }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <label for="rating">التقييم (من 1 إلى 5):</label>
                    <select name="rating" id="rating" required>
                        <option value="1">⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                    </select>

                    <label for="review">التعليق:</label>
                    <textarea name="review" id="review" required></textarea>

                    <button type="submit" class="btn btn-primary">إرسال التقييم</button>
                </form>
            @endif
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
                                        data-bs-target="#termsModal"
                                        data-installment-id="{{ $installment->id }}"
                                        data-installment-amount="{{ $installment->installment_amount }}"
                                        data-installment-due-date="{{ $installment->due_date }}">
                                        شراء
                                    </button>
                                </td>
                            @elseif ($installment->status === 'awaiting_customer_payment')
                                <td>
                                    <div class="bank-details">
                                        <p><strong>اسم البنك:</strong> مصرف الراجحي</p>
                                        <p><strong>رقم الحساب:</strong> 123456789012345</p>
                                        <p><strong>رقم الآيبان:</strong> SA1234567890123456789012</p>
                                        <p><strong>العنوان:</strong> الرياض، المملكة العربية السعودية</p>

                                    </div>
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










    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">شروط وأحكام الشراء</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>لإتمام عملية الشراء، يجب قراءة الشروط والأحكام والموافقة عليها.</p>
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
                    <button type="button" class="btn btn-primary" id="confirmTermsButton" disabled>تأكيد الشراء</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true" dir="rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">تفاصيل الدفع</h5>
                    <button type="button" class="btn-close close-payment-modal" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>الرجاء استخدام التفاصيل التالية لإتمام عملية الدفع:</p>
                    <ul>
                        <li><strong>اسم البنك:</strong> مصرف الراجحي</li>
                        <li><strong>رقم الحساب:</strong> 123456789012345</li>
                        <li><strong>رقم الآيبان:</strong> SA1234567890123456789012</li>
                        <li><strong>العنوان:</strong> الرياض، المملكة العربية السعودية</li>
                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-payment-modal" data-bs-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var termsModal = document.getElementById('termsModal');
            var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

            // تفعيل زر تأكيد الشراء بعد الموافقة على الشروط
            document.getElementById("agreeCheckbox").addEventListener("change", function() {
                document.getElementById("confirmTermsButton").disabled = !this.checked;
            });

            // عند الضغط على "تأكيد الشراء"، يتم إغلاق المودال الأول وفتح مودال الدفع
            document.getElementById("confirmTermsButton").addEventListener("click", function() {
                var modalInstance = bootstrap.Modal.getInstance(termsModal);
                modalInstance.hide();
                setTimeout(function() {
                    paymentModal.show();
                }, 500); // تأخير بسيط لضمان الإغلاق قبل الفتح
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
            var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

            // تفعيل زر "تأكيد الشراء" فقط بعد تحديد الموافقة على الشروط
            document.getElementById("agreeCheckbox").addEventListener("change", function() {
                document.getElementById("confirmTermsButton").disabled = !this.checked;
            });

            // عند الضغط على "تأكيد الشراء"، يتم إرسال طلب AJAX لتحديث حالة القسط
            document.getElementById("confirmTermsButton").addEventListener("click", function(event) {
                event.preventDefault(); // منع إعادة تحميل الصفحة

                var installmentButton = document.querySelector("button[data-bs-target='#termsModal']");
                var installmentId = installmentButton.getAttribute("data-installment-id");

                // إرسال طلب AJAX إلى الخادم لتحديث حالة القسط
                fetch("{{ route('installment.updateStatus') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // حماية CSRF
                    },
                    body: JSON.stringify({
                        installment_id: installmentId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("تم تحديث حالة القسط بنجاح");

                            // إغلاق المودال الأول قبل فتح المودال الثاني
                            termsModal.hide();
                            setTimeout(function() {
                                paymentModal.show();
                            }, 500); // تأخير بسيط لضمان الإغلاق قبل الفتح

                        } else {
                            console.error("خطأ في تحديث القسط:", data.error);
                        }
                    })
                    .catch(error => console.error("حدث خطأ أثناء تحديث القسط:", error));
            });

            // التأكد من إغلاق المودال الثاني عند الضغط على زر الإغلاق بدون إعادة تحميل الصفحة
            document.querySelector("#paymentModal .btn-secondary").addEventListener("click", function(event) {
                event.preventDefault(); // منع إعادة تحميل الصفحة
                paymentModal.hide();
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var paymentModalElement = document.getElementById('paymentModal');
            var paymentModal = new bootstrap.Modal(paymentModalElement);

            // تأكد من إغلاق المودال بدون تعليق عند الضغط على زر الإغلاق
            document.querySelectorAll(".close-payment-modal").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault(); // منع إعادة تحميل الصفحة بشكل غير مقصود
                    paymentModal.hide();
                });
            });

            // عند إغلاق المودال الثاني، يتم إعادة تحميل الصفحة تلقائيًا
            paymentModalElement.addEventListener("hidden.bs.modal", function() {
                console.log("المودال مغلق! سيتم إعادة تحميل الصفحة...");
                location.reload(); // إعادة تحميل الصفحة
            });
        });
    </script>





@endsection
