<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Militante;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // $dados = [];
        // $dados['militantes'] = Militante::get();
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    //    dd($request);
        // $request->validate([
        //     'vc_nome' => 'required|string|max:255',
        //     'vc_email' => 'required|string|email|max:255|unique:users',
        //     'vc_senha' => ['required', 'confirmed', Rules\Password::defaults()],
      
        // ]);
     if($request->password==$request->confirmed){

    $user=  User::create([
        'nomeusuario' => $request->nomeusuario,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'perfil' => " ",
        'numerobi' => $request->numerobi,
        'telefone' => $request->telefone,
        'nomecompletobi' => $request->nomecompletobi,
        'dataNascimento' => date("Y-m-d",strtotime($request->dataNascimento)),
        'genero' => $request->genero,
        'pais' => $request->pais,
        'provincia' => $request->provincia,
        'municipio' => $request->municipio,
        'residencia' => $request->residencia,
        'contaBancaria' => $request->contaBancaria,
        'iban' => $request->iban,
        'dataExpCartao' => date("Y-m-d",strtotime($request->dataExpCartao)),

  

    ]);
    event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        $submetido = true;
        return response()->json($submetido);
}else{

    return redirect()->back()->with('error',1);
}
      

        
    }
}
