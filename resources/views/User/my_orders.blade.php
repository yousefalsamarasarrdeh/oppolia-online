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

    <div class="container">
        <div class="card m-5 p-4">
        <h1 class="my-orders-title-border-b">طلباتي</h1>

        @if($orders->isEmpty())
            <p>لا توجد طلبات حتى الآن.</p>
        @else <div class="mt-5">
            <table class="table table-striped custom-rounded ">
                <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>حالة الطلب</th>
                    <th>المدى الزمني</th>
                    <th>التكلفة المتوقعة</th>
                    <th>التاريخ</th>
                    <th>عرض الطلب</th> <!-- إضافة عمود جديد -->
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @if ($order->processing_stage == 'تم إرسال الطلب')
                                تم إرسال الطلب
                            @elseif($order->processing_stage == 'تم الموافقة على الطلب')
                                تم الموافقة على الطلب


                            @else

                                {{ $order->processing_stage }}
                            @endif
                        </td>
                        <td>{{ $order->time_range }}</td>
                        <td>{{ $order->expected_cost }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>

                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">عرض الطلب</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div> 
        @endif
        </div>
    </div>
@endsection
