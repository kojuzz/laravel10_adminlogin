<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();
        User::factory()->create([
            'name' => 'Jon Doe',
            'username' => 'jon',
            'email' => 'jon@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('123123'),
        ]);
    }
}
