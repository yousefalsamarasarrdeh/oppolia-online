@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') @lang('contact.page_title') @endsection

@section('content')

    <style>
        .form-control {
            background-color: white;
        }
        a {
            color: #0a4740;
        }
    </style>

    <div class="container-fluid about-section p-0 position-relative">
        <div class="col-12 p-0">
            <img src="{{ asset('Frontend/assets/images/banners/contact-banner.png') }}" alt="Contact Us Banner" class="img-fluid about-image">
        </div>

        <div class="about-text-overlay">
            <h1 class="about-text">@lang('contact.page_title')</h1>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <div class="row mt-4 p-0">
                <div class="col-lg-12">
                    <div class="row align-items-stretch" style="background: rgba(131, 176, 171, 1);">
                        <div class="col-lg-6 align-items-stretch p-0">
                            <img src="{{ asset('Frontend/assets/images/gallery/AboutPillow.png') }}" alt="Image" class="img-fluid vision-image">
                        </div>
                        <div class="col-lg-6 text-right d-flex flex-column justify-content-center" dir="rtl">
                            <p class="contact-p p-4">
                                @lang('contact.intro_paragraph')
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="col-md-6" >
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">@lang('contact.full_name')</label>
                            <input type="text" class="form-control" name="full_name" placeholder="@lang('contact.full_name_placeholder')" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">@lang('contact.phone')</label>
                            <input type="tel" class="form-control" name="phone" placeholder="@lang('contact.phone_placeholder')" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">@lang('contact.email')</label>
                            <input type="email" class="form-control" name="email" placeholder="@lang('contact.email_placeholder')" required>
                        </div>
                    </div>

                    <div class="col-md-6" >
                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">@lang('contact.city')</label>
                            <select class="form-control" name="sub_region_id" required>
                                <option disabled selected>@lang('contact.city_placeholder')</option>
                                @foreach($subRegions as $subRegion)
                                    <option value="{{ $subRegion->id }}">
                                        {{ app()->getLocale() === 'ar' ? $subRegion->name_ar : $subRegion->name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold contact-titles">@lang('contact.message')</label>
                            <textarea class="form-control" name="message" placeholder="@lang('contact.message_placeholder')" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 text-end" style="justify-self: center; text-align-last: center;">
                    <button type="submit" class="px-5 py-2 btn button_Dark_Green">@lang('contact.submit')</button>
                </div>
            </form>
        </div>

        <div class="container p-5 " >
            <h5 class="fw-bold mb-3">@lang('contact.contact_info')</h5>
            <div class="d-flex flex-wrap gap-4 justify-content-end align-items-center">
                <p class="mb-0"><strong>@lang('contact.email_label'):</strong> <a href="mailto:info@oppoliaksa.com">info@oppoliaksa.com</a></p>
                <p class="mb-0"><strong>@lang('contact.whatsapp_label'):</strong> <a href="https://wa.me/966564444343" target="_blank">+966564444343</a></p>
                <p class="mb-0"><strong>@lang('contact.phone_label'):</strong> <a href="tel:+966564444343">+966564444343</a></p>
            </div>
        </div>
    </section>
@endsection
