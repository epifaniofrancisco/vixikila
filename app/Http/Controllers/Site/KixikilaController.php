<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Kixikila;

class KixikilaController extends Controller
{
    //

    public function store(Request $request){

        try {

            //dd($request);

            $actual = date('Y-m-d');
            $resultado = date('Y-m-d', strtotime("+{$request->radio} month",strtotime($actual)));

            // dd($resultado);
            Kixikila::create(
                [
                    'id_user'=>Auth::user()->id,
                    'montante'=>$request->montante,
                    'n_pessoas'=>$request->radio,
                    'dt_validade'=>$resultado,
                ]
            );

            return redirect()->back()->with("kixikila.cadastrar.true", '1');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("kixikila.cadastrar.false", '1');
        }

    }
}
