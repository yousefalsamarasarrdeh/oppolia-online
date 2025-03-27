@extends('layouts.Frontend.mainlayoutfrontend')

@section('content')
<section class="banner" dir="ltr">
    <div class="row g-0">
        <!-- Left Banner -->
        <div class="col-lg-7 col-md-7 p-0">
            <img src="{{ asset('Frontend/assets/images/banners/banner-home.png') }}" alt="Left Banner"
                class="img-fluid w-100">
        </div>

        <!-- Right Banner with Text -->
        <div class="col-lg-5 col-md-5 p-0 position-relative d-flex align-items-center justify-content-center">
            <img src="{{ asset('Frontend/assets/images/banners/Color.png') }}" alt="Right Banner" class="img-fluid w-100 h-100">

            <div class="position-absolute text-container text-right">
                <p class="banner-text">
                    أفكارك لبيت مثالي تنفيذها صار أسهل مع
                    <span class="highlight-text">اوبوليا اون لاين!</span>
                </p>
                @auth
                    <a href="{{ route('orders.create') }}" class="btn button_Dark_Green">!اطلب مطبخك</a>
                @endauth

                @guest
                    <button class="btn button_Dark_Green" data-bs-toggle="modal" data-bs-target="#phoneModal">!اطلب مطبخك</button>
                @endguest
            </div>
        </div>
    </div>
</section>



<!--    -->


<!-- New Section -->
<section>
<div class="kitchen-section" >
    <div class="container-fluid">
        <div class="row align-items-center">
             <!-- Text Overlay Section -->
             <div class="col-lg-2 col-md-3 d-flex align-items-center justify-content-center">
                <h2 class="text-with-underline">عن أوبوليا</h2>
            </div>
            <!-- Video Thumbnail Section -->
            <div class="col-lg-10 col-md-9 p-0 position-relative">
                <!-- Custom Thumbnail -->
                <img src="{{ asset('Frontend/assets/images/banners/Vid.png') }}" class="img-fluid w-100"
                    style="margin-top: 30px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#videoModal"
                    alt="Custom Video Thumbnail">

                <!-- Play Button Overlay -->
                <div class="play-button-overlay" data-bs-toggle="modal" data-bs-target="#videoModal">
                    <i class="play-icon"></i>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- YouTube Embed -->
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/SI1EhswdgR8" title="YouTube video" allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!--Step Section-->
<section class="steps-section">
    <div class="container  d-flex flex-column justify-content-center">
        <!-- Heading -->
        <div class="text-center mb-4">
            <h2 class="text-white" style="font-size: 24px; font-weight: bold;">خطوات طلبك من عندنا</h2>
            <div class="text-white-underline"></div>
        </div>

        <!-- Icons and Text -->
        <div class="d-flex flex-wrap justify-content-center text-center text-white" style="direction: rtl;">
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <img src="{{ asset('Frontend/assets/images/icons/Calender.png') }}" alt="Calendar Icon"
                   class="steps-icons">
                <p class="mt-2">احجز موعدك</p>
            </div>
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <img src="{{ asset('Frontend/assets/images/icons/Location.png') }}" alt="Location Icon"
                class="steps-icons">
                <p class="mt-2">تحديد الموقع</p>
            </div>
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <img src="{{ asset('Frontend/assets/images/icons/Ruler.png') }}" alt="Ruler Icon"
                class="steps-icons">
                <p class="mt-2">سجل القياسات والتفاصيل</p>
            </div>
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <img src="{{ asset('Frontend/assets/images/icons/Canvas.png') }}" alt="Canvas Icon"
                class="steps-icons">
                <p class="mt-2">ابدأ من مخطط التصميم</p>
            </div>
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <img src="{{ asset('Frontend/assets/images/icons/timer.png') }}" alt="Timer Icon"
                class="steps-icons">
                <p class="mt-2">المتابعة معك</p>
            </div>
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <img src="{{ asset('Frontend/assets/images/icons/installation.png') }}" alt="Installation Icon"
                class="steps-icons">
                <p class="mt-2">التوصيل وتركيب المطبخ</p>
            </div>
        </div>
    </div>
