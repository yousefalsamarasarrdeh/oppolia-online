@extends('layouts.designer.mainlayout')

@section('title', 'Order Processing')

@section('content')
    <div class="pagetitle">
        <h1>Processing Order #{{ $order->id }}</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Details</h5>
                        <p><strong>User Name:</strong> {{ $order->user->name }}</p>
                        <p><strong>Phone Number:</strong> {{ $order->user->phone }}</p>
                        <p><strong>Kitchen Shape:</strong> {{ $order->kitchen_shape }}</p>
                        <p><strong>Processing Stage:</strong> {{ $order->processing_stage }}</p>
                        <p><strong>Meeting Time:</strong> {{ $order->meeting_time ?? 'Not scheduled yet' }}</p>

                        <!-- هنا يمكنك إضافة أي أدوات أو حقول خاصة بالمعالجة -->
                        <form method="POST" action="{{ route('designer.order.update_processing', ['order' => $order->id]) }}">
                        @csrf

                        <!-- اختيار حالة التحقق -->
                            <div class="mb-3">
                                <label for="is_verified" class="form-label">Is Verified</label>
                                <select name="is_verified" id="is_verified" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>

                            <!-- تحديد وقت اللقاء -->
                            <div class="mb-3">
                                <label for="meeting_time" class="form-label">Meeting Time</label>
                                <input type="datetime-local" name="meeting_time" id="meeting_time" class="form-control" required>
                            </div>

                            <!-- زر إنشاء اللقاء -->
                            <button type="submit" class="btn btn-success">Create Meeting</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
