@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form action="{{ route('otp.send') }}" method="POST">
                @csrf
                <label for="phone">Enter your phone number:</label>
                <input type="text" name="phone" id="phone" required>
                <button type="submit">Send OTP</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
