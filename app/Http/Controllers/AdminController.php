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
        'steam_id' => ['nullable', 'string', 'max:255'],
        'specialization' => ['nullable', 'string', 'max:255'],
        'brigade' => ['nullable', 'string', 'max:255'],
        'days_recruit' => ['nullable', 'integer'],
        'days_prospect' => ['nullable', 'integer'],
        'days_main' => ['nullable', 'integer'],
        'on_holiday' => ['nullable', 'boolean'],
    ]);

    $user = User::create([
        'nickname' => $data['nickname'],
        'login' => $data['login'],
        'password' => Hash::make($data['password']),
        'role' => 'user',
    ]);

    $user->player()->create([
    'steam_id' => $data['steam_id'] ?? null,
    'specialization' => $data['specialization'] ?? null,
    'brigade' => $data['brigade'] ?? null,
    'join_date' => $data['join_date'] ?? null,
    'days_recruit' => $data['days_recruit'] ?? null,
    'days_prospect' => $data['days_prospect'] ?? null,
    'days_main' => $data['days_main'] ?? null,
    'on_holiday' => $data['on_holiday'] ?? false,
    'clan_role' => $data['clan_role'] ?? null,
    'kills' => 0,
    'deaths' => 0,
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

    public function update(Request $request, $playerId)
{
    $player = Player::findOrFail($playerId);
    $user = $player->user;

    if (!$user) {
        return redirect()->back()->withErrors('Пользователь не найден');
    }

    $validated = $request->validate([
        'login' => 'required|string|max:255|unique:users,login,' . $user->id,
        'nickname' => 'nullable|string|max:255',
        'steam_id' => 'nullable|string|max:255',
        'specialization' => 'nullable|string|max:255',
        'brigade' => 'nullable|string|max:255',
        'join_date' => 'nullable|date',
        'days_recruit' => 'nullable|integer|min:0',
        'days_prospect' => 'nullable|integer|min:0',
        'days_main' => 'nullable|integer|min:0',
        'kills' => 'nullable|integer|min:0',
        'deaths' => 'nullable|integer|min:0',
        'clan_role' => 'nullable|string|max:255',
    ]);

    $validated['on_holiday'] = $request->has('on_holiday');

    if (!$validated) {
    return redirect()->back()->withErrors('Валидация не прошла');
}

    // Обновление данных пользователя
    $user->login = $validated['login'] ?? $user->login;
    $user->nickname = $validated['nickname'] ?? $user->nickname;
    $user->save();

    // Обновление данных игрока
    $player->steam_id = $validated['steam_id'] ?? $player->steam_id;
    $player->specialization = $validated['specialization'] ?? $player->specialization;
    $player->brigade = $validated['brigade'] ?? $player->brigade;
    $player->join_date = $validated['join_date'] ?? $player->join_date;
    $player->days_recruit = $validated['days_recruit'] ?? $player->days_recruit;
    $player->days_prospect = $validated['days_prospect'] ?? $player->days_prospect;
    $player->days_main = $validated['days_main'] ?? $player->days_main;
    $player->kills = $validated['kills'] ?? $player->kills;
    $player->deaths = $validated['deaths'] ?? $player->deaths;
    $player->clan_role = $validated['clan_role'] ?? $player->clan_role;
    $player->on_holiday = $validated['on_holiday'];

    // Флажок отпуск — либо установлен, либо нет
    $player->on_holiday = $request->has('on_holiday');

    $player->save();

    return redirect()->back()->with('success', 'Данные успешно обновлены');
}




}