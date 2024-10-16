
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf
                    <label for="otp">Enter OTP:</label>
                    <input type="text" name="otp" id="otp" required>
                    <input type="hidden" name="phone" value="{{ session('phone') }}">
                    <button type="submit">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
