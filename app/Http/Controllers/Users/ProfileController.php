<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function edit()
    {
        $notifications = null;
        $user = Auth::user();
        if (auth()->check()) {
            $notifications = auth()->user()->notifications;
        }
        return view('User.edit_profile', compact('user','notifications'));
    }
    public function update(Request $request)
    {
        $notifications = null;
        $user = Auth::user();
        if (auth()->check()) {
            $notifications = auth()->user()->notifications;
        }

        $validated = $request->validate([
            'name'  => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|unique:users,phone,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
