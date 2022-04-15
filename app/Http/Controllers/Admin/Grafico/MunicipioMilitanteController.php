<?php

namespace App\Http\Controllers\Admin\Grafico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Cap;
use App\Models\CapMilitante;

class MunicipioMilitanteController extends Controller
{

    public function gerarGrafico() {
        $municipios = array();
        $militantes = array();
        $caps= Cap::get();
        $todos= Municipio::get();
        
        foreach($todos as $municipio ) {
            $dado = Cap::where('it_id_municipio', $municipio->id)->get();
            $militante = 0;
            foreach($dado as $cap) {
                $capMilitantes = CapMilitante::where('it_id_cap', $cap->id)->count();
                $militante = $militante + $capMilitantes;
            }
            array_push($municipios, $municipio->vc_nome);
            array_push($militantes, $militante);
        }

        $dados = (object) [
            'municipios'=> json_encode($municipios),
            'militantes'=> json_encode($militantes),
        ];
        // return view('admin.dashboard', compact('dados'));
        return $dados;
        // return redirect('/')->with('dados', $dados2);
    }
}
