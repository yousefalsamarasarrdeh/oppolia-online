<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    // دالة عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login'); // عرض صفحة تسجيل الدخول من الملف Blade auth/login.blade.php
    }

    // تحديد أن الدخول يتم عبر الهاتف بدلاً من البريد الإلكتروني
    public function username()
    {
        return 'phone';
    }

    // دالة تسجيل الدخول المعدلة للتحقق من OTP
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($this->credentials($request))) {
            $user = Auth::user();

            if (is_null($user->otp) || $user->otp_expires_at < now()) {
                $otp = rand(100000, 999999);
                $user->otp = $otp;
                $user->otp_expires_at = now()->addMinutes(5);
                $user->save();

                // إرسال الرمز عبر الـ SMS
                $this->sendOtp($user->phone, $otp);

                // تسجيل خروج المستخدم مؤقتاً وإعادة توجيهه لصفحة إدخال OTP
                Auth::logout();

                // التعديل هنا لاستخدام الاسم الجديد للمسار
                return redirect()->route('otp.verify.log-page')->with('phone', $user->phone);
            }

            return redirect($this->redirectTo);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendOtp($phone, $otp)
    {
        $message = "Your OTP code is: $otp";

        $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => env('SMS_API_KEY'),
            'username' => env('SMS_USERNAME'),
            'message' => $message,
            'sender' => env('SMS_SENDER'),
            'numbers' => $phone
        ]);

        if ($response->successful()) {
            return $response->body();
        } else {
            return 'Failed to send OTP';
        }
    }

    public function showVerifyForm(Request $request)
    {
        $phone = $request->session()->get('phone');
        return view('auth.verify-otp', ['phone' => $phone]);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp' => 'required'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'رقم الهاتف غير موجود']);
        }

        if ($user->otp !== $request->otp || $user->otp_expires_at < now()) {
            return back()->withErrors(['otp' => 'الرمز غير صحيح أو انتهت صلاحيته.']);
        }

        Auth::login($user);

        return redirect('/home');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('phone', 'password');
    }

    protected $redirectTo = '/home';

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()->withErrors([
            'phone' => trans('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        // تسجيل الخروج
        Auth::logout();

        // إبطال الجلسة
        $request->session()->invalidate();

        // توليد توكن جديد لمنع أي استخدامات غير قانونية للجلسة القديمة
        $request->session()->regenerateToken();

        // إعادة التوجيه لصفحة تسجيل الدخول أو أي صفحة أخرى تريدها
        return redirect('/'); // يمكنك تغييرها لأي مسار مناسب
    }



}
