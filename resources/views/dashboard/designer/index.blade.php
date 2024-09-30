@extends('layouts.Dashboard.mainlayout')

@section('title', 'Designer Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
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

            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Experience</th>
            <th>Description</th>
            <th>Description arabic</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user as $designer)
            <tr>

                <td>{{ $designer->name }}</td>
                <td>{{ $designer->email }}</td>
                <td>{{ $designer->phone ?? 'N/A' }}</td>
                <td>{{ $designer->role }}</td>
                <td>{{ optional($designer->designer)->experience_years }} years</td> <!-- استخدام optional لتجنب أخطاء إذا كان $designer->designer null -->
                <td>{{ optional($designer->designer)->description ?? 'No description available' }}</td>
                <td>{{ optional($designer->designer)->description_ar ?? 'No description available' }}</td>
                <td>
                    <!-- زر التعديل -->
                    <a href="{{ route('designer.showEditForm', $designer->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('designer.show', $designer->id) }}" class="btn btn-primary">show</a>
                    <!-- زر الحذف -->
             <!--       <form action="{{ route('admin.designers.destroy', $designer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا المستخدم؟')">حذف</button>
                  -->
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
