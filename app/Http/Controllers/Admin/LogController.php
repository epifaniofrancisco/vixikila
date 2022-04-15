<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogUser;
use Illuminate\Support\Facades\DB;
use App\Models\Logg;

class LogController extends Controller
{
    public $logPesquisa;

    public function __construct()
    {
        $logPesquisa=new LogUser();
    }
    public function paginaPesquisar(){
        $response['anos'] =  $response['logs'] =DB::table('logs')
        ->selectRaw('YEAR(created_at) as ano')->distinct('YEAR(created_at)')->get();

        $response['utilizadores'] =  $response['logs'] =DB::table('logs')
        ->join('users', 'users.id', '=', 'logs.id_user')
        ->select('users.name')->DISTINCT ('logs.id_user')
            ->get();
        return view('admin.logs.pesquisa.index',$response);
    }

    public function listar(Request $request, LogUser $logPesquisa)
    {

        $datatime =  $request->vc_ano;
        $utilizador = $request->vc_nome;
      
        $response['datatime'] = $datatime;
        $response['utilizador'] = $utilizador;
        $response['logs'] =  $logPesquisa->LogsForSearch($datatime,$utilizador);

        return view('admin.logs.listar.index',$response);
        //return redirect("admin/logs/visualizar/index/$datatime/$utilizador");
    }
    public function index( LogUser $logPesquisa,$datatime,$utilizador)
    {
      $response['datatime'] = $datatime;
      $response['utilizador'] = $utilizador;
      $response['logs'] =  $this->logPesquisa->LogsForSearch($datatime,$utilizador);
      //return view('admin/logs/visualizar/index', $response);
    }
}
