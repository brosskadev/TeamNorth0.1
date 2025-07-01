<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\AuthService;
use App\Services\AdminService;
use App\Services\PlayerService;

use App\Repositories\AuthRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\AdminRepository;

use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\PlayerServiceInterface;
use App\Services\Interfaces\AdminServiceInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(PlayerServiceInterface::class, PlayerService::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);


        // Привязка репозиториев
        $this->app->bind(AuthRepository::class, function ($app) {
            return new AuthRepository();
        });
        $this->app->bind(PlayerRepository::class, function ($app) {
            return new PlayerRepository();
        });
        $this->app->bind(AdminRepository::class, function ($app) {
            return new AdminRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
