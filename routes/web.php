<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProfileController;
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

Route::middleware('guest')->group(function () {
    Route::get('/register', [PageController::class, 'register'])->name('register');
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::get('/forgot-password', [PageController::class, 'forgotPassword'])->name('forgot-password');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [AdminPageController::class, 'index'])->name('admin.dashboard');
    Route::get('/manage-profile', [AdminPageController::class, 'edit'])->name('admin.edit');
    Route::get('/change-password', [AdminPageController::class, 'changePassword'])->name('admin.change-password');
    Route::get('/admin-list', [AdminPageController::class, 'adminList'])->name('admin.admin-list');

    Route::post('/manage-profile', [ProfileController::class, 'update'])->name('admin.update');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('admin.change-password.post');

    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::fallback(function () {
    return redirect()->route('login')->with('failed', 'Page not found.');
});