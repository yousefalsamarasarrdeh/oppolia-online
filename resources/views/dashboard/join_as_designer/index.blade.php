@extends('layouts.Dashboard.mainlayout')

@section('title', 'Region Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">

    <!-- إضافة CSS مخصص لتغيير لون الصف أو العمود -->
    <style>
        .status-unread {
            background-color: #d0e7ff; /* لون أزرق فاتح */
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <h1>Join as Designer Requests</h1>

        <table class=" datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($designerRequests as $request)
                <tr class="{{ $request->status === 'unread' ? 'status-unread' : '' }}">
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email_address }}</td>
                    <td>{{ $request->phone_number }}</td>
                    <td>{{ $request->city_town }}</td>
                   
                    <td>
                        <a href="{{ route('admin.joinasdesigner.show', $request->id) }}" class="btn btn-primary">View</a>

                        <form action="{{ route('admin.joinasdesigner.delete', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
