<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcao;
use Illuminate\Support\Facades\Log;
use App\Models\Logg;

class FuncaoController extends Controller
{
    public $log;
    public function __construct(){
      $this->log = new Logg();
    }
    
    public function paginaCadastrar()
    {

        return view('admin.funcao.cadastrar.index');
    }

    public function paginaEditar($id)
    {
      $dados['funcao'] =Funcao::find($id);
      return view('admin.funcao.editar.index',$dados);
      
    }

    public function listar()
    {

      $dados['funcoes'] = Funcao::where('it_estado',1)->get();
      return view('admin.funcao.listar.index',$dados);

  
    }

    public function cadastrar(Request $form)
    {
   //   dd($form);

      Funcao::create([
        'vc_nomeFuncao' => $form->vc_nomeFuncao, 
        'it_estado' => 1
      ]);

      $ultima_funcao=Funcao::orderBy('id','Desc')->limit(1)->get();
      $actividade="Cadastrou a funcao de nome ".$ultima_funcao[0]->vc_nomeFuncao;
      $this->log->Log('info', $actividade);

      return redirect()->back()->with("funcao.cadastrar.true", '1');;
    }

    public function editar(Request $form, $id)
    {   
    
      $funcao = Funcao::findOrFail($id);
      Funcao::where('id',$id)->update([

        "vc_nomeFuncao"=>$form->vc_nomeFuncao,

      ]);


      $actividade="Editou a funcão de nome( ".$funcao->vc_nomeFuncao." ) para( ".$form->vc_nomeFuncao." ) ";
      $this->log->Log('info', $actividade);

      return redirect()->back()->with("funcao.editar.true", '1');

   
    }

    public function eliminar($id)
    {

      $funcao = Funcao::findOrFail($id);
      
      Funcao::where('id',$id)->update([
          'it_estado' => 0
      ]);
      $actividade="Eliminou a função de nome( ".$funcao->vc_nomeFuncao." ) ";
      $this->log->Log('info', $actividade);
      return redirect()->back()->with("funcao.eliminar.true",'1');

    }



    public function purgar($id)
    {

      $funcao = Funcao::findOrFail($id);
      Funcao::where('id', $id)->delete();
      $actividade="Purgou a função de nome( ".$funcao->vc_nomeFuncao." ) ";
      $this->log->Log('info', $actividade);
      return redirect()->back()->with("funcao.purgar.true",'1');

        }


}
