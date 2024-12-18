<!-- create_product.blade.php -->

@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المنتج')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')

   <div class="container" dir="rtl">

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
    <!-- اختيار الفئة -->
        <div class="row">
            <div class="col-md-9">
                <label for="category_id">الفئة :</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <!-- افتراض وجود قائمة بالفئات -->
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- إدخال اسم المنتج -->
        <div class="row">
            <div class="col-md-9">
                <label for="name">اسم المنتج :</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label for="name_ar">اسم المنتج بالعربية :</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label for="sku">SKU:</label>
                <input type="text" name="sku" id="sku" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <label for="image">صورة المنتج :</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
        </div>

        <!-- قسم الأوصاف -->
        <div id="descriptions-wrapper">
            <div class="description-item">
                <div class="row">
                    <div class="col-md-9">
                        <label for="description">الوصف :</label>
                        <textarea name="descriptions[0][description]" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <label for="description_ar">الوصف بالعربية :</label>
                        <textarea name="descriptions[0][description_ar]" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <label for="description_images">صور الوصف (يمكن اختيار عدة صور) :</label>
                        <input type="file" name="descriptions[0][images][]" class="form-control" multiple>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر إضافة وصف جديد -->
        <button type="button" id="add-description-btn" class="btn btn-secondary">إضافة وصف آخر</button>

        <!-- زر إرسال البيانات -->
        <button type="submit" class="btn btn-primary">إضافة منتج</button>
    </form>
   </div>
@endsection

@section('script')
    <script>
        let descriptionCount = 1;
        document.getElementById('add-description-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('descriptions-wrapper');
            const newDescription = `
            <div class="description-item">
                <div class="row">
                    <div class="col-md-9">
                        <label for="description">الوصف :</label>
                        <textarea name="descriptions[${descriptionCount}][description]" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <label for="description_ar">الوصف بالعربية :</label>
                        <textarea name="descriptions[${descriptionCount}][description_ar]" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <label for="description_images">صور الوصف (يمكن اختيار عدة صور) :</label>
                        <input type="file" name="descriptions[${descriptionCount}][images][]" class="form-control" multiple>
                    </div>
                </div>
            </div>
        `;
            wrapper.insertAdjacentHTML('beforeend', newDescription);
            descriptionCount++;
        });
    </script>
@endsection
