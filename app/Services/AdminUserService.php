<?php

namespace App\Services;

use App\Repositories\AdminUserRepository;

class AdminUserService
{
    protected $adminUserRepository;
    public function __construct(AdminUserRepository $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }
        
    public function register($data)
    {
        return $this->adminUserRepository->register($data);
    }
    public function login($data)
    {
        return $this->adminUserRepository->login($data);
    }
}
