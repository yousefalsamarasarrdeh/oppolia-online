{{-- resources/views/auth/verify-otp.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
<h1>OTP Verification</h1>

<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="hidden" name="phone" value="{{ $phone }}">

    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" required>

    <button type="submit">Verify</button>
</form>
</body>
</html>
