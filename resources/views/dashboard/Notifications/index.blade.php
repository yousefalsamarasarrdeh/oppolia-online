@extends('layouts.Dashboard.mainlayout')

@section('title', 'Notification Management')

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
        <h2 class="mb-4">Notifications</h2>
        <div class="row">
            <div class="col-9">
        <button id="hideBlueButton" class="btn btn-warning  mb-3">Read</button>
        <button id="hideGrayButton" class="btn btn-primary mb-3">UnRead</button>
        <button id="showAllButton" class="btn btn-success mb-3">Show All</button>
            </div>

            <div class="col-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   delete all Notification Read
                </button>
            </div>

        </div>

        @if($notifications1->count())
            <ul class="list-group">
                @foreach ($notifications1 as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-start
                    @if(is_null($notification->read_at))
                        bg-light-blue
                    @else
                        bg-light-gray
                    @endif">
                        <div class="ms-2 me-auto">
                            @if(isset($notification->data['order_id']))
                                <div class="fw-bold">
                                    <a href="{{ route('admin.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                </div>
                                <small>Order ID: {{ $notification->data['order_id'] }}</small>
                            @elseif(isset($notification->data['join_as_designer_id']))
                                <div class="fw-bold">
                                    <a href="{{ route('admin.joinasdesigner.showWhitNotficition', ['joinasdesigner' => $notification->data['join_as_designer_id'], 'notificationId' => $notification->id]) }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                </div>
                                <small>Designer ID: {{ $notification->data['join_as_designer_id'] }}</small>
                            @endif
                            <br>
                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        @if(is_null($notification->read_at))
                            <span class="badge bg-primary rounded-pill">New</span>
                        @else
                            <button class="btn btn-danger btn-sm delete-notification" data-id="{{ $notification->id }}">Delete</button>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info mt-3">
                No notifications to show.
            </div>
        @endif
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete all Notification Read</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  do you need delete all Notification Read
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('notifications.deleteAllRead') }}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger">Yes, Delete All</button>
                    </form>
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

                    // إخفاء العناصر الزرقاء
                    Array.from(blueElements).forEach(function (element) {
                        element.classList.add('hidden');
                    });

                    // إظهار العناصر الرمادية
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

                    // إخفاء العناصر الرمادية
                    Array.from(grayElements).forEach(function (element) {
                        element.classList.add('hidden');
                    });

                    // إظهار العناصر الزرقاء
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
                        element.classList.remove('hidden'); // إزالة كلاس الإخفاء
                    });
                });
            }

            // حذف الإشعار عند الضغط على زر الحذف
            const deleteButtons = document.querySelectorAll('.delete-notification');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const notificationId = this.getAttribute('data-id');
                    fetch(`/dashboard/notifications/${notificationId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                    })
                        .then(response => {
                            if (response.ok) {
                                this.closest('li').remove();
                            } else {
                                alert('Failed to delete notification. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection


