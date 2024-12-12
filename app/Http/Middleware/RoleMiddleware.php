<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !Auth::user()->hasAnyRole($roles)) {
            return response()->view('errors.403', [], 403);
        }
        return $next($request);
    }

}