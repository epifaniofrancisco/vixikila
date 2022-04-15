<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CancelamentoSubscricao;
use App\Models\CategoriaPublicidade;
use App\Models\Estabelecimento;
use App\Models\Fatura;
use App\Models\Logg;
use App\Models\ModalidadeDePagemento;
use App\Models\Publicidade;
use App\Models\Subscricao;
use App\Models\Taxa;
use App\Models\TaxaLicenca\ModalidadePublicidade;
use App\Models\TaxaLicenca\TipoPublicidade;
use App\Models\TaxaLicenca\UcfLocalidade;
use App\Models\TaxaLicenca\UcfLocalidadeValore;
use App\Models\Tipo_qr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscricaoController extends Controller
{
    public $log;
    public function __construct()
    {
        $this->log = new Logg();
    }

    public function paginaCadastrar()
    {
        $dados['dis'] = "none";
        // $dados['users'] = User::all();
        $dados['categoriaPublicidades'] = CategoriaPublicidade::where('it_estado', 1)->get();
        // $dados['publicidades'] = Publicidade::where('it_estado_apr_publicidade', 1)->where('it_estado', 1)->get();
        $dados['publicidades'] = Publicidade::where('it_estado', 1)->get();
        $dados['modalidades'] = ModalidadeDePagemento::where('it_estado', 1)->get();
        $dados['estabelecimentos'] = Estabelecimento::where('it_estado', 1)->get();
        $dados['tipo_qrs'] = Tipo_qr::where('it_estado', 1)->get();
        $dados['tipos_publicidade'] = TipoPublicidade::where('it_estado', 1)->get();

        // dd($dados);
        return view('admin.subscricao.cadastrar.index', $dados);
    }

    public function paginaEditar($id)
    {
        $dados['id'] = $id;
        $dados['dis'] = " ";
        $dados['subscricao'] = $this->subscricoes()
            ->where('subscricaos.id', $id)
            ->select('users.name', 'tipo_publicidades.vc_nome as vc_tipoPublicidade',
                'superficie_publicidades.vc_nome as vc_superficie', 'estabelecimentos.nome as nome_estabelecimento',
                'modalidade_publicidades.vc_nome as vc_modalidade',
                //  'ucf_localidade_valores.fl_custo as fl_custo_ufc',
                'subscricaos.*',
                'tipo_qrs.vc_tipo', 'tipo_qrs.fl_valor', 'publicidades.vc_nomePublicidade as vc_publicidade')
            ->first();

        $dados['tipos_publicidade'] = TipoPublicidade::where('it_estado', 1)->get();
        $subscricao = Subscricao::find($id);
        $dados['publicidades'] = Publicidade::where('it_estado_apr_publicidade', 1)->where('it_estado', 1)->get();
        $dados['superficies'] = DB::table("superficie_publicidades")
            ->where('it_id_tipoPublicidade', $dados['subscricao']->it_id_tipoPublicidade)
            ->where('it_estado', 1)
            ->get();
        $dados['UcfLocalidadeValore'] = UcfLocalidadeValore::where('it_id_superficiePublicidade', $dados['subscricao']->id_superficie)
            ->where('it_id_modalidadePublicidade', $dados['subscricao']->id_modalidade)
            ->first();
        $dados['ufLocalidade'] = UcfLocalidade::find($dados['UcfLocalidadeValore']->it_id_ucfLocalidade);

        $dados['modalidades'] = DB::table("modalidade_publicidades")->where('modalidade_publicidades.it_estado', 1)->get();

        //   $dados['subscricao']=   $dados['subscricao']->max();

//dd( $dados['superficies']);
        // dd($subscricao);
        // $dados['users'] = User::all();
        // $dados['userSelecionado'] = User::where([['id', $subscricao->id_usuario]])->get()->first();
        //        $dados['publicidades'] = Publicidade::where('it_estado', 1)->get();
        //        $dados['publicidadeSelecionado'] = Publicidade::where([['id', $subscricao->id_publicidade]])->get()->first();
        //        $dados['modalidades'] = ModalidadeDePagemento::where('it_estado', 1)->get();
        //        $dados['modalidadeSelecionado'] = ModalidadeDePagemento::where([['id', $subscricao->id_modalidade]])->get()->first();
        $dados['estabelecimentos'] = Estabelecimento::where('it_estado', 1)->get();
//        $dados['estabelecimentoSelecionado'] = Estabelecimento::where([['id', $subscricao->id_estabelecimento]])->get()->first();
        $dados['tipo_qrs'] = Tipo_qr::where('it_estado', 1)->get();
//        $dados['tipo_qrSelecionado'] = Tipo_qr::where([['id', $subscricao->id_tipo_qr]])->get()->first();
        //        $dados['subscricao'] = Subscricao::find($id);
        //        $dados['categoriaPublicidades'] = CategoriaPublicidade::where('it_estado', 1)->get();
        //        // dd($dados);
        return view('admin.subscricao.editar.index', $dados);
    }

    public function listar()
    {

        $dados['subscricoes'] = $this->subscricoes()
            // ->where('subscricaos.it_estado_apr_subscricao', 1)
            ->select('subscricaos.id', 'publicidades.vc_nomePublicidade as vc_publicidade', 'users.name', 'tipo_publicidades.vc_nome as vc_nomePublicidade', 'superficie_publicidades.vc_nome as vc_nomeCategoria', 'estabelecimentos.nome', 'subscricaos.it_validacaoSubscricao', 'subscricaos.it_estado_apr_subscricao')
            ->where('subscricaos.it_estado',1)
            ->get();
        //    dd(    $dados['subscricoes']);
        return view('admin.subscricao.listar.index', $dados);
    }
    public function subscricoes()
    {
        return DB::table('subscricaos')

            ->join('users', 'subscricaos.id_usuario', 'users.id')
            ->join('tipo_publicidades', 'subscricaos.it_id_tipoPublicidade', 'tipo_publicidades.id')
            ->join('tipo_qrs', 'subscricaos.id_tipo_qr', 'tipo_qrs.id')
            ->join('modalidade_publicidades', 'subscricaos.id_modalidade', 'modalidade_publicidades.id')
            ->join('estabelecimentos', 'subscricaos.id_estabelecimento', 'estabelecimentos.id')
        //  ->join('ucf_localidade_valores', 'ucf_localidade_valores.it_id_modalidadePublicidade', 'modalidade_publicidades.id')
        //  ->join('ucf_localidades', 'ucf_localidade_valores.it_id_ucfLocalidade', 'ucf_localidades.id')
        // ->join('superficie_publicidades', 'ucf_localidade_valores.it_id_superficiePublicidade', 'superficie_publicidades.id')
            ->join('publicidades', 'subscricaos.id_publicidade', 'publicidades.id')
            ->join('superficie_publicidades', 'subscricaos.id_superficie', 'superficie_publicidades.id');
    }

    public function listar_nao_aprovadas()
    {
        $dados['subscricoes'] = $this->subscricoes()
            ->where('subscricaos.it_estado_apr_subscricao', 0)
            ->select('subscricaos.id', 'users.name', 'publicidades.vc_nomePublicidade as vc_publicidade', 'tipo_publicidades.vc_nome as vc_nomePublicidade', 'superficie_publicidades.vc_nome as vc_nomeCategoria', 'estabelecimentos.nome', 'subscricaos.it_validacaoSubscricao', 'subscricaos.it_estado_apr_subscricao')
            ->get();
        $dados['ESTADO'] = 'não aprovadas';
        // dd($dados);
        return view('admin.subscricao.listar.index', $dados);
    }

    public function cadastrar(Request $form)
    {
     
        try {
            
//            $dados = $form->validate([
            //                'id_modalidade' => 'required|max:255',
            //                'it_id_tipoPublicidade' => 'required|max:255',
            //                'id_estabelecimento' => 'required|max:255',
            //                'id_tipo_qr' => 'required|max:255',
            //                // 'id_user' => 'required|max:255',
            //                'fl_precoSubscricao' => 'required|max:255',
            //            ]);

            $estabelecimento = Estabelecimento::where('id', $form->id_estabelecimento)->get()->first();
            

            $subs = Subscricao::where('id_estabelecimento', $form->id_estabelecimento)
                ->where('id_publicidade', $form->id_publicidade)
                ->where('it_estado', 1)
                /* ->where('id_superficie', $form->id_superficie)
                ->where('it_id_tipoPublicidade', $form->it_id_tipoPublicidade)
                ->where('id_modalidade', $form->id_modalidade)
                ->where('id_modalidade', $form->id_modalidade)
                ->where('id_tipo_qr', $form->id_tipo_qr) */
                ->get()->first();
                

            $existe = false;
            if ($subs) {
                $existe = true;
            }
            

            /*  dd($form->it_croqui); */

            $subscricao = Subscricao::create([
                'id_publicidade' => $form->id_publicidade,
                'id_modalidade' => $form->id_modalidade,
                'it_id_tipoPublicidade' => $form->it_id_tipoPublicidade,
                'id_estabelecimento' => $form->id_estabelecimento,
                'id_tipo_qr' => $form->id_tipo_qr,
                'id_usuario' => $form->id_cliente,
                'it_validacaoSubscricao' => '1',
                'fl_precoSubscricao' => $form->fl_precoSubscricao,
                'id_superficie' => $form->id_superficie,
                'it_cancelamento' => 0,
                'it_croqui' => $form->it_croqui,
                'it_estado' => 1,
                'vc_matricula' => $form->vc_matricula,
                'vc_alcool' => $form->vc_alcool,
                'fl_comprimento' => $form->fl_comprimento,
                'fl_largura' => $form->fl_largura,

            ]);

            $publicidade = TipoPublicidade::where([['id', $subscricao->it_id_tipoPublicidade]])->get()->first();
//            $modalidade = ModalidadeDePagemento::where([['id', $subscricao->id_modalidade]])->get()->first();
            $modalidadePublicidade = ModalidadePublicidade::where([['id', $form->id_modalidade]])->get()->first();
            $tipo_qr = Tipo_qr::where([['id', $subscricao->id_tipo_qr]])->get()->first();

//            $data = date('d-m-Y', strtotime("+$periodo->dt_tempo day"));

            $descricao = "$publicidade->vc_nome/ $modalidadePublicidade->vc_nome";
            $total = 0;
            // $form->it_croqui
            if ($existe) {

                $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } else {

                if ($form->it_croqui == 0) {
                    $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
                } elseif ($form->it_croqui == 1) {
                    # code...
                    $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
                } elseif ($form->it_croqui == 2) {
                    # code...
                    $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Nova)")->get();
                }

            }

            $publicidade = Publicidade::where('id_estabelecimento', $form->id_estabelecimento)->first();

            if ($publicidade->vc_alcool == 'S') {
                $subscricao->fl_precoSubscricao *= 2;
            }

            /* $total =  $subscricao->fl_precoSubscricao;  */
            foreach ($taxas as $item) {
                if ($item->fl_valor != 0 && $item->fl_valor < 1) {
                    /* echo ($item->fl_valor * ( $form->fl_precoSubscricao + 0))."<br>"; */
                    $total += ($item->fl_valor * ($form->fl_precoSubscricao + 0));

                } else {
                    /*  echo "$item->fl_valor <br>"; */
                    $total += $item->fl_valor;

                }
            }

            $total += $subscricao->fl_precoSubscricao;
            $total += $tipo_qr->fl_valor;
            $n_publicidades = Publicidade::where('id_estabelecimento', $form->id_estabelecimento)->count();
            // dd($n_publicidades,$total+ $tipo_qr->fl_valor,!$n_publicidades);
            /*   if ($n_publicidades) {
            $total += $tipo_qr->fl_valor;
            } */
            /*   dd($total); */
            Fatura::create([
                'vc_descricao' => $descricao,
                'it_id_tipoPublicidade' => $subscricao->it_id_tipoPublicidade,
                'it_id_usuario' => $subscricao->id_usuario,
                'it_id_subscricao' => $subscricao->id,
                'fl_qtd_publicidade' => 1,
                'fl_valor_publicidade' => $subscricao->fl_precoSubscricao,
                'vc_licenca' => $subscricao->id,
                'dt_licenca' => null,

                'dt_pagamento' => isset($form->dt_pagamento) ? $form->dt_pagamento : date('d-m-Y'),
                'fl_total' => $total,
                'it_validacao_fatura' => 0,
                'it_estado' => 1,
            ]);

            $estabelecimento = Estabelecimento::where([['id', $subscricao->id_estabelecimento]])->get()->first();

            $ultima_subscricao = Subscricao::orderBy('id', 'Desc')->limit(1)->get();
            $actividade = "Cadastrou a subscrição de dados modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " . $modalidadePublicidade->vc_nome . ", " . $publicidade->vc_nome . ", " . $estabelecimento->nome . ", " . $tipo_qr->vc_tipo . ", " . $ultima_subscricao[0]->fl_precoSubscricao . " )";
            $this->log->Log('info', $actividade);

            return redirect()->back()->with("subscricao.cadastrar.true", '1');
        } catch (\Throwable $th) {

            return redirect()->back()->with("subscricao.cadastrar.false", '1');
        }
    }

    public function editar(Request $form, $id)
    {

        $sub = Subscricao::find($id);

        // $modNova = ModalidadePublicidade::find($form->id_modalidade);
        // $modCorrente = ModalidadePublicidade::find($sub->id_modalidade );
        // $form->fl_precoSubscricao = ($sub->fl_precoSubscricao * $modNova->it_dias) / $modCorrente->it_dias;

        $estabelecimento = Estabelecimento::where('id', $form->id_estabelecimento)->get()->first();
        $modalidadePublicidade = ModalidadePublicidade::where([['id', $form->id_modalidade]])->get()->first();

        $subscricao = Subscricao::where('id', $id)->update(
            [
                'id_modalidade' => $form->id_modalidade,
                'it_id_tipoPublicidade' => $form->it_id_tipoPublicidade,
                'id_estabelecimento' => $form->id_estabelecimento,
                'id_tipo_qr' => $form->id_tipo_qr,
                'id_usuario' => $form->id_cliente,
                'it_validacaoSubscricao' => '1',
                'fl_precoSubscricao' => $form->fl_precoSubscricao,
                'id_superficie' => $form->id_superficie,
                'it_cancelamento' => 0,
                'it_croqui' => $form->it_croqui,
                'it_estado' => 1,
                'vc_matricula' => $form->vc_matricula,
                'vc_alcool' => $form->vc_alcool,
                'fl_comprimento' => $form->fl_comprimento,
                'fl_largura' => $form->fl_largura,
            ]
        );
        $subscricao = Subscricao::find($id);

// dd($subscricao);
        if ($subscricao) {
            $publicidade = TipoPublicidade::where([['id', $subscricao->it_id_tipoPublicidade]])->get()->first();
//            $modalidade = ModalidadeDePagemento::where([['id', $subscricao->id_modalidade]])->get()->first();

            $tipo_qr = Tipo_qr::where([['id', $subscricao->id_tipo_qr]])->get()->first();

//            $data = date('d-m-Y', strtotime("+$periodo->dt_tempo day"));
            $descricao = "$publicidade->vc_nome/ $modalidadePublicidade->vc_nome";
            $total = 0;
            if ($form->it_croqui == 0) {
                $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } elseif ($form->it_croqui == 1) {
                # code...
                $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Nova)")->where("vc_taxa", '!=', "Geolocalização(Outro)")->get();
            } elseif ($form->it_croqui == 2) {
                # code...
                $taxas = Taxa::where('it_estado', 1)->where("vc_taxa", '!=', "Geolocalização(Actualização)")->where("vc_taxa", '!=', "Geolocalização(Nova)")->get();
            } else {
                $taxas = Taxa::where('it_estado', 1)->get();
            }

            // dd($form->fl_precoSubscricao);
            $publicidade_verifica_taxa = Publicidade::where("vc_alcool", $form->vc_alcool)->first();
            //  dd($form->vc_alcool);
            // if ($form->vc_alcool == 'S') {
            // dd($form->fl_precoSubscricao);
            if ($publicidade_verifica_taxa->vc_alcool === 'S') {

                // dd($form->fl_precoSubscricao*=2);
                $form->fl_precoSubscricao *= 2;
            }
            // dd(print_r($taxas));
            foreach ($taxas as $item) {

                if ($item->fl_valor != 0 && $item->fl_valor < 1) {
                    /* echo ($item->fl_valor * ( $form->fl_precoSubscricao + 0))."<br>"; */
                    $total += ($item->fl_valor * ($form->fl_precoSubscricao + 0));

                } else {
                    /*  echo "$item->fl_valor <br>"; */
                    $total += $item->fl_valor;

                }

                /* echo " TOTAL APÓS:   $total <br>"; */

            }

            $total += $form->fl_precoSubscricao;
            /*  dd($total); */
            $total += $tipo_qr->fl_valor;

            // dd($total, $form->fl_precoSubscricao);
            $fatura = Fatura::where([['it_id_subscricao', $id]])->get()->first();
            // dd($fatura);

            $periodo = ModalidadePublicidade::where('id', $subscricao->id_modalidade)->get()->first();

            $data = date('d-m-Y', strtotime("+$periodo->it_dias day", strtotime(isset($form->dt_pagamento) ? $form->dt_pagamento : $fatura->dt_pagamento)));
            $dt_licencaEUA = date('Y-m-d', strtotime($data));
            Fatura::where([['it_id_subscricao', $id]])->update([
                'vc_descricao' => $descricao,
                'it_id_tipoPublicidade' => $form->it_id_tipoPublicidade,
                'it_id_usuario' => $form->id_cliente,
                'it_id_subscricao' => $id,
                'fl_qtd_publicidade' => 1,
                'fl_valor_publicidade' => $form->fl_precoSubscricao,
                'vc_licenca' => $form->id,
                'dt_licenca' => $data,
                'dt_licencaEUA' => $dt_licencaEUA,

                'dt_pagamento' => isset($form->dt_pagamento) ? $form->dt_pagamento : $fatura->dt_pagamento,
                'fl_total' => $total,

                'it_validacao_fatura' => $fatura->it_validacao_fatura,
                'it_estado' => 1,
            ]);

        }

