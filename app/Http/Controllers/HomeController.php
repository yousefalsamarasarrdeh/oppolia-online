<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function index1()
    {
        return view('index');
    }

    public function testotp() {

        $number = '+966504686964';
        $message = 'TEST APP';

        $response = Http::asForm()->post('https://mora-sa.com/api/v1/sendsms', [
            'api_key' => env('SMS_API_KEY'),
            'username' => env('SMS_USERNAME'),
            'message' => $message,
            'sender' => env('SMS_SENDER'),
            'numbers' => $number
        ]);
         dd($response->body());
        return view('welcome', ['response' => $response->body()]);

    }

}
