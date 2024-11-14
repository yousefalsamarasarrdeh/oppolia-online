@extends('layouts.Dashboard.mainlayout')

@section('title', 'User Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <h1>Edit Designer</h1>
        <form action="{{ route('designer.storeOrUpdate', $designer->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- حقل صورة الملف الشخصي مع عرض الصورة -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-4">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" name="profile_image" accept="image/*" class="form-control">
                </div>
                <div class="col-md-2">
                    @if ($designer->profile_image)
                        <img src="{{ asset('storage/' . $designer->profile_image) }}" alt="Profile Image" style="width: 100px; height: auto;">
                    @else
                        <p>No profile image available</p>
                    @endif
                </div>
            </div>

            <!-- حقل سنوات الخبرة -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="experience_years">Experience Years:</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $designer->experience_years) }}" required class="form-control">
                </div>
            </div>

            <!-- حقل الوصف -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control">{{ old('description', $designer->description) }}</textarea>
                </div>
            </div>

            <!-- حقل الوصف بالعربية -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_ar">Description (Arabic):</label>
                    <textarea name="description_ar" class="form-control">{{ old('description_ar', $designer->description_ar) }}</textarea>
                </div>
            </div>

            <!-- حقل صور البورتفوليو مع عرض الصور -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-4">
                    <label for="portfolio_images">Portfolio Images:</label>
                    <input type="file" name="portfolio_images[]" accept="image/*" multiple class="form-control">
                </div>
                <div class="col-md-8 d-flex flex-wrap">
                    @if ($designer->portfolio_images)
                        @foreach (json_decode($designer->portfolio_images, true) as $image)
                            <div class="p-2">
                                <img src="{{ asset('storage/' . $image) }}" alt="Portfolio Image" style="width: 100px; height: auto;">
                            </div>
                        @endforeach
                    @else
                        <p>No portfolio images available</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
@endsection
