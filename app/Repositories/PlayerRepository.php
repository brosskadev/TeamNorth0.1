<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository{

    public function findById(int $id): ?Player{
        return Player::where("id", $id)->first();
    }

    public function getAll(){
        return Player::all();
    }
}