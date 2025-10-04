<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // Arahkan sesuai role
                if ($user->role === 'peserta') {
                    return redirect()->route('peserta.dashboard');
                } elseif ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                // fallback kalau role tidak dikenali
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
