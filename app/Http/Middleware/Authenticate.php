<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

/**
 * This middleware determines if the user is authenticated. If they are
 * not, it will redirect them to the login route. We extend
 * Laravel's default Authenticate middleware so we can customize
 * redirect routes later if needed.
 */
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not
     * authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}