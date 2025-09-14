@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة الطلبات')

@section('css')
    {{-- CSS الرسمي لـ DataTables + Buttons --}}


    <style>
        /* شريط الأدوات العلوي الثابت (أزرار + بحث) */
        .dt-toolbar-static{
            position: sticky;        /* يبقى ثابت أعلى المحتوى */
            top: 0;
            z-index: 50;
            background: #f8fafc;     /* أو #fff حسب ثيمك */
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-start; /* RTL */
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .dt-toolbar-static .btns-slot,
        .dt-toolbar-static .filter-slot{
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .dt-toolbar-static .dt-buttons { float: none !important; }
        .dt-toolbar-static .dataTables_filter { float: none !important; margin: 0; }
        .dt-toolbar-static .dataTables_filter label{ margin: 0; }
        .dt-toolbar-static .dataTables_filter input{ width: 220px; }

        /* شريط سفلي ثابت للمعلومة + الترقيم */
        .dt-footer-static{
             /* ليبقى أسفل الشاشة أثناء التمرير العمودي */
            bottom: 0;
            z-index: 40;
            background: #f8fafc;  /* أو #fff */
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: space-between; /* info يمين/يسار بحسب RTL */
            padding: 8px 0;
            border-top: 1px solid #eee;
        }
        .dt-footer-static .info-slot,
        .dt-footer-static .paginate-slot{
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* تمرير الجدول يكون عبر الحاوية فقط */
        .table-container { overflow-x: auto; }

        #ordersTable {
            border-collapse: collapse;
            width: 100%;
            min-width: 1200px;   /* حتى ما تتكسر الأعمدة على الشاشات الضيقة */
            table-layout: auto;
        }
        #ordersTable th {
            padding: 20px;
            text-align: center;
            font-size: 16px;
            background-color: #f1f1f1;
            color: #333;
            border: 1px solid #ddd;
            white-space: nowrap; /* الهيدر لا يلتف */
        }
        #ordersTable td {
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #555;
            border: 1px solid #ddd;
            white-space: nowrap; /* غيّرها إلى normal لو بدك التفاف نص */
        }
        #ordersTable tbody tr:nth-child(even) { background-color: #f9f9f9; }
        #ordersTable tbody tr:nth-child(odd)  { background-color: #fff; }

        /* أزرار التصدير */
        .dt-buttons button {
            background-color: #509F96;
            color: #fff;
            border: none;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .dt-buttons button:hover { background-color: rgba(10, 71, 64, 1); color: #fff; }

        .dataTables_filter label { font-size: 14px; }
        .dataTables_paginate { font-size: 14px; }
        .dataTables_info { font-size: 13px; color: #666; }

        .button { background-color: #509F96; color: #fff; }
        .button:hover { background-color: rgba(10, 71, 64, 1); color: #fff; }

        /* تنسيق أزرار الترقيم (داخل الشريط السفلي الثابت) */
        #dt-footer-static .dataTables_paginate .paginate_button {
            border: 1px solid #509F96;
            border-radius: 8px;
            padding: 6px 10px;
            margin: 0 3px;
            background: #fff !important;
            color: #0a4740 !important;
            box-shadow: 0 0 0 transparent;
        }

        #dt-footer-static .dataTables_paginate .paginate_button:hover {
            background: rgba(80,159,150,0.08) !important;
            border-color: #509F96;
            color: #0a4740 !important;
        }

        /* زر الصفحة الحالية */
        #dt-footer-static .dataTables_paginate .paginate_button.current,
        #dt-footer-static .dataTables_paginate .paginate_button.current:hover {
            background: #509F96 !important;
            color: #fff !important;
            border-color: #509F96;
        }

        /* تعطيل */
        #dt-footer-static .dataTables_paginate .paginate_button.disabled,
        #dt-footer-static .dataTables_paginate .paginate_button.disabled:hover {
            opacity: .5;
            cursor: not-allowed;
            background: #fff !important;
            color: #777 !important;
        }

        /* تمييز نص "السابق" و"التالي" شوي */
        #dt-footer-static .dataTables_paginate .paginate_button.previous,
        #dt-footer-static .dataTables_paginate .paginate_button.next {
            font-weight: 600;
        }

        /* تحسين التركيز من الكيبورد (إمكانية وصول) */
        #dt-footer-static .dataTables_paginate .paginate_button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(80,159,150,0.25);
        }

    </style>
@endsection

