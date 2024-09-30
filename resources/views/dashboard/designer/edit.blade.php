@extends('layouts.Dashboard.mainlayout') <!-- وراثة الواجهة الرئيسية -->

@section('title', 'User Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <h1>Edit Designer</h1>
    <form action="{{ route('designer.storeOrUpdate', $designer->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div>
            <label for="profile_image">Profile Image:</label>
            <input type="file" name="profile_image" accept="image/*">
        </div>

        <div>
            <label for="experience_years">Experience Years:</label>
            <input type="number" name="experience_years" value="{{ old('experience_years', $designer->experience_years) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description">{{ old('description', $designer->description) }}</textarea>
        </div>

        <div>
            <label for="description_ar">Description (Arabic):</label>
            <textarea name="description_ar">{{ old('description_ar', $designer->description_ar) }}</textarea>
        </div>

        <div>
            <label for="portfolio_images">Portfolio Images:</label>
            <input type="file" name="portfolio_images[]" accept="image/*" multiple>
        </div>

        <div>
            <label for="designer_code">Designer Code:</label>
            <input type="text" name="designer_code" value="{{ old('designer_code', $designer->designer_code) }}" required>
        </div>

        <button type="submit">Save Changes</button>
    </form>
@endsection
