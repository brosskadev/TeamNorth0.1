<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\PlayerServiceInterface;

class PlayerController extends Controller
{
    protected PlayerServiceInterface $playerService;

    public function __construct(PlayerServiceInterface $playerService)
    {
        $this->playerService = $playerService;
    }

    public function showPlayer($login)
{
    $user = User::where('login', $login)->firstOrFail();
    $player = $this->playerService->getPlayerByUserId($user->id);

    // Если игрока нет, создаём пустой объект с нужными полями, чтобы не ломать шаблон
    if (!$player) {
        $player = (object)[
            'join_date' => null,
            'kills' => null,
            'deaths' => null,
            'clan_role' => null,
            // добавь другие поля, если нужны
        ];
    }

    $daysInTeam = $player->join_date
        ? round(\Carbon\Carbon::parse($player->join_date)->diffInHours(now()) / 24, 0)
        : '-';

    return view('profile', compact('user', 'player', 'daysInTeam'));
}

    public function getAllPlayers()
    {
        $players = Player::all();

        return view('roster', compact('players'));
    }
}
