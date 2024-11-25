<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $notifications= auth()->user()->unreadNotifications;
        $notifications1 = $user->notifications;




        return view('dashboard.home.notification', compact('notifications1', 'notifications'));
    }
}
