@extends('layouts.designer.mainlayout')

@section('title', 'Product Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- إشعارات المصمم -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Notifications</h5>

                        @if($notifications->count() > 0)
                            <ul class="list-group">
                                @foreach($notifications as $notification)
                                    <li class="list-group-item">
                                        <strong>{{ $notification->data['message'] }}</strong> - {{ $notification->created_at->diffForHumans() }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No notifications available.</p>
                        @endif
                    </div>
                </div>
            </div><!-- End Notifications Section -->

        </div>
    </section>
@endsection
