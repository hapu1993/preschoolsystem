<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //If the status is not approved redirect to login
        if(Auth::check() && Auth::user()->role == 4){

            Auth::logout();
            return redirect('/login')->with('error_login', 'Access Denied');
        }
        return $response;
    }
}
