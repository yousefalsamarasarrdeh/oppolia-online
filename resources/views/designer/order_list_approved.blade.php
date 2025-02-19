@extends('layouts.designer.mainlayout')

@section('title', 'الطلبات المعتمدة')

@section('css')
    <style>
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: center;
        }
        .btn-view-order, .btn-processing {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-view-order:hover, .btn-processing:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle" dir="rtl" >
        <h1>الطلبات المعتمدة</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active">الطلبات المعتمدة</li>
            </ol>
        </nav>
    </div><!-- نهاية عنوان الصفحة -->

    <!-- عرض رسائل النجاح أو الفشل -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <section class="section dashboard " dir="rtl" >
        <div class="row">

            <!-- عرض الطلبات التي وافق عليها المصمم -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">الطلبات التي قمت بالموافقة عليها</h5>

                        @if($approvedOrders->count() > 0)
                            <table class="table table-striped table table-bordered datatable">
                                <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>اسم المستخدم</th>
                                    <th>رقم الهاتف</th>
                                    <th>مرحلة المعالجة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>الإجراءات</th> <!-- إضافة عمود للإجراءات -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($approvedOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->user->phone }}</td> <!-- تأكد من وجود حقل phone_number في جدول المستخدم -->
                                        <td>{{ $order->processing_stage }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <!-- زر عرض الطلب -->
                                            <a href="{{ route('designer.order.show_without_notification', ['order' => $order->id]) }}" class="btn-view-order">عرض الطلب</a>
                                            <!-- زر المعالجة -->
                                            @if($order->processing_stage == 'stage_eighteen')
                                                <span class="text-danger">هذا الطلب منهي</span>
                                            @else
                                                <a href="{{ route('designer.order.processing', ['order' => $order->id]) }}" class="btn-processing">معالجة</a>
                                            @endif




                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>لا توجد طلبات معتمدة.</p>
                        @endif
                    </div>
                </div>
            </div><!-- نهاية قسم الطلبات المعتمدة -->

        </div>
    </section>
@endsection
