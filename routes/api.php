<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("login", [AuthController::class, "login"]);
Route::post("register", [AuthController::class, "register"]);
Route::post('two-step-verification', [AuthController::class, 'twoStepPost']);
Route::post('resend-otp', [AuthController::class, 'resendOTP']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get("profile", [ProfileController::class, "profile"]);
    Route::post("update", [ProfileController::class, "update"]);
    Route::post("change-password", [ProfileController::class, "changePassword"]);
    Route::post("delete", [ProfileController::class, "delete"]);
    
    Route::post("logout", [AuthController::class, "logout"]);
});
