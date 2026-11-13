<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->firstOrFail();

        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $profile = Profile::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'profile_image' => ['required', 'image', 'max:2048'],
        ]);

        $profileImagePath = $request->file('profile_image')->storePublicly('profile-images', 'public');

        if ($profileImagePath === false) {
            abort(500, 'The profile image could not be stored.');
        }

        if ($profile->profile_image !== null) {
            Storage::disk('public')->delete($profile->profile_image);
        }

        $profile->update([
            'profile_image' => $profileImagePath,
        ]);

        $name = $request->input('name');
        if ($name) {
            $profile->update(['name' => $name]);
        }
        else {
            return back()->withErrors(['name' => 'The name field is required.']);
        }

        $Gender = $request->input('Gender');
        if ($Gender) {
            $profile->update(['Gender' => $Gender]);
        }
        else {
            return back()->withErrors(['Gender' => 'The Gender field is required.']);
        }

        $DOB = $request->input('DOB');
        if ($DOB) {
            $profile->update(['DOB' => $DOB]);
        }
        else {
            return back()->withErrors(['DOB' => 'The DOB field is required.']);
        }

        return redirect('/profile/edit')->with('success', 'Profile picture updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