</section>


<!-- What will you get from Oppolia -->
<section class="container mt-5 p-5">
    <div class="row">
        <!-- Desktop Layout (Two Columns) -->


        <!-- Text Content -->
        <div class="col-md-6 text-end" dir="rtl">
            <h3 class="section-title">ايش رح تستفيد من خدمات اوبوليا اون لاين؟</h3>
            <div class="row">
                <div class="col-md-4 text-item">
                    <h5 class="text-title"><span class="text-number">.1</span><br> صورة أنسب لك</h5>
                    <p class="text-content">راح تحصل على تصميم يساعدك في تخيل شكل مطبخك الجديد قبل ما تبدأ بالتنفيذ.</p>
                </div>
                <div class="col-md-4 text-item">
                    <h5 class="text-title"><span class="text-number">.2</span><br> أنت تختار على ذوقك</h5>
                    <p class="text-content">انت تختار التصميم اللي يعجبك وإحنا نسوي لك دراسة لتكلفته بناءً على ميزانيتك.</p>
                </div>
                <div class="col-md-4 text-item">
                    <h5 class="text-title"><span class="text-number">.3</span><br> مشاركتك في كل خطوة في رحلة التصميم</h5>
                    <p class="text-content">إحنا معاك في كل مرحلة من بداية الفكرة للتنفيذ، عشان نضمن لك كل شيء يناسب احتياجك.</p>
                </div>
                <div class="col-md-4 text-item">
                    <h5 class="text-title"><span class="text-number">.4</span><br> ذوقك يدخل في كل تفصيل</h5>
                    <p class="text-content">راح تقدر تختار المواد، الألوان، والخامات اللي تعجبك.</p>
                </div>
                <div class="col-md-4 text-item">
                    <h5 class="text-title"><span class="text-number">.5</span><br> يوصلك بدون عناء</h5>
                    <p class="text-content">يوصلك المطبخ كامل مع كل مكوناته لمكانك مباشرة.</p>
                </div>
                <div class="col-md-4 text-item">
                    <h5 class="text-title"><span class="text-number">.6</span><br> متابعة حتى بعد التركيب</h5>
                    <p class="text-content">ندعمك حتى بعد التركيب، لضمان راحتك واستمتاعك بمطبخك الجديد.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-none d-md-block">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6 d-flex flex-column" >
                    <img src="{{ asset('Frontend/assets/images/gallery/White.png') }}" class="image-small mb-3" alt="Gold Kitchen Design">
                    <img src="{{ asset('Frontend/assets/images/gallery/Gold.png') }}" class="image-large" alt="White Kitchen Design">
                </div>

                <!-- Right Column -->
                <div class="col-md-6 d-flex flex-column">
                    <img src="{{ asset('Frontend/assets/images/gallery/Brown.png') }}" class="image-large mb-3" alt="Brown Kitchen Design">
                    <img src="{{ asset('Frontend/assets/images/gallery/Red.png') }}" class="image-small" alt="Red Kitchen Design">
                </div>
            </div>
        </div>

        <!-- Mobile Layout (Slider) -->
        <div class="col-12 d-md-none">
            <div class="new-arrivals owl-carousel owl-theme" dir="ltr">
                <div class="item">
                    <img src="{{ asset('Frontend/assets/images/gallery/White.png') }} " class="img-fluid image-slider" alt="Gold Kitchen Design" style="height: 200px">
                </div>
                <div class="item">
                    <img src="{{ asset('Frontend/assets/images/gallery/Gold.png') }}" class="img-fluid image-slider" alt="White Kitchen Design" style="height: 200px">
                </div>
                <div class="item">
                    <img src="{{ asset('Frontend/assets/images/gallery/Brown.png') }}" class="img-fluid image-slider" alt="Brown Kitchen Design" style="height: 200px">
                </div>
                <div class="item">
                    <img src="{{ asset('Frontend/assets/images/gallery/Red.png') }}" class="img-fluid image-slider" alt="Red Kitchen Design" style="height: 200px">
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Why Us? -->
<section class="container-fluid p-5" style="background: rgba(80, 159, 150, 0.47);">
    <div class="container text-center">
        <!-- Section Title -->
        <h2 class="mb-5 fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">ليش تختارنا؟</h2>

        <!-- Cards Grid (Now with proper spacing) -->
        <div class="row g-4 d-flex justify-content-center" style="direction: rtl;">
            <!-- Card 1 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend/assets/images/icons/measurement.png') }}" class="card-icon mb-3" alt="تصاميم مميزة">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">تصاميم مميزة</h5>
                    <p>نقدم مجموعة واسعة من التصاميم العصرية، مع إمكانية التخصيص لتناسب احتياجاتك الخاصة.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend/assets/images/icons/ribbon.png') }}" class="card-icon mb-3" alt="جودة عالية">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">جودة عالية</h5>
                    <p>نستخدم أفضل المواد والمكونات في كل المنتجات لضمان أقصى درجات المتانة والجمال.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend\assets\images\icons\headphones.png')}}" class="card-icon mb-3"
                        alt="تجربة عملاء مميزة">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">تجربة عملاء مميزة</h5>
                    <p>نولي عملائنا اهتمامًا ونضمن تقديم خدمة ممتازة من البداية إلى النهاية.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend/assets/images/icons/Discount.png') }}" class="card-icon mb-3" alt="أسعار تنافسية">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">أسعار تنافسية</h5>
                    <p>نقدم أسعارًا مناسبة تنافس السوق، مع ضمان أعلى جودة مقابل السعر.</p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend/assets/images/icons/garuntee.png') }}" class="card-icon mb-3" alt="الضمان">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">الضمان</h5>
                    <p>نحن نقدم ضمانًا يصل إلى 5 سنوات على جميع المنتجات لضمان استثمارك لفترة طويلة.</p>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend/assets/images/icons/date.png') }}" class="card-icon mb-3" alt="الالتزام بالمواعيد">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">الالتزام بالمواعيد</h5>
                    <p>نلتزم بمواعيد التسليم والإنجاز لضمان راحتك وجودة الخدمة.</p>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="col-md-3 col-sm-6 d-flex">
                <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">
                    <img src="{{ asset('Frontend/assets/images/icons/delivery.png') }}" class="card-icon mb-3" alt="توصيل مريح">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">توصيل مريح</h5>
                    <p>نضمن توصيل كل شيء لك بسهولة دون عناء.</p>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="col-md-3 col-sm-6 d-flex">
            <div class="card text-center shadow p-4 d-flex flex-column align-items-center justify-content-between w-100 h-100">

                    <img src="{{ asset('Frontend/assets/images/icons/staff.png') }}" class="card-icon mb-3" alt="سهولة التواصل">
                    <h5 class="fw-bold" style="color: var(--Dark-Green, rgba(10, 71, 64, 1));">سهولة التواصل</h5>
                    <p>نحن متاحون في كل وقت لتقديم الدعم والمساعدة لك في أي شيء تحتاجه.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="container-fluid p-5">
    <div class="container text-center" style="direction: rtl">
        <!-- Section Title -->
        <h2 class="fw-bold" style="color: rgba(10, 71, 64, 1) !important;">نضمن توصيل كل شيء بشكل آمن، دون عناء.</h2>
        <p class="mt-3 " style="font-size: 16px;">
            اذا كنت تبحث عن مطابخ، خزائن، أبواب الداخلية، أو حلول المنزل أخرى.. <br>
            إحنا هنا لنساعدك في اوبوليا اون لاين، طلباتك أوامر.
        </p>

        <!-- Images Grid -->
        <div class="row g-4 mt-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 col-sm-6 d-flex flex-column align-items-center">
                <img src="{{ asset('Frontend/assets/images/gallery/NewClassic.webp') }}" class="img-fluid rounded shadow"
                    alt="مطابخ نيو كلاسيك ">
                <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">مطابخ نيو كلاسيك </h5>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 col-sm-6 d-flex flex-column align-items-center">
                <img src="{{ asset('Frontend/assets/images/gallery/Modern.webp') }}" class="img-fluid rounded shadow"
                    alt="مطابخ حديثة">
                <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">مطابخ حديثة</h5>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 col-sm-6 d-flex flex-column align-items-center">
                <img src="{{ asset('Frontend/assets/images/gallery/L-Shaped.webp') }}" class="img-fluid rounded shadow"
                    alt="مطابخ على شكل L">
                <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">مطابخ على شكل حرف L</h5>
            </div>

            <!-- Card 4 -->
            <div class="col-md-3 col-sm-6 d-flex flex-column align-items-center">
                <img src="{{ asset('Frontend/assets/images/gallery/U-Shaped.webp') }}" class="img-fluid rounded shadow"
                    alt="أمطابخ على شكل حرف U">
                <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">مطابخ على شكل حرف U</h5>
            </div>


        </div>
    </div>