//        $publicidade = Publicidade::where([['id', $form->id_publicidade]])->get()->first();
        //        $modalidade = ModalidadeDePagemento::where([['id', $form->id_modalidade]])->get()->first();
        //        $estabelecimento = Estabelecimento::where('id', $form->id_estabelecimento)->get()->first();
        $tipo_qr = Tipo_qr::where([['id', $form->id_tipo_qr]])->get()->first();
//
        $actividade = "Editou a subiscrição de modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " . $modalidadePublicidade->vc_nome . ", " . $publicidade->vc_nome . ", " . $estabelecimento->nome . ", " . $tipo_qr->vc_tipo . ", " . $subscricao->fl_precoSubscricao . " ) para( " . $modalidadePublicidade->vc_nome . ", " . $publicidade->vc_nome . ", " . $estabelecimento->nome . ", " . $tipo_qr->vc_tipo . ", " . $form->fl_precoSubscricao . " ) ";

        $this->log->Log('info', $actividade);
        return redirect()->route('admin.subscricao.listar')->with("subscricao.editar.true", '1');
    }
    public function dataPt_To_dataEUA($data)
    {

    }
    public function eliminar($id)
    {
        $subs = Subscricao::find($id)->first();
        $publi = Publicidade::where([['id', $subs->id_publicidade]])->get()->first();
        $moda = ModalidadeDePagemento::where([['id', $subs->id_modalidade]])->get()->first();
        $esta = Estabelecimento::where('id', $subs->id_estabelecimento)->get()->first();
        $tipo = Tipo_qr::where([['id', $subs->id_tipo_qr]])->get()->first();
        $periodo = ModalidadePublicidade::where('id', $subs->id_modalidade)->get()->first();
        Subscricao::where('id', $id)->update(
            [
                'it_estado' => 0,
            ]
        );

        $actividade = "Eliminou a subiscrição de modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " .  $periodo->vc_nome . ", " . $publi->vc_nomePublicidade . ", " . $esta->nome . ", " . $tipo->vc_tipo . ", " . $subs->fl_precoSubscricao . " )";

        $this->log->Log('info', $actividade);
        return redirect()->back()->with("subscricao.eliminar.true", '1');
    }

    public function cancelar($id)
    {
        $data = Subscricao::find($id);

        // dd($data);

        $subs = Subscricao::find($id)->first();
        $publi = Publicidade::where([['id', $subs->id_publicidade]])->get()->first();
        $moda = ModalidadeDePagemento::where([['id', $subs->id_modalidade]])->get()->first();
        $esta = Estabelecimento::where('id', $subs->id_estabelecimento)->get()->first();
        $tipo = Tipo_qr::where([['id', $subs->id_tipo_qr]])->get()->first();

        Subscricao::where('id', $id)->update(
            [
                'it_cancelamento' => 1,
            ]
        );
        CancelamentoSubscricao::create([
            'id_usuario' => $data->id_usuario,
            'id_subscricao' => $data->id,
            'it_estado' => 1,

        ]);

        $actividade = "Cancelou a subiscrição de modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " .  $periodo->vc_nome . ", " . $publi->vc_nomePublicidade . ", " . $esta->nome . ", " . $tipo->vc_tipo . ", " . $subs->fl_precoSubscricao . " )";
        $this->log->Log('info', $actividade);

        return redirect()->back()->with("subscricao.eliminar.true", '1');
    }

    public function purgar($id)
    {
        $subs = Subscricao::find($id)->first();
        $publi = Publicidade::where([['id', $subs->id_publicidade]])->get()->first();
        $moda = ModalidadeDePagemento::where([['id', $subs->id_modalidade]])->get()->first();
        $esta = Estabelecimento::where('id', $subs->id_estabelecimento)->get()->first();
        $tipo = Tipo_qr::where([['id', $subs->id_tipo_qr]])->get()->first();

        Subscricao::find($id)->delete();

        $actividade = "Purgou a subiscrição de modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " .  $periodo->vc_nome . ", " . $publi->vc_nomePublicidade . ", " . $esta->nome . ", " . $tipo->vc_tipo . ", " . $subs->fl_precoSubscricao . " )";
        $this->log->Log('info', $actividade);

        return redirect()->back()->with("subscricao.purgar.true", '1');
    }

    public function validar($id)
    {
        $data = Subscricao::find($id);
        if ($data->it_validacaoSubscricao == 1) {
            $data->update(['it_validacaoSubscricao' => 0]);
            $actividade = "Tirou a validação à subscrição de id " . $id;
            $this->log->Log('info', $actividade);
        } else {
            $data->update(['it_validacaoSubscricao' => 1]);
            $actividade = "Validou a subscrição de id " . $id;
            $this->log->Log('info', $actividade);
        }
        return redirect()->back()->with("subscricao.validar.true", '1');
    }

    public function aprovar($id)
    {
        $subs = Subscricao::find($id);
        $tipoPublicidade = TipoPublicidade::where([['id', $subs->it_id_tipoPublicidade]])->get()->first();
//        $moda = ModalidadeDePagemento::where([['id', $subs->id_modalidade]])->get()->first();
        $esta = Estabelecimento::where('id', $subs->id_estabelecimento)->get()->first();
        $tipo = Tipo_qr::where([['id', $subs->id_tipo_qr]])->get()->first();
        $sub = Subscricao::find($id);
        Subscricao::where('id', $id)->update(
            [
                'it_estado_apr_subscricao' => 1,
            ]
        );
//            $subscricao = Subscricao::where([['id', $id]])->get()->first();
        //            $modalidade = ModalidadeDePagemento::where([['id', $subscricao->id_modalidade]])->get()->first();
        $periodo = ModalidadePublicidade::where('id', $subs->id_modalidade)->get()->first();

//dd($periodo);
        $fat = Fatura::where("it_id_subscricao",$id)->get()->first();
        //dd( $fat);
        $dt_licencaEUA_demo = date('d-m-Y', strtotime($fat->dt_pagamento));
     
        // $data = date($fat->dt_pagamento, strtotime("$periodo->it_dias day"));
      $data=date('d-m-Y', strtotime('+'.$periodo->it_dias .' days', strtotime($dt_licencaEUA_demo)));
      

  

        $dt_licencaEUA_demo = date('Y-m-d', strtotime($data));

        // dd(   $data,$dt_licencaEUA_demo,$fat->dt_pagamento);
        $dt_licencaEUA = date($fat->dt_pagamento, strtotime($data));
        Fatura::where([['it_id_subscricao', $id]])->update([
            'it_validacao_fatura' => 1,
            'dt_licenca' => $data,
            'dt_licencaEUA' => $dt_licencaEUA,
        ]);


        // $data = date('d-m-Y', strtotime("+$periodo->it_ds day"));ia
        // $dt_licencaEUA = date('Y-m-d', strtotime($data));
        // Fatura::where([['it_id_subscricao', $id]])->update([
        //     'it_validacao_fatura' => 1,
        //     'dt_licenca' => $data,
        //     'dt_licencaEUA' => $dt_licencaEUA,
        //     'dt_pagamento' => date('d-m-Y'),
        // ]);

        $actividade = "Aprovou a subiscrição de modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " . $periodo->vc_nome . ", " . $tipoPublicidade->vc_nome . ", " . $esta->nome . ", " . $tipo->vc_tipo . ", " . $subs->fl_precoSubscricao . " )";
//
        $this->log->Log('info', $actividade);
        /* return redirect()->back()->with("subscricao.aprovou.true", '1'); */
         return response()->json($subs); 
    }

    public function reprovar($id)
    {

        $subs = Subscricao::find($id)->first();
        $publi = Publicidade::where([['id', $subs->id_publicidade]])->get()->first();
        // $moda = ModalidadeDePagemento::find($subs->id_modalidade);
        $periodo = ModalidadePublicidade::where('id', $subs->id_modalidade)->get()->first();
    
        $esta = Estabelecimento::where('id', $subs->id_estabelecimento)->get()->first();
        $tipo = Tipo_qr::where([['id', $subs->id_tipo_qr]])->get()->first();

        Subscricao::where('id', $id)->update(
            [
                'it_estado_apr_subscricao' => 0,
            ]
        );

        Fatura::where([['it_id_subscricao', $id]])->update([
            'it_validacao_fatura' => 0,
            'dt_licenca' => null,
        ]);

        $actividade = "Reprovou a subiscrição de modalidade,publicidade, estabelecimento, tipo de QrCode e preco( " . $periodo->vc_nome. ", " . $publi->vc_nomePublicidade . ", " . $esta->nome . ", " . $tipo->vc_tipo . ", " . $subs->fl_precoSubscricao . " )";
        $this->log->Log('info', $actividade);
        $this->log->Log('info', $actividade);
       /*  return redirect()->back()->with("subscricao.reprovou.true", '1'); */
       return response()->json($subs);
    }
}
