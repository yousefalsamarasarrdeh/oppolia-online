<!-- create_product.blade.php -->

@extends('layouts.Dashboard.mainlayout')

@section('title', 'product Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
    <div class="container">
        <h1>{{ $product->name }} ({{ $product->name_ar }})</h1>
        <p><strong>Category:</strong> {{ $product->category->title }}</p>
        <p><strong>SKU:</strong> {{ $product->sku }}</p>

        @if($product->image)
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px;">
            </div>
        @endif

        <h2>Descriptions:</h2>
        @if($product->descriptions->count())
            <div>
                @foreach($product->descriptions as $description)
                    <div style="margin-bottom: 20px;">
                        <p><strong>Description:</strong> {{ $description->description }}</p>
                        <p><strong>Description (Arabic):</strong> {{ $description->description_ar }}</p>

                        @if($description->images)
                            <div>
                                <p><strong>Images:</strong></p>
                                @foreach(json_decode($description->images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Description Image" style="max-width: 150px; margin-right: 10px;">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p>No descriptions available for this product.</p>
        @endif
    </div>
@endsection

