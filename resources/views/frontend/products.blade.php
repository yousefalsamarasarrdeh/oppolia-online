@extends('layouts.Frontend.mainlayoutfrontend')

@section('content')

<div class="container p-4" dir="rtl">
  
    <!-- Sorting & Results Count -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <select class="form-select w-auto">
            <option>الترتيب الافتراضي</option>
            <option value="price_asc">السعر (تصاعدي)</option>
            <option value="price_desc">السعر (تنازلي)</option>
        </select>
    </div>

    <!-- Products Grid -->
    <div class="row row-cols-1 row-cols-md-3 g-4 m-3">
        @foreach($products as $product)
        <div class="col">
            <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                <div class="designer-card p-4 text-center">
                    <img src="{{ asset($product->image ? 'storage/' . $product->image : 'storage/profile_images/ProfilePlaceholder.jpg') }}" 
                         class="img-fluid rounded-4" 
                         alt="Product Image">
                    <div class="designer-info mt-3">
                        <h5>
                            @if(App::getLocale() == 'ar')
                                {{ $product->name_ar ?? $product->name }}
                            @else 
                                {{$product->name}}
                            @endif
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection
