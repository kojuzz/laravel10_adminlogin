<?php

namespace App\Services;

use App\Repositories\AdminUserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserService
{
    protected $adminUserRepository;
    public function __construct(AdminUserRepository $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }

    // Register
    public function register($data)
    {
        $response = $this->adminUserRepository->create($data);
        return $response;
    }

    // Login
    public function login($data)
    {
        $loginField = filter_var($data['email-username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember = $data['remember'] ?? false;
        $credentials = [
            $loginField => $data['email-username'],
            'password' => $data['password'],
        ];
        if (Auth::attempt($credentials, $remember)) {
            return Auth::user();
        }
        return null;
    }

    // Update
    public function update($data, $id)
    {
        $response = $this->adminUserRepository->update($data, $id);
        return "Profile updated successfully";
    }

    // Change Password
    public function changePassword($data, $id)
    {
        if (!Hash::check($data['current_password'], Auth::user()->password)) {
            throw new Exception("Old password is incorrect");
        }
        $response = $this->adminUserRepository->update([
            'password' => Hash::make($data['new_password'])
        ], $id);
        return "Password changed successfully";
    }
}
