<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {


    }

    // Method to show the edit profile form
    public function edit()
    {
        $user = Auth::user(); // Example variable
        $profile = $user->profile; // Example variable

        return view('profile_edit', compact('user', 'profile'));
    }

//     Method to update the profile
//     Method to update the profile
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',

        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
