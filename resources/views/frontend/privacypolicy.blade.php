@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') @lang('privacy.Privacy Policy') @endsection

<style>
    .para-title {
        font-size: 20px;
        color: black;
    }

    .para {
        font-size: 16px;
    }
</style>

@section('content')
    <div class="container mt-3" >
        <h1 class="text-center mb-4 about-title">@lang('privacy.Privacy Policy')</h1>

        <h5 class="para-title fw-bold">
            @lang('privacy.This Privacy Policy outlines how Oppolia Online collects, uses, and protects any information you provide while using our website.')
        </h5>

        <p class="text-black para">
            @lang('privacy.At Oppolia Online, we are committed to safeguarding your privacy and ensuring that your personal information is protected.')<br>
            @lang('privacy.Any data collected through this website will be used in accordance with this policy.')<br>
            @lang('privacy.We may update this statement periodically to reflect changes and ensure its relevance.')
        </p>

        <h5 class="fw-bold mt-5 para-title">@lang('privacy.Information We Collect')</h5>
        <p class="para text-black">
        @lang('privacy.We may collect the following types of information:')
        <ul class="para text-black">
            <li>@lang('privacy.Your name and contact details, including email address')</li>
            <li>@lang('privacy.Demographic information such as postal code')</li>
            <li>@lang('privacy.Your interests and other relevant data gathered through surveys or promotional offers')</li>
        </ul>
        </p>

        <h5 class="fw-bold mt-4 para-title">@lang('privacy.How We Use Your Information')</h5>
        <p class="para text-black">
        @lang('privacy.We collect this information to better understand your needs and enhance the services we provide. Specifically, it may be used for:')
        <ul class="para text-black">
            <li>@lang('privacy.Internal record keeping and service improvement')</li>
            <li>@lang('privacy.Sending occasional promotional emails about new products, special offers, or other updates we believe may interest you')</li>
            <li>@lang('privacy.Contacting you for market research purposes via email, phone, or mail')</li>
            <li>@lang('privacy.Personalizing your experience and tailoring the website to match your interests')</li>
        </ul>
        </p>

        <h5 class="fw-bold mt-4 para-title">@lang('privacy.Data Security')</h5>
        <p class="text-black para">
            @lang('privacy.We are dedicated to protecting your personal information from unauthorized access or disclosure. We have implemented appropriate electronic and managerial procedures to safeguard and secure the information we collect online.')
        </p>
    </div>
@endsection
