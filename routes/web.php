<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckUserStillExists;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/roster', [PlayerController::class, 'getAllPlayers'])->name('roster');

Route::get('/login', [AuthController::class, 'showloginpage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Автоматически подхватывает 'web'
Route::middleware(['auth', CheckUserStillExists::class])->group(function () {
    Route::get('/profile/{login}', [PlayerController::class, 'showPlayer'])->name('profile.by.login');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/create', [AdminController::class, 'create'])->name('admin.create');
    Route::delete('dashboard/delete/{player}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::put('/admin/player/{player}', [AdminController::class, 'update'])->name('admin.update');

});

