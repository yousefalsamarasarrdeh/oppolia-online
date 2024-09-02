@extends('layouts.Dashboard.mainlayout') <!-- وراثة الواجهة الرئيسية -->

@section('title', 'User Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Use PUT method to update data -->
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}"><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="{{ $user->phone }}"><br>
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="designer" {{ $user->role == 'designer' ? 'selected' : '' }}>Designer</option>
        </select><br>
        <button type="submit">Update</button>
    </form>
@endsection

