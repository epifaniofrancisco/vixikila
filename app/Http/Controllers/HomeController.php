<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Grafico\MunicipioMilitanteController;
use App\Http\Controllers\Admin\Grafico\CapMunicipioController;
use App\Http\Controllers\Admin\Grafico\CapMilitanteController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Kixikila;  
class HomeController extends Controller
{
    public $capmilitante;
    public $municipiomilitante;
    public $capmunicipioController;

    public function __construct(CapMilitanteController $capmilitante, MunicipioMilitanteController $municipiomilitante, CapMunicipioController $capmunicipioController){
        $this->capmilitante=$capmilitante;
        $this->municipiomilitante=$municipiomilitante;
        $this->capmunicipioController=$capmunicipioController;
    }

    public function index(){
        $dados['kixikilas'] = Kixikila::join('users', 'kixikilas.id_user', 'users.id')->get();
        return view('site.index',$dados);
    }

    public function perfil(){

        $dados['minhaskixikilas'] = Kixikila::join('users', 'kixikilas.id_user', 'users.id')->where('kixikilas.id_user',Auth::user()->id)->get();

        $dados['kixikilas'] = Kixikila::join('users', 'kixikilas.id_user', 'users.id')->where('kixikilas.id_user','!=',Auth::user()->id)->get();

        // dd( $dados['minhaskixikilas']);
        return view('site.perfil.index',$dados);
    }
  

}
