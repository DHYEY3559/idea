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
            'name' => ['required', 'string', 'max:255'],
            'profile_description' => ['nullable', 'string'],
            'DOB' => ['nullable', 'date'],
            'Gender' => ['nullable', 'string', 'max:255', 'in:Male,Female,Other'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if($validated['DOB'] && $validated['DOB'] > now()->toDateString()) {
            return redirect('/profile/edit')->with([
                'error' => 'The date of birth must be a date before today.',
            ]);
        }

        $profile->user->update([
            'name' => $validated['name'],
        ]);

        $profile->update([
            'DOB' => $validated['DOB'] ?? null,
            'profile_description' => $validated['profile_description'] ?? null,
            'Gender' => $validated['Gender'] ?? null,
        ]);

        if ($request->hasFile('profile_image')) {
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
        }

        return redirect('/profile/edit')->with('success', 'Profile updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
