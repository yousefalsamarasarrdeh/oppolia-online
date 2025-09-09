@extends('layouts.designer.mainlayout')

@section('title', 'صفحة الاشعارات')

@section('css')
    <style>
        .bg-light-blue { background-color: #e7f3ff; }
        .bg-light-gray { background-color: #f3f3f3; }
        .hidden { display: none !important; }
        .list-group { padding-right: 0; }
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="section dashboard">
        <div class="row">
            <!-- إشعارات المصمم -->
            <div class="col-lg-12">
                <div class="card-body">
                    <h2 class="mb-4">الإشعارات</h2>

                    <div class="row">
                        <div class="col-9">
                            <button id="hideBlueButton" class="btn designer-notifications-read mb-3">مقروء</button>
                            <button id="hideGrayButton" class="btn designer-notifications-unread mb-3">غير مقروء</button>
                            <button id="showAllButton" class="btn designer-notifications-all mb-3">عرض الكل</button>
                        </div>
                        <div class="col-3" style="text-align: end;">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAllReadModal">
                                حذف كل الإشعارات المقروءة
                            </button>
                        </div>
                    </div>

                    @if($notifications1->count() > 0)
                        <ul class="list-group">
                            @foreach($notifications1 as $notification)
                                <li class="list-group-item d-flex justify-content-between align-items-center @if(is_null($notification->read_at)) bg-light-blue @else bg-light-gray @endif">
                                    <div>
                                        <strong>{{ $notification->data['message'] }}</strong>
                                        — {{ $notification->created_at->diffForHumans() }}
                                        <a href="{{ route('designer.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}">
                                            <i class="bi bi-exclamation-circle text-warning"></i>
                                            <div><p>Order ID: {{ $notification->data['order_id'] }}</p></div>
                                        </a>
                                    </div>
                                    <div>
                                        @if(is_null($notification->read_at))
                                            <span class="badge bg-primary rounded-pill">جديد</span>
                                        @else
                                            <button class="btn btn-danger btn-sm delete-notification"
                                                    data-id="{{ $notification->id }}">
                                                حذف
                                            </button>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>لا توجد إشعارات.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- مودال: حذف جميع المقروء -->
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
                    <form action="{{ route('delete.allReadnotification') }}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger">نعم، حذف الكل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال: حذف إشعار واحد -->
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
        // فلاتر العرض: مقروء/غير مقروء/الكل
        document.addEventListener('DOMContentLoaded', function () {
            const hideBlueButton = document.getElementById('hideBlueButton');
            const hideGrayButton = document.getElementById('hideGrayButton');
            const showAllButton  = document.getElementById('showAllButton');

            if (hideBlueButton) {
                hideBlueButton.addEventListener('click', function () {
                    document.querySelectorAll('.bg-light-blue').forEach(el => el.classList.add('hidden'));
                    document.querySelectorAll('.bg-light-gray').forEach(el => el.classList.remove('hidden'));
                });
            }

            if (hideGrayButton) {
                hideGrayButton.addEventListener('click', function () {
                    document.querySelectorAll('.bg-light-gray').forEach(el => el.classList.add('hidden'));
                    document.querySelectorAll('.bg-light-blue').forEach(el => el.classList.remove('hidden'));
                });
            }

            if (showAllButton) {
                showAllButton.addEventListener('click', function () {
                    document.querySelectorAll('.list-group-item').forEach(el => el.classList.remove('hidden'));
                });
            }
        });
    </script>

    <script>
        // حذف فردي مع مودال تأكيد
        document.addEventListener('DOMContentLoaded', function () {
            let currentNotificationId = null;
            let currentLi = null;

            const singleModalEl = document.getElementById('deleteSingleModal');
            const singleModal   = new bootstrap.Modal(singleModalEl);
            const confirmBtn    = document.getElementById('confirmDeleteBtn');

            // تفويض: أي زر يحمل .delete-notification يفتح المودال
            document.addEventListener('click', function (e) {
                const btn = e.target.closest('.delete-notification');
                if (!btn) return;

                e.preventDefault();
                currentNotificationId = btn.getAttribute('data-id');
                currentLi = btn.closest('li');
                singleModal.show();
            });

            // عند التأكيد: أرسل طلب الحذف ثم احذف العنصر من الواجهة عند النجاح
            confirmBtn.addEventListener('click', function () {
                if (!currentNotificationId) return;

                confirmBtn.disabled = true;
                confirmBtn.textContent = 'جاري الحذف...';

                fetch(`/notifications/${currentNotificationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(res => {
                        if (!res.ok) throw new Error('failed');
                        if (currentLi) currentLi.remove();
                        singleModal.hide();
                    })
                    .catch(() => {
                        alert('فشل حذف الإشعار. حاول مجددًا.');
                    })
                    .finally(() => {
                        confirmBtn.disabled = false;
                        confirmBtn.textContent = 'نعم، حذف';
                        currentNotificationId = null;
                        currentLi = null;
                    });
            });
        });
    </script>
@endsection
