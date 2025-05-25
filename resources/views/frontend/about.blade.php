@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')@lang('about.About Oppolia Online') @endsection
@section('content')
    <style>
        .[dir="rtl"] .nav-link i {
            transform: rotate(180deg);
        }
        .card-height {
            height: 318px;
            box-shadow: 0px 15.14px 15.14px 0px rgba(211, 218, 235, 0.7) !important;
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
            background: url("/Frontend/assets/images/icons/O-bg.svg") no-repeat center center;
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
            overflow: visible;
            margin-bottom: 30px;
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

        /* front trophy (the smaller/foreground one) */
        .awards img:nth-child(1) {
            left: -20px;
            z-index: 4;
            transform: scale(1.1);
        }

        /* back trophy starts at normal size */
        .awards img:nth-child(2) {
            left: 0;
            z-index: 2;
            transform: scale(1);
        }

        /* on hover: swap scales */
        .illu-container:hover .awards img:nth-child(1) {
            transform: scale(1);
        }

        .illu-container:hover .awards img:nth-child(2) {
            transform: scale(1.1);
        }

        /* Hover effects */
        .illu-container:hover .awards {
            transform: translate(-50px, -50%);
        }

        .illu-container:hover .dots-top {
            transform: translateY(140px);
        }

        .illu-container:hover .dots-bottom {
            transform: translateY(-140px);
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
                height: 150px;
            }
        }

        @media (max-width: 768px) {


            .feature-box,
            .supplier-card {
                margin-bottom: 20px;
            }

            .vision-image {
                height: 300px;
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
                height: 120px;
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
                <img src="{{ asset('Frontend/assets/images/banners/About-Banner.png') }}" alt="About Us Banner" class="img-fluid about-image">
            </div>
        </div>
        <div class="about-text-overlay">
            <h1 class="about-text">@lang('about.About Oppolia Online')</h1>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="container-fluid" style="background-color: rgba(243, 243, 243, 1);">
        <div class="row p-0 p-lg-4">
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
            <div class="col-lg-9 p-0">
                <!-- About Section -->
                <div class="row m-3 m-lg-4">
                    <div id="AboutOppolia" class="col-12 mb-3 mb-lg-4">
                        <h2 class="about-title">@lang('about.About Oppolia Online')</h2>
                        <h3 class="about-subtitle">@lang('about.A world of elegance and distinction.')</h3>
                        <p class="about-para">
                            @lang('about.At Oppolia, we take pride in offering the finest and most elegant custom kitchens on the market. With over 30 years of experience, we’ve been meeting our clients’ needs and making their homes more beautiful and comfortable.
We believe that a home is not just a place to live, but a space of comfort and a reflection of your personality. That’s why we’re committed to turning your ideas and dreams into a reality right before your eyes.
We always strive to create a unique shopping experience for you—one where luxury and elegance shine through in every detail.')
                        </p>
                        <h3 class="about-subtitle">@lang('about.Our products are diverse and cater to all tastes and needs.')</h3>
                        <p class="about-para">
                            @lang('about.Whether you are looking for a modern or classic kitchen in various styles, we offer a wide selection of designs and colors to match your taste and lifestyle.
We guarantee the highest standards of quality in every piece we produce. We use the finest materials and the latest technologies to ensure long-lasting durability for years to come.')
                        </p>
                        <h3 class="about-subtitle">@lang('about.oppolia ’s strength lies in customization.')</h3>
                        <p class="about-para">
                          @lang('about.Looking for a unique design that reflects who you are? Or smart solutions that make the most of every corner of your space? We are here to turn every idea in your mind into a reality, using our hands-on expertise in kitchen design and customization.')
                        </p>
                    </div>
                </div>

                <!-- Our Brand Section -->
                <div id="Brand" class="row m-3 m-lg-4">
                    <div class="col-12 section-header">
                        <h2 class="section-about-title">@lang('about.Our Brand')</h2>
                        <p class="section-description">
                           @lang('about.Our group leads the list of prestigious brands in the industry. We are committed to catering to a wide range of tastes and preferences—ensuring that every home reflects the unique personality and vision of its owner.')
                        </p>
                    </div>
                    <div class="row p-0">
                        <div class="col-12">
                            <div class="row justify-content-between ">
                                <div class="col-md-4  feature-box mb-1">
                                    <h3 class="feature-title">@lang('about.Excellence in Growth and Innovation')</h3>
                                    <p class="feature-description">
                                       @lang('about.At Oppolia, we constantly strive to innovate and introduce fresh ideas in designing and creating various kitchen models—so your home becomes a true reflection of modern style and contemporary living.')
                                    </p>
                                </div>
                                <div class="col-md-4  feature-box mb-1">
                                    <h3 class="feature-title">@lang('about.Setting Global Standards')</h3>
                                    <p class="feature-description">
                                      @lang('about.Oppolia relies on the latest technologies and the highest standards to craft strong, durable products—delivering quality that suits your home and lasts for years to come.')
                                    </p>
                                </div>
                                <div class="col-md-4  feature-box mb-1">
                                    <h3 class="feature-title">@lang('about.Projects and Global Collaboration')</h3>
                                    <p class="feature-description">
                                        @lang('about.We continuously collaborate with leading construction and development companies, and we’re proud to have completed over 5,000 projects worldwide.')
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Section -->
                <div id="Vision" class="row m-0">
                    <div class="col-12 p-0">
                        <div class="row m-3 me-lg-4">
                            <div class="col-lg-6 p-0">
                                <img src="{{ asset('Frontend/assets/images/gallery/vision.jpg') }}" alt="Modern Kitchen"
                                     class="img-fluid w-100 vision-image">
                            </div>
                            <div class="col-lg-6 text-right d-flex flex-column justify-content-center p-4"
                                 style="background: #83B0AB">
                                <h2 class="vision-title">@lang('about.Our Vision')</h2>
                                <p class="vision-description">
                                    @lang('about. At Oppolia, our vision is to lead in delivering innovative and comprehensive home solutions—blending elegant design with exceptional quality to meet the diverse needs of our clients. We believe the home is the most important place in a person’s life, and we’re proud to be part of our customers journey in building their dream homes.
We are committed to excellence in everything we do, driven by passion to exceed expectations through continuous innovation and dedication to the highest standards of quality. Every home deserves a touch of elegance and comfort—and we’re here to bring that to life with creativity')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Production Section -->
                <div id="production" class="row m-3 m-lg-4">
                    <!-- Production section description -->
                    <div class="col-12 production-lines p-3 p-lg-4">
                        <h2 class="section-title mb-4">@lang('about.Our Production')</h2>
                        <h3 class="sub-title mb-4">@lang('about.Production Lines')</h3>
                        <p class="production-para">
                            @lang('about.With 58 production lines, our facilities represent a powerhouse of productivity and efficiency, enabling us to manufacture furniture with exceptional precision. Our five strategically located manufacturing sites across the globe provide both regional and international access, allowing us to meet the needs of a wide range of markets.
More than 20,000 dedicated workers operate at these sites, spending countless hours to meet the ever-growing demand for our products.
One of the key benefits of smart furniture manufacturing is enhanced quality control. Automated systems can detect defects early in the production process, ensuring that every piece meets strict quality standards before reaching the customer. This not only reduces waste but also boosts customer satisfaction by consistently delivering high-quality products.
That’s why at Oppolia, we continuously integrate AI technologies into home furniture manufacturing—from beds and wardrobes to kitchen cabinets.')
                        </p>

                    </div>

                    <!-- Production capacity and image section -->
                    <div class="col-12 mt-3 mt-lg-5 mb-3 mb-lg-5 p-0">
                        <div class="row gx-0 align-items-stretch justify-content-center">
                            <!-- Production Capacity -->
                            <div class="col-lg-8 col-md-12 align-content-center justify-content-center production-capacity p-3 p-lg-4">
                                <h3 class="production-subtitle ">@lang('about.Production Capacity')</h3>
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
                                     alt="Production Line" class="img-fluid w-100" style="object-fit: cover; height: 100%;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Section -->
                <div id="history" class="row m-3 m-lg-4">
                    <div class="product-grid col-12 p-0" >
                        <h2 class="section-title mb-3 mb-lg-5">@lang('about.Our History')</h2>
                        <div class="new-arrivals owl-carousel owl-responsive owl-theme mb-5" dir="ltr">
                            <!-- Slide 1 -->
                            <div class="item">
                                <div class="card card-height p-3 ">
                                    <div class="event-date badge text-center">1994–1997</div>
                                    <h5 class="card-title mt-3">@lang('about.The Beginnings of Oppolia')</h5>
                                    <p class="card-description">
                                        @lang('about. Oppolia was founded in 1994 with a vision to bring beauty to interior design through the production and installation of custom furnishings across homes in Saudi Arabia. Starting as a small workshop, our focus was on creating unique and distinctive kitchen designs.')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 2 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">1998–2002</div>
                                    <h5 class="card-title mt-3">@lang('about.Expanding Horizons Globally')</h5>
                                    <p class="card-description">
                                        @lang('about. By 1998, our reputation for quality and innovation enabled us to expand operations. We launched our first major production facility, significantly increasing our capacity to meet the growing demand for custom kitchen designs.')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 3 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">2003–2009</div>
                                    <h5 class="card-title mt-3">@lang('about.Diversification and Development')</h5>
                                    <p class="card-description" dir="rtl">
                                        @lang('about. In 2003, we diversified our product range to include custom wardrobes and home furniture. This strategic step allowed us to offer comprehensive interior design solutions, better serving a wider range of customers and strengthening our market position')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 4 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">2010–2014</div>
                                    <h5 class="card-title mt-3">@lang('about.Going Global')</h5>
                                    <p class="card-description" dir="rtl">
                                       @lang('about. The year 2010 marked a milestone as we expanded internationally. We established production sites in key regions across the globe, enabling us to serve international clients and adapt to various market needs. Our global growth was powered by our skilled workforce, which by then had grown into the thousands.')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 5 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">2015–2019</div>
                                    <h5 class="card-title mt-3">@lang('about.Embracing Technological Advancements')</h5>
                                    <p class="card-description" dir="rtl">
                                       @lang('about. In 2015, we adopted cutting-edge production technologies. These innovations boosted our efficiency and precision, enabling us to produce over 6,300 kitchen and wardrobe units. Our commitment to staying at the forefront of technology has helped us meet the rising expectations of our customers.')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 6 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">2020–2023</div>
                                    <h5 class="card-title mt-3">@lang('about.Green Sustainability Initiatives')</h5>
                                    <p class="card-description" dir="rtl">
                                       @lang('about. In 2020, we launched a series of sustainability initiatives aimed at reducing our environmental impact. We prioritized the use of eco-friendly materials and energy-efficient processes, reinforcing our commitment to responsible manufacturing and a healthier climate.')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 7 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">2024</div>
                                    <h5 class="card-title mt-3">@lang('about.Celebrating 30 Years')</h5>
                                    <p class="card-description" dir="rtl">
                                        @lang('about. As we celebrate our 30th anniversary in 2024, Oppolia stands as a leader in the interior design industry. With five production sites worldwide, a workforce of over 20,000, and strong production capabilities, we continue to deliver exceptional Italian kitchens, wardrobes, and smart home solutions. Our journey from a small workshop to a global force is a testament to our enduring craftsmanship and dedication.')
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 8 (no arrow) -->

                        </div>
                    </div>
                </div>

                <!-- Our Team Section -->
                <div id="team" class="row m-3 m-lg-4">
                    <div class="col-12 section-header-team">
                        <h2 class="section-title">@lang('about.Our Team')</h2>
                        <p class="section-description">
                            @lang('about. Our team of skilled designers, craftsmen, and project managers is the backbone of Oppolia. With years of experience and a shared passion for excellence, our team works collaboratively to ensure every project meets the highest standards of quality and craftsmanship. We take pride in our attention to detail and our commitment to delivering exceptional results.')
                        </p>

                        <p class="section-description">
                           @lang('about.At Oppolia, our team of designers meets with you to understand your needs and vision, offering professional advice and exploring various design options.')
                        </p>
                    </div>
                    <div class="row m-0 box-container">
                        <!-- Box 1 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class=" p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">@lang('about.Custom Design Solutions')</h5>
                                <p class="feature-description">
                                  @lang('about. Our team specializes in creating custom designs for kitchens, wardrobes, interior doors, and home solutions—ensuring every detail fits your taste and space.')
                                </p>
                            </div>
                        </div>
                        <!-- Box 2 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class=" p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">@lang('about.Material Selection')</h5>
                                <p class="feature-description">
                                    @lang('about. We guide you through the process of selecting high-quality materials, finishes, and accessories to ensure each piece reflects elegance and durability.')
                                </p>
                            </div>
                        </div>
                        <!-- Box 3 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class=" p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">@lang('about.3D Visualizations')</h5>
                                <p class="feature-description">
                                   @lang('about. We provide detailed 3D renderings and virtual tours to help you visualize your project before execution begins.')
                                </p>
                            </div>
                        </div>
                        <!-- Box 4 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class=" p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">@lang('about.Project Management')</h5>
                                <p class="feature-description">
                                    @lang('about. Our project managers oversee all aspects of your project, ensuring it is completed on time and within budget.')
                                </p>
                            </div>
                        </div>
                        <!-- Box 5 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class=" p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">@lang('about.Expert Craftsmanship')</h5>
                                <p class="feature-description">
                                   @lang('about.Skilled artisans use advanced production techniques and premium materials to achieve superior quality.')
                                </p>
                            </div>
                        </div>
                        <!-- Box 6 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class=" p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">@lang('about.Installation & Ongoing Support')</h5>
                                <p class="feature-description">
                                    @lang('about.We ensure smooth, efficient installation and offer continuous support and aftercare to guarantee your complete satisfaction with the final result.')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Achievements Section -->
                <div id="achievements" class="m-3 m-lg-4">
                    <h2 class="section-title p-3 m-0">@lang('about.Our Achievements')</h2>
                    <!-- Row 1: illustration (left) + heading & big card (right) -->
                    <div class="row align-items-center g-4">
                        <!-- Right: big value card -->
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                <h6 class="market-title">@lang('about.Market value')</h6>
                                <h3 class="count">@lang('about.$15.3 Billion USD')</h3>
                                <p>
                                    @lang('about. In March 2021, our total market value surpassed $15.3 billion USD—reflecting our sustained success and the trust our customers place in our products.')
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                            <div class="illu-container">
                                <!-- 1) your circle+roof SVG as a true <img> or inline SVG -->
                                <img src="Frontend/assets/images/gallery/logo.webp" alt="" class="logomark">

                                <!-- 2) top‐left dot grid -->
                                <img src="Frontend/assets/images/icons/Dots-illu-top.webp" alt="" class="dots dots-top">

                                <!-- 3) bottom‐right dot grid -->
                                <img src="Frontend/assets/images/icons/Dots-illu-bottom.webp" alt="" class="dots dots-bottom">

                                <!-- 4) trophies stacked -->
                                <div class="awards">
                                    <img src="Frontend/assets/images/gallery/red-dot.webp" alt="Back trophy">
                                    <img src="Frontend/assets/images/gallery/muse.webp" alt="Front trophy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: two small cards -->
                    <div class="row g-4 mt-4">
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">@lang('about.MUSE Design Awards')</h6>
                                <h3 class="count">+1 @lang('about.MUSE Design Awards')</h3>
                                <p>@lang('about. We received the MUSE Design Awards in 2023, a well-deserved recognition of our design excellence—proving the uniqueness and quality embedded in every product we deliver.')</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">@lang('about.Red Dot Award')</h6>
                                <h3 class="count">+1 @lang('about.Red Dot Award')</h3>
                                <p>@lang('about. We were honored with the prestigious Red Dot Award in 2021.')</p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: two small cards -->
                    <div class="row g-4 mt-4">
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">@lang('about.7,000 Showrooms Worldwide')</h6>
                                <h3 class="count">+7,000</h3>
                                <p>
                                    @lang('about. We proudly operate over 7,000 showrooms across the globe, showcasing our strong presence and international impact.')
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">@lang('about.Complete Home Furnishing')</h6>
                                <h3 class="count">+40</h3>
                                <p>
                                    @lang('about. We are continually enhancing our product range and reinforcing our full-home furnishing strategy, focusing on comprehensive solutions tailored to customer needs.')
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suppliers Section -->
                <div id="suppliers" class="row m-3 m-lg-4">
                    <div class="col-12">
                        <div class="row">
                            <!-- Title aligned to the right -->
                            <div class="col-12 d-flex align-items-center justify-content-start mb-4">
                                <h2 class="section-title">@lang('about.Our Suppliers')</h2>
                            </div>
                            <!-- Supplier Cards Grid -->
                            <div class="col-12">
                                <div class="row g-4">
                                    <!-- First Row: 3 Suppliers -->
                                    <div class="col-lg-4 col-md-12 d-flex">
                                        <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/gallery/Blum-Logo-.png') }}"
                                                 alt="Blum Logo" class="supplier-logo">
                                            <p>@lang('about.Over 20 years of successful collaboration.')</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/gallery/SKAI-Logo-webp.png') }}"
                                                 alt="Skai Logo" class="supplier-logo">
                                            <p>@lang('about. A brand known for its outstanding products that set the right standards.')</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/icons/suspa.webp') }}"
                                                 alt="Suspa Logo" class="supplier-logo">
                                            <p>@lang('about. An innovative manufacturer of gas springs.')</p>
                                        </div>
                                    </div>
                                    <!-- Second Row: 2 Suppliers -->
                                    <div class="col-lg-6 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/icons/eger.webp') }}"
                                                 alt="EEGGER Logo" class="supplier-logo">
                                            <p>@lang('about.From high-quality wood flooring to trend-setting materials for furniture design.')</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/icons/bostik.webp') }}"
                                                 alt="Bostik Logo" class="supplier-logo">
                                            <p>@lang('about.Innovation is at the heart of Bostik’s identity, with technology as the foundation of their success.')</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Grid -->
                            </div>
                        </div>
                        <!-- End Inner Row -->
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
