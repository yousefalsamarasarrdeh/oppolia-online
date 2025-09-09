@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المصممين')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 0px !important;
        }
        .designer-info div {
            margin-bottom: 10px; /* تباعد بين عناصر المعلومات */
        }
    </style>
@endsection

@section('content')

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div class="container" dir="rtl">

        <h1>تفاصيل المصمم</h1>

        <!-- القسم الأول -->
        <div class="row mb-4">
            <!-- المعلومات -->
            <div class="col-12 col-md-6 order-2 order-md-1 designer-info">
                <div><strong>اسم المستخدم:</strong> {{ $designer->user->name }}</div>
                <div><strong>المنطقة:</strong> {{ $designer->user->region->name_ar }}</div>
                <div><strong>سنوات الخبرة:</strong> {{ $designer->experience_years }}</div>
                <div><strong>الوصف:</strong> {{ $designer->description }}</div>
                <div><strong>الوصف بالعربية:</strong> {{ $designer->description_ar }}</div>
                <div><strong>رمز المصمم:</strong> {{ $designer->designer_code }}</div>
            </div>

            <!-- الصورة -->
            <div class="col-12 col-md-6 order-1 order-md-2 text-end text-md-start mt-3 mt-md-0">
                @if ($designer->profile_image)
                    <img src="{{ asset('storage/' . $designer->profile_image) }}"
                         alt="Profile Image" class="img-fluid rounded" style="max-width: 200px;">
                @else
                    <p>لا توجد صورة للملف الشخصي.</p>
                @endif
            </div>
        </div>

        <!-- البورتفوليو -->
        <div class="container mt-4">
            <h3>تصاميم المصمم</h3>
            <div class="row">
                @if ($designer->portfolio_images)
                    @foreach (json_decode($designer->portfolio_images) as $image)
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image) }}"
                                     class="card-img-top img-fluid rounded"
                                     alt="Portfolio Image" style="height: 220px; object-fit: cover;">
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>لا توجد صور بورتفوليو متاحة.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
