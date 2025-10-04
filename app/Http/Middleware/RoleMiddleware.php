<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kalau belum login → lempar ke halaman login
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        // Kalau role user tidak cocok dengan role route → abort 403
        if (! in_array($userRole, $roles)) {
            abort(403, 'Unauthorized.');
        }

        // Jika cocok, lanjut
        return $next($request);
    }
}
