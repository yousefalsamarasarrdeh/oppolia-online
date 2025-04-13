@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة رسائل اتصل بنا')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">

    <style>
        .status-unread {
            background-color: #d0e7ff; /* لون أزرق فاتح */
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5" dir="rtl">
        <h1>رسائل اتصل بنا</h1>
        <div style="overflow-x: auto; width: 100%;">

        <table class="table datatable">
            <thead>
            <tr>
                <th>رقم التعريف</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>المدينة</th>
                <th>الرسالة</th>
                <th>الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->subRegion->name_ar ?? '-' }}</td>
                    <td>{{ Str::limit($contact->message, 40) }}</td>
                    <td>
                        <a href="{{ route('dashboard.contact_us.show', $contact->id) }}" >
                            <button type="submit" class="border-0 bg-transparent text-danger">
                                <img src="{{ asset('Dashboard/assets/images/view.png') }}">
                            </button>
                        </a>



                        <form action="{{ route('dashboard.contact_us.delete', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-transparent border-0">
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
