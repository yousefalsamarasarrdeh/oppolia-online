@extends('layouts.Dashboard.mainlayout')

@section('title', 'Designer Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Designer Details</h1>

    <div>
        <strong>User Name:</strong> {{ $designer->user->name }}
    </div>

    <div>
        <strong>Profile Image:</strong>
        @if ($designer->profile_image)
            <img src="{{ asset('storage/' . $designer->profile_image) }}" alt="Profile Image" width="150">
        @else
            <p>No profile image available.</p>
        @endif
    </div>

    <div>
        <strong>Experience Years:</strong> {{ $designer->experience_years }}
    </div>

    <div>
        <strong>Description:</strong> {{ $designer->description }}
    </div>

    <div>
        <strong>Portfolio Images:</strong>
        @if ($designer->portfolio_images)
            @foreach (json_decode($designer->portfolio_images) as $image)
                <img src="{{ asset('storage/' . $image) }}" alt="Portfolio Image" width="150">
            @endforeach
        @else
            <p>No portfolio images available.</p>
        @endif
    </div>

    <div>
        <strong>Designer Code:</strong> {{ $designer->designer_code }}
    </div>

@endsection
