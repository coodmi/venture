<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        foreach ($roles as $role) {
            if (Auth::user()->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized.');
    }
}
