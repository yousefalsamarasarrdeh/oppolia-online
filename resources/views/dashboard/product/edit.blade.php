@extends('layouts.Dashboard.mainlayout')

@section('title', 'تعديل المنتج')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- عرض رسالة النجاح إذا وجدت -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Input for Category -->
        <div>
            <label for="category_id">الفئة:</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input for Product Name -->
        <div>
            <label for="name">اسم المنتج:</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        </div>

        <!-- Input for Product Name in Arabic -->
        <div>
            <label for="name_ar">اسم المنتج بالعربية:</label>
            <input type="text" name="name_ar" id="name_ar" value="{{ $product->name_ar }}" required>
        </div>

        <!-- Input for SKU -->
        <div>
            <label for="sku">SKU:</label>
            <input type="text" name="sku" id="sku" value="{{ $product->sku }}" required>
        </div>

        <!-- Input for Product Image -->
        <div>
            <label for="image">صورة المنتج:</label>
            <input type="file" name="image" id="image">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100">
            @endif
        </div>

        <!-- Descriptions Section -->
        <div id="descriptions-wrapper">
            @foreach($product->descriptions as $index => $description)
                <div class="description-item">
                    <input type="hidden" name="descriptions[{{ $index }}][id]" value="{{ $description->id }}">

                    <!-- الوصف -->
                    <label for="description">الوصف:</label>
                    <textarea name="descriptions[{{ $index }}][description]" required>{{ $description->description }}</textarea>

                    <!-- الوصف بالعربية -->
                    <label for="description_ar">الوصف بالعربية:</label>
                    <textarea name="descriptions[{{ $index }}][description_ar]" required>{{ $description->description_ar }}</textarea>

                    <!-- صور الوصف القديمة -->
                    <label for="description_images">صور الوصف الحالية:</label>
                    @if($description->images)
                        @foreach(json_decode($description->images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Description Image" width="100">
                    @endforeach
                @endif

                <!-- رفع صور جديدة -->
                    <label for="description_images">رفع صور جديدة (يمكن اختيار عدة صور):</label>
                    <input type="file" name="descriptions[{{ $index }}][images][]" multiple>

                    <!-- زر حذف الوصف -->
                    <button type="button" class="remove-description-btn">حذف الوصف</button>
                </div>
            @endforeach
        </div>

        <!-- زر إضافة وصف آخر -->
        <button type="button" id="add-description-btn">إضافة وصف آخر</button>

        <!-- زر التحديث -->
        <button type="submit">تحديث المنتج</button>
    </form>

    <script>
        let descriptionCount = {{ $product->descriptions->count() }};

        // إضافة وصف جديد
        document.getElementById('add-description-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('descriptions-wrapper');
            const newDescription = `
                <div class="description-item">
                    <label for="description">الوصف:</label>
                    <textarea name="descriptions[${descriptionCount}][description]" required></textarea>

                    <label for="description_ar">الوصف بالعربية:</label>
                    <textarea name="descriptions[${descriptionCount}][description_ar]" required></textarea>

                    <label for="description_images">رفع صور جديدة (يمكن اختيار عدة صور):</label>
                    <input type="file" name="descriptions[${descriptionCount}][images][]" multiple>

                    <button type="button" class="remove-description-btn">حذف الوصف</button>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', newDescription);
            descriptionCount++;
        });

        // حذف الوصف بشكل ديناميكي
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-description-btn')) {
                event.target.closest('.description-item').remove();
            }
        });
    </script>
@endsection