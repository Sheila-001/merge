<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            // Redirect or abort if the user does not have the required role
            return redirect('/home'); // or abort(403);
        }

        return $next($request);
    }
}