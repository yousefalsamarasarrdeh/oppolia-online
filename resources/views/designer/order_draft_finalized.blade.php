@extends('layouts.designer.mainlayout')
@section('title', 'المسودات المعتمدة للطلب')
@section('content')
    <div class="container" dir="rtl">
        <h2>المسودات المعتمدة للطلب #{{ $order->id }}</h2>
        @if($approvedDrafts->isEmpty())
            <p>لا توجد مسودات معتمدة لهذا الطلب.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>السعر</th>
                    <th>الصور</th>
                    <th>PDF</th>
                </tr>
                </thead>
                <tbody>
                @foreach($approvedDrafts as $draft)
                    <tr>
                        <td>{{ $draft->price }}</td>
                        <td>
                            @foreach(json_decode($draft->images) as $image)
                                <img src="{{ asset('storage/'.$image) }}" alt="صورة" style="width: 100px;">
                            @endforeach
                        </td>
                        <td><a href="{{ asset('storage/'.$draft->pdf) }}" target="_blank">تحميل PDF</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="container" dir="rtl">
        <h2>إنشاء مسودة طلب نهائية</h2>
        <form action="{{ route('designer.order_draft_finalized.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- السعر -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="price">السعر</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="price_after_discount">السعر بعد الخصم</label>
                        <input type="number" name="price_after_discount" id="price_after_discount" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="discount_percentage">النسبة المئوية للخصم</label>
                        <input type="text" id="discount_percentage" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="installment_amount">مبلغ الدفعة الاولى</label>
                        <input type="text" name="installment_amount" id="installment_amount" class="form-control" >
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="percentage">النسبة المئوية للدفعة الاولى</label>
                        <input type="text" id="percentage" class="form-control" readonly>
                    </div>
                </div>

                <!-- رفع الصور -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="images">رفع الصور</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple required>
                    </div>
                </div>

                <!-- رفع PDF -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="pdf">رفع PDF</label>
                        <input type="file" name="pdf" id="pdf" class="form-control" required>
                    </div>
                </div>

                <!-- الحالة -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="state">الحالة</label>
                        <select name="state" id="state" class="form-control" required>
                            <option value="finalized">نهائي</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- زر الإرسال -->
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">إرسال</button>
                </div>
            </div>
        </form>
    </div>



@endsection
@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceInput = document.getElementById('price');
            const priceAfterDiscountInput = document.getElementById('price_after_discount');
            const discountPercentageInput = document.getElementById('discount_percentage');

            function calculateDiscountPercentage() {
                const price = parseFloat(priceInput.value) || 0;
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;

                if (price > 0 && priceAfterDiscount >= 0) {
                    const discountPercentage = ((price - priceAfterDiscount) / price) * 100;
                    discountPercentageInput.value = discountPercentage.toFixed(2) + ' %';
                } else {
                    discountPercentageInput.value = '0 %';
                }
            }

            // إضافة أحداث لتحديث النسبة عند إدخال القيم
            priceInput.addEventListener('input', calculateDiscountPercentage);
            priceAfterDiscountInput.addEventListener('input', calculateDiscountPercentage);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceAfterDiscountInput = document.getElementById('price_after_discount');
            const installmentAmountInput = document.getElementById('installment_amount');
            const percentageInput = document.getElementById('percentage');

            function calculateInstallment() {
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;

                if (priceAfterDiscount > 0) {
                    // احتساب مبلغ القسط الافتراضي (30% من السعر بعد الخصم)
                    const defaultInstallment = (priceAfterDiscount * 30) / 100;
                    installmentAmountInput.value = defaultInstallment.toFixed(2); // تحديث الحقل بالقيمة الافتراضية
                    calculateInstallmentPercentage(); // تحديث النسبة المئوية
                } else {
                    installmentAmountInput.value = ''; // إعادة تعيين الحقل إذا لم يتم إدخال السعر
                    percentageInput.value = '0 %';
                }
            }

            function calculateInstallmentPercentage() {
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;
                const installmentAmount = parseFloat(installmentAmountInput.value) || 0;

                if (priceAfterDiscount > 0 && installmentAmount > 0) {
                    const percentage = (installmentAmount / priceAfterDiscount) * 100;

                    // التأكد من أن النسبة لا تتجاوز 50%
                    if (percentage > 50) {
                        alert('مبلغ القسط لا يمكن أن يتجاوز 50% من السعر بعد الخصم.');
                        installmentAmountInput.value = '';
                        percentageInput.value = '';
                    } else {
                        percentageInput.value = percentage.toFixed(2) + ' %';
                    }
                } else {
                    percentageInput.value = '0 %';
                }
            }

            // تحديث مبلغ القسط الافتراضي عند إدخال السعر بعد الخصم
            priceAfterDiscountInput.addEventListener('input', calculateInstallment);

            // تحديث النسبة المئوية عند تعديل مبلغ القسط يدويًا
            installmentAmountInput.addEventListener('input', calculateInstallmentPercentage);
        });
    </script>

@endsection
