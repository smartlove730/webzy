<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to redirect authenticated users away from guest routes
 * (such as the login page). This prevents logged in admins from
 * accessing the login form again.
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}