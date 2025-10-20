<?php

namespace App\Http\Controllers;

use App\Services\AdminUserService;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    protected $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Forgot Password Post
    public function forgotPasswordPost(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);
        $response = $this->adminUserService->forgotPassword($validated['email']);
        if ($response['status'] == 'failed') {
            return redirect()->route("forgot-password")->with("failed", $response['message']);
        }
        return redirect()->route("login")->with("success", $response['message']);
    }

    // Reset Password
    public function resetPassword($token, Request $request)
    {
        $email = $request->query('email');
        if (!$email) {
            return redirect()->route('login')->with('failed', 'Invalid password reset link.');
        }
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email
        ]);
    }

    // Reset Password Post
    public function resetPasswordPost(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password'
        ]);
        $response = $this->adminUserService->resetPassword(
            $validated['token'],
            $validated['email'],
            $validated['password']
        );
        if ($response['status'] == 'failed') {
            return redirect()->route("reset-password", ['token' => $request->token, 'email' => $request->email])->with("failed", $response['message']);
        }
        return redirect()->route("login")->with("success", $response['message']);
    }
}
