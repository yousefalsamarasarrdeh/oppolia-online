<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            // إنشاء رمز OTP عشوائي
            //$otp = Str::random(6);
            $otp = rand(100000, 999999);
            // إنشاء مستخدم جديد
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            // إرسال رسالة SMS تحتوي على رمز OTP
            $this->sendOtp($data['phone'], $otp);

            // توجيه المستخدم إلى صفحة التحقق من OTP بدون تسجيل دخول
            return $user;

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Send OTP to user via SMS.
     *
     * @param string $phone
     * @param string $otp
     * @return string
     */
    protected function sendOtp($phone, $otp)
    {
        $message = "Your OTP code is: $otp";

        // إرسال طلب الـ SMS عبر API
        $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => env('SMS_API_KEY'),
            'username' => env('SMS_USERNAME'),
            'message' => $message,
            'sender' => env('SMS_SENDER'),
            'numbers' => $phone
        ]);

        return $response->body();
    }

    /**
     * Show OTP verification page.
     *
     * @param string $phone
     * @return \Illuminate\View\View
     */
    public function showOtpVerifyPage($phone)
    {
        // عرض صفحة التحقق من OTP مع تمرير رقم الهاتف للمستخدم
        return view('auth.verify-otp', ['phone' => $phone]);
    }

    /**
     * Verify the entered OTP.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOtp(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
            'phone' => ['required', 'string'],
        ]);

        // البحث عن المستخدم بواسطة رقم الهاتف ورمز OTP
        $user = User::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>=', now())
            ->first();

        // التحقق من صحة المستخدم ورمز OTP
        if (!$user) {
            return redirect()->back()->withErrors(['otp' => 'رمز OTP غير صحيح أو انتهت صلاحيته']);
        }

        // تسجيل الدخول للمستخدم
        Auth::login($user);

        // إزالة رمز OTP بعد الاستخدام
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // توجيه المستخدم إلى الصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح');
    }
}
