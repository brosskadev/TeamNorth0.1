<?php

namespace App\Services\Interfaces;

interface AuthServiceInterface{
    public function login(string $login, string $password, bool $remember = false): bool;
}