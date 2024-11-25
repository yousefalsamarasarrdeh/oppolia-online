<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Log;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  /*  public function index()
    {
        // جلب الإشعارات للمستخدم الحالي
        $notifications1 = auth()->user()->notifications;
        $notifications= auth()->user()->unreadNotifications;

        return view('dashboard.notifications.index', compact('notifications','notifications1'));
    }
  */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all'); // Default to 'all' if no filter is provided

        $user = Auth::user(); // Get the authenticated user
        $notifications= auth()->user()->unreadNotifications;

        // Start building the query
        $query = $user->notifications();

        // Apply the filter
        if ($filter == 'read') {
            $notifications1 = $query->whereNotNull('read_at')->get();
        } elseif ($filter == 'unread') {
            $notifications1 = $query->whereNull('read_at')->get();
        } else {
            $notifications1 = $query->get();
        }

        return view('dashboard.notifications.index', compact('notifications1','notifications'));
    }


    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->delete(); // حذف الإشعار
            return response()->json(['message' => 'Notification deleted successfully'], 200);
        }

        return response()->json(['message' => 'Notification not found'], 404);
    }

    public function deleteAllReadNotifications(Request $request)
    {
        // جلب المستخدم الحالي
        $user = auth()->user();

        // حذف جميع الإشعارات المقروءة
        $user->notifications()->whereNotNull('read_at')->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف جميع الإشعارات المقروءة بنجاح.');
    }
}
