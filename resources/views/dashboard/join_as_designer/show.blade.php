@extends('layouts.Dashboard.mainlayout')

@section('title', 'View Designer Request')

@section('content')
    <div class="container mt-5">
        <h1>View Designer Request</h1>

        <div class="card">
            <div class="card-header">
                Designer Request #{{ $designerRequest->id }}
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $designerRequest->name }}</p>
                <p><strong>Email:</strong> {{ $designerRequest->email_address }}</p>
                <p><strong>Phone:</strong> {{ $designerRequest->phone_number }}</p>
                <p><strong>City:</strong> {{ $designerRequest->subRegion->name_en}}</p>

                <p><strong>Gender:</strong> {{ $designerRequest->gender }}</p>
                <p><strong>Marital Status:</strong> {{ $designerRequest->marital_status }}</p>

                <p><strong>Years of Experience:</strong> {{ $designerRequest->years_of_experience }}</p>


                <!-- زر تنزيل الـ CV -->
                <p><strong>Download CV:</strong></p>
                <a href="{{ asset('storage/' . $designerRequest->cv_pdf_path) }}" class="btn btn-success" download>Download CV (PDF)</a>

                <a href="{{ route('admin.joinasdesigner.index') }}" class="btn btn-primary mt-3">Back to Requests</a>
            </div>
        </div>
    </div>
@endsection
