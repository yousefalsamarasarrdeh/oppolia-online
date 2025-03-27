<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OtpLoginController extends Controller
{
    // عرض واجهة إدخال رقم الجوال
    public function showPhoneForm()
    {
        return view('auth.phone-login');
    }

    // التحقق من رقم الجوال وإرسال OTP
    public function sendOtp(Request $request)
    {
        // تحقق من صحة البيانات المدخلة
        $request->validate([
            'phone' => 'required|numeric',
        ]);

        // تحقق مما إذا كان المستخدم موجودًا مسبقًا بناءً على رقم الجوال
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            // إذا كان المستخدم غير موجود، قم بإنشاء مستخدم جديد
            $user = User::create([
                'phone' => $request->phone,
                'password' => Hash::make('default_password'), // يمكنك تعيين كلمة مرور افتراضية
            ]);
        }

        // إنشاء رمز OTP وإرساله إلى الجوال
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(15); // صلاحية الرمز لمدة 15 دقيقة
        $user->save();

        // إعداد رسالة الـ OTP
        $message = "Your OTP code is: $otp";

        // إرسال طلب الـ SMS عبر API
      /*  $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => '47e99c42bbe91c1a52048c3582d926436fb31594',
            'username' =>'Muneef',
            'message' => $message,
            'sender' => 'OPPOLIA',
            'numbers' => $request->phone
        ]);


        if ($response->failed()) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP.'], 500);
        }*/

        return response()->json(['success' => true, 'message' => 'OTP sent successfully.']);
    }


    // عرض واجهة إدخال OTP
    public function showOtpForm()
    {
        return view('auth.otp-verify');
    }

    // التحقق من OTP
    public function verifyOtp(Request $request)
    {
        // تحقق من صحة البيانات المدخلة
        $request->validate([
            'otp' => 'required|numeric',
            'phone' => 'required|numeric',
        ]);

        // العثور على المستخدم بناءً على رقم الجوال
        $user = User::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>=', now()) // تحقق من صلاحية الرمز
            ->first();

        if ($user) {
            // OTP صحيح، قم بتسجيل الدخول
            Auth::login($user);

            // تحقق من دور المستخدم وقم بإعادة التوجيه بناءً على ذلك
            if ($user->role == 'user') {
                // إذا كان المستخدم "user"، قم بإعادة توجيهه إلى صفحة إنشاء الطلبات
                return redirect()->route('orders.create');
            } else {
                // إذا كان دوره مختلفًا، قم بإعادة توجيهه إلى الصفحة الرئيسية
                return redirect()->route('home');
            }
        } else {
            // OTP غير صحيح
            return back()->withErrors(['otp' => 'OTP is invalid or has expired.']);
        }
    }

}
