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
            return redirect()->route("admin.dashboard");
        } catch (Exception $e) {
            return back()->with([
                "failed" => $e->getMessage()
            ])->withInput();
        }
    }

    // Login
    public function login(AdminUserLoginRequest $request)
    {
        $user = $request->validated();
        try {
            if ($this->adminUserService->login($user)) {
                return redirect()->route("admin.dashboard")->with('success', 'Login successfully');
            } else {
                return back()->with([
                    "failed" => "The credentials do not match our records."
                ])->withInput();
            }
        } catch (Exception $e) {
            return back()->with([
                "failed" => $e->getMessage()
            ])->withInput();
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
