@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', __('edit_profile.title'))
@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ __('edit_profile.success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                <strong>{{ __('edit_profile.errors_header') }}</strong>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card my-5 p-4 shadow-sm">
                    <h1 class="my-orders-title-border-b mb-4">{{ __('edit_profile.update_personal_info') }}</h1>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <h3 class="form-label">{{ __('edit_profile.name') }}</h3>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <h3 class="form-label">{{ __('edit_profile.email') }}</h3>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <h3 class="form-label">{{ __('edit_profile.phone') }}</h3>
                                <div class="input-group">
                                    <span class="input-group-text">{{ __('edit_profile.phone_prefix') }}</span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="phone_display"
                                        value="{{ old('phone', ltrim($user->phone, '+966')) }}"
                                        required
                                        title="{{ __('edit_profile.phone_title') }}"
                                    >
                                </div>
                            </div>
                            <input type="hidden" name="phone" id="phone_hidden">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn button_Dark_Green">{{ __('edit_profile.update_button') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const displayInput = document.getElementById("phone_display");
            const hiddenInput = document.getElementById("phone_hidden");

            const form = displayInput.closest("form");

            form.addEventListener("submit", function () {
                const phoneNumber = displayInput.value.trim();
                hiddenInput.value = '+966' + phoneNumber;
            });
        });
    </script>
@endsection
