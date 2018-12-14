<?php

namespace App\Http\Middleware;

use Closure;

class karyawanAkses
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
        if(\Auth::user()->ref_user_level_id != 2){
            abort(404);
        }        
        return $next($request);
    }
}
