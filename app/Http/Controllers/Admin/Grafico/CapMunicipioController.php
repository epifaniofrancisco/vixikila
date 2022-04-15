<?php

namespace App\Http\Controllers\Admin\Grafico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Cap;

class CapMunicipioController extends Controller
{
    public function gerarGrafico() {
        $municipios = array();
        $caps= array();
        $dados= Municipio::get();

        foreach($dados as $municipio ) {
            $cap = Cap::where('it_id_municipio', $municipio->id)->count();
            array_push($caps, $cap);
            array_push($municipios, $municipio->vc_nome);
        }

        $dados = (object) [
            'municipios'=> json_encode($municipios),
            'caps'=> json_encode($caps),
        ];

        return $dados;
    }
}
