<!-- create_product.blade.php -->

@extends('layouts.Dashboard.mainlayout')

@section('title', 'product Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

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

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<!-- Input for Category -->
    <div>
        <label for="category_id">category :</label>
        <select name="category_id" id="category_id" required>
            <!-- Assuming you have a list of categories -->
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Input for Product Name -->
    <div>
        <label for="name">product name :</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="name_ar">product name in arabic</label>
        <input type="text" name="name_ar" id="name_ar" required>
    </div>

    <div>
        <label for="sku">SKU:</label>
        <input type="text" name="sku" id="sku" required>
    </div>

    <div>
        <label for="image">product image</label>
        <input type="file" name="image" id="image">
    </div>

    <!-- Descriptions Section -->
    <div id="descriptions-wrapper">
        <div class="description-item">
            <label for="description">description :</label>

            <textarea name="descriptions[0][description]" required></textarea>
            </br>
            <label for="description_ar">description in arabic :</label>
            <textarea name="descriptions[0][description_ar]" required></textarea>
            </br>
            <label for="description_images">Description pictures (several pictures can be selected):</label>
            <input type="file" name="descriptions[0][images][]" multiple>
        </div>
    </div>

    <!-- Button to add more descriptions -->
    <button type="button" id="add-description-btn">Add another description</button>

    <!-- Submit button -->
    <button type="submit">add product</button>
</form>
@endsection
@section('script')
<script>
    let descriptionCount = 1;
    document.getElementById('add-description-btn').addEventListener('click', function() {
        const wrapper = document.getElementById('descriptions-wrapper');
        const newDescription = `
            <div class="description-item">
                <label for="description">description :</label>
                <textarea name="descriptions[${descriptionCount}][description]" required></textarea>
                          </br>
                <label for="description_ar">description in arabic :</label>
                <textarea name="descriptions[${descriptionCount}][description_ar]" required></textarea>
                          </br>
                <label for="description_images">Description pictures (several pictures can be selected):</label>
                <input type="file" name="descriptions[${descriptionCount}][images][]" multiple>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', newDescription);
        descriptionCount++;
    });
</script>
@endsection
