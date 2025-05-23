<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {

        $regions = Region::all();
        $notifications= auth()->user()->unreadNotifications;


        return view('dashboard.Region.index', compact('regions','notifications'));
    }
}
