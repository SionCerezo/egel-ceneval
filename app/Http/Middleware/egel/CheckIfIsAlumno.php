<?php

namespace App\Http\Middleware\egel;

use Closure;
use Illuminate\Http\Request;

class CheckIfIsAlumno
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( $request->user() != null && $request->user()->isAlumno() ){
            return $next($request);
        }

        abort(403);
    }
}
