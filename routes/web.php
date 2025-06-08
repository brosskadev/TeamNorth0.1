<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/about');

Route::get('/about', function () {
    return view('welcome');
});

Route::get('/north-history', function () {
    return view('history');
});

Route::get('/north-roster', function () {
    return view('roster');
});

Route::get('/old-rosters', function () {
    return view('oldrosters');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/join-north', function () {
    return view('join');
});