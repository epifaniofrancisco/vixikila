<?php

namespace App\Http\Controllers\Admin\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Estabelecimento;
use App\Models\Multa;
use Illuminate\Http\Request;

class RmeController extends Controller
{
  public function gerarRelatorio()
  {
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
    $data = date('d-m-Y');
    $total = 0;
    $totalPagas = 0;
    $totalNaoPagas = 0;
    $valorTotal = 0;
    $valorTotalPago = 0;
    $valorTotalNaoPago = 0;
    $dados = [];
    $estabelecimentos = Estabelecimento::get();
    // dd($capMilitante);
    foreach ($estabelecimentos as $estabelecimento) {
      $valor = 0;
      $valorPago = 0;
      $valorNaoPago = 0;
      $totalMulta = 0;
      $multas = Multa::where([['id_estabelecimento', $estabelecimento->id], ['it_estado', 1]])->get();
      // dd($multas);
      foreach ($multas as $item) {
        $valor += $item->fl_valorMulta;
        $totalMulta++;
        if($item->it_multaPaga == 1) {
          $valorPago += $item->fl_valorMulta;
        }else if($item->it_multaPaga == 0) {
          $valorNaoPago += $item->fl_valorMulta;
        }
      }
      $multasPagas = Multa::where([['id_estabelecimento', $estabelecimento->id], ['it_estado', 1], ['it_multaPaga', 1]])->count();
      $multasNaoPagas = Multa::where([['id_estabelecimento', $estabelecimento->id], ['it_estado', 1], ['it_multaPaga', 0]])->count();
      // $estabelecimento = Estabelecimento::where([['id_destrito', $estabelecimento->id], ['it_estado', 1]])->count();
      $total += $totalMulta;
      $totalPagas += $multasPagas;
      $totalNaoPagas += $multasNaoPagas;
      $valorTotal += $valor;
      $valorTotalPago += $valorPago;
      $valorTotalNaoPago += $valorNaoPago;
      $dado = (object) [
        'estabelecimento' => $estabelecimento->nome,
        'multa' => $totalMulta,
        'multaPaga' => $multasPagas,
        'multaNaoPaga' => $multasNaoPagas,
        'valorPago' => $valorPago,
        'valorNaoPago' => $valorNaoPago,
        'valor' => $valor,
      ];
      array_push($dados, $dado);
    }
    $dado = (object) [
      'estabelecimento' => 'Total',
      'multa' => $total,
      'multaPaga' => $totalPagas,
      'multaNaoPaga' => $totalNaoPagas,
      'valorPago' => $valorTotalPago,
      'valorNaoPago' => $valorTotalNaoPago,
      'valor' => $valorTotal,
    ];
    array_push($dados, $dado);

    // dd($dados);

    $css = file_get_contents("css/bootstrap.min.css");
    $css1 = file_get_contents("css/style.css");

    $html = view("admin/pdfs/relatorios/multa_estabelecimento/index", compact('dados'));

    $mpdf->SetHTMLFooter('<h5><div class="text-left">' . $data . '</div></h5>');
    $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output("Relatório dos Estabelecimento por Categoria $data", "I");
  }
}
