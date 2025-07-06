<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $login = 'admin';
        $user = User::firstOrCreate(
            ['login' => $login],
            [
                'nickname' => 'Админ',
                'password' => Hash::make('brosskibrosskibrosski'), // Поменяй пароль
                'role' => 'admin',
            ]
        );
    }
}
