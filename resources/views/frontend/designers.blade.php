@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')@lang('designers.Oppolia Designers') @endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>

    .design-section {
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    }

    .design-image {
        background-image: url('Frontend/assets/images/gallery/deopq.png'); /* استبدل بمسار الصورة */
    background-size: cover;
    background-position: center;
    height: 100%;
    min-height: 300px;
    }

    .design-content {
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    }


    </style>
@endsection
@section('content')

    <div class="container-fluid about-section position-relative">
        <!-- Banner Image (Full Width) -->
        <div class="row">
            <div class="col-12 p-0">
                <img src="{{ asset('Frontend/assets/images/banners/designer.png') }}" alt="About Us Banner" class="img-fluid about-image">
            </div>
        </div>
        <!-- Centered Text Overlay -->
        <div class="about-text-overlay">
            <h1 class="about-text">@lang('designers.Oppolia Designers')</h1>
        </div>
    </div>


    <div class="container col-12 mb-3 mb-lg-4">
        <h2 class="about-title text-center mt-3">@lang('designers.The Design Team at Oppolia Online') </h2>

        <p class="about-para text-center">
            @lang('designers.We take pride in having a distinguished design team that combines experience and creativity.')
            <br>
            @lang('designers.They listen to you, understand your needs, and add your personal touch to every detail to deliver the best results.')

        </p>

    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 m-3">
        @forelse($designer as $designer)
            @php
                $avgRating = $designer->ratings->avg('rating'); // نأخذ المعدل بدقة
                $ratingCount = $designer->ratings->count();
            @endphp
            <div class="col d-flex align-items-stretch">
                <div class="card p-4 text-center h-100 d-flex flex-column w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#designerModal{{ $designer->id }}" style="cursor: pointer;">
                    <img src="{{ asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                         class="card-img-top img-fluid rounded-4 mb-3"
                         alt="Designer Image" style="object-fit: cover; height: 277px;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2">
                            @if(App::getLocale() == 'ar')
                                {{ $designer->user->name ?? 'مصمم' }}
                            @else
                                {{ $designer->user->name_en ?? 'Designer' }}
                            @endif
                        </h5>

                        <!-- عرض التقييم داخل الكارد -->
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($avgRating))
                                    <i class="fas fa-star text-warning"></i>
                                @elseif($i - $avgRating < 1)
                                    <i class="fas fa-star-half-alt text-warning"></i> <!-- نصف نجمة -->
                                @else
                                    <i class="far fa-star text-muted"></i>
                                @endif
                            @endfor
                            @if(App::getLocale() == 'ar')
                                <small class="text-muted d-block">
                                    {{ number_format($avgRating, 1) }} من 5 ({{ $ratingCount }} تقييم{{ $ratingCount == 1 ? '' : 'ات' }})
                                </small>
                            @else
                                <small class="text-muted d-block">
                                    {{ number_format($avgRating, 1) }} out of 5 ({{ $ratingCount }} rating{{ $ratingCount == 1 ? '' : 's' }})
                                </small>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal لكل مصمم -->

            <div class="modal fade" id="designerModal{{ $designer->id }}" tabindex="-1" aria-labelledby="designerModalLabel{{ $designer->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <div class="modal-content rounded-4 p-4">


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>

                        <div class="modal-body d-flex flex-column flex-md-row align-items-center">


                            <!-- صورة المصمم -->
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <img src="{{ asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                                     class="img-fluid "
                                     alt="Designer Image" style="width: 150px; height: 150px; object-fit: cover;   border-radius: 10px;">
                            </div>

                            <!-- معلومات المصمم -->
                            <div class="col-md-8 {{ App::getLocale() == 'ar' ? 'text-end' : 'text-start' }}" style="direction: {{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}; text-align: {{ App::getLocale() == 'ar' ? 'right' : 'left' }}; ">
                                <h4>
                                    @if(App::getLocale() == 'ar')
                                        {{ $designer->user->name ?? 'مصمم' }}
                                    @else
                                        {{ $designer->user->name_en ?? 'Designer' }}
                                    @endif
                                </h4>
                                <p class="text-muted mb-1">
                                    @if(App::getLocale() == 'ar')
                                        الخبرة: {{ $designer->experience_years }} سنوات
                                    @else
                                        {{ $designer->experience_years }} years of experience
                                    @endif
                                </p>

                                <!-- نجوم التقييم -->
                                <div class="mb-3">
                                    @php
                                        $avgRating = $designer->ratings->avg('rating') ?? 0;
                                        $ratingCount = $designer->ratings->count() ?? 0;
                                    @endphp

                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($avgRating))
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i - $avgRating < 1)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <small class="text-muted">
                                        @if(App::getLocale() == 'ar')
                                            ({{ number_format($avgRating, 1) }} / {{ $ratingCount }} تقييمات)
                                        @else
                                            ({{ number_format($avgRating, 1) }} / {{ $ratingCount }} ratings)
                                        @endif
                                    </small>
                                </div>

                                <!-- الوصف Description -->
                                <p class="{{ App::getLocale() == 'ar' ? 'text-right' : 'text-left' }}">
                                    @if(App::getLocale() == 'ar')
                                        {{ $designer->description_ar ?? 'لا يوجد وصف متوفر' }}
                                    @else
                                        {{ $designer->description ?? 'No description available' }}
                                    @endif
                                </p>
                            </div>

                        </div>

                        <!-- سلايدر صور البورتفوليو -->
                        @if ($designer->portfolio_images)
                            @php
                                $portfolioImages = json_decode($designer->portfolio_images);
                            @endphp

                            @if(count($portfolioImages) > 0)
                                <div id="portfolioCarousel{{ $designer->id }}" class="carousel slide mt-4" data-bs-ride="carousel">
                                    <p class="text-center text-muted py-3">@lang('homepage.Previous Work')</p>
                                <div class="carousel-inner">
                                        @foreach($portfolioImages as $key => $image)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 rounded-4" alt="Portfolio Image" style="height: 300px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel{{ $designer->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel{{ $designer->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @else
                                <p class="text-center text-muted py-3">
                                    @if(App::getLocale() == 'ar')
                                        لا توجد صور بورتفوليو متاحة
                                    @else
                                        No portfolio images available
                                    @endif
                                </p>
                            @endif
                        @else
                            <p class="text-center text-muted py-3">
                                @if(App::getLocale() == 'ar')
                                    لا توجد صور بورتفوليو متاحة
                                @else
                                    No portfolio images available
                                @endif
                            </p>
                        @endif




                    </div>
                </div>
            </div>

        @empty
            <div class="col-12 text-center">
                <p>لا يوجد مصممين متاحين حالياً.</p>
            </div>
        @endforelse
    </div>
    <div class="container my-5">
        <div class="row design-section">
            <div class="col-md-6 design-content ">
                <h5 class="about-title">@lang('designers.The Design Team at Oppolia Online')</h5>
                <p class="">
                    @lang('designers.Do you dream of becoming a kitchen interior designer?')<br>
                    @lang('designers.If you are passionate about the world of design and have the ambition to leave your mark...') <br>
                    @lang('designers.Why not join the Oppolia Online team?') <br>
                    @lang('designers.Here, we believe in purpose-driven work and support every ambitious designer who wants to grow and unleash their creativity.')
                </p>
                <div class="col-md-4">
                <a href="{{ route('joinasdesigner.create') }}" class="btn  button_Dark_Green mt-3">@lang('designers.Join as a Designer')</a>
                </div>
            </div>
            <div class="col-md-6 design-image"></div>

        </div>
    </div>


@endsection
