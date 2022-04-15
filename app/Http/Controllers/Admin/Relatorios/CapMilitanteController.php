<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cap;
use App\Models\CapMilitante;

class CapMilitanteController extends Controller
{
    public function gerarRelatorio() {
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $data = date('d-m-Y');
        $total = 0;
        $dados = [];
        $caps= Cap::get();
        // dd($capMilitante);
        foreach($caps as $cap ) {
            $militantes = CapMilitante::where('it_id_cap', $cap->id)->count();
            $total = $total + $militantes;
            $capMilitante = (object) [
                'cap'=> $cap->vc_nome,
                'militantes'=> $militantes,
            ];
            array_push($dados, $capMilitante);
        }
        $capMilitante = (object) [
            'cap'=> 'Total',
            'militantes'=> $total,
        ];
        array_push($dados, $capMilitante);
        
        // dd($dados);

        $css = file_get_contents("css/bootstrap.min.css");
        $css1 = file_get_contents("css/style.css");
        
        $html = view("admin/pdfs/relatorios/capMilitante/index", compact('dados'));
        
        $mpdf->SetHTMLFooter('<h5><div class="text-left">'.$data.'</div></h5>');
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output("Relatório dos Militantes por Cap $data", "I");
    }
}
