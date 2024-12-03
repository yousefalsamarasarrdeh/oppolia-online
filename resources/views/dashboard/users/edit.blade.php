@extends('layouts.Dashboard.mainlayout')

@section('title', 'User and Designer Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @elseif (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <h1>Edit User and Designer</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- User Information Fields -->
        <h2>User Information</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <div class="form-group">
            @php
                $userRegionId = auth()->user()->region_id; // جلب المنطقة للمستخدم الحالي
            @endphp
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" onchange="toggleDesignerFields()">
            @if($userRegionId)
                <!-- إذا كان المستخدم داخل منطقة، عرض فقط "مصمم" و "مستخدم" -->
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="designer" {{ $user->role == 'designer' ? 'selected' : '' }}>Designer</option>
            @else
                <!-- إذا لم يكن هناك منطقة، عرض جميع الأدوار -->
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="designer" {{ $user->role == 'designer' ? 'selected' : '' }}>Designer</option>
                    <option value="Sales manager" {{ $user->role == 'Sales manager' ? 'selected' : '' }}>Sales Manager</option>
                    <option value="Area manager" {{ $user->role == 'Area manager' ? 'selected' : '' }}>Area Manager</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="region_id">Select Region:</label>
            <select name="region_id" class="form-control">
                <option value="">Select a region (optional)</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id', $user->region_id) == $region->id ? 'selected' : '' }}>
                        {{ $region->name_en }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Designer Information Fields -->
        <div id="designerFields" style="display: none;">
            <h2>Designer Information</h2>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" name="profile_image" accept="image/*" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="experience_years">Experience Years:</label>
                    <input type="number" name="experience_years" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_ar">Description (Arabic):</label>
                    <textarea name="description_ar" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="portfolio_images">Portfolio Images:</label>
                    <input type="file" name="portfolio_images[]" accept="image/*" multiple>
                </div>
            </div>


        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
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
