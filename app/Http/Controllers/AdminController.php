<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
{
    $users = User::with('player')->get();
    $now = now();

    foreach ($users as $user) {
        $player = $user->player;
        if (!$player) {
            continue;
        }

        $daysSinceChange = $player->role_changed_at ? (int)$player->role_changed_at->diffInDays($now) : 0;

        switch (mb_strtolower($player->clan_role)) {
            case 'новобранец':
            case 'рекрут':
                if ($daysSinceChange > (int)$player->days_recruit) {
                    $player->days_recruit = $daysSinceChange;
                    $player->save();
                }
                break;

            case 'проспект':
                if ($daysSinceChange > (int)$player->days_prospect) {
                    $player->days_prospect = $daysSinceChange;
                    $player->save();
                }
                break;

            case 'основа':
                if ($daysSinceChange > (int)$player->days_main) {
                    $player->days_main = $daysSinceChange;
                    $player->save();
                }
                break;
        }
    }

    return view('dashboard', compact('users'));
}



    public function create(Request $request)
    {
        $data = $request->validate([
            'player_id' => ['required', 'string', 'unique:players,player_id'],
            'nickname' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users,login'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

            'join_date' => ['nullable', 'date'],
            'clan_role' => ['nullable', 'string', 'max:255'], // роль: новобранец/проспект/основа
            'steam_id' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'brigade' => ['nullable', 'string', 'max:255'],
            'days_recruit' => ['nullable', 'integer'],
            'days_prospect' => ['nullable', 'integer'],
            'days_main' => ['nullable', 'integer'],
            'on_holiday' => ['nullable', 'boolean'],
        ]);

        // Создаём пользователя
        $user = User::create([
            'nickname' => $data['nickname'],
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        // Создаём игрока, связываем с user_id
        Player::create([
            'player_id' => $data['player_id'],
            'user_id' => $user->id,
            'steam_id' => $data['steam_id'] ?? null,
            'specialization' => $data['specialization'] ?? null,
            'brigade' => $data['brigade'] ?? null,
            'join_date' => $data['join_date'] ?? null,
            'days_recruit' => $data['days_recruit'] ?? 0,
            'days_prospect' => $data['days_prospect'] ?? 0,
            'days_main' => $data['days_main'] ?? 0,
            'on_holiday' => $data['on_holiday'] ?? false,
            'clan_role' => $data['clan_role'] ?? null,
            'role_changed_at' => now(),
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

    $newRole = $validated['clan_role'] ?? $player->clan_role;
    $now = now();

    if ($player->clan_role !== $newRole) {
        // Обновляем только дату смены роли, не трогая счетчики дней
        $player->role_changed_at = $now;
        $player->clan_role = $newRole;
    }

    // Обновляем данные пользователя
    $user->login = $validated['login'];
    $user->nickname = $validated['nickname'] ?? $user->nickname;
    $user->save();

    // Обновляем данные игрока
    $player->steam_id = $validated['steam_id'] ?? $player->steam_id;
    $player->specialization = $validated['specialization'] ?? $player->specialization;
    $player->brigade = $validated['brigade'] ?? $player->brigade;
    $player->join_date = $validated['join_date'] ?? $player->join_date;
    $player->days_recruit = $validated['days_recruit'] ?? $player->days_recruit;
    $player->days_prospect = $validated['days_prospect'] ?? $player->days_prospect;
    $player->days_main = $validated['days_main'] ?? $player->days_main;
    $player->kills = $validated['kills'] ?? $player->kills;
    $player->deaths = $validated['deaths'] ?? $player->deaths;
    $player->on_holiday = $request->has('on_holiday');

    $player->save();

    return redirect()->back()->with('success', 'Данные успешно обновлены');
}

}
