<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Designer;
use App\Models\SubRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // استدعاء Auth
use Illuminate\Support\Facades\Log;  // استدعاء Log
use App\Models\Product;
use App\Models\ContactUs;
use function Livewire\Features\SupportFormObjects\all;


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
        $subRegions = SubRegion::all();
        return view('frontend.contact', compact( 'notifications','subRegions'));
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

    public function privacypolicy()
    {  $notifications = null;

        $designer=Designer::all();

        if (auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        return view('frontend.privacypolicy', compact( 'notifications','designer'));
    }

    public function storeContact(Request $request)
    {
        // تحقق من صحة البيانات
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'nullable|string|max:20',
            'sub_region_id'  => 'required|exists:sub_regions,id',
            'message'        => 'required|string',
        ]);

        // جلب sub region وتحديد المنطقة الرئيسية منها
        $subRegion = SubRegion::with('region')->findOrFail($validated['sub_region_id']);
        $regionId = $subRegion->region->id;

        // حفظ البيانات
        ContactUs::create([
            'name'          => $validated['full_name'],
            'email'         => $validated['email'],
            'phone'         => $validated['phone'],
            'region_id'     => $regionId,
            'sub_region_id' => $validated['sub_region_id'],
            'message'       => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح، شكرًا لتواصلك معنا!');
    }



}
