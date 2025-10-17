<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\User;

class AdminUserRepository
{
    public function create($data)
    {
        if ($data['username'] == null) {
            $username = Str::slug($data['name'], '');
            $username = preg_replace('/^[^a-z]+/', '', $username);
            $originalUsername = $username;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $originalUsername . $counter;
                $counter++;
            }
            $data['username'] = $username;
        }
        return User::create($data);
    }
}