@section('content')
    <div class="container mt-5" dir="rtl">
        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        <h1>جدول الطلبات</h1>

        {{-- شريط أدوات علوي ثابت (أزرار + بحث) --}}
        <div id="dt-toolbar-static" class="dt-toolbar-static" dir="rtl">
            <div class="btns-slot"></div>
            <div class="filter-slot"></div>
        </div>

        <div class="table-container">
            <table id="ordersTable" class="display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th class="no-export">خيارات</th>
                    <th>id</th>
                    <th>اسم المستخدم</th>
                    <th>اسم المنطقة</th>
                    <th>اسم المنطقة الفرعية</th>
                    <!-- <th>مساحة المطبخ</th>
                    <th>شكل المطبخ</th>
                    <th>نوع المطبخ</th> -->
                    <!--   <th>الكلفة المتوقعة</th> -->
                    <!--  <th>المدة الزمنية</th> -->
                    <!-- <th>ستايل المطبخ</th> -->
                    <!--    <th>وقت اللقاء</th>  -->
                    <!--   <th>خطوة الطول</th>
                       <th>خطوة العرض</th> -->
                    <th>العنوان</th>
                    <th>اسم المصمم</th>
                    <th>الحالة</th>
                    <th>مرحلة علاج الطلب</th>

                </tr>
                </thead>
            </table>
        </div>

        {{-- شريط سفلي ثابت (معلومة + ترقيم) --}}
        <div id="dt-footer-static" class="dt-footer-static" dir="rtl">
            <div class="info-slot"></div>
            <div class="paginate-slot"></div>
        </div>
    </div>

    {{-- Modal تأكيد الحذف --}}
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true" dir="rtl">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>هل أنت متأكد من حذف الطلب <strong id="confirm-order-id"></strong> وكل ما يرتبط به؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger js-confirm-delete">تأكيد الحذف</button>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery + DataTables + Buttons + JSZip (لـ Excel/CSV) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            const table = $('#ordersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders.data') }}", // عدّل الاسم لو مختلف
                columns: [
                    //  { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'id', name: 'id' },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'region_name', name: 'region_name' },
                    { data: 'sub_region_name', name: 'sub_region_name' },
                    // { data: 'kitchen_area', name: 'kitchen_area' },
                    // { data: 'kitchen_shape', name: 'kitchen_shape' },
                    // { data: 'kitchen_type', name: 'kitchen_type' },
                    //  { data: 'expected_cost', name: 'expected_cost' },
                    //  { data: 'time_range', name: 'time_range' },
                    // { data: 'kitchen_style', name: 'kitchen_style' },
                    //   { data: 'meeting_time', name: 'meeting_time' },
                    //  { data: 'length_step', name: 'length_step' },
                    //  { data: 'width_step', name: 'width_step' },
                    { data: 'geocode_string', name: 'geocode_string' },
                    { data: 'designer_name', name: 'designer_name' },
                    { data: 'order_status_label', name: 'order_status' },
                    { data: 'processing_stage', name: 'processing_stage' },

                ],
                dom: 'Bfrtip',        // نولّد الأزرار والفلتر ثم ننقلهم
                autoWidth: false,
                deferRender: true,
                language: {
                    search: "البحث:",
                    lengthMenu: "عرض _MENU_ سجل في الصفحة",
                    info: "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    infoEmpty: "لا توجد سجلات",
                    paginate: { next: "التالي", previous: "السابق" },
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json"
                },
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'تصدير إلى CSV',
                        charset: 'utf-8',
                        bom: true,
                        title: 'جدول الطلبات',
                        className: 'btn button',
                        exportOptions: { columns: ':not(.no-export):not(:last-child)' }
                    },
                    {
                        extend: 'print',
                        text: 'طباعة',
                        className: 'btn button',
                        exportOptions: { columns: ':not(.no-export):not(:last-child)' },
                        customize: function (win) { $(win.document.body).attr('dir', 'rtl'); }
                    }
                ],
                initComplete: function () {
                    const wrapper = $('#ordersTable').closest('.dataTables_wrapper');

                    // نقل عناصر الشريط العلوي
                    table.buttons().container().appendTo('#dt-toolbar-static .btns-slot');
                    wrapper.find('.dataTables_filter').appendTo('#dt-toolbar-static .filter-slot');

                    // نقل عناصر الشريط السفلي
                    wrapper.find('.dataTables_info').appendTo('#dt-footer-static .info-slot');
                    wrapper.find('.dataTables_paginate').appendTo('#dt-footer-static .paginate-slot');

                    // تنظيف النسخ الزائدة داخل الغلاف
                    wrapper.find('.dt-buttons').not('#dt-toolbar-static .dt-buttons').remove();
                    wrapper.find('.dataTables_filter').not('#dt-toolbar-static .dataTables_filter').remove();
                    wrapper.find('.dataTables_info').not('#dt-footer-static .dataTables_info').remove();
                    wrapper.find('.dataTables_paginate').not('#dt-footer-static .dataTables_paginate').remove();

                    this.api().columns.adjust();
                }
            });

            // بعض إصدارات DT تعيد توليد عناصر الترقيم عند كل redraw — نضمن إعادة نقلها
            table.on('draw', function(){
                const wrapper = $('#ordersTable').closest('.dataTables_wrapper');
                if (!$('#dt-footer-static .dataTables_info').length) {
                    wrapper.find('.dataTables_info').appendTo('#dt-footer-static .info-slot');
                }
                if (!$('#dt-footer-static .dataTables_paginate').length) {
                    wrapper.find('.dataTables_paginate').appendTo('#dt-footer-static .paginate-slot');
                }
            });
        });

        // مودال تأكيد الحذف
        let pendingDeleteForm = null;
        let deleteModalInstance = null;

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.js-delete-btn');
            if (!btn) return;

            e.preventDefault();

            pendingDeleteForm = btn.closest('.js-delete-form');
            const id = pendingDeleteForm?.dataset?.orderId || '';

            const idSpan = document.getElementById('confirm-order-id');
            if (idSpan) idSpan.textContent = '#' + id;

            const modalEl = document.getElementById('deleteConfirmModal');
            if (window.bootstrap && bootstrap.Modal && modalEl) {
                if (!deleteModalInstance) {
                    deleteModalInstance = new bootstrap.Modal(modalEl);
                }
                deleteModalInstance.show();
            } else {
                if (confirm('هل أنت متأكد من حذف الطلب #' + id + ' وكل ما يرتبط به؟')) {
                    pendingDeleteForm.submit();
                }
            }
        });

        document.addEventListener('click', function(e) {
            const confirmBtn = e.target.closest('.js-confirm-delete');
            if (!confirmBtn) return;
            confirmBtn.disabled = true;
            confirmBtn.innerText = 'جارٍ الحذف...';
            if (pendingDeleteForm) pendingDeleteForm.submit();
        });
    </script>
@endsection
