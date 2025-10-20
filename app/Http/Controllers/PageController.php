<?php

namespace App\Http\Controllers;

use App\Models\OTP;

class PageController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
}
