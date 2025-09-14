@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')@lang('about.About Oppolia Online') @endsection
@section('content')
    <style>
        
        .card-height {
            height: 318px;
            box-shadow: 0px 15.14px 15.14px 0px rgba(211, 218, 235, 0.7) !important;
        }

        /* Equal height cards for timeline */
        .new-arrivals.owl-carousel {
            display: flex !important;
            align-items: stretch !important;
        }
        
        .new-arrivals .owl-stage {
            display: flex !important;
            align-items: stretch !important;
        }
        
        .new-arrivals .owl-item {
            display: flex !important;
            align-items: stretch !important;
        }
        
        .new-arrivals .item {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
        }
        
        .new-arrivals .item .card {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            gap: 24px;
        }

        .text-green {
            color: rgba(10, 71, 64, 1);
        }

        /* Each slide item: position relative & room for arrow */
        .new-arrivals .item .card {
            position: relative;
            overflow: hidden;
        }

        /* Hover-background SVG via ::before */
        .new-arrivals .item .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("/Frontend/assets/images/icons/o.svg") no-repeat center center;
            background-size: 150px auto;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.4s ease, transform 0.4s ease;
            pointer-events: none;
        }

        .new-arrivals .item .card:hover::before {
            opacity: 1;
            transform: scale(1);
        }

        /* Arrow sits inside each card */
        .new-arrivals .item .slide-arrow {
            position: absolute;
            top: 50%;
            right: 0;
            width: 40px;
            height: 120px;
            transform: translateY(-50%) rotate(180deg);
            transition: top 0.5s ease, right 0.5s ease, left 0.5s ease, transform 0.9s ease;
            pointer-events: none;
            margin-right: -25px;
        }

        .new-arrivals .item:hover .slide-arrow {
            top: -40px;
            right: auto;
            left: calc(50% - 20px);
            transform: translate(0, 0) rotate(90deg);
            opacity: 0.25;
        }

        .illu-container {
            position: relative;
            width: 100%;
            height: 200px;
        }

        /* 1) Logo mark centered under everything */
        .logomark {
            position: absolute;
            top: 50%;
            left: 50%;
            height: 200px;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 1;
        }

        /* 2&3) Dot patterns & 4) trophies */
        .dots,
        .awards {
            position: absolute;
            transition: transform 0.6s ease-in-out;
            will-change: transform;
        }

        /* Top‐left grid */
        .dots-top {
            top: 20px;
            left: 20px;
            width: 80px;
            height: 80px;
            transform: translateY(0);
            z-index: 2;
        }

        /* Bottom‐right grid */
        .dots-bottom {
            bottom: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            transform: translateY(0);
            z-index: 2;
        }

        /* Trophies */
        .awards {
            position: absolute;
            top: 100%;
            left: 45%;
            transform: translate(100px, -50%);
            transition: transform 0.6s ease-in-out;
            pointer-events: none;
            z-index: 3;
            width: 0;
            height: 0;
            max-width: 100%;
        }

        /* SVG styling - positioned to the left of trophy images initially */
        .awards-svg {
            position: absolute;
            bottom: 0;
            left: -150px;
            width: 150px;
            height: 250px;
            z-index: 0;
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
            opacity: 1;
        }

        .svg-a-path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: drawPath 2s ease-in-out forwards;
            transition: stroke-dashoffset 0.6s ease-in-out;
        }

        @keyframes drawPath {
            to {
                stroke-dashoffset: 0;
            }
        }

        /* stack the two SVGs/images exactly on top of each other */
        .awards img {
            position: absolute;
            bottom: 0;
            width: auto;
            height: 200px;
            transform-origin: bottom center;
            transition: transform 0.6s ease-in-out;
        }

        /* SVG logo (first child) */
        .awards img:nth-child(1) {
            left: -150px;
            z-index: 0;
            transition: transform 0.6s ease-in-out, left 0.6s ease-in-out;
            max-width: 150px;
        }

        /* front trophy (second child) */
        .awards img:nth-child(2) {
            left: -40px;
            z-index: 4;
            transform: scale(1.1);
            transition: transform 0.6s ease-in-out, left 0.6s ease-in-out;
            max-width: 200px;
        }

        /* back trophy (third child) */
        .awards img:nth-child(3) {
            left: -10px;
            z-index: 2;
            transform: scale(1);
            transition: transform 0.6s ease-in-out, left 0.6s ease-in-out;
            max-width: 200px;
        }

        /* on hover: SVG moves right, trophies move left */
        .illu-container:hover .awards img:nth-child(1) {
            left: -115px;
        }

        .illu-container:hover .awards img:nth-child(2) {
            transform: scale(1);
            left: -180px;
        }

        .illu-container:hover .awards img:nth-child(3) {
            transform: scale(1.1);
            left: -150px;
        }


        .illu-container:hover .dots-top {
            transform: translateY(140px);
        }

        .illu-container:hover .dots-bottom {
            transform: translateY(-140px);
        }

        /* Main content container with flexbox */
        .main-content-container {
            display: flex;
            flex-direction: column;
            gap: 4em;
        }

        /* Section styling */
        .content-section {
            width: 100%;
        }

        /* Achievement cards flexbox layout */
        .achievement-cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
        }

        .achievement-cards-container .achievement-card {
            flex: 1 1 calc(50% - 0.5em);
            min-width: 300px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .vision-image {
                height: 400px;
                object-fit: cover;
            }

            .illu-container {
                height: 150px;
            }

            .logomark,
            .awards img {
                height: 200px;
            }
            
            .awards img:nth-child(1) {
                left: -120px;
            }
            
            .awards img:nth-child(2) {
                left: -120px;
            }
            
            .illu-container:hover .awards img:nth-child(1) {
                left: 40px;
            }
            
            .illu-container:hover .awards img:nth-child(2) {
                left: -160px;
            }
            
            .illu-container:hover .awards img:nth-child(3) {
                left: -120px;
            }
        }

        @media (max-width: 768px) {
            .feature-box,
            .supplier-card {
                margin-bottom: 0;
            }

            .vision-image {
                height: 300px;
            }
            
            .illu-container {
                overflow: hidden;
            }
            
            .container-fluid {
                overflow-x: hidden;
            }
        }

        @media (max-width: 576px) {
            .about-text {
                font-size: 1.5rem;
            }

            .section-title,
            .about-title {
                font-size: 1.8rem;
            }

            .illu-container {
                height: 120px;
            }

            .logomark,
            .awards img {
                height: 160px;
            }
            
            .awards img:nth-child(1) {
                left: -100px;
            }
            
            .awards img:nth-child(2) {
                left: -100px;
            }
            
            .illu-container:hover .awards img:nth-child(1) {
                left: 30px;
            }
            
            .illu-container:hover .awards img:nth-child(2) {
                left: -130px;
            }
            
            .illu-container:hover .awards img:nth-child(3) {
                left: -100px;
            }

            .dots-top,
            .dots-bottom {
                width: 60px;
                height: 60px;
            }
        }
    </style>

    <div class="container-fluid about-section position-relative">
        <div class="row">
            <div class="col-12 p-0">
                <img src="{{ asset('Frontend/assets/images/banners/About-Banner.png') }}" alt="About Us Banner" class="img-fluid about-image" loading="lazy">
            </div>
        </div>
        <div class="about-text-overlay">
            <h1 class="about-text">@lang('about.About Oppolia Online')</h1>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="container-fluid" style="background-color: rgba(243, 243, 243, 1);">
        <div class="row px-2 px-lg-4 py-1 py-lg-4">
            <!-- Sidebar Column - Hidden on mobile -->
            <div class="col-lg-2 order-lg-first d-none d-lg-block" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                <aside class="sticky-sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#AboutOppolia">
                                @lang('about.About Oppolia Online')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#Vision">
                                @lang('about.vision')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#production">
                                @lang('about.production')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#history">
                                @lang('about.history')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#team">
                                @lang('about.team')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#achievements">
                                @lang('about.achievements')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#suppliers">
                                @lang('about.suppliers')
                                <i class="bx bx-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content Column -->
            <div class="col-lg-9 p-0" style="display: flex; flex-direction: column; gap: 3rem;">
                <div class="main-content-container">
                    <!-- About Section -->
                    <div id="AboutOppolia" class="content-section">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="about-title">@lang('about.About Oppolia Online')</h2>
                                <h3 class="about-subtitle">@lang('about.A world of elegance and distinction.')</h3>
                                <p class="about-para">
                                    @lang('about.about_oppolia_intro')
                                </p>
                                <p class="about-para">
                                    @lang('about.products_diverse_description')
                                </p>
                                <p class="about-para">
                                  @lang('about.customization_description')
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Our Brand Section -->
                    <div id="Brand" class="content-section">
                        <div class="col-12 section-header">
                            <h2 class="section-about-title">@lang('about.Our Brand')</h2>
                            <p class="section-description">
                               @lang('about.brand_description')
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-between">
                                    <div class="col-md-4 feature-box">
                                        <h3 class="feature-title">@lang('about.Excellence in Growth and Innovation')</h3>
                                        <p class="feature-description">
                                           @lang('about.excellence_description')
                                        </p>
                                    </div>
                                    <div class="col-md-4 feature-box">
                                        <h3 class="feature-title" style="white-space: nowrap;">@lang('about.Setting Global Standards')</h3>
                                        <p class="feature-description">
                                          @lang('about.global_standards_description')
                                        </p>
                                    </div>
                                    <div class="col-md-4 feature-box">
                                        <h3 class="feature-title">@lang('about.Projects and Global Collaboration')</h3>
                                        <p class="feature-description">
                                            @lang('about.collaboration_description')
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vision Section -->
                    <div id="Vision" class="content-section">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-5 p-0">
                                    <img src="{{ asset('Frontend/assets/images/gallery/vision.jpg') }}" alt="Modern Kitchen"
                                         class="img-fluid w-100 vision-image" loading="lazy">
                                </div>
                                <div class="col-lg-7 text-right d-flex flex-column justify-content-center p-4"
                                     style="background: #83B0AB">
                                    <h2 class="vision-title">@lang('about.Our Vision')</h2>
                                    <p class="vision-description">
                                        @lang('about.vision_description')
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Production Section -->
                    <div id="production" class="content-section">
                        <!-- Production section description -->
                        <div class="col-12 production-lines p-3 p-lg-4">
                            <h2 class="section-title mb-3">@lang('about.Our Production')</h2>
                            <h3 class="sub-title mb-3">@lang('about.Production Lines')</h3>
                            <p class="production-para">
                                @lang('about.production_description')
                            </p>
                            <p class="production-para">
                                @lang('about.production_description_1')
                            </p>
                            <p class="production-para">
                                @lang('about.production_description_2')
                            </p>
                        </div>
    </div>

                        <!-- Production capacity and image section -->
                        <div class="col-12">
                            <div class="row gx-0 align-items-stretch justify-content-center">
                                <!-- Production Capacity -->
                                <div class="col-lg-8 col-md-12 align-content-center justify-content-center production-capacity p-3 p-lg-4">
                                    <h3 class="production-subtitle">@lang('about.Production Capacity')</h3>
                                    <ul class="production-li">
                                        <li>@lang('about.Produces over 6,300 kitchen and wardrobe units.')</li>
                                        <li>@lang('about.Ensures timely delivery and customer satisfaction.')</li>
                                        <li>@lang('about.Maintains high production standards using advanced manufacturing technologies.')</li>
                                        <li>@lang('about.Guarantees products meet strict quality standards.')</li>
                                        <li>@lang('about.Fulfills customer needs effectively.')</li>
                                    </ul>
                                </div>

                                <!-- Image Section -->
                                <div class="col-lg-4 col-md-12 p-0 d-flex align-items-stretch">
                                    <img src="{{ asset('Frontend/assets/images/gallery/production.webp') }}"
                                         alt="Production Line" class="img-fluid w-100" style="object-fit: cover; height: 100%;" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- History Section -->
                    <div id="history" class="content-section">
                        <div class="product-grid col-12">
                            <h2 class="section-title mt-4 mb-4">@lang('about.Our History')</h2>
                            <div class="new-arrivals owl-carousel owl-responsive owl-theme" dir="ltr" style="display: flex; align-items: stretch;">
                                <!-- Slide 1 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">1994–1997</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.The Beginnings of Oppolia')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.beginnings_description')
                                        </p>
                                    </div>
                                    <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                        <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                              fill="#509F96" />
                                    </svg>
                                </div>

                                <!-- Slide 2 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">1998–2002</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Expanding Horizons Globally')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.expanding_description')
                                        </p>
                                    </div>
                                    <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                        <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                              fill="#509F96" />
                                    </svg>
                                </div>

                                <!-- Slide 3 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">2003–2009</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Diversification and Development')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.diversification_description')
                                        </p>
                                    </div>
                                    <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                        <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                              fill="#509F96" />
                                    </svg>
                                </div>

                                <!-- Slide 4 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">2010–2014</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Going Global')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.going_global_description')
                                        </p>
                                    </div>
                                    <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                        <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                              fill="#509F96" />
                                    </svg>
                                </div>

                                <!-- Slide 5 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">2015–2019</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Embracing Technological Advancements')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.tech_advancements_description')
                                        </p>
                                    </div>
                                    <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                        <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                              fill="#509F96" />
                                    </svg>
                                </div>

                                <!-- Slide 6 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">2020–2023</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Green Sustainability Initiatives')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.sustainability_description')
                                        </p>
                                    </div>
                                    <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                        <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                              fill="#509F96" />
                                    </svg>
                                </div>

                                <!-- Slide 7 -->
                                <div class="item" style="display: flex; flex-direction: column;">
                                    <div class="card p-3" style="flex: 1; display: flex; flex-direction: column; min-height: 250px;">
                                        <div class="event-date badge text-center">2024</div>
                                        <h5 class="card-title mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Celebrating 30 Years')</h5>
                                        <p class="card-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; flex: 1;">
                                            @lang('about.thirty_years_description')
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Our Team Section -->
                    <div id="team" class="content-section">
                        <div class="col-12 section-header-team">
                            <h2 class="section-title">@lang('about.Our Team')</h2>
                            <p class="section-description">
                                @lang('about.team_backbone_description')
                            </p>
                            <p class="section-description  align-items-center" style="font-weight: 700;">
                                @lang('about.How Can Our Team Support You?')
                                <span class="section-description ms-2" style="font-weight: normal;">@lang('about.Personal Consultation')</span>
                            </p>

                            <p class="section-description">
                               @lang('about.team_designers_description')
                            </p>
                        </div>
                        <div class="row box-container">
                            <!-- Box 1 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="p-3 h-100" style="background: white; border-radius: 8px;">
                                    <h5 class="feature-title">@lang('about.Custom Design Solutions')</h5>
                                                                    <p class="feature-description">
                                  @lang('about.custom_design_description')
                                </p>
                                </div>
                            </div>
                            <!-- Box 2 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="p-3 h-100" style="background: white; border-radius: 8px;">
                                    <h5 class="feature-title">@lang('about.Material Selection')</h5>
                                                                    <p class="feature-description">
                                    @lang('about.material_selection_description')
                                </p>
                                </div>
                            </div>
                            <!-- Box 3 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="p-3 h-100" style="background: white; border-radius: 8px;">
                                    <h5 class="feature-title">@lang('about.3D Visualizations')</h5>
                                                                    <p class="feature-description">
                                   @lang('about.3d_visualizations_description')
                                </p>
                                </div>
                            </div>
                            <!-- Box 4 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="p-3 h-100" style="background: white; border-radius: 8px;">
                                    <h5 class="feature-title">@lang('about.Project Management')</h5>
                                                                    <p class="feature-description">
                                    @lang('about.project_management_description')
                                </p>
                                </div>
                            </div>
                            <!-- Box 5 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="p-3 h-100" style="background: white; border-radius: 8px;">
                                    <h5 class="feature-title">@lang('about.Expert Craftsmanship')</h5>
                                                                    <p class="feature-description">
                                   @lang('about.expert_craftsmanship_description')
                                </p>
                                </div>
                            </div>
                            <!-- Box 6 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="p-3 h-100" style="background: white; border-radius: 8px;">
                                    <h5 class="feature-title">@lang('about.Installation & Ongoing Support')</h5>
                                                                    <p class="feature-description">
                                    @lang('about.installation_support_description')
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements Section -->
                    <div id="achievements" class="content-section">
                        <h2 class="section-title p-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Our Achievements')</h2>
                        <!-- Row 1: Market value card + illustration -->
                        <div class="row align-items-center g-4">
                            <!-- Market value card - order changes based on locale -->
                            <div class="col-lg-6 {{ app()->getLocale() === 'ar' ? 'order-lg-2' : 'order-lg-1' }}">
                                <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                    <h6 class="market-title" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Market value')</h6>
                                    <h3 class="count" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.$15.3 Billion USD')</h3>
                                    <p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.market_value_description')</p>
                                </div>
                            </div>

                            <!-- Illustration - order changes based on locale -->
                            <div class="col-lg-6 d-none d-lg-flex justify-content-center {{ app()->getLocale() === 'ar' ? 'order-lg-1' : 'order-lg-2' }}">
                                <div class="illu-container">
                                    <!-- 1) your circle+roof SVG as a true <img> or inline SVG -->
                                    <img src="Frontend/assets/images/gallery/logo.webp" alt="" class="logomark" loading="lazy">

                                    <!-- 2) top‐left dot grid -->
                                    <img src="Frontend/assets/images/icons/Dots-illu-top.webp" alt="" class="dots dots-top" loading="lazy">

                                    <!-- 3) bottom‐right dot grid -->
                                    <img src="Frontend/assets/images/icons/Dots-illu-bottom.webp" alt="" class="dots dots-bottom" loading="lazy">

                                    <!-- 4) trophies stacked -->
                                    <div class="awards">
                                        <!-- SVG positioned to the left of MUSE award -->
                                        <img class="awards-svg" src="Frontend/assets/images/icons/Oppolia online Icon.svg" alt="Awards SVG" loading="lazy">
                                        <img src="Frontend/assets/images/gallery/red-dot.webp" alt="Back trophy" loading="lazy">
                                        <img src="Frontend/assets/images/gallery/muse.webp" alt="Front trophy" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Achievement Cards Grid Layout -->
                        <div class="row g-4 mt-4">
                            <div class="col-lg-6">
                                <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                    <h6 class="market-title" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.MUSE Design Awards')</h6>
                                    <h3 class="count" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">+1 @lang('about.MUSE Design Awards')</h3>
                                    <p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.muse_awards_description')</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                    <h6 class="market-title" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Red Dot Award')</h6>
                                    <h3 class="count" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">+1 @lang('about.Red Dot Award')</h3>
                                    <p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.red_dot_award_description')</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                    <h6 class="market-title" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.7,000 Showrooms Worldwide')</h6>
                                    <h3 class="count" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">+7,000</h3>
                                    <p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.showrooms_description')</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                    <h6 class="market-title" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.Complete Home Furnishing')</h6>
                                    <h3 class="count" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">+40</h3>
                                    <p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">@lang('about.home_furnishing_description')</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Suppliers Section -->
                    <div id="suppliers" class="content-section">
                        <div class="col-12">
                            <div class="row">
                                <!-- Title aligned to the right -->
                                <div class="col-12 d-flex align-items-center justify-content-start">
                                    <h2 class="section-title">@lang('about.Our Suppliers')</h2>
                                </div>
                                <!-- Supplier Cards Grid -->
                                <div class="col-12">
                                    <div class="row g-4">
                                        <!-- First Row: 3 Suppliers -->
                                        <div class="col-lg-4 col-md-12 d-flex">
                                            <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Blum-Logo-.png') }}"
                                                     alt="Blum Logo" class="supplier-logo" loading="lazy">
                                                <p>@lang('about.blum_collaboration')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 d-flex">
                                            <div
                                                class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/SKAI-Logo-webp.png') }}"
                                                     alt="Skai Logo" class="supplier-logo" loading="lazy">
                                                <p>@lang('about.skai_description')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 d-flex">
                                            <div
                                                class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/icons/suspa.webp') }}"
                                                     alt="Suspa Logo" class="supplier-logo" loading="lazy">
                                                <p>@lang('about.suspa_description')</p>
                                            </div>
                                        </div>
                                        <!-- Second Row: 2 Suppliers -->
                                        <div class="col-lg-6 col-md-12 d-flex">
                                            <div
                                                class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/icons/eger.webp') }}"
                                                     alt="EEGGER Logo" class="supplier-logo" loading="lazy">
                                                <p>@lang('about.egger_description')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 d-flex">
                                            <div
                                                class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/icons/bostik.webp') }}"
                                                     alt="Bostik Logo" class="supplier-logo" loading="lazy">
                                                <p>@lang('about.bostik_description')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
