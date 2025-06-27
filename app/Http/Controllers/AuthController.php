<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Interfaces\AuthServiceInterface;
class AuthController extends Controller
{
    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function showloginpage(){
        return view('login');
    }

    public function login(LoginRequest $request)
{
    $remember = $request->boolean('remember');

    if ($this->authService->login($request->login, $request->password, $remember)) {
        $request->session()->regenerate();
        return redirect('/profile');
    }

    return back()->withErrors(['login' => 'Неверные учетные данные']);
}
}
