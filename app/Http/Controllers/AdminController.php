<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Загрузим пользователей с игроками (lazy eager loading)
        $users = User::all();

        return view('dashboard', compact('users'));
    }

     public function create(Request $request)
{
    $data = $request->validate([
        'nickname' => ['required', 'string', 'max:255'],
        'login' => ['required', 'string', 'max:255', 'unique:users,login'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'join_date' => ['nullable', 'date'],
        'clan_role' => ['nullable', 'string', 'max:255'],
    ]);

    $user = User::create([
        'nickname' => $data['nickname'],
        'login' => $data['login'],
        'password' => Hash::make($data['password']),
        'role' => 'user',
    ]);

    $user->player()->create([
        'kills' => 0,
        'deaths' => 0,
        'join_date' => $data['join_date'] ?? null,
        'clan_role' => $data['clan_role'] ?? null,
    ]);

    return redirect()->route('dashboard')->with('success', 'Пользователь и игрок созданы');
}

    public function delete(Player $player)
    {
        
        $deletedAtLeastOne = false;

    if ($player->exists && $player->delete()) {
        $deletedAtLeastOne = true;
    }

    $user = $player->user;
    if ($user && $user->exists && $user->delete()) {
        $deletedAtLeastOne = true;
    }

    if (!$deletedAtLeastOne) {
        return redirect()->route('dashboard')->with('error', 'Удаление не выполнено.');
    }

    return redirect()->route('dashboard')->with('success', 'Удаление выполнено.');

    }

}