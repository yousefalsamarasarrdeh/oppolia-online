@extends('layouts.designer.mainlayout')

@section('title', 'Approved Orders')

@section('css')
    <style>
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
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
    <div class="pagetitle">
        <h1>Approved Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Approved Orders</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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

    <section class="section dashboard">
        <div class="row">

            <!-- عرض الطلبات التي وافق عليها المصمم -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Orders You Approved</h5>

                        @if($approvedOrders->count() > 0)
                            <table class="table table-striped table table-bordered datatable">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Phone Number</th>
                                    <th>Processing Stage</th>
                                    <th>Actions</th> <!-- إضافة عمود للإجراءات -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($approvedOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->user->phone }}</td> <!-- تأكد من وجود حقل phone_number في جدول المستخدم -->
                                        <td>{{ $order->processing_stage }}</td>
                                        <td>
                                            <!-- زر عرض الطلب -->
                                            <a href="{{ route('designer.order.show_without_notification', ['order' => $order->id]) }}" class="btn-view-order">View Order</a>
                                            <!-- زر Processing -->
                                            <a href="{{ route('designer.order.processing', ['order' => $order->id]) }}" class="btn-processing">Processing</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No approved orders found.</p>
                        @endif
                    </div>
                </div>
            </div><!-- End Approved Orders Section -->

        </div>
    </section>
@endsection
