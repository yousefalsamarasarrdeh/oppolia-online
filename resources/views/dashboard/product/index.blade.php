@extends('layouts.Dashboard.mainlayout')

@section('title', 'Product Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1>products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
        <table class="table table-bordered datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>product name</th>
                <th>product name in arabic</th>
                <th>SKU</th>
                <th>category</th>
                <th>action</th>
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
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">show</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success">edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
