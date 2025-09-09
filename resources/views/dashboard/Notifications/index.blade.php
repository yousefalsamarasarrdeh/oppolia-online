@extends('layouts.Dashboard.mainlayout')

@section('title', 'صفحة الاشغارات')

@section('css')
    <style>
        .bg-light-blue {
            background-color: #e7f3ff; /* لون أزرق فاتح */
        }
        .bg-light-gray {
            background-color: #f3f3f3; /* لون رمادي فاتح */
        }
        .hidden {
            display: none !important;
        }
        a {
            color: #509F96;
        }
    </style>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="mb-4">
        @if($notifications1->count())
            <ul class="list-group card-body">
                <h2 class="mb-4">الإشعارات</h2>
                <div class="row">
                    <div class="col-9 text-end">
                        <button id="hideBlueButton" class="btn designer-notifications-read mb-3">تمت قراءتها</button>
                        <button id="hideGrayButton" class="btn designer-notifications-unread mb-3">غير مقروءة</button>
                        <button id="showAllButton" class="btn designer-notifications-all mb-3">عرض الكل</button>
                    </div>

                    <div class="col-3 "  style="text-align: end;">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAllReadModal">
                            حذف كل الإشعارات المقروءة
                        </button>
                    </div>
                </div>

                @foreach ($notifications1 as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-start
                        @if(is_null($notification->read_at)) bg-light-blue @else bg-light-gray @endif">

                        <div class="me-2 ms-auto text-end">
                            @if(isset($notification->data['order_id']))
                                <div class="fw-bold">
                                    <a href="{{ route('admin.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}">
                                        {{ isset($notification->data['meeting_time'])
                                            ? Str::of($notification->data['message'])->replace($notification->data['meeting_time'], explode('T', $notification->data['meeting_time'])[0])
                                            : $notification->data['message'] }}
                                    </a>
                                </div>
                                <small>رقم الطلب: {{ $notification->data['order_id'] }}</small>
                            @elseif(isset($notification->data['join_as_designer_id']))
                                <div class="fw-bold">
                                    <a href="{{ route('admin.joinasdesigner.showWhitNotficition', ['joinasdesigner' => $notification->data['join_as_designer_id'], 'notificationId' => $notification->id]) }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                </div>
                                <small>رقم المصمم: {{ $notification->data['join_as_designer_id'] }}</small>
                            @endif
                            <br>
                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                        </div>

                        @if(is_null($notification->read_at))
                            <span class="badge bg-primary rounded-pill">جديد</span>
                        @else
                        <!-- زر حذف إشعار واحد (يفتح مودال التأكيد) -->
                            <button type="button"
                                    class="btn btn-danger btn-sm delete-notification"
                                    data-id="{{ $notification->id }}">
                                حذف
                            </button>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info mt-3 text-end">
                لا توجد إشعارات لعرضها.
            </div>
        @endif
    </div>

    <!-- Modal: حذف جميع الإشعارات المقروءة -->
    <div class="modal fade" id="deleteAllReadModal" tabindex="-1" aria-labelledby="deleteAllReadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAllReadLabel">حذف جميع الإشعارات المقروءة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    هل تريد حذف جميع الإشعارات المقروءة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <form action="{{ route('notifications.deleteAllRead') }}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger">نعم، حذف الكل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: حذف إشعار واحد -->
    <div class="modal fade" id="deleteSingleModal" tabindex="-1" aria-labelledby="deleteSingleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSingleLabel">حذف الإشعار</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    هل تريد بالتأكيد حذف هذا الإشعار؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button id="confirmDeleteBtn" type="button" class="btn btn-danger">نعم، حذف</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hideBlueButton = document.getElementById('hideBlueButton');
            const hideGrayButton = document.getElementById('hideGrayButton');
            const showAllButton = document.getElementById('showAllButton');

            // إخفاء العناصر ذات الكلاس bg-light-blue وإظهار bg-light-gray
            if (hideBlueButton) {
                hideBlueButton.addEventListener('click', function () {
                    const blueElements = document.getElementsByClassName('bg-light-blue');
                    const grayElements = document.getElementsByClassName('bg-light-gray');

                    Array.from(blueElements).forEach(function (element) {
                        element.classList.add('hidden');
                    });
                    Array.from(grayElements).forEach(function (element) {
                        element.classList.remove('hidden');
                    });
                });
            }

            // إخفاء العناصر ذات الكلاس bg-light-gray وإظهار bg-light-blue
            if (hideGrayButton) {
                hideGrayButton.addEventListener('click', function () {
                    const grayElements = document.getElementsByClassName('bg-light-gray');
                    const blueElements = document.getElementsByClassName('bg-light-blue');

                    Array.from(grayElements).forEach(function (element) {
                        element.classList.add('hidden');
                    });
                    Array.from(blueElements).forEach(function (element) {
                        element.classList.remove('hidden');
                    });
                });
            }

            // عرض جميع العناصر
            if (showAllButton) {
                showAllButton.addEventListener('click', function () {
                    const allElements = document.querySelectorAll('.list-group-item');
                    Array.from(allElements).forEach(function (element) {
                        element.classList.remove('hidden');
                    });
                });
            }

            // =========================
            // حذف إشعار واحد مع مودال تأكيد
            // =========================
            let notificationIdToDelete = null;
            let liToRemove = null;

            // افتح المودال عند الضغط على زر الحذف (لا تحذف مباشرة)
            const singleDeleteButtons = document.querySelectorAll('.delete-notification');
            singleDeleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    notificationIdToDelete = this.getAttribute('data-id');
                    liToRemove = this.closest('li');

                    const modalEl = document.getElementById('deleteSingleModal');
                    const deleteModal = new bootstrap.Modal(modalEl);
                    deleteModal.show();
                });
            });

            // تنفيذ الحذف عند التأكيد
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function () {
                    if (!notificationIdToDelete) return;

                    fetch(`/dashboard/notifications/${notificationIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                    })
                        .then(response => {
                            if (response.ok) {
                                if (liToRemove) liToRemove.remove();
                            } else {
                                alert('فشل حذف الإشعار، حاول مرة أخرى.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        })
                        .finally(() => {
                            const modalEl = document.getElementById('deleteSingleModal');
                            const inst = bootstrap.Modal.getInstance(modalEl);
                            if (inst) inst.hide();

                            // تنظيف المتغيرات
                            notificationIdToDelete = null;
                            liToRemove = null;
                        });
                });
            }
        });
    </script>
@endsection
