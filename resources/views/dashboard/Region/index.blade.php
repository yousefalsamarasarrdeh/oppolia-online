@extends('layouts.Dashboard.mainlayout')

@section('title', 'Region Management')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <ul>
        @foreach ($regions as $region)
            <li>{{ $region->name_ar }} ({{ $region->name_en }})</li>
        @endforeach
    </ul>
@endsection
