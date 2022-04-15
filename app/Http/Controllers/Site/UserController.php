<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Militante;
use Illuminate\Support\Facades\Log;
use App\Models\Logg;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public $log;
    public function __construct(){
      $this->log = new Logg();
    }

   
     public function editar(request $req){
         try { 

       

            $user = User::findOrFail($req->id);
          

            if($req->vc_senha==$req->confirmed){
         
              
            
                       
                    $u = User::findOrFail($req->id)->update([
                            'name' => $req->vc_nome,
                            'email' => $req->vc_email,
                            'password' => Hash::make($req->vc_senha),
                            'it_telefone'=>$req->it_telefone,
                            'vc_genero'=>$req->vc_genero,
                            'vc_bi'=>$req->vc_bi,
                        ]);

                        //dd($u);
                        

                    
                                $actividade="Editou o utilizador de nome,email e BI( ".$user->name.", ".$user->email.", ".$user->vc_bi." ) para( ".$req->vc_nome.", ".$req->vc_email.", ".$req->vc_bi." ) ";


                                $this->log->Log('info', $actividade);

                        $message = "Utilizador $req->vc_nome";

                        return redirect()->back()->with("perfil.editar.true", '1'); 
           

        }else{

            return redirect()->back()->with('error',1);
        }
        } catch (\Throwable $th) {
            return redirect()->back()->with("perfil.editar.false", '1');
       } 
     }
     public function paginaEditar($id){
         

        $dados['user'] = User::findOrFail($id);
         //dd($dados['user']);

         

         return view('site.user.editar.index', $dados);
     }
    

}
