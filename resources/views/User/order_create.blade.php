@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', 'انشاء طلب')
@section('css')
    <!-- Bootstrap Stepper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/css/bs-stepper.min.css">

    <style>
        label {
            font-size: 20px;
        }

        /* RTL Slider Fix for Arabic */
        [dir="rtl"] input[type="range"] {
            direction: rtl;
        }

        [dir="rtl"] input[type="range"]::-webkit-slider-thumb {
            transform: scaleX(-1);
        }

        [dir="rtl"] input[type="range"]::-moz-range-thumb {
            transform: scaleX(-1);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive design for stepper */
        @media (max-width: 768px) {
            .bs-stepper .bs-stepper-label {
                font-size: 11px;
                max-width: 80px;
                line-height: 1.1;
                padding: 0 3px;
                height: 50px;
            }

            .bs-stepper .step-trigger {
                height: 80px;
            }

            .bs-stepper .bs-stepper-circle {
                width: 24px;
                height: 24px;
                font-size: 12px;
            }

            .bs-stepper .bs-stepper-line {
                top: -12px;
            }
        }
        /* إخفاء جميع الخطوات افتراضياً */
        .form-step {
            display: none;
        }
        /* تنسيق صور الاختيار */
        .radio-image input[type="radio"] {
            display: none;
        }
        .radio-image img {
            border: 2px solid transparent;
            cursor: pointer;
            transition: border 0.3s ease;
            width: 200px;
            height: 200px;
        }
        .radio-image input[type="radio"]:checked + img {
            border: 2px solid #0A4740;
        }

        /* Kitchen shapes container for horizontal layout */
        .kitchen-shapes-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
            margin: 20px 0;
        }

        .kitchen-shapes-container .radio-image {
            flex: 0 0 auto;
        }

        /* Responsive design for mobile devices */
        @media (max-width: 768px) {
            .kitchen-shapes-container {
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
                text-align: center;
            }

            .kitchen-shapes-container .radio-image {
                flex: 0 0 calc(50% - 7.5px);
                max-width: calc(50% - 7.5px);
            }

            .kitchen-shapes-container .radio-image img {
                width: 100%;
                height: auto;
                max-width: 150px;
                max-height: 150px;
            }
        }

        /* Extra small screens */
        @media (max-width: 480px) {
            .kitchen-shapes-container .radio-image img {
                max-width: 120px;
                max-height: 120px;
            }

            .bs-stepper .bs-stepper-label {
                font-size: 10px;
                max-width: 70px;
                line-height: 1.0;
                padding: 0 2px;
                height: 45px;
            }

            .bs-stepper .step-trigger {
                height: 70px;
            }

            .bs-stepper .step {
                margin: 0 5px;
                min-width: 80px;
            }
        }
        .Dark_Green:hover {
            color:#509F96;
        }

        /* Ensure Next button is always on the right - with !important to override cache */
        .navigation-buttons {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            direction: ltr !important;
        }

        .navigation-buttons .next-btn {
            order: 2 !important;
            margin-left: auto !important;
        }

        .navigation-buttons .back-btn {
            order: 1 !important;
        }

        /* When only Next button is visible, ensure it's on the right */
        .navigation-buttons:has(.next-btn:only-child) .next-btn,
        .navigation-buttons .next-btn:only-child {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        /* Error highlighting styles */
        .form-step.has-errors {
            /* Remove individual form step error styling */
        }

        /* Main page container error highlighting */
        .main-container.has-errors {
            border: 3px solid #dc3545;
            border-radius: 28px;
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.3);
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            font-weight: 500;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
        }

        .radio-container.has-error {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        .radio-image.has-error img {
            border-color: #dc3545;
        }

        /* Kitchen style image container with labels */
        .kitchen-style-container {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .kitchen-style-label {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: white;
            color: #0A4740;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 10;
        }

        /* Kitchen shape image container with labels */
        .kitchen-shape-container {
            position: relative;
            display: inline-block;
            margin: 10px;
            background-color: #d3d3d3;
            padding: 10px;
            border-radius: 8px;
        }

        /* User info step styling */
        .user-info-step {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 32px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .user-info-step h5 {
            color: #0A4740;
            font-weight: 600;
            margin-bottom: 24px;
            text-align: center;
        }

        .user-info-step .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .user-info-step .form-control:focus {
            border-color: #0A4740;
            box-shadow: 0 0 0 3px rgba(10, 71, 64, 0.25);
            outline: none;
        }

        .user-info-step .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
        }

        .user-info-step label {
            color: #495057;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .user-info-step .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 4px;
            font-weight: 500;
        }

        .user-info-step .btn-next {
            background: #0A4740;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .user-info-step .btn-next:hover {
            background: #083a35;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(10, 71, 64, 0.3);
        }

        /* Kitchen shape selection styling */
        .radio-image input[type="radio"]:checked + .kitchen-shape-container {
            border: 3px solid #0A4740;
            border-radius: 8px;
        }

        .kitchen-shape-label {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: white;
            color: #0A4740;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 10;
        }

        /* Mobile responsive font size for kitchen shape labels */
        @media (max-width: 768px) {
            .kitchen-shape-label {
                font-size: 10px;
                padding: 3px 6px;
            }
        }

        /* Kitchen styles container - separate from shapes */
        .kitchen-styles-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
            margin: 20px 0;
        }

        .kitchen-styles-container .radio-image {
            flex: 0 0 auto;
            cursor: pointer;
        }

        /* Kitchen style checked state - apply tryout hover animation */
        .kitchen-styles-container .radio-image input[type="radio"]:checked + .kitchen-style-container img {
            border: 2px solid #0A4740;
            transform: scale(1.1);
        }

        /* Responsive design for kitchen styles */
        @media (max-width: 768px) {
            .kitchen-styles-container {
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
                text-align: center;
            }

            .kitchen-styles-container .radio-image {
                flex: 0 0 calc(50% - 7.5px);
                max-width: calc(50% - 7.5px);
            }

            .kitchen-styles-container img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
    <style>
        /* تنسيق عناصر النموذج */
        /* تنسيق عناصر النموذج */
        .radio-options {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .radio-container {
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            flex-grow: 1;
            margin-inline: 10px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .radio-container:not(:last-child) {
            margin-right: 10px;
        }

        .radio-container input[type="radio"] {
            display: none;
        }

        .radio-container .radio-label {
            font-size: 16px;
            color: #333; /* اللون الأساسي */
        }

        /* عند اختيار الخيار، يتغير لون الخلفية بالكامل ويتحول لون النص إلى الأبيض */
        .radio-container.selected {
            background-color: #0A4740 !important;
            color: white !important;
        }

        /* التأكد من أن النص داخل الصندوق أيضًا يصبح أبيض عند التحديد */
        .radio-container.selected .radio-label {
            color: white !important;
        }

        /* Ensure Next button is always on the right */
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            direction: ltr !important;
        }

        .navigation-buttons .next-btn {
            order: 2;
            margin-left: auto;
        }

        .navigation-buttons .back-btn {
            order: 1;
        }

        /* When only Next button is visible, ensure it's on the right */
        .navigation-buttons:has(.next-btn:only-child) .next-btn,
        .navigation-buttons .next-btn:only-child {
            margin-left: auto;
            margin-right: 0;
        }

        /* Bootstrap Stepper Header */
        .bs-stepper .bs-stepper-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            position: relative;
            gap: 0;
            padding: 0 16px;
            margin-bottom: 30px;
        }

        /* Bootstrap Stepper RTL Support */
        .bs-stepper.rtl .bs-stepper-header {
            flex-direction: row-reverse;
        }

        .bs-stepper.rtl .bs-stepper-line {
            transform: scaleX(-1);
        }

        .bs-stepper.rtl .step {
            flex-direction: row-reverse;
        }

        .bs-stepper.rtl .step-trigger {
            flex-direction: row-reverse;
        }

        /* Additional Bootstrap Stepper Customization */
        .bs-stepper .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            position: relative;
            flex-shrink: 0;
            min-width: 120px;
            max-width: 150px;
        }

        .bs-stepper .step-trigger {
            background: none;
            border: none;
            padding: 8px 16px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: default !important;
        }
        .bs-stepper .step-trigger:hover {
            background: transparent;
        }

        .bs-stepper .bs-stepper-circle {
            background-color: #e9ecef;
            color: #6c757d;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 8px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .bs-stepper .step.active .bs-stepper-circle {
            background-color: #0A4740;
            color: white;
            animation: pulse 2s infinite;
        }

        /* Pulse animation for active step */
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(10, 71, 64, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(10, 71, 64, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(10, 71, 64, 0);
            }
        }

        .bs-stepper .step.completed .bs-stepper-circle {
            background-color: #0A4740;
            color: white;
        }

        .bs-stepper .bs-stepper-label {
            font-weight: 500;
            color: #495057;
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
            text-align: center;
            max-width: 120px;
            line-height: 1.2;
            padding: 0 5px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            text-align: center;
        }

        .bs-stepper .step.active .bs-stepper-label {
            color: #0A4740;
            font-weight: 600;
        }

        .bs-stepper .step.completed .bs-stepper-label {
            color: #0A4740;
            font-weight: 500;
        }

        .bs-stepper .bs-stepper-line {
            background-color: #e9ecef;
            height: 2px;
            flex: 1;
            margin: 0 8px;
            transition: all 0.3s ease;
            align-self: center;
            position: relative;
            top: -25px;
            min-width: 32px;
            max-width: calc(100% - 64px);
        }



        .bs-stepper .bs-stepper-line.completed {
            background-color: #0A4740;
        }

        .bs-stepper .step.completed + .bs-stepper-line {
            background-color: #0A4740;
        }

        :dir(ltr) .bs-stepper .step.active + .bs-stepper-line {
            background: linear-gradient(90deg, #0A4740 0%, #e9ecef 100%);
        }

        :dir(rtl) .bs-stepper .step.active + .bs-stepper-line {
            background: linear-gradient(270deg, #0A4740 0%, #e9ecef 100%);
        }

        /* RTL completed line fix */
        .bs-stepper.rtl .bs-stepper-line.completed {
            background-color: #0A4740 !important;
        }

        /* Error state styling */
        .bs-stepper .step.has-error .bs-stepper-circle {
            background-color: #dc3545 !important;
            color: white !important;
            border: 2px solid #dc3545;
        }

        .bs-stepper .step.has-error .bs-stepper-label {
            color: #dc3545 !important;
            font-weight: 600;
        }

        .bs-stepper .step.has-error + .bs-stepper-line {
            background-color: #dc3545 !important;
        }

        /* Ensure lines don't extend beyond steps */
        .bs-stepper .step:first-child {
            margin-left: 0;
        }

        .bs-stepper .step:last-child {
            margin-right: 0;
        }

        /* Line positioning to connect steps properly */
        .bs-stepper .bs-stepper-line {
            margin-left: -64px;
            margin-right: -64px;
        }

        /* Additional stepper spacing and layout fixes */
        .bs-stepper .step {
            margin: 0 10px;
            min-width: 120px;
        }

        .bs-stepper .step-trigger {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
            height: 100px;
            justify-content: center;
        }

        .bs-stepper .bs-stepper-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            width: 100%;
        }

        .bs-stepper .step {
            margin: 0 10px;
            min-width: 120px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Ensure labels maintain center alignment */
        .bs-stepper .bs-stepper-label span,
        .bs-stepper .bs-stepper-label div {
            text-align: center;
            width: 100%;
        }
    </style>
@endsection
@section('content')

    @php
        // تحديد الخطوات بناءً على وجود اسم المستخدم
        $steps = [];
        $hasName = !empty(auth()->user()->name);

        // إذا لم يكن للمستخدم اسم مسجل، نضيف خطوة المعلومات الأساسية
        if(!$hasName) {
            $steps[] = app()->getLocale() == 'ar' ? 'المعلومات الأساسية' : 'Basic Information';
        }
        $steps[] = __('order.step_kitchen_area_shape');
        $steps[] = __('order.step_kitchen_type_cost');
        $steps[] = __('order.step_time_style');
        $steps[] = __('order.step_meeting_location');

        $totalSteps = count($steps);

        // إعداد خيارات المدة الزمنية (القيم النصية)
    $locale = app()->getLocale();

    $timeOptions = $locale === 'ar'
        ? ["شهر", "شهرين", "ثلاثة أشهر", "أربعة أشهر", "خمسة أشهر", "ستة أشهر"]
        : ["One Month", "Two Months", "Three Months", "Four Months", "Five Months", "Six Months"];

        // افتراضيًا نختار أول خيار (يمكنك تغييره)
        $defaultTime = old('time_range');
        $defaultTimeIndex = 0;
        if($defaultTime) {
            $found = array_search($defaultTime, $timeOptions);
            $defaultTimeIndex = ($found !== false) ? $found : 0;
        }

        // تحديد الخطوة التي تحتوي على أخطاء
        $errorStep = 0;
        if ($errors->any()) {
            $errorFields = $errors->keys();

            // تحديد الخطوة بناءً على الحقول التي تحتوي على أخطاء
            if (!$hasName && (in_array('name', $errorFields) || in_array('email', $errorFields))) {
                $errorStep = 0;
            } elseif (in_array('kitchen_area', $errorFields) || in_array('kitchen_shape', $errorFields)) {
                $errorStep = $hasName ? 0 : 1;
            } elseif (in_array('kitchen_type', $errorFields) || in_array('expected_cost', $errorFields)) {
                $errorStep = $hasName ? 1 : 2;
            } elseif (in_array('time_range', $errorFields) || in_array('kitchen_style', $errorFields)) {
                $errorStep = $hasName ? 2 : 3;
            } elseif (in_array('meeting_time', $errorFields) || in_array('length_step', $errorFields) || in_array('width_step', $errorFields)) {
                $errorStep = $hasName ? 3 : 4;
            }
        }
    @endphp

    <div style="background-color: #f3f3f3" class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center pt-5 pb-5 main-container {{ $errors->any() ? 'has-errors' : '' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="border-radius: 28px;background-color: white;margin: auto">
                <div class="col-md-8 col-sm-12 col-lg-8">

                    <!-- Bootstrap Stepper -->
                    <div id="bs-stepper" class="bs-stepper">
                        <div class="bs-stepper-header">
                        @if(!$hasName)
                            <!-- Step 1: Basic Information -->
                                <div class="step" data-target="#step-1">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.basic_information') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 2: Kitchen Area & Shape -->
                                <div class="step" data-target="#step-2">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_kitchen_area_shape') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 3: Kitchen Type & Cost -->
                                <div class="step" data-target="#step-3">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_kitchen_type_cost') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 4: Time & Style -->
                                <div class="step" data-target="#step-4">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_time_style') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 5: Meeting & Location -->
                                <div class="step" data-target="#step-5">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_meeting_location') }}
                                        </span>
                                    </div>
                                </div>
                        @else
                            <!-- Step 1: Kitchen Area & Shape -->
                                <div class="step" data-target="#step-1">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_kitchen_area_shape') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 2: Kitchen Type & Cost -->
                                <div class="step" data-target="#step-2">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_kitchen_type_cost') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 3: Time & Style -->
                                <div class="step" data-target="#step-3">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_time_style') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="bs-stepper-line"></div>

                                <!-- Step 4: Meeting & Location -->
                                <div class="step" data-target="#step-4">
                                    <div class="step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">
                                            {{ __('order.step_meeting_location') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- End Bootstrap Stepper -->

                        <!-- رسائل النجاح والأخطاء -->
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <i class="bx bx-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <i class="bx bx-error-triangle"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <i class="bx bx-error-triangle"></i>
                                <strong>{{ app()->getLocale() == 'ar' ? 'يرجى تصحيح الأخطاء التالية:' : 'Please correct the following errors:' }}</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('orders.store') }}" method="POST" onsubmit="return debugFormValues()">
                        @csrf

                        <!-- الخطوة 1: المعلومات الأساسية (تظهر فقط إذا لم يكن للمستخدم اسم) -->
                            @if(!$hasName)
                                <div class="form-step user-info-step {{ $errors->has('name') || $errors->has('email') ? 'has-errors' : '' }}" id="form-step-0">
                                    <h5 class="text-center mb-4">@lang('order.personal_information')</h5>
                                    <div class="mb-4">
                                        <label for="name">@lang('order.username')</label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}">
                                        @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="email">@lang('order.email')</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email address' }}">
                                        @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end" style="direction: ltr;">
                                        <a type="button" onclick="nextPrev(1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2">
                                            {{ app()->getLocale() == 'ar' ? 'التالي' : 'Next' }}
                                            <i class="bx bx-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                        @endif

                        <!-- الخطوة 2: مساحة وشكل المطبخ (مع 4 صور لاختيار شكل المطبخ) -->
                            <div class="form-step {{ $errors->has('kitchen_area') || $errors->has('kitchen_shape') ? 'has-errors' : '' }}" id="form-step-{{ $hasName ? 0 : 1 }}">
                                <h5 class="text-center mb-3">@lang('order.kitchen_area_and_shape')</h5>

                                <div class="mb-3">
                                    <label for="kitchen_area" class="mb-2">@lang('order.kitchen_area'):</label>
                                    <div class="d-flex align-items-center gap-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                        <input type="range" name="kitchen_area" id="kitchen_area"
                                               value="{{ old('kitchen_area') ?? 6 }}" min="1" max="100" style="accent-color: #0A4740; width: 200px;">
                                        <span id="kitchen_area_value" class="fw-bold" style="color: #0A4740;">{{ old('kitchen_area') ?? 6 }}m<sup>2</sup></span>
                                    </div>
                                    @error('kitchen_area')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>@lang('order.kitchen_shape'):</label>
                                    <div class="kitchen-shapes-container">
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_shape" value="مطبخ له شكل حرف L" {{ old('kitchen_shape')=='مطبخ له شكل حرف L' ? 'checked' : '' }}>
                                            @php
                                                $locale = app()->getLocale();
                                                $img = 'L-Shaped kitchen.png';
                                                $img2 = 'U-Shaped Kitchen.png';
                                                $img3 = 'Linear Kitchen.png';
                                                $img4 = 'Parallel Kitchen.png';
                                            @endphp
                                            <div class="kitchen-shape-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/' . $img) }}" alt="@lang('order.kitchen_shapes.مطبخ له شكل حرف L')">
                                                <div class="kitchen-shape-label">
                                                    {{ app()->getLocale() == 'ar' ? 'على شكل حرف L' : 'L-Shaped Kitchen' }}
                                                </div>
                                            </div>
                                        </label>
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_shape" value="مطبخ له شكل حرف U" {{ old('kitchen_shape')=='مطبخ له شكل حرف U' ? 'checked' : '' }}>
                                            <div class="kitchen-shape-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/'.$img2) }}" alt="@lang('order.kitchen_shapes.مطبخ له شكل حرف U')">
                                                <div class="kitchen-shape-label">
                                                    {{ app()->getLocale() == 'ar' ? 'على شكل حرف U' : 'U-Shaped Kitchen' }}
                                                </div>
                                            </div>
                                        </label>
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_shape" value="مستقيم" {{ old('kitchen_shape')=='مستقيم' ? 'checked' : '' }}>
                                            <div class="kitchen-shape-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/'.$img3) }}" alt="@lang('order.kitchen_shapes.مستقيم')">
                                                <div class="kitchen-shape-label">
                                                    {{ app()->getLocale() == 'ar' ? 'مستقيم' : 'Linear Kitchen' }}
                                                </div>
                                            </div>
                                        </label>
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_shape" value="متوازي" {{ old('kitchen_shape')=='متوازي' ? 'checked' : '' }}>
                                            <div class="kitchen-shape-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/'.$img4) }}" alt="@lang('order.kitchen_shapes.متوازي')">
                                                <div class="kitchen-shape-label">
                                                    {{ app()->getLocale() == 'ar' ? 'متوازي' : 'Parallel Kitchen' }}
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @error('kitchen_shape')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="navigation-buttons">
                                    @if(!$hasName)
                                        <a type="button" onclick="nextPrev(-1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 back-btn">
                                            <i class="bx bx-chevron-left"></i>
                                            {{ app()->getLocale() == 'ar' ? 'السابق' : 'Back' }}
                                        </a>
                                    @else
                                        <div class="back-btn"></div>
                                    @endif
                                    <a type="button" onclick="nextPrev(1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 next-btn">
                                        {{ app()->getLocale() == 'ar' ? 'التالي' : 'Next' }}
                                        <i class="bx bx-chevron-right"></i>
                                    </a>
                                </div>
                            </div>


                            <!-- الخطوة 3: نوع المطبخ والتكلفة (مع خيارات للكلفة) -->


                            <div class="form-step {{ $errors->has('kitchen_type') || $errors->has('expected_cost') ? 'has-errors' : '' }}" id="form-step-{{ $hasName ? 1 : 2 }}">
                                <h5 class="text-center mb-3">@lang('order.kitchen_type_and_cost')</h5>

                                <!-- Kitchen Type -->
                                <div class="mb-3">
                                    <label>@lang('order.select_kitchen_type'):</label>
                                    <div class="radio-options" id="kitchen-type-options">
                                        <label class="radio-container">
                                            <input type="radio" name="kitchen_type" value="قديم" {{ old('kitchen_type') == 'قديم' ? 'checked' : '' }}>
                                            <span class="radio-label">@lang('order.kitchen_type_old')</span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" name="kitchen_type" value="جديد" {{ old('kitchen_type') == 'جديد' ? 'checked' : '' }}>
                                            <span class="radio-label">@lang('order.kitchen_type_new')</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Expected Cost -->
                                <div class="mb-3">
                                    <label>@lang('order.select_expected_cost'):</label>
                                    <div class="radio-options" id="cost-options">
                                        <label class="radio-container">
                                            <input type="radio" name="expected_cost" value="20000" {{ old('expected_cost') == '20000' ? 'checked' : '' }}>
                                            <span class="radio-label">@lang('order.cost_below_20')</span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" name="expected_cost" value="40000" {{ old('expected_cost') == '40000' ? 'checked' : '' }}>
                                            <span class="radio-label">@lang('order.cost_20_40')</span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" name="expected_cost" value="60000" {{ old('expected_cost') == '60000' ? 'checked' : '' }}>
                                            <span class="radio-label">@lang('order.cost_above_40')</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="navigation-buttons">
                                    <a type="button" onclick="nextPrev(-1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 back-btn">
                                        <i class="bx bx-chevron-left"></i>
                                        {{ app()->getLocale() == 'ar' ? 'السابق' : 'Back' }}
                                    </a>
                                    <a type="button" onclick="nextPrev(1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 next-btn">
                                        {{ app()->getLocale() == 'ar' ? 'التالي' : 'Next' }}
                                        <i class="bx bx-chevron-right"></i>
                                    </a>
                                </div>
                            </div>





                            <!-- الخطوة 4: المدة الزمنية وستايل المطبخ (مع صور لاختيار ستايل المطبخ) -->
                            <div class="form-step {{ $errors->has('time_range') || $errors->has('kitchen_style') ? 'has-errors' : '' }}" id="form-step-{{ $hasName ? 2 : 3 }}">
                                <h5 class="text-center mb-3">@lang('order.time_and_style')</h5>

                                <!-- Time Range -->
                                <div class="mb-3">
                                    <label for="time_range_slider" class="mb-2">@lang('order.time_range'):</label>
                                    <div class="d-flex align-items-center gap-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                        <input type="range" id="time_range_slider" min="0" max="5" step="1" value="{{ $defaultTimeIndex }}" style="accent-color: #0A4740; width: 200px;">
                                        <span id="time_range_value" class="fw-bold" style="color: #0A4740;">
                                        @php
                                            $timeRangeKeys = ['شهر', 'شهرين', 'ثلاثة أشهر', 'أربعة أشهر', 'خمسة أشهر', 'ستة أشهر'];
                                            $currentKey = $timeRangeKeys[$defaultTimeIndex];
                                        @endphp
                                            {{ __('order.time_ranges.' . $currentKey) }}
                                    </span>
                                    </div>

                                    <!-- التخزين دائمًا بالعربية -->
                                    <input type="hidden" name="time_range" id="time_range_hidden" value="{{ ["شهر", "شهرين", "ثلاثة أشهر", "أربعة أشهر", "خمسة أشهر", "ستة أشهر"][$defaultTimeIndex] }}">

                                    @error('time_range')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kitchen Style -->
                                <div class="mb-3">
                                    <label>@lang('order.select_kitchen_style'):</label>
                                    <div class="kitchen-styles-container">
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_style" value="عصري" {{ old('kitchen_style') == 'عصري' ? 'checked' : '' }}>
                                            <div class="kitchen-style-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Modern.webp') }}" alt="@lang('order.kitchen_styles.عصري')">
                                                <div class="kitchen-style-label">{{ app()->getLocale() == 'ar' ? 'عصري' : 'Modern' }}</div>
                                            </div>
                                        </label>
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_style" value="كلاسيكي" {{ old('kitchen_style') == 'كلاسيكي' ? 'checked' : '' }}>
                                            <div class="kitchen-style-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Classic.webp') }}" alt="@lang('order.kitchen_styles.كلاسيكي')">
                                                <div class="kitchen-style-label">{{ app()->getLocale() == 'ar' ? 'كلاسيكي' : 'Classic' }}</div>
                                            </div>
                                        </label>
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_style" value="أنيق" {{ old('kitchen_style') == 'أنيق' ? 'checked' : '' }}>
                                            <div class="kitchen-style-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Elegant.webp') }}" alt="@lang('order.kitchen_styles.انيق')">
                                                <div class="kitchen-style-label">{{ app()->getLocale() == 'ar' ? 'أنيق' : 'Elegant' }}</div>
                                            </div>
                                        </label>
                                        <label class="radio-image tryout">
                                            <input type="radio" name="kitchen_style" value="مريح" {{ old('kitchen_style') == 'مريح' ? 'checked' : '' }}>
                                            <div class="kitchen-style-container">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Comfortable.webp') }}" alt="@lang('order.kitchen_styles.مريح')">
                                                <div class="kitchen-style-label">{{ app()->getLocale() == 'ar' ? 'مريح' : 'Comfortable' }}</div>
                                            </div>
                                        </label>
                                    </div>
                                    @error('kitchen_style')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="navigation-buttons">
                                    <a type="button" onclick="nextPrev(-1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 back-btn">
                                        <i class="bx bx-chevron-left"></i>
                                        {{ app()->getLocale() == 'ar' ? 'السابق' : 'Back' }}
                                    </a>
                                    <a type="button" onclick="nextPrev(1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 next-btn">
                                        {{ app()->getLocale() == 'ar' ? 'التالي' : 'Next' }}
                                        <i class="bx bx-chevron-right"></i>
                                    </a>
                                </div>
                            </div>


                            <!-- الخطوة 5: وقت اللقاء والموقع - DISABLED FOR TESTING -->
                            <div class="form-step {{ $errors->has('meeting_time') || $errors->has('length_step') || $errors->has('width_step') ? 'has-errors' : '' }}" id="form-step-{{ $hasName ? 3 : 4 }}">
                                <h5 class="text-center mb-3">@lang('order.meeting_and_location')</h5>

                                <div class="mb-3">
                                    <label for="meeting_time">@lang('order.meeting_time'):</label>
                                    <div class="datetime-field-wrapper" style="position: relative; cursor: pointer;">
                                        <input class="form-control {{ $errors->has('meeting_time') ? 'is-invalid' : '' }}"
                                               type="datetime-local"
                                               name="meeting_time"
                                               id="meeting_time"
                                               value="{{ old('meeting_time') }}"
                                               min="{{ date('Y-m-d\TH:i') }}"
                                               style="cursor: pointer; padding-right: 40px;"
                                               required>
                                        <div class="datetime-field-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; cursor: pointer; z-index: 1; background: transparent;"></div>
                                    </div>
                                    @error('meeting_time')
                                    <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>@lang('order.select_kitchen_location'):</label>
                                    <div id="map" style="width: 100%; height: 300px;"></div>
                                </div>

                                <input type="hidden" name="length_step" id="length_step" value="{{ old('length_step') }}">
                                <input type="hidden" name="width_step" id="width_step" value="{{ old('width_step') }}">
                                <input type="hidden" name="region_name" id="region_name" value="{{ old('region_name') }}">
                                <input type="hidden" name="geocode_string" id="geocode_string" value="{{ old('geocode_string') }}">

                                <div class="mb-3">
                                    <label for="search_map">@lang('order.search_location')</label>
                                    <input id="search_map" type="text" placeholder="{{ app()->getLocale() == 'ar' ? 'ابحث عن موقعك أو انقر على الخريطة' : 'Search for your location or click on the map' }}" class="form-control">
                                    <small class="form-text text-muted">
                                        {{ app()->getLocale() == 'ar' ? 'يمكنك البحث عن موقعك أو النقر مباشرة على الخريطة لتحديد الموقع' : 'You can search for your location or click directly on the map to select a location' }}
                                    </small>
                                </div>

                                <div class="navigation-buttons">
                                    <a type="button" onclick="nextPrev(-1)" class="Dark_Green chevron-hover d-flex align-items-center gap-2 back-btn">
                                        <i class="bx bx-chevron-left"></i>
                                        {{ app()->getLocale() == 'ar' ? 'السابق' : 'Back' }}
                                    </a>
                                    <button type="submit" class="btn button_Dark_Green next-btn">@lang('order.submit_request')</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Stepper JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/js/bs-stepper.min.js"></script>

        <script>
            var currentStepIndex = {{ $errorStep }};
            var totalSteps = {{ $totalSteps }};
            var allFormSteps = document.getElementsByClassName('form-step');
            var hasErrors = {{ $errors->any() ? 'true' : 'false' }};
            var stepper; // Bootstrap Stepper instance

            // إخفاء جميع الخطوات أولاً
            for (var i = 0; i < allFormSteps.length; i++) {
                allFormSteps[i].style.display = 'none';
            }

            // عرض الخطوة التي تحتوي على أخطاء أو أول خطوة
            showStep(currentStepIndex);

            // Initialize Bootstrap Stepper
            document.addEventListener('DOMContentLoaded', function() {
                const currentLang = '{{ app()->getLocale() }}';
                const isRTL = currentLang === 'ar';

                // Initialize stepper
                stepper = new Stepper(document.getElementById('bs-stepper'), {
                    linear: false,
                    animation: true
                });


                // Set RTL direction if Arabic
                if (isRTL) {
                    document.getElementById('bs-stepper').style.direction = 'rtl';
                    document.getElementById('bs-stepper').classList.add('rtl');
                }

                // Set current step and update visual state
                updateStepperVisual(currentStepIndex);

                // If there are errors, highlight the error step
                if (hasErrors) {
                    highlightErrorStep(currentStepIndex);
                }
            });

            function showStep(n) {
                for (var i = 0; i < allFormSteps.length; i++) {
                    allFormSteps[i].style.display = 'none';
                }
                allFormSteps[n].style.display = 'block';
                updateStepper(n);

                // إعادة تهيئة الخريطة إذا كانت الخطوة الأخيرة وتوجد الخريطة
                if (n === totalSteps - 1 && typeof map !== 'undefined') {
                    google.maps.event.trigger(map, 'resize');
                }

                // إضافة تأثير التمرير السلس إلى الخطوة
                setTimeout(function() {
                    allFormSteps[n].scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            }

            function nextPrev(direction) {
                currentStepIndex += direction;
                if (currentStepIndex < 0) currentStepIndex = 0;
                if (currentStepIndex >= totalSteps) currentStepIndex = totalSteps - 1;
                showStep(currentStepIndex);
            }

            // Update stepper when step changes
            function updateStepper(stepIndex) {
                if (stepper) {
                    stepper.to(stepIndex + 1);
                } else {
                }
                // Also update the visual state
                updateStepperVisual(stepIndex);
            }

            // Update stepper visual state (circles and lines)
            function updateStepperVisual(stepIndex) {
                const steps = document.querySelectorAll('.bs-stepper .step');
                const lines = document.querySelectorAll('.bs-stepper .bs-stepper-line');


                steps.forEach((step, index) => {
                    const circle = step.querySelector('.bs-stepper-circle');
                    const label = step.querySelector('.bs-stepper-label');

                    // Remove all classes first (but preserve error state)
                    step.classList.remove('active', 'completed');
                    circle.classList.remove('active', 'completed');
                    label.classList.remove('active', 'completed');

                    if (index === stepIndex) {
                        // Current step
                        step.classList.add('active');
                        circle.classList.add('active');
                        label.classList.add('active');
                    } else if (index < stepIndex) {
                        // Completed steps
                        step.classList.add('completed');
                        circle.classList.add('completed');
                        label.classList.add('completed');
                    } else {
                    }
                });

                // Update connecting lines
                lines.forEach((line, index) => {
                    if (index < stepIndex) {
                        // Line is completed (fill with #0A4740)
                        line.classList.add('completed');
                    } else {
                        // Line is not completed yet
                        line.classList.remove('completed');
                    }
                });

                // Re-apply error highlighting if there are errors
                if (hasErrors) {
                    highlightErrorStep(currentStepIndex);
                }
            }

            // Function to highlight error step
            function highlightErrorStep(errorStepIndex) {
                const steps = document.querySelectorAll('.bs-stepper .step');
                const lines = document.querySelectorAll('.bs-stepper .bs-stepper-line');


                // Remove any existing error classes
                steps.forEach(step => {
                    step.classList.remove('has-error');
                });

                // Add error class to the step with errors
                if (steps[errorStepIndex]) {
                    steps[errorStepIndex].classList.add('has-error');
                }

                // Also highlight the line before the error step if it exists
                if (errorStepIndex > 0 && lines[errorStepIndex - 1]) {
                    lines[errorStepIndex - 1].classList.add('has-error');
                }
            }


        </script>

        <!-- تضمين خرائط جوجل -->
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=geometry,places&callback=initMap" async defer></script>
        <script>
            let map;
            let marker;
            let geocoder;
            let autocomplete;
            let locationManuallySelected = false; // Flag to track if user has manually selected a location
            let currentLocationUsed = false; // Flag to track if current location was used initially

            function initMap() {
                // Check if we have old location data from validation errors
                var oldLat = document.getElementById('length_step').value;
                var oldLng = document.getElementById('width_step').value;

                if (oldLat && oldLng && oldLat !== '' && oldLng !== '') {
                    // Use old location data
                    const oldLocation = {
                        lat: parseFloat(oldLat),
                        lng: parseFloat(oldLng)
                    };
                    initMapAtLocation(oldLocation, 15);
                    placeMarker(oldLocation, map);
                    geocodeLatLng(oldLocation);

                    const regionName = getRegionNameFromLatLng(oldLocation, map);
                    if (regionName) {
                        // Convert Arabic name to English if needed
                        const englishRegionName = regionNameMapping[regionName] || regionName;
                        document.getElementById('region_name').value = englishRegionName;
                    }
                } else {
                    // Try to get user's current location for better UX, but make it overridable
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function (position) {
                                // Only use current location if user hasn't manually selected one
                                if (!locationManuallySelected) {
                                const userLocation = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                };
                                initMapAtLocation(userLocation, 15);
                                document.getElementById('length_step').value = userLocation.lat;
                                document.getElementById('width_step').value = userLocation.lng;
                                geocodeLatLng(userLocation);

                                const regionName = getRegionNameFromLatLng(userLocation, map);
                                if (regionName) {
                                        // Convert Arabic name to English if needed
                                        const englishRegionName = regionNameMapping[regionName] || regionName;
                                        document.getElementById('region_name').value = englishRegionName;
                                }

                                placeMarker(userLocation, map);
                                    currentLocationUsed = true;
                                    
                                    // Show a subtle message that current location was used
                                    showLocationSelectedMessage('تم استخدام موقعك الحالي. يمكنك البحث عن موقع آخر أو النقر على الخريطة لتغييره.');
                                }
                            },
                            function () {
                                console.warn("لم يتم السماح بالحصول على الموقع أو فشل في الحصول عليه.");
                                initMapAtDefaultLocation(); // في حال الرفض أو الفشل
                            }
                        );
                    } else {
                        console.warn("المتصفح لا يدعم تحديد الموقع الجغرافي.");
                        initMapAtDefaultLocation();
                    }
                }
            }

            function initMapAtDefaultLocation() {
                const defaultLocation = { lat: 24.7136, lng: 46.6753 }; // الرياض
                initMapAtLocation(defaultLocation, 8);
            }

            function initMapAtLocation(center, zoomLevel) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: center,
                    zoom: zoomLevel
                });
                geocoder = new google.maps.Geocoder();

                // تحميل الحدود الإدارية للسعودية
                map.data.loadGeoJson('/saudi-arabia-with-regions_1509.geojson', null, function (features) {
                    map.data.addListener('click', function (event) {
                        // Mark that user has manually selected a location
                        locationManuallySelected = true;
                        
                        // If current location was used initially, show a message that it's being overridden
                        
                        const regionName = event.feature.getProperty('name');
                        // Convert Arabic name to English if needed
                        const englishRegionName = regionNameMapping[regionName] || regionName;
                        document.getElementById('region_name').value = englishRegionName;
                        placeMarker(event.latLng, map);
                        geocodeLatLng(event.latLng);
                    });
                });

                // الضغط على الخريطة
                map.addListener('click', function (e) {
                    checkRegionAndPlaceMarker(e.latLng, map);
                });

                // البحث عبر العنوان
                const input = document.getElementById('search_map');
                autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);
                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        alert("لا توجد تفاصيل للعنصر: '" + place.name + "'");
                        return;
                    }
                    
                    // Mark that user has manually selected a location
                    locationManuallySelected = true;
                    
                    // If current location was used initially, show a message that it's being overridden
             
                    
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    
                    // Clear any existing location data and set new location
                    placeMarker(place.geometry.location, map);
                    geocodeLatLng(place.geometry.location);
                    
                    // First try to get region from place address components (most reliable for search)
                    const addressComponents = place.address_components;
                    let regionSet = false;
                    
                    if (addressComponents) {
                        for (let component of addressComponents) {
                            if (component.types.includes('administrative_area_level_1')) {
                                const foundRegion = component.long_name;
                                
                                // First try direct mapping
                                let englishName = regionNameMapping[foundRegion];
                                
                                // If not found, try normalized version
                                if (!englishName) {
                                    const normalizedRegion = normalizeRegionName(foundRegion);
                                    englishName = regionNameMapping[normalizedRegion] || normalizedRegion;
                                }
                                
                                document.getElementById('region_name').value = englishName;
                                regionSet = true;
                                break;
                            }
                        }
                    }
                    
                    // If not set from address components, try GeoJSON
                    if (!regionSet) {
                        const regionName = getRegionNameFromLatLng(place.geometry.location, map);
                        if (regionName) {
                            // Convert Arabic name to English if needed
                            const englishName = regionNameMapping[regionName] || regionName;
                            document.getElementById('region_name').value = englishName;
                            regionSet = true;
                        }
                    }
                    
                    // Final fallback: if still no region found, try to detect from address text
                    if (!regionSet) {
                        const addressText = place.formatted_address || place.name || '';
                        
                        // Check if address contains region names
                        for (const [arabicName, englishName] of Object.entries(regionNameMapping)) {
                            if (addressText.includes(arabicName) || addressText.includes(englishName)) {
                                document.getElementById('region_name').value = englishName;
                                regionSet = true;
                                break;
                            }
                        }
                        
                        // Also check for normalized versions
                        if (!regionSet) {
                            const normalizedAddress = normalizeRegionName(addressText);
                            for (const [arabicName, englishName] of Object.entries(regionNameMapping)) {
                                if (normalizedAddress.includes(arabicName) || normalizedAddress.includes(englishName)) {
                                    document.getElementById('region_name').value = englishName;
                                    regionSet = true;
                                    break;
                                }
                            }
                        }
                        
                        // Ultimate fallback
                        if (!regionSet) {
                            console.warn('No region found, setting default to Riyadh');
                            document.getElementById('region_name').value = 'Riyadh';
                        }
                    }
                    
                    // Debug: Log final region value
                    
                    // Show success message
                    showLocationSelectedMessage(place.formatted_address || place.name);
                });
            }

            // Mapping of Arabic region names to English region names (matching GeoJSON file)
            // Based on actual region names found in saudi-arabia-with-regions_1509.geojson
            const regionNameMapping = {
                'الرياض': 'Riyadh',
                'مكة المكرمة': 'Makkah',
                'المدينة المنورة': 'Madinah',
                'القصيم': 'Qassim',
                'الشرقية': 'Eastern Region',
                'عسير': 'Asir',
                'تبوك': 'Tabuk',
                'حائل': 'Hail',
                'الحدود الشمالية': 'Northern Region',
                'جازان': 'Jizan',
                'نجران': 'Najran',
                'الباحة': 'Bahah',
                'الجوف': 'Jawf',
                // Additional variations that Google Places API might return
                'Riyadh Province': 'Riyadh',
                'Makkah Province': 'Makkah',
                'Madinah Province': 'Madinah',
                'Qassim Province': 'Qassim',
                'Eastern Province': 'Eastern Region',
                'Asir Province': 'Asir',
                'Tabuk Province': 'Tabuk',
                'Hail Province': 'Hail',
                'Northern Province': 'Northern Region',
                'Jizan Province': 'Jizan',
                'Najran Province': 'Najran',
                'Bahah Province': 'Bahah',
                'Jawf Province': 'Jawf'
            };

            // Reverse mapping for fallback (English to Arabic)
            const reverseRegionMapping = {
                'Riyadh': 'الرياض',
                'Makkah': 'مكة المكرمة',
                'Madinah': 'المدينة المنورة',
                'Qassim': 'القصيم',
                'Eastern Region': 'الشرقية',
                'Asir': 'عسير',
                'Tabuk': 'تبوك',
                'Hail': 'حائل',
                'Northern Region': 'الحدود الشمالية',
                'Jizan': 'جازان',
                'Najran': 'نجران',
                'Bahah': 'الباحة',
                'Jawf': 'الجوف'
            };

            // Function to normalize region names (remove common suffixes/prefixes)
            function normalizeRegionName(regionName) {
                if (!regionName) return regionName;
                
                // Remove common suffixes
                let normalized = regionName
                    .replace(/\s+Province$/i, '')
                    .replace(/\s+Region$/i, '')
                    .replace(/\s+Governorate$/i, '')
                    .replace(/\s+Emirate$/i, '')
                    .trim();
                
                return normalized;
            }

            function getRegionNameFromLatLng(latLng, map) {
                let regionName = null;
                
                // First try to get region from GeoJSON
                try {
                map.data.forEach(function (feature) {
                    const geometry = feature.getGeometry();
                    if (google.maps.geometry.poly.containsLocation(latLng, geometry)) {
                        regionName = feature.getProperty('name');
                        }
                    });
                } catch (error) {
                    console.warn('Error checking GeoJSON regions:', error);
                }
                
                // If no region found from GeoJSON, try to get it from geocoding
                if (!regionName) {
                    geocoder.geocode({ location: latLng }, function (results, status) {
                        if (status === 'OK' && results[0]) {
                            // Try to extract region from address components
                            const addressComponents = results[0].address_components;
                            for (let component of addressComponents) {
                                if (component.types.includes('administrative_area_level_1')) {
                                    let foundRegion = component.long_name;
                                    // Convert Arabic name to English if needed
                                    const englishName = regionNameMapping[foundRegion] || foundRegion;
                                    document.getElementById('region_name').value = englishName;
                                    break;
                                }
                            }
                        }
                    });
                } else {
                    // Convert Arabic name to English if needed
                    const englishName = regionNameMapping[regionName] || regionName;
                    document.getElementById('region_name').value = englishName;
                    return englishName;
                }
                
                return regionName;
            }

            function checkRegionAndPlaceMarker(latLng, map) {
                let isInsideRegion = false;
                let regionName = "";
                map.data.forEach(function (feature) {
                    const geometry = feature.getGeometry();
                    if (google.maps.geometry.poly.containsLocation(latLng, geometry)) {
                        isInsideRegion = true;
                        regionName = feature.getProperty('name');
                    }
                });
                if (isInsideRegion) {
                    // Mark that user has manually selected a location
                    locationManuallySelected = true;
                    
                  
                    
                    // Convert Arabic name to English if needed
                    const englishRegionName = regionNameMapping[regionName] || regionName;
                    document.getElementById('region_name').value = englishRegionName;
                    
                    placeMarkerAndPanTo(latLng, map, englishRegionName);
                    geocodeLatLng(latLng);
                    
                    // Show success message for map click
                    geocoder.geocode({ location: latLng }, function (results, status) {
                        if (status === 'OK' && results[0]) {
                            showLocationSelectedMessage(results[0].formatted_address);
                        }
                    });
                } else {
                    alert('لا يمكنك اختيار نقطة خارج مناطق السعودية.');
                }
                
                // Final fallback: if still no region found, set a default
                if (!document.getElementById('region_name').value) {
                    console.warn('No region found from map click, setting default to Riyadh');
                    document.getElementById('region_name').value = 'Riyadh';
                }
            }

            function placeMarker(location, map) {
                if (marker) {
                    marker.setPosition(location);
                } else {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
                document.getElementById('length_step').value = location.lat();
                document.getElementById('width_step').value = location.lng();
            }

            function placeMarkerAndPanTo(latLng, map, regionName) {
                placeMarker(latLng, map);
            }

            function geocodeLatLng(latLng) {
                geocoder.geocode({ location: latLng }, function (results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            document.getElementById('geocode_string').value = results[0].formatted_address;
                        } else {
                            alert('لم يتم العثور على عنوان.');
                        }
                    } else {
                        alert('فشل الـ Geocoder بسبب: ' + status);
                    }
                });
            }

            // Function to show location selection confirmation
            function showLocationSelectedMessage(address) {
                const message = document.createElement('div');
                message.className = 'alert alert-success location-selected-message';
                message.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 1000;
                    max-width: 300px;
                    font-size: 14px;
                    padding: 10px 15px;
                    border-radius: 5px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                `;
                message.innerHTML = `
                    <i class="bx bx-check-circle"></i>
                    <strong>{{ app()->getLocale() == 'ar' ? 'تم اختيار الموقع:' : 'Location selected:' }}</strong><br>
                    ${address}
                `;
                
                document.body.appendChild(message);
                
                // Remove message after 3 seconds
                setTimeout(() => {
                    if (message.parentNode) {
                        message.parentNode.removeChild(message);
                    }
                }, 3000);
            }

            // Debug function to check form values before submission
            function debugFormValues() {
             
                
                // Check if all required fields are filled
                const requiredFields = ['length_step', 'width_step', 'region_name', 'geocode_string'];
                const missingFields = requiredFields.filter(field => !document.getElementById(field).value);
                
                if (missingFields.length > 0) {
                    console.warn('Missing required fields:', missingFields);
                    alert('يرجى التأكد من تحديد الموقع على الخريطة');
                    return false;
                }
                
              
                
                return true;
            }
        </script>


        <!-- كود تحديث عرض قيمة الشريط لحجم المطبخ -->
        <script>
            var kitchenRange = document.getElementById('kitchen_area');
            var kitchenValue = document.getElementById('kitchen_area_value');
            if(kitchenRange && kitchenValue){
                // Set initial value from old input or default
                var initialValue = kitchenRange.value;
                kitchenValue.innerHTML = initialValue + 'm<sup>2</sup>';

                // Update progress on load
                updateRangeProgress(kitchenRange);

                kitchenRange.addEventListener('input', function(){
                    kitchenValue.innerHTML = this.value + 'm<sup>2</sup>';
                    updateRangeProgress(this);
                });
            }

            function updateRangeProgress(rangeInput) {
                const value = (rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min) * 100;
                rangeInput.style.setProperty('--range-progress', value + '%');
            }
        </script>



        <!-- تنسيق الدوائر (Stepper) وتنسيق اختيار الصور -->

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // إدارة تغييرات نوع المطبخ
                setupRadioSelection('kitchen-type-options');

                // إدارة تغييرات التكلفة المتوقعة
                setupRadioSelection('cost-options');

                function setupRadioSelection(groupId) {
                    var radios = document.querySelectorAll('#' + groupId + ' input[type="radio"]');

                    radios.forEach(function(radio) {
                        radio.addEventListener('change', function() {
                            resetBackgrounds(groupId);
                            if (radio.checked) {
                                radio.parentNode.classList.add('selected'); // أضف الفئة لتغيير اللون
                            }
                        });

                        // تعيين الخيار المختار مسبقًا عند تحميل الصفحة
                        if (radio.checked) {
                            radio.parentNode.classList.add('selected');
                        }
                    });
                }

                function resetBackgrounds(groupId) {
                    document.querySelectorAll('#' + groupId + ' .radio-container').forEach(function(container) {
                        container.classList.remove('selected');
                    });
                }
            });
        </script>
        <script>
            // Prevent form submission when pressing Enter in search field
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search_map');
                if (searchInput) {
                    searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // منع إرسال الفورم
                }
            });
                }
            });
        </script>


        <script>
            // تعريف القيم بلغتين
            const timeRanges = {
                ar: ["شهر", "شهرين", "3 أشهر", "4 أشهر", "5 أشهر", "6 أشهر"],
                en: ["1 Month", "2 Months", "3 Months", "4 Months", "5 Months", "6 Months"]
            };

            // القيم العربية للتخزين (نفس القيم العربية)
            const arabicValues = timeRanges.ar;

            const slider = document.getElementById('time_range_slider');
            const valueDisplay = document.getElementById('time_range_value');
            const hiddenInput = document.getElementById('time_range_hidden');

            // تحديد لغة الصفحة من Laravel
            const currentLang = "{{ app()->getLocale() }}"; // 'ar' أو 'en'

            // Initialize the display with current value
            if (slider && valueDisplay && hiddenInput) {
                const initialIndex = parseInt(slider.value);
                valueDisplay.textContent = timeRanges[currentLang][initialIndex];
                hiddenInput.value = arabicValues[initialIndex];

                // Initialize the CSS custom property for slider fill
                const percentage = (initialIndex / 5) * 100;
                slider.style.setProperty('--range-progress', percentage + '%');
            }

            slider.addEventListener('input', function() {
                const index = parseInt(this.value);
                valueDisplay.textContent = timeRanges[currentLang][index]; // يعرض حسب اللغة
                hiddenInput.value = arabicValues[index]; // يخزن بالعربية دائمًا

                // Update the CSS custom property for slider fill
                const percentage = (index / 5) * 100;
                this.style.setProperty('--range-progress', percentage + '%');
            });
        </script>

        <style>
            /* FINAL OVERRIDE - Loaded last to ensure highest priority */
            /* Override ALL possible range input styling */
            input[type="range"],
            input[type="range"]:hover,
            input[type="range"]:focus,
            input[type="range"]:active {
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                appearance: none !important;
                outline: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 0 !important;
                transform: none !important;
                filter: none !important;
                color: inherit !important;
                background: #e0e0e0 !important;
                height: 6px !important;
                border-radius: 3px !important;
            }

            /* Firefox-specific styling */
            input[type="range"]::-moz-range-track {
                background: #e0e0e0 !important;
                border: none !important;
                border-radius: 3px !important;
                height: 6px !important;
            }

            /* Firefox progress fill */
            input[type="range"]::-moz-range-progress {
                background: #0A4740 !important;
                border-radius: 3px !important;
                height: 6px !important;
            }

            /* RTL Firefox progress fill */
            [dir="rtl"] input[type="range"]::-moz-range-progress {
                background: #0A4740 !important;
                border-radius: 3px !important;
                height: 6px !important;
                /* Firefox automatically handles RTL direction */
            }

            input[type="range"]::-moz-range-thumb {
                background: #0A4740 !important;
                border: none !important;
                border-radius: 50% !important;
                width: 16px !important;
                height: 16px !important;
                cursor: pointer !important;
                margin-top: -5px !important;
            }

            input[type="range"]::-moz-range-thumb:hover,
            input[type="range"]::-moz-range-thumb:active {
                background: #0A4740 !important;
            }

            /* Webkit browsers styling */
            input[type="range"]::-webkit-slider-track {
                background: #e0e0e0 !important;
                border: none !important;
                border-radius: 3px !important;
                height: 6px !important;
            }

            /* Webkit progress fill */
            input[type="range"]::-webkit-slider-runnable-track {
                background: linear-gradient(to right, #0A4740 0%, #0A4740 var(--range-progress, 0%), #e0e0e0 var(--range-progress, 0%), #e0e0e0 100%) !important;
                border-radius: 3px !important;
                height: 6px !important;
            }

            /* RTL Webkit progress fill */
            [dir="rtl"] input[type="range"]::-webkit-slider-runnable-track {
                background: linear-gradient(to left, #0A4740 0%, #0A4740 var(--range-progress, 0%), #e0e0e0 var(--range-progress, 0%), #e0e0e0 100%) !important;
            }

            input[type="range"]::-webkit-slider-thumb {
                background: #0A4740 !important;
                border: none !important;
                border-radius: 50% !important;
                width: 16px !important;
                height: 16px !important;
                cursor: pointer !important;
                -webkit-appearance: none !important;
                margin-top: -5px !important;
            }

            input[type="range"]::-webkit-slider-thumb:hover,
            input[type="range"]::-webkit-slider-thumb:active {
                background: #0A4740 !important;
            }

            /* Specific ID targeting for maximum specificity */
            #kitchen_area,
            #time_range_slider {
                accent-color: #0A4740 !important;
            }

            /* RTL Slider Fix - Visual only, keep logical behavior */
            [dir="rtl"] input[type="range"] {
                /* Don't change direction - keep logical behavior */
            }
        </style>

        <script>
            // RTL Slider Fix for Arabic - Visual fill only
            document.addEventListener('DOMContentLoaded', function() {
                const isRTL = document.documentElement.dir === 'rtl' || '{{ app()->getLocale() }}' === 'ar';

                if (isRTL) {
                    const sliders = document.querySelectorAll('input[type="range"]');
                    sliders.forEach(slider => {
                        // Keep logical behavior but adjust visual fill
                        slider.addEventListener('input', function() {
                            const value = this.value;
                            const min = this.min;
                            const max = this.max;
                            const percentage = ((value - min) / (max - min)) * 100;

                            // Set the percentage normally - CSS handles RTL direction
                            this.style.setProperty('--range-progress', percentage + '%');
                        });

                        // Initialize the RTL fill
                        slider.dispatchEvent(new Event('input'));
                    });
                }
            });

            // Initialize all sliders with proper progress on page load
            document.addEventListener('DOMContentLoaded', function() {
                const allSliders = document.querySelectorAll('input[type="range"]');
                allSliders.forEach(slider => {
                    const value = slider.value;
                    const min = slider.min;
                    const max = slider.max;
                    const percentage = ((value - min) / (max - min)) * 100;
                    slider.style.setProperty('--range-progress', percentage + '%');
                });
            });

            // Meeting time validation and enhancement
            document.addEventListener('DOMContentLoaded', function() {
                const meetingTimeInput = document.getElementById('meeting_time');
                const datetimeOverlay = document.querySelector('.datetime-field-overlay');

                if (meetingTimeInput) {
                    // Set minimum date/time to current time
                    const now = new Date();
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

                    meetingTimeInput.min = minDateTime;

                    // Add validation on change
                    meetingTimeInput.addEventListener('change', function() {
                        const selectedDateTime = new Date(this.value);
                        const currentDateTime = new Date();

                        if (selectedDateTime <= currentDateTime) {
                            alert('{{ app()->getLocale() == "ar" ? "يرجى اختيار وقت في المستقبل" : "Please select a future date and time" }}');
                            this.value = '';
                            this.focus();
                        }
                    });

                    // Make the entire field clickable by adding click event to overlay
                    if (datetimeOverlay) {
                        datetimeOverlay.addEventListener('click', function() {
                            meetingTimeInput.focus();
                            meetingTimeInput.showPicker && meetingTimeInput.showPicker();
                        });
                    }

                    // Make the entire field clickable by adding click event to label
                    const label = document.querySelector('label[for="meeting_time"]');
                    if (label) {
                        label.style.cursor = 'pointer';
                        label.addEventListener('click', function() {
                            meetingTimeInput.focus();
                            meetingTimeInput.showPicker && meetingTimeInput.showPicker();
                        });
                    }
                }
            });
        </script>

@endsection
