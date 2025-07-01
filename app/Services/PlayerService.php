<?php

namespace App\Services;

use App\Repositories\PlayerRepository;
use App\Services\Interfaces\PlayerServiceInterface;
use App\Models\User;

class PlayerService implements PlayerServiceInterface
{
    protected PlayerRepository $playerRepo;

    public function __construct(PlayerRepository $playerRepo)
    {
        $this->playerRepo = $playerRepo;
    }

    public function getPlayerByUserId(int $userId)
    {
        // Например, поиск по user_id
        return $this->playerRepo->getAll()->firstWhere('user_id', $userId);
    }

    public function getAll()
    {   
        return $this->playerRepo->getAll();
    }
}
