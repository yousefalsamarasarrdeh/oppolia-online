@extends('layouts.app')
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
        @foreach($notifications1 as $notification)
            <a href="{{ route('user.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $notification->data['message'] ?? 'Notification' }}</h5>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">Order ID: {{ $notification->data['order_id'] ?? 'N/A' }}</p>
                <small>{{ $notification->read_at ? 'Read' : 'Unread' }}</small>
            </a>
        @endforeach
    </div>

@endsection
