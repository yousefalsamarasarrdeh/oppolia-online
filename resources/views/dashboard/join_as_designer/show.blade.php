@extends('layouts.Dashboard.mainlayout')

@section('title', 'عرض طلب المصمم')

@section('content')
    <div class="container mt-5" dir="rtl">
        <h1>عرض طلب المصمم</h1>

        <div class="card">
            <div class="card-header">
                طلب المصمم رقم #{{ $designerRequest->id }}
            </div>
            <div class="card-body">
                <p><strong>الاسم:</strong> {{ $designerRequest->name }}</p>
                <p><strong>البريد الإلكتروني:</strong> {{ $designerRequest->email_address }}</p>
                <p><strong>رقم الهاتف:</strong> {{ $designerRequest->phone_number }}</p>
                <p><strong>المدينة:</strong> {{ $designerRequest->subRegion->name_en }}</p>

                <p><strong>الجنس:</strong> {{ $designerRequest->gender }}</p>
                <p><strong>الحالة الاجتماعية:</strong> {{ $designerRequest->marital_status }}</p>

                <p><strong>سنوات الخبرة:</strong> {{ $designerRequest->years_of_experience }}</p>

                <!-- زر تنزيل الـ CV -->
                <p><strong>تنزيل السيرة الذاتية:</strong></p>
                <a href="{{ asset('storage/' . $designerRequest->cv_pdf_path) }}" class="btn btn-success" download>تنزيل السيرة الذاتية (PDF)</a>

                <a href="{{ route('admin.joinasdesigner.index') }}" class="btn btn-primary mt-3">الرجوع إلى الطلبات</a>
            </div>
        </div>
    </div>
@endsection
