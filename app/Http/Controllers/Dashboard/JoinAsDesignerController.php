<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JoinAsADesigner;
use Illuminate\Support\Facades\Storage;
class JoinAsDesignerController extends Controller
{
    public function index()
    {
        // جلب جميع الطلبات من قاعدة البيانات
        $designerRequests = JoinAsADesigner::all();
        $notifications= auth()->user()->unreadNotifications;
        // عرض الطلبات في الصفحة
        return view('dashboard.join_as_designer.index', compact('designerRequests','notifications'));
    }

    public function show($id)
    {
        // جلب طلب الانضمام بناءً على ID
        $designerRequest = JoinAsADesigner::findOrFail($id);

        // التحقق من حالة الطلب إذا كانت unread وتحديثها إلى read
        if ($designerRequest->status === 'unread') {
            $designerRequest->status = 'read';
            $designerRequest->save(); // حفظ التغييرات في قاعدة البيانات
        }
        $notifications= auth()->user()->unreadNotifications;

        // عرض الطلب في الصفحة
        return view('dashboard.join_as_designer.show', compact('designerRequest','notifications'));
    }

    public function  destroy($id) {

        $designer = JoinAsADesigner::findOrFail($id);

        // حذف ملف الـ PDF المرتبط إذا كان موجودًا
        if (Storage::disk('public')->exists($designer->cv_pdf_path)) {
            Storage::disk('public')->delete($designer->cv_pdf_path);
        }

        // حذف السجل من قاعدة البيانات
        $designer->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'Record has been deleted successfully.');

    }
}
