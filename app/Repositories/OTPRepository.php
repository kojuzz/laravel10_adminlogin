<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\OTP;
use App\Notifications\TwoStepVerification;
use Exception;
use Illuminate\Support\Facades\Notification;

class OTPRepository
{
    private function otpCode()
    {
        if (config('app.env') == 'production') {
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } else {
            $code = '123123';
        }
        return $code;
    }

    public function send($email)
    {
        $otp = OTP::where('email', $email)->where('expired_at', '>=', now())->first();
        if (!$otp) {
            $otp = OTP::create([
                'email' => $email,
                'code' => $this->otpCode(),
                'expired_at' => now()->addMinutes(10),
                'token' => encrypt(['uuid' => Str::uuid(), 'email' => $email])
            ]);
            if (config('app.env') == 'production') {
                Notification::route('mail', $email)->notify(new TwoStepVerification($otp));
            }
        }
        return $otp;
    }

    public function verify($otp_token, $code)
    {
        $otp = OTP::where('token', $otp_token)->first();
        if (!$otp) {
            throw new Exception('Invalid OTP token');
        }
        if ($otp->expired_at < now()) {
            $otp->delete();
            throw new Exception('OTP has expired');
        }
        if ($otp->code != $code) {
            throw new Exception('The OTP code is incorrect');
        }
        $otp->delete();
        return $otp;
    }

    public function resend($otp_token)
    {
        $otp = OTP::where('token', $otp_token)->first();
        if (!$otp) {
            throw new Exception('Invalid OTP');
        }
        if ($otp->expired_at > now()) {
            throw new Exception('Wait for OTP to expire. The OTP will expire in ' . now()->diff($otp->expired_at)->format('%i minutes and %s seconds'));
        }
        $otp->delete();
        $otp = $this->send($otp->email);
        return $otp;
    }
}
