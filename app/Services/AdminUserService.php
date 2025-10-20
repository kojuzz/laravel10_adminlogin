<?php

namespace App\Services;

use App\Models\User;
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
                    "message" => "Registration successfully",
                    "access_token" => $user->createToken('token')->plainTextToken,
                    "user" => $user
                ];
            } else {
                $otp = $this->otpRepository->send($user->email);
                $response = [
                    "is_verified" => 0,
                    "status" => "success",
                    "message" => "Registration successfully, Please check your email for verification code",
                    "otp_token" => $otp->token,
                    "user" => $user
                ];
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = [
                "status" => "failed",
                "message" => $e->getMessage()
            ];
        }
        return $response;
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
        try {
            if (Auth::guard('web')->attempt($credentials, $remember)) {
                $user = Auth::guard('web')->user();

                if ($user->email_verified_at) {
                    $response = [
                        "is_verified" => 1,
                        "status" => "success",
                        "message" => "Login successfully",
                        "access_token" => $user->createToken('token')->plainTextToken,
                        "user" => $user
                    ];
                } else {
                    $otp = $this->otpRepository->send($user->email);
                    $response = [
                        "is_verified" => 0,
                        "status" => "success",
                        "message" => "Please check your email for verification code",
                        "otp_token" => $otp->token,
                        "user" => $user
                    ];
                }
            } else {
                $response = [
                    "status" => "failed",
                    "message" => "Invalid email or password"
                ];
            }
        } catch (Exception $e) {
            $response = [
                "status" => "failed",
                "message" => "Something went wrong. Please try again."
            ];
        }
        return $response;
    }

    // Verify
    public function verify($token, $otp)
    {
        try {
            DB::beginTransaction();
            $decrypted_otp_token = decrypt($token);
            $user = $this->adminUserRepository->getByEmail($decrypted_otp_token['email']);
            if (!$user) {
                throw new Exception('The User is not found');
            }
            $this->otpRepository->verify($token, $otp);
            $this->adminUserRepository->update([
                'email_verified_at' => now()
            ], $user->id);
            DB::commit();
            $response = [
                "is_verified" => 1,
                "status" => "success",
                "message" => "Verification completed successfully",
                "access_token" => $user->createToken('token')->plainTextToken,
                "user" => $user
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $response = [
                "status" => "failed",
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }

    // Resend OTP
    public function resendOTP($token)
    {
        try {
            $otp = $this->otpRepository->resend($token);
            $response = [
                "is_verified" => 0,
                "status" => "success",
                "message" => "OTP sent successfully",
                "otp" => $otp
            ];
        } catch (Exception $e) {
            $response = [
                "status" => "failed",
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }

    // Forgot Password
    public function forgotPassword($email)
    {
        try {
            $mail = $this->adminUserRepository->sendMail($email);
            return [
                "status" => "success",
                "message" => "Email sent successfully"
            ];
        } catch (Exception $e) {
            return [
                "status" => "failed",
                "message" => $e->getMessage()
            ];
        }
    }

    // Reset Password
    public function resetPassword($token, $email, $password)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return [
                "status" => "failed",
                "message" => "User not found"
            ];
        }
        try {
            $user = $this->adminUserRepository->update([
                'password' => Hash::make($password)
            ], $user->id);
            return [
                "status" => "success",
                "message" => "Password reset successfully"
            ];
        } catch (Exception $e) {
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
