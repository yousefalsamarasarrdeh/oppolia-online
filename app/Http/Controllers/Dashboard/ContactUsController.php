<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{

    public function index()
    {
        if (auth()->user()->role === 'Area manager') {
            // جلب المنطقة الخاصة بالـ Area Manager
            $regionId = auth()->user()->region_id;

            // عرض رسائل التواصل ضمن منطقته فقط
            $contacts = ContactUs::where('region_id', $regionId)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // إذا كان المدير أو مسؤول، يعرض كل الرسائل
            $contacts = ContactUs::orderBy('created_at', 'desc')->get();
        }

        $notifications = auth()->user()->unreadNotifications;

        return view('dashboard.contact.index', compact('contacts', 'notifications'));
    }
    public function show($id)
    {
        $contact = ContactUs::with('subRegion')->findOrFail($id);

        $user = auth()->user();

        // السماح فقط للـ Area manager إذا كان من نفس المنطقة
        if ($user->role === 'Area manager' && $user->region_id !== $contact->region_id) {
            abort(403, 'غير مسموح لك بالوصول إلى هذه الرسالة.');
        }

        // (اختياري) تحديث حالة الرسالة لو فيها status
        if (isset($contact->status) && $contact->status === 'unread') {
            $contact->status = 'read';
            $contact->save();
        }

        $notifications = auth()->user()->unreadNotifications;

        return view('dashboard.contact.show', compact('contact', 'notifications'));
    }
    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);

        $user = auth()->user();
        if ($user->role === 'Area manager' && $user->region_id !== $contact->region_id) {
            abort(403, 'غير مسموح لك بالحذف.');
        }

        $contact->delete();

        return redirect()->route('dashboard.contact_us.index')->with('success', 'تم حذف الرسالة بنجاح.');
    }

}
