@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')تواصل معنا @endsection

@section('content')

    <style>
        .form-control
        {
            background-color: white;
        }
        a{
            color: #0a4740;
        }
    </style>

    <div class="container-fluid about-section p-0 position-relative">
        <!-- Banner Image (Full Width) -->
        <div class="col-12 p-0">
            <img src="{{ asset('Frontend/assets/images/banners/Contact-Banner.png') }}" alt="Contact Us Banner" class="img-fluid about-image">
        </div>

        <!-- Centered Text Overlay -->
        <div class="about-text-overlay">
            <h1 class="about-text">تواصل معنا</h1>
        </div>
    </div>


    <section>
        <!-- Contact Section -->
        <div class="container-fluid">
            <div  class="row mt-4 p-0">
                <div class="col-lg-12">
                    <div class="row align-items-stretch" style="background: rgba(131, 176, 171, 1);">
                        <div class="col-lg-6 align-items-stretch p-0">
                            <img src="{{ asset('Frontend/assets/images/gallery/AboutPillow.png') }}" alt="Image of a pillow on a couch" class="img-fluid vision-image">
                        </div>
                        <div class="col-lg-6 text-right d-flex flex-column justify-content-center" dir="rtl">
                            <p class="contact-p p-4">
                                يمكنك التواصل معنا عبر النموذج أدناه، وسنبذل قصارى جهدنا للرد عليك في أقرب وقت ممكن. كما يمكنك أيضًا التواصل معنا عبر البريد الإلكتروني أو الهاتف المحمول المدرجين أدناه.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="container p-2">
            @if (session('success'))
                <div style="color: green;" dir="rtl">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="color: red;" dir="rtl">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('home.contact.store') }}">
                @csrf

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6" dir="rtl">
                        <!-- Full Name -->
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">الاسم الكامل</label>
                            <input type="text" class="form-control" name="full_name" placeholder="يرجى إدخال الاسم الكامل" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">رقم الهاتف</label>
                            <input type="tel" class="form-control" name="phone" placeholder="يرجى إدخال رقم الهاتف" required dir="rtl">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">البريد الإلكتروني</label>
                            <input type="email" class="form-control" name="email" placeholder="يرجى إدخال البريد الإلكتروني" required>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6" dir="rtl">
                        <!-- Sub Region (City) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">المدينة</label>
                            <select class="form-control" name="sub_region_id" required>
                                <option disabled selected>يرجى اختيار المدينة</option>
                                @foreach($subRegions as $subRegion)
                                    <option value="{{ $subRegion->id }}">
                                        {{ $subRegion->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">الرسالة</label>
                            <textarea class="form-control" name="message" placeholder="يرجى مشاركة تفاصيل استفسارك معنا لمزيد من المعلومات التفصيلية مستعدون على خدمتك بشكل أفضل" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 text-end" style="justify-self: center; text-align-last: center;">
                    <button type="submit" class="px-5 py-2 btn button_Dark_Green">إرسال</button>
                </div>
            </form>
        </div>


        <!-- Contact Details Section -->
        <!-- Contact Details Section - Inline -->
        <div class="container p-5 text-end" dir="rtl">
            <h5 class="fw-bold mb-3">معلومات التواصل المباشر:</h5>
            <div class="d-flex flex-wrap gap-4 justify-content-end align-items-center">
                <p class="mb-0"><strong>الإيميل:</strong> <a href="mailto:info@oppoliaksa.com">info@oppoliaksa.com</a></p>
                <p class="mb-0"><strong>واتساب:</strong> <a href="https://wa.me/966564444343" target="_blank">+966564444343</a></p>
                <p class="mb-0"><strong>الهاتف:</strong> <a href="tel:+966564444343">+966564444343</a></p>
            </div>
        </div>


    </section>
@endsection
