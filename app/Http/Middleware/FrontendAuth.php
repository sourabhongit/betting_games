<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FrontendAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !auth()->user()->hasRole('player')) {
            // If not authenticated or the user does not have the 'user' role, redirect to the login route
            return redirect()->route('user.login');
        }

        // Proceed with the request
        return $next($request);
    }
}
