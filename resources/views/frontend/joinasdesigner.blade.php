@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') انضم كمصمم @endsection
@section('content')

    <style>


        .designer-form-wrapper {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: bold;
            color: #0A4740;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #ffffff;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolygon points='0,0 140,0 70,80' fill='%23509f96'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 10px center;
            background-size: 12px;
            padding-left: 30px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #509f96;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0A4740;
        }

        .alert {
            margin-top: 15px;
            text-align: center;
        }
    </style>
    <div class="container mt-5" dir="rtl">
        <h1 style="justify-self: center; color: #0A4740;">انضم كمصمم</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="designer-form-wrapper mb-4 ">
            <form action="{{ route('joinasdesigner.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                @csrf

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الاسم:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الدولة:</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">البريد الإلكتروني:</label>
                        <input type="email" name="email_address" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">رقم الهاتف:</label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">العمر:</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الجنسية:</label>
                        <input type="text" name="nationality" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الجنس:</label>
                        <select name="gender" class="form-control" required>
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">الحالة الاجتماعية:</label>
                        <select name="marital_status" class="form-control" required>
                            <option value="single">أعزب</option>
                            <option value="married">متزوج</option>
                            <option value="other">أخرى</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">المنطقة:</label>
                        <select name="region_id" class="form-control" required>
                            <option value="" disabled selected>اختر المنطقة</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">التخصص التعليمي:</label>
                        <input type="text" name="major_in_education" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">سنوات الخبرة:</label>
                        <input type="number" name="years_of_experience" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">هل لديك خبرة في المبيعات؟</label>
                        <select name="experience_in_sales" class="form-control" required>
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">ما هو عملك الحالي؟</label>
                        <input type="text" name="current_occupation" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">هل ترغب في العمل كمستقل؟</label>
                        <select name="willing_to_work_as_freelancer" class="form-control" required>
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">هل تملك سيارة؟</label>
                        <select name="own_car" class="form-control" required>
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">هل لديك خبرة في أعمال أثاث المطبخ؟</label>
                        <select name="experience_in_kitchen_furniture_business" class="form-control" required>
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">إذا كانت الإجابة نعم، يرجى التوضيح:</label>
                        <textarea name="kitchen_furniture_experience_description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">رفع السيرة الذاتية (PDF):</label>
                        <input type="file" name="cv_pdf" class="form-control" required>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">إرسال</button>
                </div>
            </form>
        </div>
    </div>

@endsection
