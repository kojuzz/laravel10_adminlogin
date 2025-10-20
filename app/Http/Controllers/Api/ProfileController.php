<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserChangePasswordRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Services\AdminUserService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }
    public function profile()
    {
        return response()->json([
            "status" => "success",
            "message" => "Profile retrieved successfully",
            "user" => Auth::user()
        ]);
    }

    public function update(AdminUserUpdateRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $this->adminUserService->update($data, $user->id);
        return response()->json([
            "status" => "success",
            "message" => "Profile updated successfully",
            "user" => $user
        ]);
    }

    public function changePassword(AdminUserChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $this->adminUserService->changePassword($data, $user->id);
        return response()->json([
            "status" => "success",
            "message" => "Password changed successfully"
        ]);
    }

    public function delete()
    {
        $user = Auth::user();
        $this->adminUserService->delete($user->id);
        return response()->json([
            "status" => "success",
            "message" => "Account deleted successfully"
        ]);
    }
}
