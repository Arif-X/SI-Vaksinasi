<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PevaksinMiddleware
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
        if(auth()->user()->role < 2){
            return redirect('/user/profil');
        } else {
            return $next($request);
        } 
    }
}
