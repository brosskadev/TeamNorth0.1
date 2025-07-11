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
            'password' => Hash::make('brosski'),
            'role' => 'admin',
        ]
    );

    if (!$user->player) {
        $user->player()->create([
            'player_id' => '1111', // уникальный ID игрока вручную, если у тебя есть такое поле
            'steam_id' => 'ADMIN_STEAM',
            'specialization' => 'админ',
            'join_date' => now(),
            'clan_role' => 'админ',
            'on_holiday' => false,
            'kills' => 0,
            'deaths' => 0,
            // остальные обязательные поля, если есть
        ]);
    }
}

}