@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') المنتجات @endsection
@section('content')

<div class="container p-5">
    <!-- Arrow and Product Name in One Line -->
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="text-right m-0" style="color: rgba(10, 71, 64, 1); font-size: 30px; font-weight:500;">
                @if(App::getLocale() === 'ar')
                    {{ $product->name_ar ?? $product->name }}
                @else
                    {{ $product->name }}
                @endif
            </h1>
            <a href="{{ url('/products') }}" class="black-color">
                <i class="fas  me-2 "></i> رجوع ⬅
            </a>
        </div>
    </div>

    <!-- Product Image Section -->
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset($product->image ? 'storage/' . $product->image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                 class="img-fluid rounded-4 w-100 mb-4"
                 alt="Product Image">
        </div>
    </div>

    <!-- Description Section -->
    @foreach($product->descriptions as $description)
    <div class="row">
        <div class="col-md-12">
            <p class="p-4 text-justify">
                @if(App::getLocale() === 'ar')
                    {{ $description->description_ar  ?? $description->description }}
                @else
                    {{ $description->description }}
                @endif
            </p>
        </div>
    </div>

    <!-- Additional Images Section -->
    @if($description->images)
        @php
            $images = json_decode($description->images);
        @endphp
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('storage/' . $images[0]) }}" alt="Main Image" class="img-fluid rounded-4 w-100 mb-4">
            </div>
        </div>
        <div class="row">
            @foreach(array_slice($images, 1) as $image)
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('storage/' . $image) }}" alt="Side Image" class="img-fluid rounded-4 w-100">
                </div>
            @endforeach
        </div>
    @endif
    @endforeach
</div>

@endsection
