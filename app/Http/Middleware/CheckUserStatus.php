<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado == 0) {
            Auth::logout(); // Desconectamos al usuario si el estado es 0
            return redirect()->route('login')->withErrors(['error' => 'Tu cuenta ha sido deshabilitada.']);
        }
        return $next($request);
    }
}
