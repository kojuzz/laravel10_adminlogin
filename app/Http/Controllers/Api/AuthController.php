<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserLoginRequest;
use App\Http\Requests\AdminUserRegisterRequest;
use App\Services\AdminUserService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function login(AdminUserLoginRequest $request)
    {
        $data = $request->validated();
        try {
            $response = $this->adminUserService->login($data);
            if ($response['status'] == 'success') {
                if ($response['is_verified'] == 1) {
                    return response()->json($response);
                } else {
                    return response()->json($response);
                }
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => $response['message']
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function register(AdminUserRegisterRequest $request)
    {
        $data = $request->validated();        
        try {
            $response = $this->adminUserService->register($data);
            if ($response['status'] == 'success') {
                return response()->json([
                    "status" => "success",
                    "message" => $response['message'],
                    "otp_token" => $response['otp_token'],
                    "user" => $response['user']
                ]);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => $response['message']
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function twoStepPost(Request $request)
    {
        $validated = $request->validate([
            'otp_token' => 'required|string',
            'otp' => 'required|string'
        ]);
        $response = $this->adminUserService->verify($validated['otp_token'], $validated['otp']);
        if ($response['status'] == 'failed') {
            return response()->json([
                "status" => "failed",
                "message" => $response['message']
            ]);
        }
        return response()->json($response);
    }

    public function resendOTP(Request $request)
    {
        $validated = $request->validate([
            'otp_token' => 'required|string'
        ]);
        $response = $this->adminUserService->resendOTP($validated['otp_token']);
        if ($response['status'] == 'failed') {
            return response()->json([
                "status" => "failed",
                "message" => $response['message']
            ]);
        }
        return response()->json($response);
    }

    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);
        $response = $this->adminUserService->forgotPassword($validated['email']);
        if ($response['status'] == 'failed') {
            return response()->json([
                "status" => "failed",
                "message" => $response['message']
            ]);
        }
        return response()->json($response);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                "status" => "success",
                "message" => "Logout successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => $e->getMessage()
            ]);
        }
    }
}
