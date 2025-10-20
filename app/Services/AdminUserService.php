<?php

namespace App\Services;

use App\Repositories\AdminUserRepository;
use App\Repositories\OTPRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserService
{
    protected $adminUserRepository;
    protected $otpRepository;
    public function __construct(AdminUserRepository $adminUserRepository, OTPRepository $otpRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
        $this->otpRepository = $otpRepository;
    }

    // Register
    public function register($data)
    {
        try {
            DB::beginTransaction();
            $user = $this->adminUserRepository->create($data);
            if ($user->email_verified_at) {
                $response = [
                    "is_verified" => 1,
                    "status" => "success",
                    "message" => "Login successfully",
                    "user" => $user
                ];
            } else {
                $otp = $this->otpRepository->send($user->email);
                $response = [
                    "is_verified" => 0,
                    "status" => "success",
                    "message" => "Please check your email for verification code",
                    "user" => $user
                ];
            }
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            return [
                "status" => "failed",
                "message" => $e->getMessage()
            ];
        }
    }

    // Login
    public function login($data)
    {
        $loginField = filter_var($data['email-username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember = $data['remember'] ?? false;
        $credentials = [
            $loginField => $data['email-username'],
            'password' => $data['password'],
        ];
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->email_verified_at) {
                return $response = [
                    "is_verified" => 1,
                    "status" => "success",
                    "message" => "Login successfully",
                    "user" => $user
                ];
            } else {
                $otp = $this->otpRepository->send($user->email);
                return $response = [
                    "is_verified" => 0,
                    "status" => "success",
                    "message" => "Please check your email for verification code",
                    "user" => $user
                ];
            }
            return $response;
        }
    }

    // Verify
    public function verify($token, $otp)
    {
        try {
            DB::beginTransaction();
            $this->otpRepository->verify($token, $otp);
            $this->adminUserRepository->update([
                'email_verified_at' => now()
            ], Auth::user()->id);
            DB::commit();
            return [
                "status" => "success",
                "message" => "Verification completed successfully"
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                "status" => "failed",
                "message" => $e->getMessage()
            ];
        }
    }

    // Update
    public function update($data, $id)
    {
        $response = $this->adminUserRepository->update($data, $id);
        return "Profile updated successfully";
    }

    // Change Password
    public function changePassword($data, $id)
    {
        if (!Hash::check($data['current_password'], Auth::user()->password)) {
            throw new Exception("Old password is incorrect");
        }
        $response = $this->adminUserRepository->update([
            'password' => Hash::make($data['new_password'])
        ], $id);
        return "Password changed successfully";
    }
}
