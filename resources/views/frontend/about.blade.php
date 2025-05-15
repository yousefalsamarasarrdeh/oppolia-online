@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')عن اوبوليا @endsection
@section('content')
    <style>
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
            <h1 class="about-text">عن اوبوليا</h1>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="container-fluid" style="background-color: rgba(243, 243, 243, 1);">
        <div class="row p-0 p-lg-4">
            <!-- Sidebar Column - Hidden on mobile -->
            <div class="col-lg-2 order-lg-first d-none d-lg-block" dir="rtl">
                <aside class="sticky-sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#AboutOppolia">
                                عن اوبوليا اونلاين <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#Vision">
                                رؤيتنا <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#production">
                                إنتاجنا <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#history">
                                تاريخنا <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#team">
                                فريقنا <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#achievements">
                                إنجازاتنا <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#suppliers">
                                الموردون <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#whyUs">
                                ليش تختارنا؟ <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="#responsibility">
                                مسؤوليتنا الاجتماعية <i class="bx bx-chevron-left"></i>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content Column -->
            <div class="col-lg-9 p-0">
                <!-- About Section -->
                <div class="row m-3 m-lg-4">
                    <div id="AboutOppolia" class="col-12 mb-3 mb-lg-5">
                        <h2 class="about-title">عن اوبوليا اونلاين</h2>
                        <h3 class="about-subtitle">عالم من الأناقة والتميز.</h3>
                        <p class="about-para">
                            نفتخر في اوبوليا بتقديم أفضل وأرقى منتجات أثاث المنزل المخصصة في السوق. لدينا أكثر من 30 عاماً
                            من الخبرة في تلبية احتياجات عملائنا وجعل منازلهم أكثر جمالاً. نؤمن بأن المنزل هو مكان الراحة
                            والتعبير عن الذات. لذلك، نسعى دائماً لتحويل أفكار وأحلام عملائنا إلى واقع. نسعى لتقديم تجربة
                            تسوق فريدة تنعكس فيها الأناقة والرفاهية في كل تفصيل.
                        </p>
                        <p class="about-para">
                            تقدم اوبوليا مجموعة متنوعة من منتجات أثاث المنزل المخصصة. سواء كنت بحاجة إلى تصميم مطبخ عصري أو
                            غرفة نوم هادئة أو منطقة معيشة مريحة فإننا نقدم خيارات متعددة من التصاميم والألوان لتلبية
                            احتياجاتك وتفضيلاتك. نحن نضمن أعلى معايير الجودة في كل منتج نقدمه. نستخدم أفضل المواد والتقنيات
                            لضمان تحقيق أعلى مستوى من الراحة والمتانة. لهذا السبب، نقدم ضمانًا يمتد لمدة 15 عاماًَ على
                            منتجاتنا.
                        </p>
                        <p class="about-para">
                            تأتي قوة اوبوليا في قدرتنا على تخصيص منتجاتنا لتلبية احتياجاتك الخاصة. سواء كنت تبحث عن تصميم
                            فريد يعبر عن شخصيتك أو تحتاج إلى حلاً عملياً لاستغلال المساحة بذكاء، نحن هنا لنجعل ذلك حقيقة.
                        </p>
                    </div>
                </div>

                <!-- Our Brand Section -->
                <div id="Brand" class="row m-3 m-lg-4">
                    <div class="col-12 section-header">
                        <h2 class="section-about-title">علامتنا التجارية</h2>
                        <p class="section-description">
                            تحتل مجموعتنا رأس قائمة العلامات التجارية المرموقة في هذا المجال،
                            ونؤكد على التزامنا بتلبية مجموعة واسعة من الأذواق والأداء،
                            الذي يضمن أن يكون كل منزل معبراً عن شخصية وأداء كل شخص.
                        </p>
                    </div>
                    <div class="row p-0">
                        <div class="col-12">
                            <div class="row justify-content-between p-2 p-lg-4">
                                <div class="col-md-4 text-right feature-box mb-4">
                                    <h3 class="feature-title">التميز في النمو والابتكار</h3>
                                    <p class="feature-description">
                                        أوبوليا تقدم أفكاراً جديدة في تصميم أنواع مختلفة من الأثاث، مما يجعل كل منزل
                                        متميزًا.
                                    </p>
                                </div>
                                <div class="col-md-4 text-right feature-box mb-4">
                                    <h3 class="feature-title">وضع المعايير على الساحة العالمية</h3>
                                    <p class="feature-description">
                                        أوبوليا تعتمد أحدث التقنيات لصناعة منتجات متينة وعالية الجودة.
                                    </p>
                                </div>
                                <div class="col-md-4 text-right feature-box mb-4">
                                    <h3 class="feature-title">المشاريع والتعاون العالم</h3>
                                    <p class="feature-description">
                                        تعمل دائمًا مع شركات البناء والتطوير، ولديها مشاريع متميزة لأكثر من 5000 منزل حول
                                        العالم.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Section -->
                <div id="Vision" class="row m-0">
                    <div class="col-12 p-0">
                        <div class="row m-3 m-lg-4">
                            <div class="col-lg-6 p-0">
                                <img src="{{ asset('Frontend/assets/images/gallery/vision.jpg') }}" alt="Modern Kitchen"
                                     class="img-fluid w-100 vision-image">
                            </div>
                            <div class="col-lg-6 text-right d-flex flex-column justify-content-center p-4"
                                 style="background: #83B0AB">
                                <h2 class="vision-title">رؤيتنا</h2>
                                <p class="vision-description">
                                    نسعى في أوبوليا لتحقيق رؤيتنا أن نكون الرواد في تقديم حلول المنازل المبتكرة والمتكاملة،
                                    حيث نجمع بين التصميم الأنيق والجودة الفائقة لتلبية احتياجات عملائنا المتنوعة.
                                    نؤمن في أوبوليا بأن المنزل هو المكان الأكثر أهمية في حياة الفرد، ونعمل على أن يكون جزءًا
                                    من رحلة عملائنا في بناء ما يعبر عن هويتهم ويحقق أحلامهم.
                                    لذلك نحن دائمًا في تحقيق التميز في كل ما نقدمه، ونعمل باستمرار على تطوير منتجاتنا من
                                    خلال الابتكار المستمر والالتزام بأعلى معايير الجودة
                                    مما يستحق لمسة من الأناقة والراحة.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Production Section -->
                <div id="production" class="row m-3 m-lg-4">
                    <!-- Production section description -->
                    <div class="col-12 production-lines p-3 p-lg-4">
                        <h2 class="section-title mb-4">إنتاجنا</h2>
                        <h3 class="sub-title mb-4">خطوط الإنتاج</h3>
                        <p class="production-para">
                            مع 58 خط إنتاج، لقد صممنا بنية إنتاجية بكفاءة استثنائية تتيح لنا إنشاء آلات بكفاءة
                            استثنائية. حيث لم نضع مواقع التصنيع الخمسة لدينا بشكل استراتيجي في جميع أنحاء العالم لتوفير
                            وصول عالمي عالي الجودة والقيمة على طيلة العملية، مما يوسع من الأسواق.
                        </p>
                        <p class="production-para">
                            يتم توزيع أكثر من 200000 منتج عالميًا، مما يضمن ساعات إنتاج وإمدادات ثابتة في ظل تلبية
                            الطلبات المتزايدة باستمرار.
                        </p>
                        <p class="production-para">
                            تعتمد أحدث المعايير المتقدمة للتصنيع الذكي في كل مرحلة من العملية، مما يتيح التحكم الدقيق في
                            الإنتاج أثناء تكامل التكنولوجيا الذكية، مما يضمن أن كل منتج يتم تصنيعه بالجودة العالية وفق
                            أعلى المعايير.
                        </p>
                        <p class="production-para">
                            نحن نلتزم في أوبوليا دائمًا على الاستثمار في أحدث التقنيات الإنتاجية في الأسواق مع التوسع في
                            طرق التصنيع واستراتيجيات التصدير.
                        </p>
                    </div>

                    <!-- Production capacity and image section -->
                    <div class="col-12 mt-3 mt-lg-5 mb-3 mb-lg-5 p-0">
                        <div class="row gx-0 align-items-stretch justify-content-center">
                            <!-- Production Capacity -->
                            <div class="col-lg-8 col-md-12 align-content-center justify-content-center production-capacity p-3 p-lg-4">
                                <h3 class="production-subtitle text-right">الطاقة الإنتاجية</h3>
                                <ul class="production-li">
                                    <li>ننتج أكثر من 6300 وحدة مطبخ وخزانة ملابس.</li>
                                    <li>نضمن الاستدامة في الوقت المناسب ورضا العملاء.</li>
                                    <li>الحفاظ على مستوى الإنتاج الصناعي وفقًا لمعايير التصنيع المتقدمة.</li>
                                    <li>نضمن أتمتة العمليات لزيادة المرونة التصنيعية.</li>
                                    <li>تلبي احتياجات العملاء.</li>
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
                        <h2 class="section-title mb-3 mb-lg-5">تاريخنا</h2>
                        <div class="new-arrivals owl-carousel owl-responsive owl-theme mb-5" dir="ltr">
                            <!-- Slide 1 -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge text-center">1994–1997</div>
                                    <h5 class="card-title mt-3">بدايات اوبوليا</h5>
                                    <p class="card-description">
                                        تأسست اوبوليا في عام 1994 برؤية لجلب الجمال للتصميم الداخلي وإنتاجه وتركيبه في منازل
                                        المملكة العربية السعودية.
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
                                    <h5 class="card-title mt-3">بداية التوسع</h5>
                                    <p class="card-description">
                                        بدأنا بالتوسع إلى أسواق جديدة مع التركيز على تصميم مطابخ مميزة وفريدة.
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
                                    <h5 class="card-title mt-3">التطوير والتحديث</h5>
                                    <p class="card-description" dir="rtl">
                                        قمنا بدمج أحدث تقنيات التصنيع لتعزيز جودة التصاميم.
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
                                    <h5 class="card-title mt-3">الذهاب إلى العالمية</h5>
                                    <p class="card-description" dir="rtl">
                                        توسعنا دوليًا من خلال افتتاح مواقع إنتاج في مناطق رئيسية.
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
                                    <h5 class="card-title mt-3">التطورات التكنولوجية</h5>
                                    <p class="card-description" dir="rtl">
                                        اعتماد أحدث تقنيات التصنيع الرقمي لتحقيق إنتاج أسرع وأكثر كفاءة.
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
                                    <h5 class="card-title mt-3">الابتكار والتطوير</h5>
                                    <p class="card-description" dir="rtl">
                                        تقديم حلول ذكية في التصميمات المخصصة والمستدامة.
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
                                    <h5 class="card-title mt-3">مبادرات الاستدامة</h5>
                                    <p class="card-description" dir="rtl">
                                        إطلاق برامج جديدة للحد من التأثير البيئي وتعزيز الاستدامة.
                                    </p>
                                </div>
                                <svg class="slide-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 53 51 150">
                                    <path d="M20.9695 128L51 59.7244L45.0457 53L0 128L45.0457 203L51 196.017L20.9695 128Z"
                                          fill="#509F96" />
                                </svg>
                            </div>

                            <!-- Slide 8 (no arrow) -->
                            <div class="item">
                                <div class="card card-height p-3 text-end">
                                    <div class="event-date badge">2025</div>
                                    <h5 class="card-title mt-3">الاحتفال بمرور 30 عامًا</h5>
                                    <p class="card-description" dir="rtl">
                                        مواصلة أوبوليا قيادة مجال التصميم الداخلي.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Our Team Section -->
                <div id="team" class="row m-3 m-lg-4">
                    <div class="col-12 section-header-team">
                        <h2 class="section-title">فريقنا</h2>
                        <p class="section-description">
                            فريقنا من المصممين والحرفيين ومدراء المشاريع ذوي المهارات العالية هو العمود الفقري لشركة
                            اوبوليا.
                            مع سنوات من الخبرة والشغف المشترك بالتميز، يعمل فريقنا بشكل تعاوني لضمان أن كل مشروع يفي
                            بأعلى معايير الجودة والحرفية. نحن نفخر باهتمامنا بالتفاصيل والتزامنا بتحقيق نتائج استثنائية.
                        </p>
                        <p class="team-subtitle">كيف يستطيع فريقنا مساعدتك؟
                            <span class="personal-consultation">الاستشارة الشخصية</span>
                        </p>
                        <p class="section-description">
                            يجتمع مستشارو التصميم مع العملاء لفهم احتياجاتهم ورؤيتهم.
                            يقدمون المشورة المهنية ويكتشفون خيارات التصميم.
                        </p>
                    </div>
                    <div class="row m-0 box-container">
                        <!-- Box 1 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-end p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">حلول التصميم المخصصة</h5>
                                <p class="feature-description">
                                    يخصص أوبوليا لتقديم تصميمات مخصصة من المنتجات المختلفة، بالإضافة إلى
                                    الألوان والتشطيبات المتنوعة، مما يمنحك تحكمًا كاملاً في التفاصيل.
                                </p>
                            </div>
                        </div>
                        <!-- Box 2 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-end p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">اختيار المواد</h5>
                                <p class="feature-description">
                                    نساعدك خلال عملية اختيار مواد عالية الجودة والتشطيبات المختلفة،
                                    لضمان أن كل قطعة تعكس الأناقة والمتانة.
                                </p>
                            </div>
                        </div>
                        <!-- Box 3 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-end p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">التصورات ثلاثية الأبعاد</h5>
                                <p class="feature-description">
                                    نقدم لك عروض تصاميم ثلاثية الأبعاد وجولات افتراضية لمساعدتك
                                    على تصور المشروع بشكل أفضل قبل بدء التنفيذ.
                                </p>
                            </div>
                        </div>
                        <!-- Box 4 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-end p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">إدارة المشاريع</h5>
                                <p class="feature-description">
                                    نحرص على إدارة مشاريعك مع تقديم خدمات الدعم المستمر،
                                    للحفاظ على الأعمال وضمان القيام بها على أكمل وجه.
                                </p>
                            </div>
                        </div>
                        <!-- Box 5 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-end p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">الحرفية الجيدة</h5>
                                <p class="feature-description">
                                    يستخدم الحرفيون المهرة تقنيات الإنتاج المتقدمة
                                    والمواد المتينة لإنشاء منتجات عالية الجودة.
                                </p>
                            </div>
                        </div>
                        <!-- Box 6 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="text-end p-3 h-100" style="background: white; border-radius: 8px;">
                                <h5 class="feature-title">التركيب والمتابعة الدائمة</h5>
                                <p class="feature-description">
                                    يوفر فريق التركيب لدينا جميع جوانب المشروع، بما يشمل
                                    التركيبات الأخيرة والدعم لضمان جودة المنتجات.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Achievements Section -->
                <div id="achievements" class="m-3 m-lg-4">
                    <h2 class="section-title p-3 m-0">إنجازاتنا</h2>
                    <!-- Row 1: illustration (left) + heading & big card (right) -->
                    <div class="row align-items-center g-4">
                        <!-- Right: big value card -->
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column h-100 p-4">
                                <h6 class="market-title">القيمة السوقية</h6>
                                <h3 class="count">15.3 مليار دولار أمريكي</h3>
                                <p>
                                    في يناير 2021، تجاوزت قيمة مشاريعنا الإجمالية 15.3 مليار دولار أمريكي،
                                    مما يعكس النمو المستدام لعملائنا.
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
                                <h6 class="market-title">جائزة MUSE Design</h6>
                                <h3 class="count">+1 MUSE Design Award</h3>
                                <p>حصلنا على جائزة MUSE لعام 2023 تكريماً لابتكاراتنا.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">جائزة Red-dot</h6>
                                <h3 class="count">+1 Red-dot Award</h3>
                                <p>تم منحنا جائزة Red-dot لعام 2021.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: two small cards -->
                    <div class="row g-4 mt-4">
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">صالة عرض</h6>
                                <h3 class="count">+7,000</h3>
                                <p>
                                    نغطي أكثر من 7,000 صالة عرض حول العالم، مما يعزز النمو التجاري
                                    والتواصل الفعال.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="achievement-card green-border d-flex flex-column w-100 p-4">
                                <h6 class="market-title">منزل مؤثث بشكل كامل</h6>
                                <h3 class="count">+40</h3>
                                <p>
                                    نعمل دائمًا على تحسين مساحة مستخدمينا وتعزيز استراتيجيات الأثاث
                                    المثالية.
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
                                <h2 class="section-title">الموردون</h2>
                            </div>
                            <!-- Supplier Cards Grid -->
                            <div class="col-12">
                                <div class="row g-4">
                                    <!-- First Row: 3 Suppliers -->
                                    <div class="col-lg-4 col-md-12 d-flex">
                                        <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/gallery/Blum-Logo-.png') }}"
                                                 alt="Blum Logo" class="supplier-logo">
                                            <p>اكثر من 20 عاما ونحن نعمل معا</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/gallery/SKAI-Logo-webp.png') }}"
                                                 alt="Skai Logo" class="supplier-logo">
                                            <p>تمثل هذه العلامة بمنتجاتها المميزة التي تحدد المعايير الصحيحة</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/icons/suspa.webp') }}"
                                                 alt="Suspa Logo" class="supplier-logo">
                                            <p>هي شركة تصنيع مبتكرة لأنظمة الغاز</p>
                                        </div>
                                    </div>
                                    <!-- Second Row: 2 Suppliers -->
                                    <div class="col-lg-6 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/icons/eger.webp') }}"
                                                 alt="EEGGER Logo" class="supplier-logo">
                                            <p>من الألواح الخشبية عالية الجودة إلى المرايا التي تحدد الاتجاه للأثاث</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 d-flex">
                                        <div
                                            class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                            <img src="{{ asset('Frontend/assets/images/icons/bostik.webp') }}"
                                                 alt="Bostik Logo" class="supplier-logo">
                                            <p>الابتكار هو هوية بوستيك والتكنولوجيا هي حجر الأساس في نجاحهم</p>
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
