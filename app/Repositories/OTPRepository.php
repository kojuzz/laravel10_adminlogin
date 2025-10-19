<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\OTP;
use App\Notifications\TwoStepVerification;
use Illuminate\Support\Facades\Notification;

class OTPRepository
{
    public function send($email)
    {
        $otp = OTP::where('email', $email)->where('expired_at', '>=', now())->first();
        if(!$otp) {
            $otp = OTP::create([
                'email' => $email,
                'code' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                'expired_at' => now()->addMinutes(10),
                'token' => encrypt(['uuid' => Str::uuid(), 'email' => $email])
            ]);
            Notification::route('mail', $email)->notify(new TwoStepVerification($otp));
        }
        return $otp;
    }
}
