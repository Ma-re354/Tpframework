<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminAuthenticated
{
    /**
     * Handle an incoming request.
     * If no admin session found, redirect to login.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('admin_user_id')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
