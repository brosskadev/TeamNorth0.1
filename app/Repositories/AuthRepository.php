<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository{

    public function findByLogin(string $login): ?User{
        return User::where("login", $login)->first();
    }

}