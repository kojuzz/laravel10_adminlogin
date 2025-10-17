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
        $response = $this->adminUserRepository->register($data);
        return $response;
    }

    // Login
    public function login($data)
    {
        $loginField = filter_var($data['email-username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $data['email-username'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null; // login fail
    }
}
