<?php
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CategoriaAlvaraController extends Controller
{
    //
    public function getSubCategoriasAlvara($id){
        $subCategorias=  DB::table('sub_categoria_alvaras')
        ->join('categoria_alvaras', 'sub_categoria_alvaras.it_id_categoria_alvara', '=', 'categoria_alvaras.id')
        ->where('categoria_alvaras.id',$id)
     ->pluck('sub_categoria_alvaras.vc_subCategoria','sub_categoria_alvaras.id');
    
       return response()->json($subCategorias);
    }
   
}
