<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxaLicenca\TipoPublicidade;
use DB;
use App\Models\TaxaLicenca\SuperficiePublicidade;
use App\Models\Subscricao;

class TipoPublicidadeController extends Controller
{
    //
    public function getSuperficies($idTipoPublicidade){
//       $superficies= SuperficiePublicidade::where('it_id_tipoPublicidade',$idTipoPublicidade)->where('it_estado', 1)->get();
     $superficies=   DB::table("superficie_publicidades")
            ->where('it_id_tipoPublicidade',$idTipoPublicidade)
->where('it_estado', 1)
 ->pluck("vc_nome","id");
 
      return response()->json($superficies);
    }
    
      public function getModalidades($idSuperficie){
//       $superficies= SuperficiePublicidade::where('it_id_tipoPublicidade',$idTipoPublicidade)->where('it_estado', 1)->get();
     $modalidades=   DB::table("ucf_localidade_valores")
          ->join('superficie_publicidades', 'ucf_localidade_valores.it_id_superficiePublicidade', 'superficie_publicidades.id')
           ->join('modalidade_publicidades', 'ucf_localidade_valores.it_id_modalidadePublicidade', 'modalidade_publicidades.id')
            ->where('superficie_publicidades.id',$idSuperficie)
->where('ucf_localidade_valores.it_estado', 1)
 ->pluck("modalidade_publicidades.vc_nome","modalidade_publicidades.id");
 
      return response()->json($modalidades);
    }
    
    public function getUCF($id_modalidade, $id_supeficie){
      $UCF_localidade=   DB::table("ucf_localidade_valores")
            ->join('ucf_localidades', 'ucf_localidade_valores.it_id_ucfLocalidade', 'ucf_localidades.id')
            ->where('ucf_localidade_valores.it_id_modalidadePublicidade',$id_modalidade)
           ->where('ucf_localidade_valores.it_id_superficiePublicidade',$id_supeficie)
->where('ucf_localidade_valores.it_estado', 1)
 ->pluck('ucf_localidade_valores.fl_custo','ucf_localidades.vc_nome');
        
       
        return response()->json($UCF_localidade);
        
    }
    
    public function getCliente($id_estabelecimento){
        $cliente = DB::table('estabelecimentos')
            ->join('users', 'users.id', 'estabelecimentos.it_id_usuario')
             ->where('estabelecimentos.id',$id_estabelecimento)
            ->pluck('users.name','users.id');
         return response()->json($cliente);
        
    }
    public function getEstabelecimento($id_publicidade){
   
      $result = DB::table('publicidades')
      ->join('users','publicidades.id_user','users.id')
      ->join('estabelecimentos','publicidades.id_estabelecimento','estabelecimentos.id')
 
      // ->where('publicidades.it_estado_apr_publicidade', 0)
      ->where('publicidades.id',  $id_publicidade)
      ->select('estabelecimentos.id','estabelecimentos.nome','publicidades.fl_comprimento','publicidades.fl_largura','publicidades.vc_alcool','users.name','users.id as id_usuario')->first()
      ;

    
  //  return response()->json($cliente);
      return response()->json($result);

    }



    public function getCroqui($id_publicidade,$it_id_tipoPublicidade,$id_supeficie,$id_modalidade,$id_estabelecimento,$id_tipo_qr){

      $subs = Subscricao::where('id_estabelecimento',$id_estabelecimento)
            ->where('id_publicidade',$id_publicidade)
          /*   ->where('id_superficie',$id_supeficie)
            ->where('it_id_tipoPublicidade',$it_id_tipoPublicidade) */
            /* ->where('id_modalidade',$id_modalidade) */
            ->where('it_estado',1)
            ->where('id_tipo_qr',$id_tipo_qr)->get()->first();
            $existe = false;
            if($subs){
                $existe = true;
            }
            
       return response()->json($existe);
      
  }



}
