<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User_Level;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    User_Level::insert([
            ['id_user_level' => 1, 'user_level' => 'Admin'],
            ['id_user_level' => 2, 'user_level' => 'User'],
        ]);
    }
}