</section>




<section class="container p-5">
    <div class="row align-items-center justify-content-center">
        <!-- Image Slider -->

        <!-- ✅ Text Section -->
        <div class="col-md-5 text-end">
            <h3 class="fw-bold text-success">الجودة الألمانية</h3>
            <p class="text-section">
                في أوبوليا، نفخر بتقديم تصاميم تعكس الجودة الألمانية المعروفة بدقتها ومتانتها.
                نستخدم مواد عالية الجودة وتقنيات متطورة مما يضمن لك أثاث منزلي يدوم طويلاً
                ويجمع بين الجمال والوظيفة.
            </p>
            <p class="text-section">
                معنا، تأكد أنك تختار الأفضل لمنزلك، حيث الجودة الألمانية هي أساس كل تصميم.
            </p>
        </div>

        <div class="col-md-6 position-relative">
            <div id="germanQualitySlider" class="carousel slide" data-bs-ride="carousel">

                <!-- ✅ Indicators (Positioned Correctly) -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="3"></button>

                </div>

                <!-- ✅ Carousel Images -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('Frontend/assets/images/gallery/01.png') }}" class="d-block w-100 rounded-4"
                            alt="German Quality Kitchen">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Frontend/assets/images/gallery/02.png') }}" class="d-block w-100 rounded-4"
                            alt="Luxury Kitchen">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Frontend/assets/images/gallery/03.png') }}" class="d-block w-100 rounded-4"
                            alt="Modern Kitchen">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Frontend/assets/images/gallery/04.png') }}" class="d-block w-100 rounded-4"
                            alt="Modern Kitchen">
                    </div>
                </div>

                <!-- ✅ Navigation Controls -->
                <div class="carousel-controls">
                    <!-- Previous Button -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#germanQualitySlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>

                    <!-- Next Button -->
                    <button class="carousel-control-next" type="button" data-bs-target="#germanQualitySlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Meet Our Designers Section -->
