<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        session()->regenerate();

        return redirect('/');
    }

    public function destroy()
    {
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }
}
