<?php

namespace App\Http\Controllers\Admin\Grafico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cap;
use App\Models\CapMilitante;

class CapMilitanteController extends Controller
{
    public function gerarGrafico() {
        $caps= array();
        $militantes = array();
        $todos= Cap::get();
        
        foreach($todos as $cap ) {
            array_push($caps, $cap->vc_nome);
            $militante = CapMilitante::where('it_id_cap', $cap->id)->count();
            array_push($militantes, $militante);
        }

        $dados = (object) [
            'caps'=> json_encode($caps),
            'militantes'=> json_encode($militantes),
        ];
        // $dados1 = json_encode($dados1);
        // return view('admin.dashboard', compact('dados1'));
        return $dados;
    }
}
