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
        <h1>طلباتي</h1>

        @if($orders->isEmpty())
            <p>لا توجد طلبات حتى الآن.</p>
        @else
            <table class="table table-striped">
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
                            @if ($order->processing_stage == 'stage_one')
                                في الانتظار
                            @elseif($order->processing_stage == 'stage_two')
                                قام أحد المصممين بالموافقة على طلبك بانتظار تحديد موعد
                            @elseif($order->processing_stage == 'stage_three' || $order->processing_stage == 'stage_four')
                                بانتظار التصميم الأولي
                            @elseif($order->processing_stage == 'stage_five')
                                شاهد التصميم الاولي
                            @elseif($order->processing_stage == 'stage_six')
                                سوف يرسل لك المصمم التصمييم النهائي
                            @elseif($order->processing_stage == 'stage_seven')
                                شاهد التصميم النهائي
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
        @endif
    </div>
@endsection
