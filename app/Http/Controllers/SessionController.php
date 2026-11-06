<?php

namespace App\Http\Controllers;

use App\resources\view;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
}
