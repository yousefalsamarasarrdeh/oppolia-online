@extends('layouts.Dashboard.mainlayout') <!-- وراثة الواجهة الرئيسية -->

@section('title', 'User Management')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
    <
@endsection

@section('content')

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>rola</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <!-- زر التعديل -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">تعديل</a>
                    <!-- زر الحذف -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا المستخدم؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- إضافة سكربت Simple DataTables -->




@endsection

