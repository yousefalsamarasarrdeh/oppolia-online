@extends('layouts.app')

@section('content')

    <!-- عرض رسالة النجاح -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- عرض رسالة الخطأ -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <!-- عرض رسائل التحقق من الأخطاء لكل حقل -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5" dir="rtl">
        <h1>انضم كمصمم</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('joinasdesigner.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
        @csrf

        <!-- حقل الاسم -->
            <div class="mb-3">
                <label for="name" class="form-label">الاسم:</label>
                <input type="text" name="name" class="form-control" required>
            </div>



            <div class="mb-3">
                <label for="country" class="form-label">الدولة:</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email_address" class="form-label">البريد الإلكتروني:</label>
                <input type="email" name="email_address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">رقم الهاتف:</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">العمر:</label>
                <input type="number" name="age" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nationality" class="form-label">الجنسية:</label>
                <input type="text" name="nationality" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">الجنس:</label>
                <select name="gender" class="form-control" required>
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="marital_status" class="form-label">الحالة الاجتماعية:</label>
                <select name="marital_status" class="form-control" required>
                    <option value="single">أعزب</option>
                    <option value="married">متزوج</option>
                    <option value="other">أخرى</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="region_id" class="form-label">المنطقة:</label>
                <select name="region_id" id="region_id" class="form-control" required>
                    <option value="" disabled selected>اختر المنطقة</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name_ar }}</option> <!-- فقط تمرير المعرف -->
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label for="major_in_education" class="form-label">التخصص التعليمي:</label>
                <input type="text" name="major_in_education" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="years_of_experience" class="form-label">سنوات الخبرة:</label>
                <input type="number" name="years_of_experience" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="experience_in_sales" class="form-label">هل لديك خبرة في المبيعات؟</label>
                <select name="experience_in_sales" class="form-control" required>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="current_occupation" class="form-label">ما هو عملك الحالي؟</label>
                <select name="current_occupation" class="form-control" required>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="willing_to_work_as_freelancer" class="form-label">هل ترغب في العمل كمستقل؟</label>
                <select name="willing_to_work_as_freelancer" class="form-control" required>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="own_car" class="form-label">هل تملك سيارة؟</label>
                <select name="own_car" class="form-control" required>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="experience_in_kitchen_furniture_business" class="form-label">هل لديك خبرة في أعمال أثاث المطبخ؟</label>
                <select name="experience_in_kitchen_furniture_business" class="form-control" required>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="kitchen_furniture_experience_description" class="form-label">إذا كانت الإجابة نعم، يرجى التوضيح:</label>
                <textarea name="kitchen_furniture_experience_description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="cv_pdf" class="form-label">رفع السيرة الذاتية (PDF):</label>
                <input type="file" name="cv_pdf" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">إرسال</button>
        </form>
    </div>

@endsection
