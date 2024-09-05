@extends('layouts.dashboard.mainlayout')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title (English)</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $category->title) }}">
        </div>
        <div class="form-group">
            <label for="title_ar">Title (Arabic)</label>
            <input type="text" class="form-control" id="title_ar" name="title_ar" required value="{{ old('title_ar', $category->title_ar) }}">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" alt="Current Category Image" width="100px" height="100px">
            @endif
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active" @if($category->status == 'active') selected @endif>Active</option>
                <option value="inactive" @if($category->status == 'inactive') selected @endif>Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="parent_id">Parent Category (Optional)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">None</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
