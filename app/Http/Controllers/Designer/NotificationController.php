<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function destroy($id)
    {
        try {
            $notification = auth()->user();
            $notification=  $notification->Designer;
            $notification =$notification->notifications()->find($id);
            if (!$notification) {
                return response()->json(['message' => 'لم يتم العثور على الإخطار'], 404);
            }

            $notification->delete();
            return response()->json(['message' => 'تم حذف الإشعار بنجاح'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteAllReadNotifications(){
        $user = auth()->user();
        $user=$user->Designer;
        // حذف جميع الإشعارات المقروءة
        $user->notifications()->whereNotNull('read_at')->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف جميع الإشعارات المقروءة بنجاح.');
    }
}
