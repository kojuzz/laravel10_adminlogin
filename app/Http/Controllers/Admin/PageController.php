<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function index()
    {
        return view('admin.dashboard', [
            'user' => $this->user
        ]);
    }

    public function about()
    {
        return view('admin.about');
    }

    public function edit()
    {
        return view('admin.edit', [
            'user' => $this->user
        ]);
    }

    public function changePassword()
    {
        return view('admin.change-password', [
            'user' => $this->user
        ]);
    }

    public function adminList()
    {
        $admins = User::latest()->paginate(15);
        return view('admin.admin-list', [
            'admins' => $admins
        ]);
    }
}
