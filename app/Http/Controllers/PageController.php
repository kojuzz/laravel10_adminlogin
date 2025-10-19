<?php

namespace App\Http\Controllers;

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
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function twoStep()
    {
        return view('auth.two-step');
    }
}
