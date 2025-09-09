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
        $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => 'a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f',
            'username' =>'Muneef',
            'message' => $message,
            'sender' => 'OPPOLIA',
            'numbers' => $request->phone
        ]);


        if ($response->failed()) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP.'], 500);
        }

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
            switch ($user->role) {
                case 'user':
                    return redirect()->route('orders.create');
                case 'admin':
                case 'Sales manager':
                case 'Area manager':
                    return redirect()->route('admin.designers.index');
                case 'designer':
                    return redirect()->route('designer.notification');
                default:
                    // في حال دور غير معروف، توجهه لمكان مناسب أو صفحة خطأ مثلاً
                    return redirect()->route('dashboard'); // عدّلها حسب الحاجة
            }
        } else {
            // OTP غير صحيح
            return back()->withErrors(['otp' => __('messages.otp_invalid')])
                ->withInput(['phone' => $request->phone]);;
        }
    }

}
