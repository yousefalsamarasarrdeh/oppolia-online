@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', 'تعديل الملف الشخصي')
@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
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
                    <h1 class="my-orders-title-border-b mb-4">تعديل المعلومات الشخصية</h1>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <h3 for="name" class="form-label">الاسم</h3>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <h3 for="email" class="form-label">البريد الإلكتروني</h3>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <h3 for="phone" class="form-label">رقم الهاتف</h3>
                                <div class="input-group">
                                    <span class="input-group-text">🇸🇦 +966</span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="phone_display"

                                        value="{{ old('phone', ltrim($user->phone, '+966')) }}"
                                        required
                                        title="يجب أن يبدأ الرقم بـ 5 ويتكوّن من 9 أرقام"
                                    >
                                </div>
                            </div>
                            <input type="hidden" name="phone" id="phone_hidden">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn button_Dark_Green">تحديث</button>
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
