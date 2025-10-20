<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\OTP;

class CheckVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user) {
            Auth::logout();
            return redirect()->route('login')->with('failed', 'Please log in first.');
        }
        if (!$user->email_verified_at) {
            $otp = OTP::where('email', $user->email)->where('expired_at', '>=', now())->first();
            if (!$otp) {
                Auth::logout();
                return redirect()->route('login')->with('failed', 'Verification expired. Please log in again.');
            }
            return redirect()->route('two-step', ['otpToken' => $otp->token])->with('warning', 'Please verify your email first.');
        }
        return $next($request);
    }
}
