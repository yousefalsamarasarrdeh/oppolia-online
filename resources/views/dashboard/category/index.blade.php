@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة الفئات')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div  dir="rtl">
     <h1>الفئات</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

     <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">إضافة فئة جديدة</a>

    <div class="container mt-3">
     <table class="table">
        <thead>
        <tr>
            <th>المعرف</th>
            <th>العنوان</th>
            <th>العنوان بالعربية</th>
            <th>الفئة الأساسية</th> <!-- عمود جديد للفئة الأساسية -->
            <th>الحالة</th>
            <th>الإجراءات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->title_ar }}</td>
                <td>{{ $category->parent ? $category->parent->title : 'لايوجد' }}</td> <!-- عرض الفئة الأساسية -->
                <td>{{ $category->status }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-info">تعديل</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>
     </div>

    </div>
@endsection
