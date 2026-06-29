<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'staff' role
        if (auth()->check() && auth()->user()->role === 'Staff') {
            return $next($request);
        }

        return redirect()->route('/'); // Redirect unauthorized users to the login page
    }
}
