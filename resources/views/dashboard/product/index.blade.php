@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المنتجات')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container" dir="rtl">
        <h1>المنتجات</h1>
        <a href="{{ route('admin.products.create') }}" class="btn  button_Green" >إضافة منتج جديد</a>
        <div style="overflow-x: auto; width: 100%;">
        <table class="table table datatable" style="min-width: 800px;">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم المنتج</th>
                <th>اسم المنتج بالعربية</th>
                <th>SKU</th>
                <th>الفئة</th>
                <th>الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->name_ar }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category->title ?? 'غير متوفر' }}</td>
                    <td>
                        <div class="d-flex flex-row align-items-center justify-content-center">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info bg-transparent border-0">
                                <button type="submit" class="btn bg-transparent border-0">
                                    <img src="{{ asset('Dashboard/assets/images//view.png') }}">
                                </button>

                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success bg-transparent border-0">
                                <button type="submit" class="bg-transparent border-0 text-danger">
                                    <img src="{{ asset('Dashboard/assets/images/edit.png') }}">
                                </button>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger bg-transparent border-0" onclick="return confirm('هل أنت متأكد؟')">
                                    <img src="{{ asset('Dashboard/assets/images/delete.png') }}">
                                </button>

                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
