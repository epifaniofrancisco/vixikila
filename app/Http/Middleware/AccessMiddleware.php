<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $perfil)
    {
        $vc_perfil = \Auth::user()->vc_perfil;
        // dd(\Auth::user());

        if($vc_perfil == $perfil || $vc_perfil == 'Provincial' || $perfil == 'Cap') {
            return $next($request);
        }else {
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
