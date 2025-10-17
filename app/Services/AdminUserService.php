<?php

namespace App\Services;

use App\Repositories\AdminUserRepository;
use Illuminate\Support\Facades\Auth;

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
}
