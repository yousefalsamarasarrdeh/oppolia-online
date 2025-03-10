<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // استدعاء Auth
use Illuminate\Support\Facades\Log;  // استدعاء Log

class HomeController extends Controller
{
    public function index()
    {  $notifications = null;

       $designer=Designer::all();

        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.homepage', compact( 'notifications','designer'));
    }
    public function about()
    {  $notifications = null;

        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.about', compact( 'notifications'));
    }

    public function contact()
    {  $notifications = null;

        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.contact', compact( 'notifications'));
    }


}
