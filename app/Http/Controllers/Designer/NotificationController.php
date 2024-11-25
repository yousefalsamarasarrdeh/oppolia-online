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
                return response()->json(['message' => 'Notification not found'], 404);
            }

            $notification->delete();
            return response()->json(['message' => 'Notification deleted successfully'], 200);
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
