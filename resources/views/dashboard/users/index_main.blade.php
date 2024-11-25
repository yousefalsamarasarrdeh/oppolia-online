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

    <table class="table datatable" dir="rtl">
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
                <td>{{ $user->phone }}</td>
                <td>
                    @switch($user->role)
                        @case('admin')
                        مدير النظام
                        @break
                        @case('designer')
                        مصمم
                        @break
                        @case('user')
                        مستخدم
                        @break
                        @case('Sales manager')
                        مدير المبيعات
                        @break
                        @case('Area manager')
                        مدير المنطقة
                        @break
                        @default
                        غير معروف
                    @endswitch
                </td>
                <td>
                    <!-- زر التعديل -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">تعديل</a>
                    <!-- زر الحذف -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
