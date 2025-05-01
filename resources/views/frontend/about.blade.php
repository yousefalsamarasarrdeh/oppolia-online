@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')عن اوبوليا @endsection
@section('content')
    <style>

        .card-height {
            height: 300px;
            border-radius: 25px !important;
        }
        .text-green {
            color: rgba(10, 71, 64, 1);
        }
    </style>
    <div class="container-fluid about-section position-relative">
        <!-- Banner Image (Full Width) -->
        <div class="row">
            <div class="col-12 p-0">
                <img src="{{ asset('Frontend/assets/images/banners/joinasdesigner.png') }}" alt="About Us Banner" class="img-fluid about-image">
            </div>
        </div>
        <!-- Centered Text Overlay -->
        <div class="about-text-overlay">
            <h1 class="about-text">عن اوبوليا اونلاين</h1>
        </div>
    </div>

    <!-- Main Content Section -->
    <section  class="container-fluid">
        <div class="row p-4">
            <!-- Sidebar Column -->
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
            <div class="col-lg-9">
                <!-- About Section -->
                <div id="AboutOppolia" class="col-lg-12 col-md-12 mb-3 mb-lg-5  " dir="rtl">
                    <h2 class="about-title">عن أوبوليا أون لاين</h2>
                    <h3 class="about-subtitle">عالم من الأناقة والتميز.</h3>
                    <p class="about-para">
                        نفتخر في اوبوليا بتقديم أفضل وأرقى منتجات أثاث المنزل المخصصة في السوق. لدينا أكثر من 30 عاماً من الخبرة في تلبية احتياجات عملائنا وجعل منازلهم أكثر جمالاً. نؤمن بأن المنزل هو مكان الراحة والتعبير عن الذات. لذلك، نسعى دائماً لتحويل أفكار وأحلام عملائنا إلى واقع. نسعى لتقديم تجربة تسوق فريدة تنعكس فيها الأناقة والرفاهية في كل تفصيل.
                    </p>
                    <p class="about-para">
                        تقدم اوبوليا مجموعة متنوعة من منتجات أثاث المنزل المخصصة. سواء كنت بحاجة إلى تصميم مطبخ عصري أو غرفة نوم هادئة أو منطقة معيشة مريحة فإننا نقدم خيارات متعددة من التصاميم والألوان لتلبية احتياجاتك وتفضيلاتك. نحن نضمن أعلى معايير الجودة في كل منتج نقدمه. نستخدم أفضل المواد والتقنيات لضمان تحقيق أعلى مستوى من الراحة والمتانة. لهذا السبب، نقدم ضمانًا يمتد لمدة 15 عاماًَ على منتجاتنا.
                    </p>
                    <p class="about-para">
                        تأتي قوة اوبوليا في قدرتنا على تخصيص منتجاتنا لتلبية احتياجاتك الخاصة. سواء كنت تبحث عن تصميم فريد يعبر عن شخصيتك أو تحتاج إلى حلاً عملياً لاستغلال المساحة بذكاء، نحن هنا لنجعل ذلك حقيقة.
                    </p>
                </div>

                <!-- Our Brand Section -->
                <div id="Brand" class="row m-4 mb-3 mb-lg-5" style="overflow: visible;">
                    <div class="col-lg-12 col-md-12 col-sm-12 section-header">
                        <h2 class="section-about-title">علامتنا التجارية</h2>
                        <p class="section-description">
                            تحتل مجموعتنا رأس قائمة العلامات التجارية المرموقة في هذا المجال،
                            ونؤكد على التزامنا بتلبية مجموعة واسعة من الأذواق والأداء،
                            الذي يضمن أن يكون كل منزل معبراً عن شخصية وأداء كل شخص.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-sm-12">
                            <img src="{{ asset('Frontend\assets\images\gallery\about.png') }}" alt="Modern Kitchen" class="img-fluid rounded section-image">
                        </div>
                        <div class="col-lg-7 col-sm-12">
                            <div class="row justify-content-evenly" dir="rtl">
                                <div class="col-md-4 text-right feature-box">
                                    <h3 class="feature-number">1.</h3>
                                    <h4 class="feature-title">التميز في النمو والابتكار</h4>
                                    <p class="feature-description">
                                        أوبوليا تقدم أفكاراً جديدة في تصميم أنواع مختلفة من الأثاث، مما يجعل كل منزل متميزًا.
                                    </p>
                                </div>
                                <div class="col-md-4 text-right feature-box">
                                    <h3 class="feature-number">2.</h3>
                                    <h4 class="feature-title">وضع المعايير على الساحة العالمية</h4>
                                    <p class="feature-description">
                                        أوبوليا تعتمد أحدث التقنيات لصناعة منتجات متينة وعالية الجودة.
                                    </p>
                                </div>
                                <div class="col-md-4 text-right feature-box">
                                    <h3 class="feature-number">3.</h3>
                                    <h4 class="feature-title">المشاريع والتعاون العالمي</h4>
                                    <p class="feature-description">
                                        تعمل دائمًا مع شركات البناء والتطوير، ولديها مشاريع متميزة لأكثر من 5000 منزل حول العالم.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Section -->
                <div id="Vision"class="row m-4 mb-3 mb-lg-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row align-items-stretch"  style="background: rgba(131, 176, 171, 1);">
                                <div class="col-lg-6 text-right d-flex flex-column justify-content-center" dir="rtl">
                                    <h2 class="vision-title">رؤيتنا</h2>
                                    <p class="vision-description">
                                        نسعى في أوبوليا لتحقيق رؤيتنا أن نكون الرواد في تقديم حلول المنازل المبتكرة والمتكاملة،
                                        حيث نجمع بين التصميم الأنيق والجودة الفائقة لتلبية احتياجات عملائنا المتنوعة.
                                        نؤمن في أوبوليا بأن المنزل هو المكان الأكثر أهمية في حياة الفرد، ونعمل على أن يكون جزءًا من رحلة عملائنا في بناء ما يعبر عن هويتهم ويحقق أحلامهم.
                                        لذلك نحن دائمًا في تحقيق التميز في كل ما نقدمه، ونعمل باستمرار على تطوير منتجاتنا من خلال الابتكار المستمر والالتزام بأعلى معايير الجودة
                                        مما يستحق لمسة من الأناقة والراحة.
                                    </p>
                                </div>
                                <div class="col-lg-6 align-items-stretch p-0">
                                    <img src="{{ asset('Frontend/assets/images/gallery/vision.jpg') }}" alt="Modern Kitchen"
                                         class="img-fluid vision-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Production Section -->
                <div id="production" class="row m-4 mb-3 mb-lg-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="section-title">إنتاجنا</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 production-lines">
                            <h3 class="sub-title">خطوط الإنتاج</h3>
                            <p style="color: rgba(243, 243, 243, 1);">
                                مع 58 خط إنتاج، لقد صممنا بنية إنتاجية بكفاءة استثنائية تتيح لنا إنشاء آلات بكفاءة استثنائية. حيث لم نضع مواقع التصنيع الخمسة لدينا بشكل استراتيجي في جميع أنحاء العالم لتوفير وصول عالمي عالي الجودة والقيمة على طيلة العملية، مما يوسع من الأسواق.
                                <br><br>
                                يتم توزيع أكثر من 200000 منتج عالميًا، مما يضمن ساعات إنتاج وإمدادات ثابتة في ظل تلبية الطلبات المتزايدة باستمرار.
                                <br><br>
                                تعتمد أحدث المعايير المتقدمة للتصنيع الذكي في كل مرحلة من العملية، مما يتيح التحكم الدقيق في الإنتاج أثناء تكامل التكنولوجيا الذكية، مما يضمن أن كل منتج يتم تصنيعه بالجودة العالية وفق أعلى المعايير.
                                <br><br>
                                نحن نلتزم في أوبوليا دائمًا على الاستثمار في أحدث التقنيات الإنتاجية في الأسواق مع التوسع في طرق التصنيع واستراتيجيات التصدير.
                            </p>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 col-md-12 d-flex flex-column production-capacity h-100 justify-content-center">
                            <h3 class="production-subtitle text-center">الطاقة الإنتاجية</h3>
                            <ul class="production-li">
                                <li>ننتج أكثر من 6300 وحدة مطبخ وخزانة ملابس.</li>
                                <li>نضمن الاستدامة في الوقت المناسب ورضا العملاء.</li>
                                <li>الحفاظ على مستوى الإنتاج الصناعي وفقًا لمعايير التصنيع المتقدمة.</li>
                                <li>نضمن أتمتة العمليات لزيادة المرونة التصنيعية.</li>
                                <li>تلبي احتياجات العملاء.</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-12 p-0">
                            <img src="{{ asset('Frontend/assets/images/gallery/production.jpg') }}" alt="Production Line" class="img-fluid w-100">
                        </div>

                    </div>
                </div>

                <!-- History Section -->
                <div id="history" class="row m-4 " dir="rtl">
                    <div class="product-grid col-lg-12 m-4" >
                        <h2 class="section-title">تاريخنا</h2>
                        <div class="new-arrivals owl-carousel owl-theme position-relative" dir="ltr">
                            <!-- Slide 1 -->
                            <div class="item">
                                <div class="card card-height p-4 text-center">
                                    <div class="event-date badge bg-dark">1994-1997</div>
                                    <h5 class="fw-bold mt-3">بدايات اوبوليا</h5>
                                    <p class="text-muted mt-4">
                                        تأسست اوبوليا في عام 1994 برؤية لجلب الجمال للتصميم الداخلي وإنتاجه وتركيبه في منازل المملكة العربية السعودية.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="item">
                                <div class="card card-height p-4 text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">1998-2002</div>
                                    <h5 class="fw-bold mt-3">بداية التوسع</h5>
                                    <p class="text-muted mt-4">
                                        بدأنا بالتوسع إلى أسواق جديدة مع التركيز على تصميم مطابخ مميزة وفريدة.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="item">
                                <div class="card p-4 card-height text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">2003-2009</div>
                                    <h5 class="fw-bold mt-3">التطوير والتحديث</h5>
                                    <p class="text-muted  mt-4">
                                        قمنا بدمج أحدث تقنيات التصنيع لتعزيز جودة التصاميم.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 4 -->
                            <div class="item">
                                <div class="card p-4 card-height text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">2010-2014</div>
                                    <h5 class="fw-bold mt-3">الذهاب إلى العالمية</h5>
                                    <p class="text-muted mt-4">
                                        توسعنا دوليًا من خلال افتتاح مواقع إنتاج في مناطق رئيسية.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 5 -->
                            <div class="item">
                                <div class="card p-4 card-height text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">2015-2019</div>
                                    <h5 class="fw-bold mt-3">التطورات التكنولوجية</h5>
                                    <p class="text-muted mt-4" dir="rtl">
                                        اعتماد أحدث تقنيات التصنيع الرقمي لتحقيق إنتاج أسرع وأكثر كفاءة.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 6 -->
                            <div class="item">
                                <div class="card p-4 card-height text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">2020-2023</div>
                                    <h5 class="fw-bold mt-3">الابتكار والتطوير</h5>
                                    <p class="text-muted  mt-4">
                                        تقديم حلول ذكية في التصميمات المخصصة والمستدامة.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 7 -->
                            <div class="item">
                                <div class="card p-4 card-height text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">2024</div>
                                    <h5 class="fw-bold mt-3">مبادرات الاستدامة</h5>
                                    <p class="text-muted  mt-4">
                                        إطلاق برامج جديدة للحد من التأثير البيئي وتعزيز الاستدامة.
                                    </p>
                                </div>
                            </div>
                            <!-- Slide 8 -->
                            <div class="item">
                                <div class="card p-4 card-height text-center">
                                    <div class="event-date badge bg-dark text-white py-2 px-3">2025</div>
                                    <h5 class="fw-bold mt-3">الاحتفال بمرور 30 عامًا</h5>
                                    <p class="text-muted  mt-4">
                                        مواصلة أوبوليا قيادة مجال التصميم الداخلي.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Our Team Section -->
                    <div id="team" class="row m-4  mb-lg-5" dir="rtl">
                        <div class="col-lg-12 col-md-12 section-header-team">
                            <h2 class="section-title">فريقنا</h2>
                            <p class="section-description" >
                                فريقنا من المصممين والحرفيين ومدراء المشاريع ذوي المهارات العالية هو العمود الفقري لشركة اوبوليا.
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


                        <!-- Features Grid -->
                        <div class="row justify-content-center col-lg-12 col-md-12 box-container mb-3 mb-lg-5">
                            <div class="col-lg-4 col-md-12 text-center p-4">
                                <h5 class="feature-title">حلول التصميم المخصصة</h5>
                                <p class="feature-description">
                                    يخصص أوبوليا لتقديم تصميمات مخصصة من المنتجات المختلفة، بالإضافة إلى
                                    الألوان والتشطيبات المتنوعة، مما يمنحك تحكمًا كاملاً في التفاصيل.
                                </p>
                            </div>
                            <!-- Box 2 -->
                            <div class="col-lg-4 col-md-12 text-center p-3">
                                <h5 class="feature-title">اختيار المواد</h5>
                                <p class="feature-description">
                                    نساعدك خلال عملية اختيار مواد عالية الجودة والتشطيبات المختلفة،
                                    لضمان أن كل قطعة تعكس الأناقة والمتانة.
                                </p>
                            </div>
                            <!-- Box 3 -->
                            <div class="col-lg-4 col-md-12 text-center p-3">
                                <h5 class="feature-title">التصورات ثلاثية الأبعاد</h5>
                                <p class="feature-description">
                                    نقدم لك عروض تصاميم ثلاثية الأبعاد وجولات افتراضية لمساعدتك
                                    على تصور المشروع بشكل أفضل قبل بدء التنفيذ.
                                </p>
                            </div>
                            <!-- Box 4 -->
                            <div class="col-lg-4 col-md-12 text-center p-3">
                                <h5 class="feature-title">إدارة المشاريع</h5>
                                <p class="feature-description">
                                    نحرص على إدارة مشاريعك مع تقديم خدمات الدعم المستمر،
                                    للحفاظ على الأعمال وضمان القيام بها على أكمل وجه.
                                </p>
                            </div>
                            <!-- Box 5 -->
                            <div class="col-lg-4 col-md-12 text-center p-3">
                                <h5 class="feature-title">الحرفية الجيدة</h5>
                                <p class="feature-description">
                                    يستخدم الحرفيون المهرة تقنيات الإنتاج المتقدمة
                                    والمواد المتينة لإنشاء منتجات عالية الجودة.
                                </p>
                            </div>
                            <!-- Box 6 -->
                            <div class="col-lg-4 col-md-12 text-center p-3">
                                <h5 class="feature-title">التركيب والمتابعة الدائمة</h5>
                                <p class="feature-description">
                                    يوفر فريق التركيب لدينا جميع جوانب المشروع، بما يشمل
                                    التركيبات الأخيرة والدعم لضمان جودة المنتجات.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements Section -->


                    <div id="achievements" class="row g-4 m-4 mb-3 mb-lg-5" dir="rtl">
                        <h2 class="section-title p-3 m-0">إنجازاتنا</h2>

                        <!-- Right Side: Market Value Box (6 Columns, Takes Full Height) -->
                        <div class="col-lg-4 d-flex align-items-stretch">
                            <div class="market-value-box d-flex flex-column w-100 h-100">
                                <h6 class="market-title">القيمة السوقية</h6>
                                <h3 class="count">15.3 مليار دولار أمريكي</h3>
                                <p>في يناير 2021، تجاوزت قيمة مشاريعنا الإجمالية 15.3 مليار دولار أمريكي، مما يعكس النمو المستدام لعملائنا.</p>
                            </div>
                        </div>
                        <!-- Left Side: 4 Achievement Cards (6 Columns in Large Screens) -->
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <div class="col-md-6 d-flex">
                                    <div class="achievement-card green-border d-flex flex-column w-100 h-100">
                                        <h6 class="market-title">منزل مؤثث بشكل كامل</h6>
                                        <h3 class="count">+ 40</h3>
                                        <p>نعمل دائمًا لتحسين مساحة مستخدمينا وتعزيز استراتيجيات الأثاث المثالية.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="achievement-card green-border d-flex flex-column w-100 h-100">
                                        <h6 class="market-title">صالة عرض</h6>
                                        <h3 class="count">+ 7,000</h3>
                                        <p>نقوم بتغطية أكثر من 7,000 صالة عرض حول العالم، وهذا يعزز النمو التجاري والتواصل الفعال.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="achievement-card green-border d-flex flex-column w-100 h-100">
                                        <h6 class="market-title">MUSE Design Award جائزة</h6>
                                        <h3 class="count">+1 MUSE Design Award</h3>
                                        <p>حصلنا على جائزة MUSE Design لعام 2023 تكريماً لابتكاراتنا في التصميم.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="achievement-card green-border d-flex flex-column w-100 h-100">
                                        <h6 class="market-title">Red-dot Award جائزة</h6>
                                        <h3 class="count">+1 Red-dot Award</h3>
                                        <p>تم منحنا جائزة Red-dot لعام 2021.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Suppliers Section -->
                    <div id="suppliers" class="row mb-3 mb-lg-5">
                        <div class="col-lg-12">
                            <div class="row">
                                <!-- Title aligned to the right -->
                                <div class="col-lg-3 d-flex align-items-center justify-content-start m-4">
                                    <h2 class="section-title">الموردون</h2>
                                </div>
                                <!-- Supplier Cards Grid -->
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <!-- First Row: 3 Suppliers -->
                                        <div class="col-lg-4 d-flex">
                                            <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Blum-Logo-.png') }}" alt="Blum Logo" class="supplier-logo">
                                                <p>اكثر من 20 عاما ونحن نعمل معا</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 d-flex">
                                            <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/SKAI-Logo-webp.png') }}" alt="Skai Logo" class="supplier-logo">
                                                <p>تمثل هذه العلامة بمنتجاتها المميزة التي تحدد المعايير الصحيحة</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 d-flex">
                                            <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Suspa (1).png') }}" alt="Suspa Logo" class="supplier-logo">
                                                <p>هي شركة تصنيع مبتكرة لأنظمة الغاز</p>
                                            </div>
                                        </div>
                                        <!-- Second Row: 2 Suppliers -->
                                        <div class="col-lg-6 d-flex">
                                            <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/EEGGER (1).png') }}" alt="EEGGER Logo" class="supplier-logo">
                                                <p>من الألواح الخشبية عالية الجودة إلى المرايا التي تحدد الاتجاه للأثاث</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-flex">
                                            <div class="supplier-card d-flex flex-column align-items-center justify-content-center w-100">
                                                <img src="{{ asset('Frontend/assets/images/gallery/Bostik.png') }}" alt="Bostik Logo" class="supplier-logo">
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

                    <!-- Why Us Section -->
                    <div id="whyUs" class="row mb-3 mb-lg-5">
                        <!-- Main Content Area (8 columns, 1 column left offset) -->
                        <div class="col-lg-12 p-4" style="background: rgba(80, 159, 150, 0.47);">
                            <!-- Section Title -->
                            <h2 class="fw-bold py-4" style="color:rgba(10, 71, 64, 1); text-align: center;">ليش تختارنا؟</h2>
                            <!-- Cards Grid -->
                            <div class="row g-4 justify-content-center" style="direction: rtl">
                                <!-- Card 1 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/measurement.png') }}" class="card-icon mb-3" alt="تصاميم مميزة">
                                        <h5 class="fw-bold card-about">تصاميم مميزة</h5>
                                        <p>نقدم مجموعة واسعة من التصاميم العصرية، مع إمكانية التخصيص لتناسب احتياجاتك الخاصة.</p>
                                    </div>
                                </div>
                                <!-- Card 2 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/ribbon.png') }}" class="card-icon mb-3" alt="جودة عالية">
                                        <h5 class="fw-bold card-about">جودة عالية</h5>
                                        <p>نستخدم أفضل المواد في كل المنتجات لضمان أقصى درجات المتانة والجمال.</p>
                                    </div>
                                </div>
                                <!-- Card 3 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/headphones.png') }}" class="card-icon mb-3" alt="تجربة عملاء مميزة">
                                        <h5 class="fw-bold card-about">تجربة عملاء مميزة</h5>
                                        <p>نولي عملائنا اهتمامًا ونضمن تقديم خدمة ممتازة من البداية إلى النهاية.</p>
                                    </div>
                                </div>
                                <!-- Card 4 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/Discount.png') }}" class="card-icon mb-3" alt="أسعار تنافسية">
                                        <h5 class="fw-bold card-about">أسعار تنافسية</h5>
                                        <p>نقدم أسعارًا مناسبة تنافس السوق، مع ضمان أعلى جودة مقابل السعر</p>
                                    </div>
                                </div>
                                <!-- Card 5 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/garuntee.png') }}" class="card-icon mb-3" alt="الضمان">
                                        <h5 class="fw-bold card-about">الضمان</h5>
                                        <p>نحن نقدم ضمانًا يصل إلى 5 سنوات على جميع المنتجات لضمان استثمارك لفترة طويلة.</p>
                                    </div>
                                </div>
                                <!-- Card 6 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/date.png') }}" class="card-icon mb-3" alt="الالتزام بالمواعيد">
                                        <h5 class="fw-bold card-about">الالتزام بالمواعيد</h5>
                                        <p>نلتزم بمواعيد التسليم والإنجاز لضمان راحتك وجودة الخدمة.</p>
                                    </div>
                                </div>
                                <!-- Card 7 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/delivery.png') }}" class="card-icon mb-3" alt="توصيل مريح">
                                        <h5 class="fw-bold card-about">توصيل مريح</h5>
                                        <p>نضمن توصيل كل شيء لك بسهولة دون عناء.</p>
                                    </div>
                                </div>
                                <!-- Card 8 -->
                                <div class="col-md-3 col-sm-6 d-flex">
                                    <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100" style="border-radius: 30px;">
                                        <img src="{{ asset('Frontend/assets/images/icons/staff.png') }}" class="card-icon mb-3" alt="سهولة التواصل">
                                        <h5 class="fw-bold card-about">سهولة التواصل</h5>
                                        <p>نحن متاحون في كل وقت لتقديم الدعم والمساعدة لك في أي شيء تحتاجه.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Cards Grid -->
                        </div>
                        <!-- End Main Content -->
                    </div>

                    <!-- German Quality Slider -->
                    <div id="responsibility" class="row align-items-center mb-3 mb-lg-5 mt-lg-5">
                        <!-- Image Slider -->

                        <!-- Text Section -->
                        <div class="col-md-12 text-end text-align-right mt-4">
                            <h3 class="fw-bold text-green">الجودة الألمانية</h3>
                            <p class="text-section">
                                في أوبوليا، نفخر بتقديم تصاميم تعكس الجودة الألمانية المعروفة بدقتها ومتانتها.
                                نستخدم مواد عالية الجودة وتقنيات متطورة مما يضمن لك أثاث منزلي يدوم طويلاً
                                ويجمع بين الجمال والوظيفة.
                            </p>
                            <p class="text-section">
                                معنا، تأكد أنك تختار الأفضل لمنزلك، حيث الجودة الألمانية هي أساس كل تصميم.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
