<?php

namespace App\Http\Middleware;

use Closure;

class company
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
        if(Auth::check() && Auth::isRole()=="company") {
            return $next($request);
        }else{

            redirect("login");
        }
    }
}
