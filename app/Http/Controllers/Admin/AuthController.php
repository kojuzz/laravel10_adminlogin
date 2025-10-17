<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserLoginRequest;
use App\Http\Requests\AdminUserRegisterRequest;
use App\Services\AdminUserService;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    // Register
    public function register(AdminUserRegisterRequest $request)
    {
        $user = $request->validated();
        try {
            $user = $this->adminUserService->register($user);
            Auth::login($user);
            return redirect()->route("welcome");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route("login");
    }

    // Login
    public function login(AdminUserLoginRequest $request)
    {
        $user = $request->validated();
        try {
            $this->adminUserService->login($user);
            return redirect()->route("welcome");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route("login");
    }

    // Forgot Password
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route("login");
    }
}
