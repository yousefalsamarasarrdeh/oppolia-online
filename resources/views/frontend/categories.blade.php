@extends('layouts.Frontend.mainlayoutfrontend')

@section('content')

<div class="container p-4" dir="rtl">



    <!-- Products Grid -->
    <div class="row row-cols-1 row-cols-md-3 g-4 m-3">
        @foreach($categories as $category)


        <div class="col">
            <a href="{{ route('category.products', $category->id) }}" class="text-decoration-none text-dark">
                <div class="designer-card p-4 text-center">
                    <img src="{{ asset($category->image ? 'storage/' . $category->image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                         class="img-fluid rounded-4"
                         alt="Product Image">
                    <div class="designer-info mt-3">
                        <h5>
                            @if(App::getLocale() == 'ar')
                                {{ $category->title_ar ?? $category->title }}
                            @else
                                {{$category->title}}
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
