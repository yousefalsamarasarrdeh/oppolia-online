@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المستخدمين')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->

    <style>
        .form-select {
            background-position: left .75rem center!important;
        }
    </style>
@endsection

@section('content')
    <div class="container" dir="rtl">
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @elseif (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <h1>تعديل معلومات المستخدم</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- User Information Fields -->
        <h2>معلومات المستخدم</h2>
        <div class="row">
        <div class="form-group col-6">
            <label for="name">الاسم :</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="form-group col-6">
            <label for="email"> البريد إلكتروني :</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        </div>
        <div class="row">

        <div class="form-group col-6">
            <label for="phone">الهاتف :</label>
            <input type="text" style="direction: ltr;text-align: right;" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <div class="form-group col-6">
            @php
                $userrole = auth()->user()->role; // جلب المنطقة للمستخدم الحالي
            @endphp
            <label for="role"> الدور :</label>
            <select name="role" id="role" class="form-select" onchange="toggleDesignerFields()">
            @if( $userrole =='Area manager')
                <!-- إذا كان المستخدم داخل منطقة، عرض فقط "مصمم" و "مستخدم" -->
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>مستخدم</option>
                    <option value="designer" {{ $user->role == 'designer' ? 'selected' : '' }}>مصمم</option>
            @else
                <!-- إذا لم يكن هناك منطقة، عرض جميع الأدوار -->
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>مستخدم</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ادمن</option>
                    <option value="designer" {{ $user->role == 'designer' ? 'selected' : '' }}>مصمم </option>
                    <option value="Sales manager" {{ $user->role == 'Sales manager' ? 'selected' : '' }}>مدير مبيعات</option>
                    <option value="Area manager" {{ $user->role == 'Area manager' ? 'selected' : '' }}>مدير المنطقة</option>
                @endif
            </select>
        </div>
        </div>

        <div class="form-group col-6">
            <label for="region_id"> اختر المنطقة :</label>
            <select name="region_id" class="form-select">
                <option value=""></option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id', $user->region_id) == $region->id ? 'selected' : '' }}>
                        {{ $region->name_ar }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Designer Information Fields -->
        <div id="designerFields" style="display: none;">
            <h2>معلومات المصمم</h2>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="profile_image">الصورة الشخصية :</label>
                    <input type="file" name="profile_image" accept="image/*" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="experience_years">سنوات الخبرة:</label>
                    <input type="number" name="experience_years" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description">الوصف:</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_ar">الوصف بالعربي:</label>
                    <textarea name="description_ar" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="portfolio_images">صور معرض الاعمال :</label>
                    <input type="file" name="portfolio_images[]" accept="image/*" multiple>
                </div>
            </div>


        </div>
        <button type="submit" class="btn button_Green m-2">تحديث</button>
    </form>
    </div>
@endsection

@section('script')
    <script>
        // Function to show/hide designer fields based on role
        function toggleDesignerFields() {
            var role = document.getElementById("role").value;
            var designerFields = document.getElementById("designerFields");

            if (role === "designer") {
                designerFields.style.display = "block";
            } else {
                designerFields.style.display = "none";
            }
        }

        // Initial call to set the correct visibility on page load
        document.addEventListener("DOMContentLoaded", function() {
            toggleDesignerFields();
        });
    </script>
@endsection
