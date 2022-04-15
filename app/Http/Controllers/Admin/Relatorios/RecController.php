<?php

namespace App\Http\Controllers\Admin\Relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaEstabelecimento;
use App\Models\Estabelecimento;

class RecController extends Controller
{
    public function gerarRelatorio() {
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $data = date('d-m-Y');
        $total = 0;
        $dados = [];
        $categoriaEstabelecimentos = CategoriaEstabelecimento::get();
        // dd($capMilitante);
        foreach($categoriaEstabelecimentos as $categoriaEstabelecimento ) {
            $estabelecimento = Estabelecimento::where([['it_id_categoria_estabelecimento', $categoriaEstabelecimento->id], ['it_estado', 1]])->count();
            $total = $total + $estabelecimento;
            $dado = (object) [
                'categoria_estabelecimento'=> $categoriaEstabelecimento->vc_nomeCategoria,
                'estabelecimento'=> $estabelecimento,
            ];
            array_push($dados, $dado);
        }
        $dado = (object) [
            'categoria_estabelecimento'=> 'Total',
            'estabelecimento'=> $total,
        ];
        array_push($dados, $dado);
        
        // dd($dados);

        $css = file_get_contents("css/bootstrap.min.css");
        $css1 = file_get_contents("css/style.css");
        
        $html = view("admin/pdfs/relatorios/estabelecimento_categoria/index", compact('dados'));
        
        $mpdf->SetHTMLFooter('<h5><div class="text-left">'.$data.'</div></h5>');
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output("Relatório dos Estabelecimento por Categoria $data", "I");
    }
}
