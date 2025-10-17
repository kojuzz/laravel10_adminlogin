<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\User;

class AdminUserRepository
{
    public function register($data)
    {
        if ($data['username'] == null) {
            $username = Str::slug($data['name'], '');
            $username = preg_replace('/^[^a-z]+/', '', $username);
            $data['username'] = $username;
        }
        return User::create($data);
    }
}
