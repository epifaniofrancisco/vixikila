<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cap;
use App\Models\Municipio;

class CapMunicipioController extends Controller
{
    public function gerarRelatorio() {
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $data = date('d-m-Y');
        $total = 0;
        $dados = [];
        $municipios= Municipio::get();
        // dd($capMilitante);
        foreach($municipios as $municipio ) {
            $cap = Cap::where('it_id_municipio', $municipio->id)->count();
            $total = $total + $cap;
            $capMunicipio = (object) [
                'municipio'=> $municipio->vc_nome,
                'cap'=> $cap,
            ];
            array_push($dados, $capMunicipio);
        }
        $capMunicipio = (object) [
            'municipio'=> 'Total',
            'cap'=> $total,
        ];
        array_push($dados, $capMunicipio);
        
        // dd($dados);

        $css = file_get_contents("css/bootstrap.min.css");
        $css1 = file_get_contents("css/style.css");
        
        $html = view("admin/pdfs/relatorios/capMunicipio/index", compact('dados'));
        
        $mpdf->SetHTMLFooter('<h5><div class="text-left">'.$data.'</div></h5>');
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output("Relatório dos Caps por Municipio $data", "I");
    }
}
