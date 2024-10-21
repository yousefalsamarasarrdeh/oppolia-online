@extends('layouts.Dashboard.mainlayout') <!-- وراثة الواجهة الرئيسية -->

@section('title', 'User Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')

    @if (session('error'))
        <div style="color: green;">
            {{ session('error') }}
        </div>
    @endif
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Use PUT method to update data -->

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
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="designer" {{ $user->role == 'designer' ? 'selected' : '' }}>Designer</option>
                <option value="Sales manager" {{ $user->role == 'Sales manager' ? 'selected' : '' }}>Sales Manager</option>
                <option value="Area manager" {{ $user->role == 'Area manager' ? 'selected' : '' }}>Area Manager</option>
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

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
