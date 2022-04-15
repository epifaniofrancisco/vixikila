<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModalidadeDePagemento;
use Illuminate\Support\Facades\Log;
use App\Models\Logg;
use App\Models\PeriodoModalidade;

class ModalidadePagamentoController extends Controller
{
    public $log;
    public function __construct(){
      $this->log = new Logg();
    }

    public function paginaCadastrar()
    {
        $dados['periodos'] = PeriodoModalidade::get();
        return view('admin.modalidade_de_pagamento.cadastrar.index', $dados);
    }
    
    public function paginaEditar($id)
    {
        $modalidade = ModalidadeDePagemento::find($id);
        $dados['modalidade'] = ModalidadeDePagemento::find($id);
        $dados['periodos'] = PeriodoModalidade::get();
        $dados['periodoSelecionado'] = PeriodoModalidade::where([['id', $modalidade->it_id_periodo_modalidade]]);
        return view('admin.modalidade_de_pagamento.editar.index', $dados);
    }

    public function listar()
    {
        $dados['modalidades'] = ModalidadeDePagemento::where('it_estado', 1)->get();
        //dd($dados);

        return view('admin.modalidade_de_pagamento.listar.index', $dados);
    }

    public function cadastrar(Request $form)
    {
       // dd($form);
        $dados = $form->validate([
            'vc_nomeModalidade' => 'required|max:255',
            'it_multiplo' => 'required|max:255',
        ]);
        ModalidadeDePagemento::create([
            'vc_nomeModalidade' => $form->vc_nomeModalidade,
            'it_multiplo' => $form->it_multiplo,
            'it_id_periodo_modalidade' => $form->it_id_periodo_modalidade,
            'it_estado' => 1,
        ]);

        $ultima_modalidade=ModalidadeDePagemento::orderBy('id','Desc')->limit(1)->get();
        $periodo = PeriodoModalidade::find($ultima_modalidade[0]->it_id_periodo_modalidade)->first();


         $actividade="Cadastrou a modalidade de pagamento com os dados nome, múltiplo, periodo de modalidade( ".$ultima_modalidade[0]->vc_nomeModalidade.", ".$ultima_modalidade[0]->it_multiplo.", ".$periodo->vc_periodo."  )";

        $this->log->Log('info', $actividade);
   

        return redirect()->back()->with("modalidade.cadastrar.true", '1');
    }

    public function editar(Request $form, $id)
    {

        $modalidade=ModalidadeDePagemento::find($id)->first();
        $periodo = PeriodoModalidade::find($modalidade->it_id_periodo_modalidade)->first();

        ModalidadeDePagemento::where('id', $id)->update(
            [
                'vc_nomeModalidade' => $form->vc_nomeModalidade,
                'it_multiplo' => $form->it_multiplo,
                'it_id_periodo_modalidade' => $form->it_id_periodo_modalidade,
            ]
        );


        $novo_p = PeriodoModalidade::find($form->it_id_periodo_modalidade)->first();
        $actividade="Editou a modalidade de pagamento de nome, múltiplo, periodo de modalidade( ".$modalidade->vc_nomeModalidade.", ".$modalidade->it_multiplo.", ".$periodo->vc_periodo." ) para( ".$form->vc_nomeModalidade.", ".$form->it_multiplo.", ".$novo_p->vc_periodo." ) ";

        $this->log->Log('info', $actividade);
        return redirect()->back()->with("modalidade.editar.true", '1');
    }

    public function eliminar($id)
    {

        $modalidade=ModalidadeDePagemento::find($id)->first();
        $periodo = PeriodoModalidade::find($modalidade->it_id_periodo_modalidade)->first();

        ModalidadeDePagemento::where('id', $id)->update(
            [
                'it_estado' => 0
            ]
        );
         $actividade="Eliminou a  modalidade de pagamento de nome, múltiplo, periodo de modalidade( ".$modalidade->vc_nomeModalidade.", ".$modalidade->it_multiplo.", ".$periodo->vc_periodo." )";
        $this->log->Log('info', $actividade);

        return redirect()->back()->with("modalidade.eliminar.true", '1');
    }

    public function purgar($id)
    {

        $modalidade=ModalidadeDePagemento::find($id)->first();
        $periodo = PeriodoModalidade::find($modalidade->it_id_periodo_modalidade)->first();

        ModalidadeDePagemento::find($id)->delete();

        $actividade="Purgou a  modalidade de pagamento de nome, múltiplo, periodo de modalidade( ".$modalidade->vc_nomeModalidade.", ".$modalidade->it_multiplo.", ".$periodo->vc_periodo." )";
        $this->log->Log('info', $actividade);

        return redirect()->back()->with("modalidade.purgar.true", '1');
    }
} 
