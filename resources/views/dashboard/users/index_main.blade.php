@extends('layouts.Dashboard.mainlayout') <!-- وراثة الواجهة الرئيسية -->

@section('title', 'إدارة المستخدمين')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mt-5" dir="rtl">
        <h1>جدول المستخدمين</h1>

    <div style="overflow-x: auto; width: 100%;">
        <table class="table datatable" dir="rtl" style="min-width: 800px;">
            <thead>
            <tr>
                <th>المعرف</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>الدور</th>
                <th>الإجراء</th>
            </tr>
            </thead>
            <tbody style="text-align: center!important;">
            @foreach ($users as $user)
                <tr style="text-align: center!important;">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td dir="ltr">{{ $user->phone }}</td>
                    <td>
                        @switch($user->role)
                            @case('admin') مدير النظام @break
                            @case('designer') مصمم @break
                            @case('user') مستخدم @break
                            @case('Sales manager') مدير المبيعات @break
                            @case('Area manager') مدير المنطقة @break
                            @default غير معروف
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary bg-transparent border-0">
                            <button type="submit" class="border-0 bg-transparent text-danger">
                                <img src="{{ asset('Dashboard/assets/images/edit.png') }}">
                            </button>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-transparent border-0" onclick="return confirm('هل أنت متأكد؟')">
                                <img src="{{ asset('Dashboard/assets/images/delete.png') }}">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>


@endsection
