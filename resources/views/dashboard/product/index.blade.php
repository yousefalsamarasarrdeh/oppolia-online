@extends('layouts.Dashboard.mainlayout')

@section('title', 'Product Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1>قائمة المنتجات</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
        <table class="table table-bordered datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم المنتج</th>
                <th>اسم المنتج بالعربية</th>
                <th>SKU</th>
                <th>الفئة</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->name_ar }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category->title ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">عرض</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success">تعديل</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
