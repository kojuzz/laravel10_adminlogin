<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Http\Requests\AdminUserChangePasswordRequest;
use App\Services\AdminUserService;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    // Update Profile
    public function update(AdminUserUpdateRequest $request)
    {
        $user = $request->validated();
        $id = Auth::user()->id;
        $this->adminUserService->update($user, $id);
        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully');
    }

    // Change Password
    public function changePassword(AdminUserChangePasswordRequest $request)
    {
        $user = $request->validated();
        $id = Auth::user()->id;
        try {
            $response = $this->adminUserService->changePassword($user, $id);
            return redirect()->route('admin.dashboard')->with('success', $response);
        } catch (Exception $e) {
            return back()->with('failed', $e->getMessage())->withInput();
        }
    }
}
