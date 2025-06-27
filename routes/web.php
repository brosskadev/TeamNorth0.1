<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserStillExists;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', [AuthController::class, 'showloginpage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware([
    'web',
    'auth',
    EnsureFrontendRequestsAreStateful::class,
    CheckUserStillExists::class
])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    });
});

