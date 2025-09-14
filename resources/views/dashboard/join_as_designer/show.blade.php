@extends('layouts.Dashboard.mainlayout')

@section('title', 'عرض طلب المصمم')
<style>
  
    .main-container {
       
        min-height: 100vh;
        padding: 20px;
    }
    .content-card {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 1000px;
    }
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e9ecef;
    }
    .section-title {
        background-color: #509f96;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 18px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    .info-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }
    .info-label {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .info-value {
     background-color: #f6f9ff;
     padding: 10px 15px;
     border-radius: 8px;
     border: 1px solid #f6f9ff;
     font-size: 16px;
    /* color: #f6f9ff; */
     font-weight: 500;
    }
    .section-divider {
        border-top: 2px dotted #dee2e6;
        margin: 30px 0;
    }
    .experience-section {
        margin-top: 20px;
    }
    .experience-text {
        background-color: #f6f9ff;
    padding: 20px;
    border-radius: 8px;
    /* border: 1px solid #bbdefb; */
    font-size: 16px;
    line-height: 1.6;
    /* color: #1976d2; */
    min-height: 120px;
    font-weight: 500;
    }
    .download-btn {
        background-color: #509f96;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .download-btn:hover {
        background-color: #218838;
        color: white;
        text-decoration: none;
    }
    .page-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }
    .details-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }
    .embed-icon {
        font-size: 20px;
        color: #6c757d;
    }
    
    .main-title {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        padding: 20px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-radius: 10px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .header-section {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
        .content-card {
            margin: 10px;
            padding: 20px;
        }
    }
</style>
@section('content')
<div class="main-container" dir="rtl">
<H1 class="mb-4">عرض طلب المصمم</H1>
    <div class="content-card">
        <!-- Main Title -->
      

        <!-- Personal Information Section -->
        <div class="section-title">المعلومات الشخصية</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">الاسم</div>
                <div class="info-value">{{ $designerRequest->name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">البريد الإلكتروني</div>
                <div class="info-value">{{ $designerRequest->email_address }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">رقم الجوال</div>
                <div class="info-value">{{ $designerRequest->phone_number }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">العمر</div>
                <div class="info-value">{{ $designerRequest->age }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">الجنسية</div>
                <div class="info-value">{{ $designerRequest->nationality }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">الجنس</div>
                <div class="info-value">    @if($designerRequest->gender == 'male')
            ذكر
        @elseif($designerRequest->gender == 'female')
            أنثى
        @endif</div>
            </div>
           
            <div class="info-item">
                <div class="info-label">الحالة الاجتماعية</div>
                <div class="info-value">   @if($designerRequest->marital_status == 'single')
            أعزب
        @elseif($designerRequest->marital_status == 'married')
            متزوج
        @else
            أخرى
        @endif</div>
            </div>
            <div class="info-item">
                <div class="info-label">الدولة</div>
                <div class="info-value">{{ $designerRequest->country }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">المنطقة</div>
                <div class="info-value">{{ $designerRequest->region->name_ar ?? 'غير محدد' }}</div>
            </div>
        </div>

        <!-- Section Divider -->
        <div class="section-divider"></div>

        <!-- Professional Information Section -->
        <div class="section-title">المعلومات المهنية</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">التخصص التعليمي</div>
                <div class="info-value">{{ $designerRequest->major_in_education }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">ما هو عملك الحالي؟</div>
                <div class="info-value">{{ $designerRequest->current_occupation }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">سنوات الخبرة</div>
                <div class="info-value">{{ $designerRequest->years_of_experience }} سنوات</div>
            </div>
            <div class="info-item">
                <div class="info-label">هل ترغب في العمل كمستقل؟</div>
                <div class="info-value">{{ $designerRequest->willing_to_work_as_freelancer ? 'نعم' : 'لا' }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">هل لديك خبرة في المبيعات؟</div>
                <div class="info-value">{{ $designerRequest->experience_in_sales ? 'نعم' : 'لا' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">هل لديك خبرة في أعمال آنات المطبخ؟</div>
                <div class="info-value">{{ $designerRequest->experience_in_kitchen_furniture_business ? 'نعم' : 'لا' }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">هل تملك سيارة؟</div>
                <div class="info-value">{{ $designerRequest->own_car ? 'نعم' : 'لا' }}</div>
            </div>
        </div>

        <!-- Experience Description Section -->
        <div class="experience-section">
            <div class="info-label">إذا كانت لديك خبرة في أعمال آنات المطبخ فيرجى التوضيح</div>
            <div class="experience-text">
                {{ $designerRequest->kitchen_furniture_experience_description ?? 'لم يتم تقديم وصف للخبرة' }}
            </div>
        </div>

        <!-- Download Button -->
        <div class="text-center mt-4">
            <a href="{{ asset('storage/' . $designerRequest->cv_pdf_path) }}" class="download-btn" download>
                <i class="fas fa-download"></i>
                تحميل السيرة الذاتية (PDF)
            </a>
        </div>
    </div>
</div>
@endsection
