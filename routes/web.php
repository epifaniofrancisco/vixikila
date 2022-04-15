<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now criar something great!
|
*/

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

//Route::get('multatext', ['as' => 'multatext', 'uses' => 'Admin\MultaController@verificarMulta']);

//Route::get('multatext', ['as' => 'multatext', 'uses' => 'Admin\MultaController@paginaVerificarCriarMulta']);


//admin.user.criar
/* Grupo de rotas autenticadas */



route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
route::get('/perfil', ['as' => 'perfil', 'uses' => 'HomeController@perfil'])->middleware('verified');


Route::middleware(['auth'])->group(function () {
    // route::get('/', ['as' => 'admin.dashboard', 'uses' => 'HomeController@index']);

    Route::prefix('/site')->group(function () {

        Route::prefix('/kixikila')->group(function () {

            Route::post('/store', ['as' => 'site.kixikila.store', 'uses' => 'Site\KixikilaController@store']);
           
        });
    });


   
   

     
    
  

    
    Route::middleware(['AccessControllAdmin'])->prefix('/admin')->group(function () {


        // Taxa de Licença: Tipo de Publicidade  -Início- 
    
    




       
        Route::prefix('/funcao')->group(function () {

            Route::get('/cadastrar', ['as' => 'admin.funcao.cadastrar', 'uses' => 'Admin\FuncaoController@paginaCadastrar']);
            Route::get('/editar/{id}', ['as' => 'admin.funcao.editar', 'uses' => 'Admin\FuncaoController@paginaEditar']);
            Route::post('/store', ['as' => 'admin.funcao.store', 'uses' => 'Admin\FuncaoController@cadastrar']);
            Route::get('/listar', ['as' => 'admin.funcao.listar', 'uses' => 'Admin\FuncaoController@listar']);
            Route::get('/eliminar/{id}', ['as' => 'admin.funcao.eliminar', 'uses' => 'Admin\FuncaoController@eliminar']);
            Route::post('/editar/{id}', ['as' => 'admin.funcao.update', 'uses' => 'Admin\FuncaoController@editar']);
            Route::get('/purgar/{id}', ['as' => 'admin.funcao.purgar', 'uses' => 'Admin\FuncaoController@purgar']);
        });
    });


       


   
        


      

  
});


// Auth::routes(['verify'=>true]);


/* inclui as rotas de autenticação do ficheiro auth.php */
require __DIR__ . '/auth.php';
