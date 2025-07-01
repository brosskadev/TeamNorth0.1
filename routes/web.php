<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserStillExists;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/roster', [PlayerController::class, 'showPlayer'])->name('roster');

Route::get('/login', [AuthController::class, 'showloginpage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([
    'web',
    'auth',
    EnsureFrontendRequestsAreStateful::class,
    CheckUserStillExists::class
])->group(function () {
    Route::get('/profile/{login}', [PlayerController::class, 'showPlayer'])->name('profile.by.login');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');;
    Route::post('dashboard/create', [AdminController::class, 'create'])->name('admin.create');
    Route::delete('dashboard/delete/{player}', [AdminController::class, 'delete'])->name('admin.delete');

});
