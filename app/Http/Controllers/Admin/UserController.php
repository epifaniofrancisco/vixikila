<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Militante;
use Illuminate\Support\Facades\Log;
use App\Models\Logg;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public $log;
    public function __construct(){
      $this->log = new Logg();
    }

    public function cadastrar(request $req){
       try {
            $req->validate([
                'vc_nome' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'vc_perfil'=> 'required|string|max:255',
                'vc_bi'=> 'required|string|max:255',
                'vc_genero'=> 'required|string|max:1',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $data = User::where('vc_bi',$req->vc_bi)->where('email',$req->email)->limit(1)->get();
            if($data != null ){

                User::create([
                    'name'=>$req->vc_nome,
                    'email'=>$req->email,
                    'password'=>Hash::make($req->password),
                    'vc_perfil'=>$req->vc_perfil,
                    'vc_bi'=>$req->vc_bi,
                    'vc_genero'=>$req->vc_genero
                ]);
                $ultimo_utilizador=User::orderBy('id','Desc')->limit(1)->get();
                $actividade="Cadastrou o utilizador de nome ".$ultimo_utilizador[0]->name.", email: ".$ultimo_utilizador[0]->email.", com o perfil de: ".$ultimo_utilizador[0]->vc_perfil;
                $this->log->Log('info', $actividade);

             $message = "Utilizador $req->vc_nome";

             return redirect()->back()
                 ->with('status', 1)
                 ->with('message', $message)
                 ->with('opcao', 3);
           }else{
               return redirect()->back()->with('status', 0)
               ->with('message', 'utilizador')
               ->with('opcao', 3);
           }


   } catch (\Throwable $th) {
            return redirect()->back()
                ->with('status', 0)
                ->with('message', 'utilizador')
                ->with('opcao', 3);
      }


     }
     public function paginaCadastrar(){


         return view('admin.user.cadastrar.index');

     }
     public function listar(){

         $dados= [];
         if (Auth::user()->vc_perfil == 'Administrador') {
             # code...
             $dados['users'] = User::where('vc_perfil','!=','Master')->get();
         } else {
             # code...
             $dados['users'] = User::get();
         }
         
         


         return view('admin.user.listar.index', $dados);
     }

     public function editar( $id,request $req){
        try {

            $user = User::findOrFail($id);
            $req->validate([
                'vc_nome' => 'required|string|max:255',
            ]);

            if(isset($req->password)) {
                $req->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
            }

            if($req->email != $user->email) {
                $req->validate([
                    'email' => 'required|string|email|max:255|unique:users',
                ]);
            }

           User::findOrFail($id)->update([
                'name'=>$req->vc_nome,
                'email'=>$req->email,
                'it_id_militante'=>$req->it_id_militante,
                'password'=>Hash::make($req->password),
                'vc_perfil'=>$req->vc_perfil,
                'vc_bi'=>$req->vc_bi,
                'vc_genero'=>$req->vc_genero
             ]);


          
                    $actividade="Editou o utilizador de nome,email,perfil e BI( ".$user->name.", ".$user->email.", ".$user->vc_perfil.", ".$user->vc_bi." ) para( ".$req->name.", ".$req->email.", ".$req->vc_perfil.", ".$req->vc_bi." ) ";


                    $this->log->Log('info', $actividade);

             $message = "Utilizador $req->vc_nome";

             return redirect()->back()
                 ->with('status', 1)
                 ->with('message', $message)
                 ->with('opcao', 1);

        } catch (\Throwable $th) {
          //  return redirect()->back()
          //      ->with('status', 0)
           //     ->with('message', 'utilizador')
            //    ->with('opcao', 1);
       }
     }
     public function paginaEditar($id){
        // dd($id);

         $dados['dados'] = User::findOrFail($id);

         return view('admin.user.editar.index', $dados);
     }
     public function eliminar($id){
         try {
            $dados=User::findOrFail($id);
            if(isset($dados)){
             $dados->delete();
             }
             $actividade="Eliminou o utilizador de nome,email,perfil e BI( ".$dados->name.", ".$dados->email.", ".$dados->vc_perfil.", ".$dados->vc_bi." )";
             $this->log->Log('info', $actividade);

             $message = "Utilizador $dados->nome";

             return redirect()->back()
                 ->with('status', 1)
                 ->with('message', $message)
                 ->with('opcao', 4);

         } catch (\Throwable $th) {
            return redirect()->back()
                ->with('status', 0)
                ->with('message', 'utilizador')
                ->with('opcao', 4);
         }
     }

     public function editar_nivel($id, $nivel)
     {

       
         $user =  User::find($id)->update(['vc_perfil' => $nivel]);
         return response()->json($user);
     }

}
