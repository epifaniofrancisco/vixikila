<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Estabelecimento;
use App\Models\Publicidade;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Arr;
use App\Http\Resources\EstabelecimentoResource;
use function PHPSTORM_META\type;
use App\Http\Resources\API;
use phpDocumentor\Reflection\Types\Void_;

class APIController extends Controller
{
    public function index($id)
    {
        try {

            $datad = DB::table('estabelecimentos')->where('estabelecimentos.id', $id)
                ->join('users', 'estabelecimentos.it_id_usuario', 'users.id')
                ->join('subscricaos', 'estabelecimentos.id', 'subscricaos.id_estabelecimento')
                ->join('distritos', 'estabelecimentos.id_destrito', 'distritos.id')
                ->get();
            //->join('subscricaos','')
            //   dd($datad);
            if (!empty($datad[0])) {
                // dd($datad);
                return  new EstabelecimentoResource($datad);
            } else {
                return response($datad);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        //  $data = (object) $datad;

    }

    public function indexZenga()
    {
        try {


            // dd('datad');
            return  'https://zenga.co.ao';
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        //  $data = (object) $datad;

    }

    public function veFuncionario($id = 1)
    {

        $value = DB::table('funcionarios')->where('funcionarios.id', $id)->join('funcaos', 'funcionarios.id_funcao', 'funcaos.id')->select('funcionarios.it_estado', 'funcionarios.id', 'funcionarios.vc_primeiroNome', 'funcionarios.vc_foto', 'funcionarios.vc_genero', 'funcionarios.vc_ultimoNome', 'funcaos.vc_nomeFuncao')->get();
        $data['response'] = $value[0];

        //  dd($data['response']);
        return view("site.funcionario.ver.index", $data);
    }
}
