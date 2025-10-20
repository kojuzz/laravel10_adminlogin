<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\PasswordReset;
use Exception;

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

    public function update($data, $id)
    {
        return User::where('id', $id)->update($data);
    }

    public function sendMail($email)
    {
        $token = Str::random(60);
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new Exception("User not registered. Please register first.");
        }
        $user->notify(new PasswordReset($token, $email));
        return true;
    }

    public function getByEmail($email)
    {
        $record = User::where('email', $email)->first();
        return $record;
    }

    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }
}
