<!-- create_product.blade.php -->

@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المنتج')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
    <div class="container" dir="rtl">
        <h1>{{ $product->name }} ({{ $product->name_ar }})</h1>
        <p><strong>الفئة:</strong> {{ $product->category->title }}</p>
        <p><strong>SKU:</strong> {{ $product->sku }}</p>

        @if($product->image)
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px;">
            </div>
        @endif

        <h2>الأوصاف:</h2>
        @if($product->descriptions->count())
            <div>
                @foreach($product->descriptions as $description)
                    <div style="margin-bottom: 20px;">
                        <p><strong>الوصف:</strong> {{ $description->description }}</p>
                        <p><strong>الوصف (بالعربية):</strong> {{ $description->description_ar }}</p>

                        @if($description->images)
                            <div>
                                <p><strong>الصور:</strong></p>
                                @foreach(json_decode($description->images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="صورة الوصف" style="max-width: 150px; margin-right: 10px;">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p>لا توجد أوصاف لهذا المنتج.</p>
        @endif
    </div>
@endsection
