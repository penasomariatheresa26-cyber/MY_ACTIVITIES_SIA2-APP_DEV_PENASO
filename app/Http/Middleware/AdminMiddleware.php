<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Is the user logged in?
        // 2. Is their database role column exactly 'admin'?
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If they aren't an admin, block them or redirect away
        abort(403, 'Unauthorized action. Admin access only.');
    }
}