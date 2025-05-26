<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'id_user_level' => 1,
                'nama' => 'Admin Utama',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => Hash::make('password')
            ],
            [
                'id_user_level' => 2,
                'nama' => 'User Biasa',
                'email' => 'user@example.com',
                'username' => 'user',
                'password' => Hash::make('password')
            ],
        ]);
    }
}
