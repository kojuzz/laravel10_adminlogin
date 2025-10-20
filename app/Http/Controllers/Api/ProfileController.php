<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return response()->json([
            "status" => "success",
            "message" => "Profile retrieved successfully",
            "user" => Auth::user()
        ]);
    }
}
