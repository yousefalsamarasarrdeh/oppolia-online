@extends('layouts.Dashboard.mainlayout')


@section('title', 'Order Management')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
    <style>
        /* تنسيق الخريطة */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endsection

@section('content')

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
    <div class="container">
        <h1>Order Details</h1>

        <div class="order-info">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Kitchen Area:</strong> {{ $order->kitchen_area }} sqm</p>
            <p><strong>Kitchen Shape:</strong> {{ $order->kitchen_shape }}</p>
            <p><strong>Expected Cost:</strong> ${{ $order->expected_cost }}</p>
            <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
        </div>

        <div class="user-info">
            <h2>User Details</h2>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Phone Number:</strong> {{ $order->user->phone }}</p> <!-- تأكد من أن لديك حقل 'phone_number' في جدول المستخدم -->
        </div>

        <!-- عرض الخريطة -->
        <div id="map"></div>
        @php
            // الحصول على المصمم المرتبط بالمستخدم المسجل
            $designer = auth()->user()->designer;
        @endphp




        <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>

        <script>
            function initMap() {
                var lengthStep = {{ $order->length_step ?? 24.7136 }};
                var widthStep = {{ $order->width_step ?? 46.6753 }};
                var orderLocation = {lat: lengthStep, lng: widthStep};

                var map = new google.maps.Map(document.getElementById('map'), {
                    center: orderLocation,
                    zoom: 14
                });

                var marker = new google.maps.Marker({
                    position: orderLocation,
                    map: map
                });
            }
        </script>
@endsection
