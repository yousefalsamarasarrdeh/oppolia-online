@extends('layouts.app')
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

    <div class="container">
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
        @if ($order->orderDraft->isNotEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th>رقم المسودة</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                    <th>ملفات الصور</th>
                    <th>ملف PDF</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->orderDraft as $draft)
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>لا توجد مسودات مرتبطة بهذا الطلب.</p>
        @endif
    </div>
@endsection
