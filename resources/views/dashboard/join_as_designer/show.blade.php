@extends('layouts.Dashboard.mainlayout')

@section('title', 'عرض طلب المصمم')
<style>
    .background-grey {
        border-radius: 21.333px !important;
        background:rgba(232, 232, 232, 1);
        font-size: 20px;
    }
    .nav-tabs .nav-link {
        color: rgba(28, 28, 28, 0.4);
    }
    .nav-link.active{
        color: rgba(28, 28, 28, 1) !important;
        font-weight: bold;
    }
    .font-15-px{
        font-size: 15px!important;
    }
</style>
@section('content')
    <div class="container mt-4" dir="rtl">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">عرض طلب المصمم</h2>


        </div>

        <div class="card p-4 shadow-sm">
            <h5 class="text-center mb-4">طلب المصمم رقم #{{ $designerRequest->id }}</h5>

            <div class="d-flex justify-content-center">
                <ul class="nav nav-tabs mb-3" id="designerTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab">المعلومات الشخصية</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-info-tab" data-bs-toggle="tab" data-bs-target="#contact-info" type="button" role="tab">معلومات التواصل</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="designerTabsContent">
                <!-- المعلومات الشخصية -->
                <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <span class="badge font-15-px  text-dark p-3 background-grey" ><strong>الاسم:</strong> {{ $designerRequest->name }}</span>
                        <span class="badge  font-15-px text-dark p-3 background-grey" ><strong>المدينة:</strong> {{ $designerRequest->subRegion->name_ar }}</span>
                        <span class="badge font-15-px  text-dark p-3 background-grey" ><strong>الجنس:</strong> {{ $designerRequest->gender }}</span>
                        <span class="badge font-15-px  text-dark p-3 background-grey" ><strong>الحالة الاجتماعية:</strong> {{ $designerRequest->marital_status }}</span>
                        <span class="badge font-15-px text-dark p-3 background-grey" ><strong>سنوات الخبرة:</strong> {{ $designerRequest->years_of_experience }}</span>
                    </div>
                </div>

                <!-- معلومات التواصل -->
                <div class="tab-pane fade" id="contact-info" role="tabpanel">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <span class="badge font-15-px text-dark p-3 background-grey"><strong>البريد الإلكتروني:</strong> {{ $designerRequest->email_address }}</span>
                        <span class="badge font-15-px text-dark p-3 background-grey"><strong>رقم الهاتف:</strong> {{ $designerRequest->phone_number }}</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ asset('storage/' . $designerRequest->cv_pdf_path) }}" class="btn btn-success" download>تنزيل السيرة الذاتية (PDF)</a>
            </div>
        </div>
    </div>
@endsection
