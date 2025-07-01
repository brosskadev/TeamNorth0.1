<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface PlayerServiceInterface{
    public function getPlayerByUserId(int $userId);

    public function getAll();
}