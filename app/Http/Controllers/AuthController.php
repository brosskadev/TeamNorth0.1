<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
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
        return redirect('/profile/' . $request->login);
    }

    return back()->withErrors(['login' => 'Неверные учетные данные']);
    }

     public function logout(Request $request){
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
