<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // استدعاء Auth
use Illuminate\Support\Facades\Log;  // استدعاء Log
use App\Models\Product;


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



    public function Product()
    {  $notifications = null;

        $products = Product::all();


        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.products', compact( 'notifications','products'));
    }

    public function ProductID($id)
    {
        $notifications = null;

        $product = Product::find($id);


        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.singleProduct', compact( 'notifications','product'));
    }

    public function show_designers()
    {

        $notifications = null;
        $designer=Designer::all();

        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.designers', compact( 'notifications','designer'));
    }



}
