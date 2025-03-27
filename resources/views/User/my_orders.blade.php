@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', 'طلباتي')
@section('content')

    <style>
        /* حجم الخط العام */
        .custom-table th,
        .custom-table td {
            font-size: 18px;
        }

        .btn-details {
            font-size: 16px;
            padding: 8px 16px;
        }

        @media (max-width: 767.98px) {
            /* تعديلات الموبايل */
            .responsive-table thead {
                display: none;
            }

            .responsive-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.25rem;
                background: white;
            }

            .responsive-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                color:#676767 !important;
                border-bottom: 0px solid #dee2e6;
                font-size: 14px !important;
            }

            .responsive-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 1rem;
                color: #333;
                flex-basis: 40%;
                font-size: 14px;
            }

            .btn-details {
                font-size: 14px !important;
                padding: 6px 12px;
            }
            .custom-rounded {
               background-color: #f2f2f2;
            }
        }
    </style>

    <div class="">
        <!-- رسائل التنبيه -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card m-md-5 p-4">
            <h1 class="my-orders-title-border-b">طلباتي</h1>

            @if($orders->isEmpty())
                <p class="mt-4">لا توجد طلبات حتى الآن.</p>
            @else
                <div class="mt-5 table-responsive">
                    <table class="table table-striped custom-rounded responsive-table custom-table">
                        <thead class="d-md-table-header-group">
                        <tr>
                            <th>رقم الطلب</th>
                            <th>حالة الطلب</th>
                            <th>المدى الزمني</th>
                            <th>التكلفة المتوقعة</th>
                            <th>التاريخ</th>
                            <th>عرض الطلب</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td data-label="رقم الطلب">{{ $order->id }}</td>
                                <td data-label="حالة الطلب">
                                    @if ($order->processing_stage == 'تم إرسال الطلب')
                                        تم إرسال الطلب
                                    @elseif($order->processing_stage == 'تم الموافقة على الطلب')
                                        تم الموافقة على الطلب
                                    @else
                                        {{ $order->processing_stage }}
                                    @endif
                                </td>
                                <td data-label="المدى الزمني">{{ $order->time_range }}</td>
                                <td data-label="التكلفة المتوقعة">{{ $order->expected_cost }}</td>
                                <td data-label="التاريخ">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td data-label="عرض الطلب">
                                    <a href="{{ route('order.show', $order->id) }}" class="btn  button_Dark_Green ">
                                        عرض التفاصيل
                                    </a>
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
