<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AccessControllAdmin
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
        if(Auth::user()->vc_perfil=='Administrador' || Auth::user()->vc_perfil=='Master'){
         
            return $next($request);
        }else{
         
           return redirect()->back()->with('nao_permintido','1');
        }
    }
}
