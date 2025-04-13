@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المصممين')

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
    <div class="container" dir="rtl">

        <h1>تفاصيل المصمم</h1>

        <div>
            <strong>اسم المستخدم:</strong> {{ $designer->user->name }}
        </div>

        <div>
            <strong>المنطقة:</strong> {{ $designer->user->region->name_ar }}
        </div>

        <div>
            <strong>صورة الملف الشخصي:</strong>
            @if ($designer->profile_image)
                <img src="{{ asset('storage/' . $designer->profile_image) }}" alt="Profile Image" width="150">
            @else
                <p>لا توجد صورة للملف الشخصي.</p>
            @endif
        </div>

        <div>
            <strong>سنوات الخبرة:</strong> {{ $designer->experience_years }}
        </div>

        <div>
            <strong>الوصف:</strong> {{ $designer->description }}
        </div>

        <div>
            <strong>الوصف بالعربية:</strong> {{ $designer->description_ar }}
        </div>

        <div>
            <strong>صور البورتفوليو:</strong>
            @if ($designer->portfolio_images)
                @foreach (json_decode($designer->portfolio_images) as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Portfolio Image" width="150">
                @endforeach
            @else
                <p>لا توجد صور بورتفوليو متاحة.</p>
            @endif
        </div>

        <div>
            <strong>رمز المصمم:</strong> {{ $designer->designer_code }}
        </div>

    </div>

@endsection
