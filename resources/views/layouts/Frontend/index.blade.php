@extends('layouts.Dashboard.mainlayout')

@section('title', 'Order Management')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
    <style>

        .table-container {
            overflow-x: auto; /* تفعيل التمرير الأفقي */
            white-space: nowrap; /* منع التفاف النصوص داخل الجدول */
        }

        .table-container th {
            padding: 20px; /* زيادة المسافات داخل الترويسات */
            text-align: center; /* توسيط النصوص */
            font-size: 16px; /* جعل النصوص أكبر */
            background-color: #f1f1f1; /* لون خلفية واضح للترويسات */
            color: #333; /* لون النص */
            border: 1px solid #ddd; /* تحديد حدود واضحة */
        }

        #ordersTable {
            border-collapse: collapse; /* إزالة المسافات بين حدود الجدول */
            width: 100%;
            min-width: 1200px; /* عرض أدنى للجدول */
        }

        #ordersTable th {
            padding: 20px; /* زيادة المسافات داخل الترويسات */
            text-align: center; /* توسيط النصوص */
            font-size: 16px; /* جعل النصوص أكبر */
            background-color: #f1f1f1; /* لون خلفية واضح للترويسات */
            color: #333; /* لون النص */
            border: 1px solid #ddd; /* تحديد حدود واضحة */
        }

        #ordersTable td {
            padding: 15px; /* زيادة المسافات داخل الخلايا */
            text-align: center; /* توسيط النصوص داخل الخلايا */
            font-size: 14px;
            color: #555; /* لون نص واضح */
            border: 1px solid #ddd; /* حدود واضحة للخلايا */
        }

        #ordersTable tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* لون مختلف للصفوف الزوجية */
        }

        #ordersTable tbody tr:nth-child(odd) {
            background-color: #fff; /* لون للصفوف الفردية */
        }

        /* تحسين أزرار تصدير البيانات */
        .dt-buttons button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .dt-buttons button:hover {
            background-color: #0056b3;
        }

        /* تحسين صندوق البحث */
        .dataTables_filter label {
            font-size: 14px;
            margin-right: 10px;
        }

        /* تحسين الترقيم */
        .dataTables_paginate {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>


@endsection

@section('content')
    <div class="container mt-5" dir="rtl">
        <h1>جدول الطلبات</h1>
        <div class="table-container">
            <table id="ordersTable" class="display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المستخدم</th>
                    <th>اسم المنطقة</th>
                    <th>اسم المنطقة الفرعية</th>
                
                    <th>شكل المطبخ</th>
                    <th>نوع المطبخ</th>
                   
                    <th>اسم المصمم</th>
                    <th>الحالة</th>
                    <th>خيارات</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#ordersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'region_name', name: 'region_name' },
                    { data: 'sub_region_name', name: 'sub_region_name' },
                  //  { data: 'kitchen_area', name: 'kitchen_area' },
                    { data: 'kitchen_shape', name: 'kitchen_shape' },
                    { data: 'kitchen_type', name: 'kitchen_type' },
                 //   { data: 'expected_cost', name: 'expected_cost' },
                 //   { data: 'time_range', name: 'time_range' },
                 //   { data: 'kitchen_style', name: 'kitchen_style' },
                 //   { data: 'meeting_time', name: 'meeting_time' },
                 //   { data: 'length_step', name: 'length_step' },
                  //  { data: 'width_step', name: 'width_step' },
                  //  { data: 'geocode_string', name: 'geocode_string' },
                    { data: 'designer_name', name: 'designer_name' },
                    { data: 'order_status_label', name: 'order_status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                dom: 'Bfrtip',
                scrollX: true, // تمكين التمرير الأفقي

                buttons: [
                //    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json"
                }


            });
        });
    </script>

@endsection
