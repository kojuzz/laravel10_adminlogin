<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/privacy-policy', 'auth.privacy-policy')->name('privacy-policy');

Route::middleware('guest')->group(function () {
    Route::get('register', [PageController::class, 'register'])->name('register');
    Route::get('login', [PageController::class, 'login'])->name('login');

    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::get('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('forgot-password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset-password.post');
});

Route::middleware('auth')->group(function () {
    Route::get('two-step', [AuthController::class, 'twoStep'])->name('two-step');
    Route::post('two-step', [AuthController::class, 'twoStepPost'])->name('two-step.post');
    Route::post('resend-otp', [AuthController::class, 'resendOTP'])->name('resend-otp');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware('auth', 'checkVerified')->group(function () {
    Route::get('/', [AdminPageController::class, 'index'])->name('admin.dashboard');
    Route::get('about', [AdminPageController::class, 'about'])->name('admin.about');
    Route::get('manage-profile', [AdminPageController::class, 'edit'])->name('admin.edit');
    Route::get('change-password', [AdminPageController::class, 'changePassword'])->name('admin.change-password');
    Route::get('admin-list', [AdminPageController::class, 'adminList'])->name('admin.admin-list');

    Route::post('manage-profile', [ProfileController::class, 'update'])->name('admin.update');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('admin.change-password.post');
});

Route::fallback(function () {
    return redirect()->route('login')->with('failed', 'Page not found.');
});
