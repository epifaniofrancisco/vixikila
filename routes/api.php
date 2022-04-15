<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\APIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/estabelecimento',['as'=>'api','as '=> 'Admin/APIController@index']);


Route::get('/estabelecimento/{id}',['as' =>'admin.estabelecimento.listar','uses' =>'Admin\APIController@index']);

Route::get('/zengaQr',['as' =>'admin.zengaQr.listar','uses' =>'Admin\APIController@indexZenga']);

Route::post('register', 'Admin\MobileController@register');
Route::post('v1/login', 'Admin\MobileController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'Admin\MobileController@getAuthenticatedUser');
    Route::get('closed', 'Admin\MobileControllerDataController@closed');

   

});

 Route::middleware(['auth'])->group(function () {
      Route::middleware('jwt.verify')->get('v1/estabelecimento/{id}',['as' =>'admin.api.estabelecimento.listar','uses' =>'Admin\APIController@index']);
     Route::get('v1/estabelecimento/{id}',['as' =>'admin.api.estabelecimento.listar','uses' =>'Admin\APIController@index']);
   
     });

 /* Route::middleware(['auth'])->group(function () { */
 Route::get('v1/estabelecimento/{id}',['as' =>'admin.api.estabelecimento.listar','uses' =>'Admin\APIController@index']);
Route::get('v1/funcionario/{id}',['as' =>'admin.api.funcionaio.ver','uses' =>'Admin\APIController@veFuncionario']);
Route::get('v1/zenga',['as' =>'admin.api.zengaQr.listar','uses' =>'Admin\APIController@indexZenga']);
/* }); */