<section class="container text-center p-5">
    <h2 class="fw-bold text-success">مصممو اوبوليا اون لاين!</h2>
    <p class="mt-3 designers-text">
        في اوبوليا اون لاين، لدينا فريق محترف من المصممين المتخصصين الذين يتمتعون بين الإبداع والجدارة.
        <br> يعمل مصممونا على فهم احتياجاتك وتوفيرك لبيت مثالي، وتحويل أفكارك إلى واقع.
    </p>
    <p class="be-a-designer"> انضم الآن وكن جزء من فريق التصميم</p>

    <!-- Designers Owl Carousel -->
    <div class="new-arrivals owl-carousel owl-rtl d-flex justify-content-center owl-theme designers-carousel position-relative align-content-center mt-5" dir="ltr">
        @foreach($designer as $designer)
        <div class="item">
            <div class="designer-card p-4 text-center"
                 data-bs-toggle="modal"
                 data-bs-target="#designerModal"
                 data-name="{{ $designer->user->name }}"
                 data-image="{{ asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                 data-bio="{{ $designer->description_ar }}"
                 data-experience="{{ $designer->experience_years }}"
                 data-rating="{{ $designer->rating }}"
                 data-portfolio="{{ $designer->portfolio_images }}">
                <img src="{{asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}" class="img-fluid rounded-4" alt="Designer Profile Picture">
                <div class="designer-info mt-3">
                    <h5>{{ $designer->user->name }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

<!-- Designer Info Modal -->
<div class="modal fade" id="designerModal" tabindex="-1" aria-labelledby="designerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="align-items: center;">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close" style="padding: 15px;"></button>

            <div class="modal-header">
                <h5 class="modal-title" id="designerName"></h5>
            </div>
            <div class="modal-body text-center">
                <img id="designerImage" src="" class="img-fluid rounded mb-3" style="max-width: 200px;">
                <p id="designerBio" class="mt-2"></p>

                <!-- Portfolio Images -->

                <!-- Portfolio Images Carousel -->
                <div id="portfolioContainerWrapper">
                    <div id="portfolioContainer" class="owl-carousel owl-theme p-3" style="text-align: -webkit-center" dir="ltr"></div>
                </div>

                <p><strong>الخبرة:</strong> <span id="designerExperience"></span> سنوات</p>
                <p><strong>التقييم:</strong> ⭐ <span id="designerRating"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Image Full View Modal -->
<div class="modal fade" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">عرض الصورة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="portfolioImage" src="" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>


<!-- JavaScript to Update Portfolio Modal Image -->

    <script>
   document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".designer-card").forEach(card => {
        card.addEventListener("click", function () {
            // Get designer data attributes
            let name = this.getAttribute("data-name") || "غير معروف";
            let image = this.getAttribute("data-image") || "/ProfilePlaceholder.jpg";
            let bio = this.getAttribute("data-bio") || "لا يوجد وصف متاح";
            let experience = this.getAttribute("data-experience") || "غير معروف";
            let rating = this.getAttribute("data-rating") || "غير متاح";
            let portfolioJson = this.getAttribute("data-portfolio");

            console.log("Clicked Designer:", { name, image, bio, experience, rating, portfolioJson });

            // Update designer modal with data
            document.getElementById("designerName").innerText = name;
            document.getElementById("designerImage").src = image;
            document.getElementById("designerBio").innerText = bio;
            document.getElementById("designerExperience").innerText = experience;
            document.getElementById("designerRating").innerText = rating;

            // Handle portfolio images dynamically
            let portfolioContainer = $("#portfolioContainer");

            // **Destroy Owl Carousel if already initialized**
            if (portfolioContainer.hasClass("owl-loaded")) {
                portfolioContainer.trigger("destroy.owl.carousel").removeClass("owl-loaded");
            }

            portfolioContainer.empty(); // Clear old images

            if (portfolioJson) {
                let portfolioImages = [];
                try {
                    portfolioImages = JSON.parse(portfolioJson);
                } catch (error) {
                    console.error("Error parsing portfolio JSON:", error);
                    return;
                }

                // Append new images to the carousel
                portfolioImages.forEach(imagePath => {
                    let itemDiv = `<div class="item">
                        <img src="/storage/${imagePath}" class="img-fluid rounded" style="width: 150px; cursor: pointer;" onclick="showPortfolioImage('/storage/${imagePath}')">
                    </div>`;
                    portfolioContainer.append($(itemDiv));
                });

                // **Reinitialize Owl Carousel**
                portfolioContainer.owlCarousel({
                    loop: false,
                    margin: 10,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 2 },
                        1000: { items: 3 }
                    }
                });
            }

            // Open the designer modal
            $("#designerModal").modal("show");
        });
    });
});

// Function to show the full image in the portfolio modal
function showPortfolioImage(imageSrc) {
    $("#portfolioImage").attr("src", imageSrc);
    $("#portfolioModal").modal("show");
}


</script>




    <div class="text-center mt-4">
        <a href="{{route('home.designers') }}" class="btn btn-success">مشاهدة الكل</a>
    </div>
</section>




<!--    -->


@endsection



@php
                    $portfolioImages = json_decode($designer->portfolio_images, true);
@endphp
