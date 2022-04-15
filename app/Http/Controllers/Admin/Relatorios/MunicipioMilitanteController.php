<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Cap;
use App\Models\CapMilitante;

class MunicipioMilitanteController extends Controller
{
    public function gerarRelatorio() {
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $data = date('d-m-Y');
        $total = 0;
        $dados = [];
        $municipios= Municipio::get();
        // dd($capMilitante);
        foreach($municipios as $municipio ) {
            $dado = Cap::where('it_id_municipio', $municipio->id)->get();
            $militantes = 0;
            foreach($dado as $cap) {
                $capMilitantes = CapMilitante::where('it_id_cap', $cap->id)->count();
                $militantes = $militantes + $capMilitantes;
            }
            $total = $total + $militantes;
            
            $municipioMilitante = (object) [
                'municipio'=> $municipio->vc_nome,
                'militantes'=> $militantes,
            ];
            array_push($dados, $municipioMilitante);
        }
        $municipioMilitante = (object) [
            'municipio'=> 'Total',
            'militantes'=> $total,
        ];
        array_push($dados, $municipioMilitante);
        
        // dd($dados);

        $css = file_get_contents("css/bootstrap.min.css");
        $css1 = file_get_contents("css/style.css");
        
        $html = view("admin/pdfs/relatorios/municipioMilitante/index", compact('dados'));
        
        $mpdf->SetHTMLFooter('<h5><div class="text-left">'.$data.'</div></h5>');
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output("Relatório dos Militantes por Cap $data", "I");
    }
}