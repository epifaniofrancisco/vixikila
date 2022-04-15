<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CategoriaPublicidade;
use App\Models\Estabelecimento;
use App\Models\Logg;
use App\Models\Publicidade;
use App\Models\TaxaLicenca\TipoPublicidade;
use App\Models\Tipo_qr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Subscricao;
use App\Models\Taxa;
use App\Models\Fatura;
use App\Models\TaxaLicenca\ModalidadePublicidade;
class SubscricaoController extends Controller
{
    //
    public $log;
    public function __construct()
    {
        $this->log = new Logg();
    }

    public function index()
    {

        $dados['subscricoes'] = $this->subscricoes()->distinct()
        
        ->select('subscricaos.id', 'users.name', 'publicidades.vc_nomePublicidade as vc_publicidade' , 'tipo_publicidades.vc_nome as vc_nomePublicidade', 'superficie_publicidades.vc_nome as vc_nomeCategoria', 'estabelecimentos.nome', 'subscricaos.it_validacaoSubscricao', 'subscricaos.it_estado_apr_subscricao')
      ->where('users.id', Auth::id())
            ->get();
            // dd(  $dados['subscricoes']);

        return view('site/subescricao/index', $dados);
    }

    public function subscricoes(){
        return  DB::table('subscricaos')
            ->join('users', 'subscricaos.id_usuario', 'users.id')
            ->join('tipo_publicidades', 'subscricaos.it_id_tipoPublicidade', 'tipo_publicidades.id')
             ->join('tipo_qrs', 'subscricaos.id_tipo_qr', 'tipo_qrs.id')
            ->join('modalidade_publicidades', 'subscricaos.id_modalidade', 'modalidade_publicidades.id')
            ->join('estabelecimentos', 'subscricaos.id_estabelecimento', 'estabelecimentos.id')
            //  ->join('ucf_localidade_valores', 'ucf_localidade_valores.it_id_modalidadePublicidade', 'modalidade_publicidades.id')
            //  ->join('ucf_localidades', 'ucf_localidade_valores.it_id_ucfLocalidade', 'ucf_localidades.id')
            // ->join('superficie_publicidades', 'ucf_localidade_valores.it_id_superficiePublicidade', 'superficie_publicidades.id')
            ->join('publicidades', 'subscricaos.id_publicidade', 'publicidades.id')
            ->join('superficie_publicidades', 'subscricaos.id_superficie', 'superficie_publicidades.id')
            ;
    }

    public function paginaCadastrar()
    {
        $user = Auth::user();
        // $dados['tipoPublicidade'] = TipoPublicidade::select('id', 'vc_nome')->get();
        // $dados['users'] = User::all();
        $dados['dis'] = "none";
        $dados['publicidades'] = Publicidade::where([['it_estado', 1], ['id_user', $user->id]])->get();
        $dados['categoriaPublicidades'] = CategoriaPublicidade::where('it_estado', 1)->get();

        $dados['tipo_qrs'] = Tipo_qr::where('it_estado', 1)->get();
        $dados['tipos_publicidade'] = TipoPublicidade::where('it_estado', 1)->get();
        $dados['estabelecimentos'] = Estabelecimento::where([['it_estado', 1], ['it_id_usuario', $user->id]])->get();
        $dados['tipo_qrs'] = Tipo_qr::where('it_estado', 1)->get();
        // $dados['tipos_publicidade'] = TipoPublicidade::where('it_estado',1)->get();
        $dados['tipos_publicidade'] = TipoPublicidade::select('id', 'vc_nome')->get();
        return view('site.subescricao.subescrever.index', $dados);
    }

    public function cadastrar(Request $form)
    {
//         dd($form);
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
            ->where('it_estado',1)
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
                
                $taxas = Taxa::where('it_estado', 1)->where("vc_taxa",'!=',"Geolocalização(Nova)")->where("vc_taxa",'!=',"Geolocalização(Actualização)")->where("vc_taxa",'!=',"Geolocalização(Outro)")->get();
            }else{
                

                if( $form->it_croqui == 0){
                    $taxas = Taxa::where('it_estado', 1)->where("vc_taxa",'!=',"Geolocalização(Actualização)")->where("vc_taxa",'!=',"Geolocalização(Outro)")->get();
                }elseif ($form->it_croqui == 1) {
                    # code...
                    $taxas = Taxa::where('it_estado', 1)->where("vc_taxa",'!=',"Geolocalização(Nova)")->where("vc_taxa",'!=',"Geolocalização(Outro)")->get();
                } elseif ($form->it_croqui == 2) {
                    # code...
                    $taxas = Taxa::where('it_estado', 1)->where("vc_taxa",'!=',"Geolocalização(Actualização)")->where("vc_taxa",'!=',"Geolocalização(Nova)")->get();
                }
               
            }
           
             $publicidade= Publicidade::where('id_estabelecimento', $form->id_estabelecimento)->first();

            if ($publicidade->vc_alcool == 'S') {
                $subscricao->fl_precoSubscricao *= 2;
            }

             /* $total =  $subscricao->fl_precoSubscricao;  */
            foreach ($taxas as $item) {
                if ($item->fl_valor != 0 && $item->fl_valor < 1) {
                    /* echo ($item->fl_valor * ( $form->fl_precoSubscricao + 0))."<br>"; */
                    $total += ($item->fl_valor * ( $form->fl_precoSubscricao + 0));
                    
                } 
                else {
                   /*  echo "$item->fl_valor <br>"; */
                    $total += $item->fl_valor;

                }
            }

            

            $total += $subscricao->fl_precoSubscricao;
            $total += $tipo_qr->fl_valor;
            $n_publicidades = Publicidade::where('id_estabelecimento', $form->id_estabelecimento)->count();
            // dd($n_publicidades,$total+ $tipo_qr->fl_valor,!$n_publicidades);
           /*  if ($n_publicidades) {
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

                'dt_pagamento' => date('d-m-Y'),
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

}
