<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStillExists
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $freshUser = \App\Models\User::find($user->id);
            if (!$freshUser) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors(['login' => 'Пользователь не найден. Пожалуйста, войдите снова.']);
            }
        }

        return $next($request);
    }
}