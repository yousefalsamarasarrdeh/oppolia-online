@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                    <!-- تحقق من دور المستخدم واضف الزر المناسب -->
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.designers.index') }}" class="btn btn-primary mt-3">
                                {{ __('Go to Admin Dashboard') }}
                            </a>
                        @elseif (Auth::user()->role == 'designer')
                            <a href="{{ route('designer.notification') }}" class="btn btn-secondary mt-3">
                                {{ __('Go to Designer Dashboard') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
