<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JoinAsADesigner;

class JoinAsDesignerController extends Controller
{
    // عرض استمارة الانضمام
    public function create()
    {
        return view('frontend.joinasdesigner');
    }

    // تخزين البيانات في قاعدة البيانات
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'city_town' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email_address' => 'required|email|unique:join_as_a_designer,email_address',
            'phone_number' => 'required|string|unique:join_as_a_designer,phone_number',
            'age' => 'required|integer|min:18',
            'nationality' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'marital_status' => 'required|string|in:single,married,other',
            'current_country' => 'required|string|max:255',
            'current_city' => 'required|string|max:255',
            'preferred_city' => 'required|string|max:255',
            'major_in_education' => 'required|string|max:255',
            'years_of_experience' => 'required|integer|min:0',
            'experience_in_sales' => 'required|boolean',
            'current_occupation' => 'required|boolean',
            'willing_to_work_as_freelancer' => 'required|boolean',
            'own_car' => 'required|boolean',
            'experience_in_kitchen_furniture_business' => 'required|boolean',
            'kitchen_furniture_experience_description' => 'nullable|string',
            'cv_pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        // حفظ الـ PDF في مجلد التخزين
        $cvPath = $request->file('cv_pdf')->store('cvs', 'public');

        // إنشاء سجل جديد في قاعدة البيانات
        JoinAsADesigner::create([
            'name' => $request->name,
            'city_town' => $request->city_town,
            'country' => $request->country,
            'email_address' => $request->email_address,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'current_country' => $request->current_country,
            'current_city' => $request->current_city,
            'preferred_city' => $request->preferred_city,
            'major_in_education' => $request->major_in_education,
            'years_of_experience' => $request->years_of_experience,
            'experience_in_sales' => $request->experience_in_sales,
            'current_occupation' => $request->current_occupation,
            'willing_to_work_as_freelancer' => $request->willing_to_work_as_freelancer,
            'own_car' => $request->own_car,
            'experience_in_kitchen_furniture_business' => $request->experience_in_kitchen_furniture_business,
            'kitchen_furniture_experience_description' => $request->kitchen_furniture_experience_description,
            'cv_pdf_path' => $cvPath,
            'status' => 'unread', // تحديد الحالة الافتراضية كـ 'unread'
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'Your information has been submitted successfully.');
    }

}
