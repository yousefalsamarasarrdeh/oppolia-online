<!-- show_product.blade.php -->

@extends('layouts.Dashboard.mainlayout')

@section('title', 'تفاصيل المنتج')

@section('css')
    <style>
        .product-detail-container {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .edit-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .edit-btn:hover {
            background-color: #218838;
            color: white;
        }

        .main-product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .product-info-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .product-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 20px;
        }

        .product-info-left, .product-info-right {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .product-category {
            font-size: 1.1rem;
            color: #6c757d;
            margin: 0;
        }

        .product-code {
            font-size: 1rem;
            color: #6c757d;
            margin: 0;
        }

        .description-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 20px 0 10px 0;
        }

        .description-text {
            font-size: 1rem;
            color: #495057;
            line-height: 1.6;
            margin: 0;
        }

        .divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 30px 0;
        }

        .gallery-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .gallery-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 0 0 20px 0;
            text-align: right;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .gallery-image:hover {
            transform: scale(1.02);
        }

        .no-image-placeholder {
            width: 100%;
            height: 400px;
            background-color: #e9ecef;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .no-gallery-placeholder {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 40px;
        }

        @media (max-width: 768px) {
            .product-info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="product-detail-container" dir="rtl">
        <!-- Header Section -->
        <div class="product-header">
            <h1 class="product-title">تفاصيل المنتج</h1>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="button_Green p-3 rounded-2" >
                <i class="bi bi-pencil"></i>
                تعديل
            </a>
        </div>

        <!-- Main Product Image -->
        @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="main-product-image" loading="lazy">
        @else
            <div class="no-image-placeholder">
                <i class="bi bi-image" style="font-size: 3rem; margin-bottom: 10px;"></i>
                <div>لا توجد صورة للمنتج</div>
            </div>
    @endif

    <!-- Product Information Section -->
        <div class="product-info-section">
            <div class="product-info-grid">
                <!-- Left Column (English) -->
                <div class="product-info-right">
                    <h2 class="product-name">{{ $product->name_ar }}</h2>
                    <p class="product-category">{{ $product->categories->pluck('title_ar')->join('، ') }}</p>
                    <p class="product-code">رمز المنتج: {{ $product->sku }}</p>

                    @if($product->descriptions->count())
                        <div class="description-label">الأوصاف (بالعربية):</div>
                        @foreach($product->descriptions as $index => $description)
                            @if($description->description_ar)
                                <div class="description-item mb-3">
                                    <p class="description-text">{!! $description->description_ar !!}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="description-text">لا توجد أوصاف متاحة</p>
                    @endif
                </div>

                <div class="product-info-left">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <p class="product-category">{{ $product->categories->pluck('title')->join(', ') }}</p>

                    @if($product->descriptions->count())
                        <div class="description-label">Descriptions (English):</div>
                        @foreach($product->descriptions as $index => $description)
                            @if($description->description)
                                <div class="description-item mb-3">
                                    <p class="description-text">{{ $description->description }}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="description-text">No descriptions available</p>
                    @endif
                </div>

            </div>
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Product Image Gallery -->
        <div class="gallery-section">
            <h2 class="gallery-title">صور المنتج</h2>
            <div class="gallery-grid">
                @php
                    $galleryImages = [];

                    // Add main product image if it exists
                    if($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                        $galleryImages[] = $product->image;
                    }

                    // Add description images if they exist
                    if($product->descriptions->count()) {
                        foreach($product->descriptions as $description) {
                            if($description->images) {
                                $images = json_decode($description->images);
                                foreach($images as $image) {
                                    if(file_exists(storage_path('app/public/' . $image))) {
                                        $galleryImages[] = $image;
                                    }
                                }
                            }
                        }
                    }
                @endphp

                @if(count($galleryImages) > 0)
                    @foreach($galleryImages as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="صورة المنتج" class="gallery-image" loading="lazy">
                    @endforeach
                @else
                    <div class="no-gallery-placeholder">
                        <i class="bi bi-images" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <div>لا توجد صور متاحة للمنتج</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
