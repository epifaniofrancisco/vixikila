<?php

namespace App\Http\Controllers\Admin\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Estabelecimento;
use App\Models\Publicidade;
use Illuminate\Http\Request;

class RpeController extends Controller
{
  public function gerarRelatorio()
  {
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
    $data = date('d-m-Y');
    $total = 0;
    $dados = [];
    $estabelecimentos = Estabelecimento::get();
    // dd($capMilitante);
    foreach ($estabelecimentos as $estabelecimento) {
      $publicidades = Publicidade::where([['id_estabelecimento', $estabelecimento->id], ['it_estado', 1]])->count();
      // $estabelecimento = Estabelecimento::where([['id_destrito', $estabelecimento->id], ['it_estado', 1]])->count();
      $total = $total + $publicidades;
      $dado = (object) [
        'estabelecimento' => $estabelecimento->nome,
        'publicidade' => $publicidades,
      ];
      array_push($dados, $dado);
    }
    $dado = (object) [
      'estabelecimento' => 'Total',
      'publicidade' => $total,
    ];
    array_push($dados, $dado);

    // dd($dados);

    $css = file_get_contents("css/bootstrap.min.css");
    $css1 = file_get_contents("css/style.css");

    $html = view("admin/pdfs/relatorios/publicidade_estabelecimento/index", compact('dados'));

    $mpdf->SetHTMLFooter('<h5><div class="text-left">' . $data . '</div></h5>');
    $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output("Relatório dos Estabelecimento por Categoria $data", "I");
  }
}
