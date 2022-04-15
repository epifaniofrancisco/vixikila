<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Estabelecimento;
use App\Models\Fatura;
use App\Models\Logg;
use App\Models\MultaEstabelecimento;
use App\Models\Publicidade;
use App\Models\Subscricao;
use App\Models\Taxa;
use App\Models\TaxaLicenca\ModalidadePublicidade;
use App\Models\TaxaLicenca\SuperficiePublicidade;
use App\Models\TaxaLicenca\TipoPublicidade;
use App\Models\Tipo_qr;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class FaturaController extends Controller
{
    public $log;
    public function __construct()
    {
        $this->log = new Logg();
    }

    public function listar()
    {
      $user = Auth::user();
      $dados['faturas'] =  DB::table('faturas')
      ->join('subscricaos', 'faturas.it_id_subscricao', 'subscricaos.id')
      ->join('publicidades', 'subscricaos.id_publicidade', 'publicidades.id')
      ->select('faturas.id', 'faturas.it_validacao_fatura', 'faturas.vc_descricao', 'publicidades.vc_nomePublicidade',
       'faturas.dt_pagamento', 'faturas.dt_licenca', 'faturas.fl_total', 'faturas.it_id_subscricao')
       ->where('subscricaos.id_usuario', Auth::id())
      ->where('faturas.it_estado', 1)
      ->get();

        return view('site.fatura.index', $dados);
    }

    public function gerarRelatorio($id)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);
        $data = date('d-m-Y');
        $total = 0;
        $subscricao = Subscricao::find($id);

        $estabelecimento = Estabelecimento::join('users', 'estabelecimentos.it_id_usuario', 'users.id')
            ->join('distritos', 'estabelecimentos.id_destrito', 'distritos.id')
            ->select(
                'estabelecimentos.id',
                'estabelecimentos.nif',
                'estabelecimentos.vc_endereco',
                'estabelecimentos.nome',
                'users.name',
                'users.email',
                'users.it_telefone',
                'distritos.vc_nomeDestrito'
            )
            ->where('estabelecimentos.it_estado', 1)->where([['estabelecimentos.id', $subscricao->id_estabelecimento]])->get()->first();
        $dados = [];

        $dados['taxas'] = Taxa::where('it_estado', 1)->get()->take(5);
        $dados['superficie'] = SuperficiePublicidade::find($subscricao->id_superficie)->first();
        $dados['modalidade'] = ModalidadePublicidade::find($subscricao->id_modalidade)->first();
        $dados['publicidade_normal'] = Publicidade::where([['id', $subscricao->id_publicidade]])->get()->first();

        $dados["estabelecimento"] = $estabelecimento;

        $dados['publicidade'] = TipoPublicidade::where([['id', $subscricao->it_id_tipoPublicidade]])->get()->first();
        $dados['tipo_qr'] = Tipo_qr::where('id', $subscricao->id_tipo_qr)->get()->first();
        $dados['fatura'] = Fatura::where([['it_id_subscricao', $subscricao->id]])->get()->first();

        $id = $dados['fatura']->id;
        // dd($dados);

        // dd($dados['taxas']);

        $dados['existe'] = false;
        $total = 0;
        // dd($subscricao);

        if ($subscricao->it_croqui == 0) {
            $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
        } elseif ($subscricao->it_croqui == 1) {
            # code...

            $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
        } elseif ($subscricao->it_croqui == 2) {

            # code...
            $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Nova)")->get();
            // dd($taxas);
        } else {
            $taxas = Taxa::where('it_estado', 1)->get();
        }

        // dd($subscricao->vc_alcool);
        if ($subscricao->vc_alcool == 'S') {
            $subscricao->fl_precoSubscricao *= 2;
        }

        /* $total =  $subscricao->fl_precoSubscricao;  */
        foreach ($taxas as $item) {
            if ($item->fl_valor != 0 && $item->fl_valor < 1) {

                /*  echo ($item->fl_valor * $subscricao->fl_precoSubscricao."<br>"); */
                $t = $item->fl_valor * $subscricao->fl_precoSubscricao;
                $total += $t;
                /* echo"total = ".$total."<br>"; */
                /*  $total += ($item->fl_valor * $subscricao->fl_precoSubscricao); */
            }
            // elseif ($item->fl_valor ==0) {

            //   dd('a');
            //   /*  echo ($item->fl_valor * $subscricao->fl_precoSubscricao."<br>"); */
            //     $t = $item->fl_valor + $subscricao->fl_precoSubscricao;
            //     $total += $t;
            //     /* echo"total = ".$total."<br>"; */
            //     /*  $total += ($item->fl_valor * $subscricao->fl_precoSubscricao); */
            // }
            else {

                $total += $item->fl_valor;
            }
        }

        $total += $subscricao->fl_precoSubscricao;
        $total += $dados['tipo_qr']->fl_valor;

        /* dd($dados['fatura']->fl_total);  */

        $a = intval($total);
        // dd($a);
        $dados['fatura']->fl_total = intval($dados['fatura']->fl_total);

        /* print("A:  ".$a."<br>");
        print("B:  ". $dados['fatura']->fl_total."<br>" ); */
        // dd($dados['fatura']->fl_total);

        if ($a > $dados['fatura']->fl_total) {

            $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Actualização)")
                ->where("vc_taxa", '!=', "Geolocalização(Outro)")->get()->take(6);
            /*  $dados['existe']=true; */
        } elseif ($a == $dados['fatura']->fl_total) {
            # code..
            /* dd("Igual<br>"); */
            if ($subscricao->it_croqui == 0) {
                $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } elseif ($subscricao->it_croqui == 1) {
                # code...

                $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } elseif ($subscricao->it_croqui == 2) {

                # code...
                $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Nova)")->get();
                // dd($taxas);
            }
        } else {

            /* dd("Menor<br>"); */

            /*
         */
        }
     $percentual=$this->vrf_multa($estabelecimento->id);
     $valor_multa =$percentual*$subscricao->fl_precoSubscricao;
     $dados['valor_multa']=$valor_multa;
     $dados['percentual']=$percentual;


        $idd = QrCode::size(126)->generate(route("admin.api.estabelecimento.listar", $estabelecimento->id));
        $code = (string) $idd;
        $i = $code;
        $do = substr((string) $i, 38, strlen((string) $i));
        $dados['code'] = str_replace("width=\"200\" height=\"200\"", "width=\"50\" height=\"40\"", $do);

        $css = file_get_contents("css/bootstrap.min.css");
        $css1 = file_get_contents("css/style.css");

        $html = view("admin/pdfs/fatura/index", $dados);

        // $mpdf->SetHTMLFooter('<h5><div class="text-right">'.$data.'</div></h5>');
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html);

        $mpdf->Output("Fatura Nº $id - $estabelecimento->nome", "I");
        // dd(1);
    }

    public function vrf_multa($id_estabelecimento)
    {
        $result = MultaEstabelecimento::where('id_estabelecimento', $id_estabelecimento)->where('it_multaPaga', 0)->where('it_estado', 1)->count();
        if ($result) {
            return $this->buscar_percentual($id_estabelecimento);
        }
    }

    public function buscar_percentual($id_estabelecimento)
    {

        return MultaEstabelecimento::join('motivo_multas', 'multa_estabelecimentos.id_motivo', 'motivo_multas.id')
            ->where('multa_estabelecimentos.id_estabelecimento', $id_estabelecimento)
            ->where('multa_estabelecimentos.it_estado', 1)
            ->where('multa_estabelecimentos.it_multaPaga', 0)->select('motivo_multas.fl_valor')->sum('motivo_multas.fl_valor');

    }

    public function gerarRelatorioLiquidacao($id)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);
        $data = date('d-m-Y');
        $total = 0;
        $subscricao = Subscricao::find($id);

        $estabelecimento = Estabelecimento::join('users', 'estabelecimentos.it_id_usuario', 'users.id')
            ->join('distritos', 'estabelecimentos.id_destrito', 'distritos.id')
            ->select(
                'estabelecimentos.id',
                'estabelecimentos.nif',
                'estabelecimentos.vc_endereco',
                'estabelecimentos.nome',
                'users.name',
                'users.email',
                'users.it_telefone',
                'distritos.vc_nomeDestrito'
            )
            ->where('estabelecimentos.it_estado', 1)->where([['estabelecimentos.id', $subscricao->id_estabelecimento]])->get()->first();
        $dados = [];

        $dados['taxas'] = Taxa::where('it_estado', 1)->get()->take(5);
        $dados['superficie'] = SuperficiePublicidade::find($subscricao->id_superficie)->first();
        $dados['modalidade'] = ModalidadePublicidade::find($subscricao->id_modalidade)->first();
        $dados['publicidade_normal'] = Publicidade::where([['id', $subscricao->id_publicidade]])->get()->first();

        $dados["estabelecimento"] = $estabelecimento;

        $dados['publicidade'] = TipoPublicidade::where([['id', $subscricao->it_id_tipoPublicidade]])->get()->first();
        $dados['tipo_qr'] = Tipo_qr::where('id', $subscricao->id_tipo_qr)->get()->first();
        $dados['fatura'] = Fatura::where([['it_id_subscricao', $subscricao->id]])->get()->first();

        $id = $dados['fatura']->id;
        // dd($dados);

        // dd($dados['taxas']);

        $dados['existe'] = false;
        $total = 0;
        // dd($subscricao);

        if ($subscricao->it_croqui == 0) {
            $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
        } elseif ($subscricao->it_croqui == 1) {
            # code...

            $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
        } elseif ($subscricao->it_croqui == 2) {

            # code...
            $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Nova)")->get();
            // dd($taxas);
        } else {
            $taxas = Taxa::where('it_estado', 1)->get();
        }

        // dd($subscricao->vc_alcool);
        if ($subscricao->vc_alcool == 'S') {
            $subscricao->fl_precoSubscricao *= 2;
        }

        /* $total =  $subscricao->fl_precoSubscricao;  */
        foreach ($taxas as $item) {
            if ($item->fl_valor != 0 && $item->fl_valor < 1) {

                /*  echo ($item->fl_valor * $subscricao->fl_precoSubscricao."<br>"); */
                $t = $item->fl_valor * $subscricao->fl_precoSubscricao;
                $total += $t;
                /* echo"total = ".$total."<br>"; */
                /*  $total += ($item->fl_valor * $subscricao->fl_precoSubscricao); */
            }
            // elseif ($item->fl_valor ==0) {

            //   dd('a');
            //   /*  echo ($item->fl_valor * $subscricao->fl_precoSubscricao."<br>"); */
            //     $t = $item->fl_valor + $subscricao->fl_precoSubscricao;
            //     $total += $t;
            //     /* echo"total = ".$total."<br>"; */
            //     /*  $total += ($item->fl_valor * $subscricao->fl_precoSubscricao); */
            // }
            else {

                $total += $item->fl_valor;
            }
        }

        $total += $subscricao->fl_precoSubscricao;
        $total += $dados['tipo_qr']->fl_valor;

        /* dd($dados['fatura']->fl_total);  */

        $a = intval($total);
        // dd($a);
        $dados['fatura']->fl_total = intval($dados['fatura']->fl_total);

        /* print("A:  ".$a."<br>");
        print("B:  ". $dados['fatura']->fl_total."<br>" ); */
        // dd($dados['fatura']->fl_total);

        if ($a > $dados['fatura']->fl_total) {

            $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Actualização)")
                ->where("vc_taxa", '!=', "Geolocalização(Outro)")->get()->take(6);
            /*  $dados['existe']=true; */
        } elseif ($a == $dados['fatura']->fl_total) {
            # code..
            /* dd("Igual<br>"); */
            if ($subscricao->it_croqui == 0) {
                $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } elseif ($subscricao->it_croqui == 1) {
                # code...

                $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } elseif ($subscricao->it_croqui == 2) {

                # code...
                $dados['taxas'] = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Nova)")->get();
                // dd($taxas);
            }
        } else {

            /* dd("Menor<br>"); */

            /*
         */
        }
     $percentual=$this->vrf_multa($estabelecimento->id);
     $valor_multa =$percentual*$subscricao->fl_precoSubscricao;
     $dados['valor_multa']=$valor_multa;
     $dados['percentual']=$percentual;


        // $idd = QrCode::size(126)->generate(route("admin.api.estabelecimento.listar", $estabelecimento->id));
        // $code = (string) $idd;
        // $i = $code;
        // $do = substr((string) $i, 38, strlen((string) $i));
        // $dados['code'] = str_replace("width=\"200\" height=\"200\"", "width=\"50\" height=\"40\"", $do);

        $css = file_get_contents("css/bootstrap.min.css");
        $css1 = file_get_contents("css/style.css");

        $html = view("admin/pdfs/fatura/nota_liquidacao/index", $dados);

        // $mpdf->SetHTMLFooter('<h5><div class="text-right">'.$data.'</div></h5>');
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html);


     
        $mpdf->Output("Fatura Nº $id - $estabelecimento->nome", "I");
        // dd(1);
    }

}
