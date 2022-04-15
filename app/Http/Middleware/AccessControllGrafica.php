<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AccessControllGrafica
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
        if(Auth::user()->vc_perfil=='Administrador' || Auth::user()->vc_perfil=='Master' || Auth::user()->vc_perfil=='Gráfica A' || Auth::user()->vc_perfil=='Gráfica B'){
         
            return $next($request);
        }else{
         
           return redirect()->back()->with('nao_permintido','1');
        }
    }
}
