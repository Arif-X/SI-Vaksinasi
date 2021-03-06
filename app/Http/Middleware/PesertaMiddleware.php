<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PesertaMiddleware
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
        if(auth()->user()->role <= 3){
            return $next($request);
        } else {
            return redirect('/user/profil');
        } 
    }
}
