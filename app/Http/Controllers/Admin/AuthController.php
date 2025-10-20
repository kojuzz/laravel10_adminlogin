<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserLoginRequest;
use App\Http\Requests\AdminUserRegisterRequest;
use App\Services\AdminUserService;
use Exception;
use Illuminate\Http\Request;
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
            $response = $this->adminUserService->register($user);
            Auth::login($response['user']);
            if ($response['status'] == 'success') {
                if ($response['is_verified'] == 1) {
                    return redirect()->route("admin.dashboard")->with('success', $response['message']);
                } else {
                    return redirect()->route("two-step", [$response['otp_token']])->with('success', $response['message']);
                }
            } else {
                return back()->with("failed", $response['message'])->withInput();
            }
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
            $response = $this->adminUserService->login($user);
            if ($response['status'] == 'success') {
                if ($response['is_verified'] == 1) {
                    return redirect()->route("admin.dashboard")->with('success', $response['message']);
                } else {
                    return redirect()->route("two-step", [$response['otp_token']])->with('success', $response['message']);
                }
            } else {
                return back()->with("failed", $response['message'])->withInput();
            }
        } catch (Exception $e) {
            return back()->with("failed", $e->getMessage())->withInput();
        }
        return redirect()->route("login");
    }

    // Two Step
    public function twoStep(Request $request)
    {
        $validated = $request->validate([
            'otp_token' => 'required|string',
            'otp' => 'required|string'
        ]);
        $response = $this->adminUserService->verify($validated['otp_token'], $validated['otp']);
        if ($response['status'] == 'failed') {
            // return redirect()->route("two-step", [$validated['otp_token']])->with("failed", $response['message']);
            return redirect()->route("two-step", ['otpToken' => $validated['otp_token']])->with("failed", $response['message']);
        } 
        return redirect()->route("admin.dashboard")->with('success', $response['message']);
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
