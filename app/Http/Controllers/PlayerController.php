<?php

namespace App\Http\Controllers;

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

        $daysInTeam = $player->join_date
        ? round(\Carbon\Carbon::parse($player->join_date)->diffInHours(now()) / 24, 0)
        : null;

        return view('profile', compact('user', 'player', 'daysInTeam'));
    }
}
