@extends('layouts.Dashboard.mainlayout')

@section('title', 'Order Management')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2>Order List</h2>

        <!-- Form for Filtering Orders -->
        <form action="{{ route('admin.orders.filter') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="designer_id">Filter by Designer:</label>
                    <select name="designer_id" id="designer_id" class="form-select">
                        <option value="">Select Designer</option>
                        @foreach($designers as $designer)
                            <option value="{{ $designer->id }}">
                                {{ $designer->user->name ?? 'Unknown' }} ({{ $designer->orders_count }} Orders)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="region_id">Filter by Region:</label>
                    <select name="region_id" id="region_id" class="form-select">
                        <option value="">Select Region</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">
                                {{ $region->name_en }} ({{ $region->orders_count }} Orders)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Orders Table -->
        <table class="table table-bordered datatable">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Region</th>
                <th>Kitchen Area</th>
                <th>Kitchen Shape</th>
                <th>Kitchen Type</th>
                <th>Expected Cost</th>
                <th>Time Range</th>
                <th>Kitchen Style</th>
                <th>Meeting Time</th>
                <th>Length</th>
                <th>Width</th>
                <th>Geocode</th>
                <th>Designer Code</th>
                <th>Status</th>
                <th>Processing Stage</th>
                <th>Approved Designer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'Not Available' }}</td>
                    <td>{{ $order->region->name_en ?? 'Not Available' }}</td>
                    <td>{{ $order->kitchen_area }}</td>
                    <td>{{ $order->kitchen_shape }}</td>
                    <td>{{ $order->kitchen_type }}</td>
                    <td>{{ $order->expected_cost }}</td>
                    <td>{{ $order->time_range }}</td>
                    <td>{{ $order->kitchen_style }}</td>
                    <td>{{ $order->meeting_time }}</td>
                    <td>{{ $order->length_step }}</td>
                    <td>{{ $order->width_step }}</td>
                    <td>{{ $order->geocode_string }}</td>
                    <td>{{ $order->designer_code }}</td>
                    <td>{{ $order->order_status }}</td>
                    <td>{{ $order->processing_stage }}</td>
                    <td>{{ $order->designer->user->name ?? 'Not Available' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
