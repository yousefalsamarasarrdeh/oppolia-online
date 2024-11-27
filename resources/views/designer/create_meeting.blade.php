@extends('layouts.designer.mainlayout')

@section('title', 'معالجة الطلب')

@section('content')
    <div class="pagetitle">
        <h1>معالجة الطلب رقم #{{ $order->id }}</h1>
    </div><!-- نهاية عنوان الصفحة -->

    <section class="section dashboard" dir="rtl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">تفاصيل الطلب</h5>
                        <p><strong>اسم المستخدم:</strong> {{ $order->user->name }}</p>
                        <p><strong>رقم الهاتف:</strong> {{ $order->user->phone }}</p>
                        <p><strong>شكل المطبخ:</strong> {{ $order->kitchen_shape }}</p>
                        <p><strong>مرحلة المعالجة:</strong> {{ $order->processing_stage }}</p>
                        <p><strong>وقت الاجتماع:</strong> {{ $order->meeting_time ?? 'لم يتم تحديد موعد بعد' }}</p>

                        <!-- هنا يمكن إضافة أدوات أو حقول إضافية للمعالجة -->
                        <form method="POST" action="{{ route('designer.order.update_processing', ['order' => $order->id]) }}">
                        @csrf

                        <!-- اختيار حالة التحقق -->
                            <div class="mb-3">
                                <label for="is_verified" class="form-label">هل تم التحقق؟</label>
                                <select name="is_verified" id="is_verified" class="form-control">
                                    <option value="1">نعم</option>
                                    <option value="0" selected>لا</option>
                                </select>
                            </div>

                            <!-- تحديد وقت الاجتماع -->
                            <div class="mb-3">
                                <label for="meeting_time" class="form-label">وقت الاجتماع</label>
                                <input type="datetime-local" name="meeting_time" id="meeting_time" class="form-control" required>
                            </div>

                            <!-- زر إنشاء الاجتماع -->
                            <button type="submit" class="btn btn-success">ارسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
