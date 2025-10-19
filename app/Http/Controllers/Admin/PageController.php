<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('admin.edit', [
            'user' => Auth::user()
        ]);
    }

    public function changePassword()
    {
        return view('admin.change-password', [
            'user' => Auth::user()
        ]);
    }

    public function adminList()
    {
        $admins = User::latest()->paginate(10);
        return view('admin.admin-list', [
            'admins' => $admins
        ]);
    }
}
