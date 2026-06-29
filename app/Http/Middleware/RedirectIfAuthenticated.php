<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Session::has('user_2fa')) {
                return redirect()->to('2fa');
            }
            else if (auth()->user()->email_verified_at == null || auth()->user()->email_verified_at == '') {
             return redirect()->to('email/verify');
            }
            else if(auth()->user()->role == 'Admin'){
            return redirect()->to('homeadmin');
            }
            else if(auth()->user()->role == 'Staff'){
            return redirect()->to('homestaff');
            }
            else if(auth()->user()->role == 'Customer'){
            return redirect()->to('homecustomer');
            }
        }

        return $next($request);
    }
}
