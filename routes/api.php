<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function(){
    Route::post('login', 'ApiAndroidController@loginCambista');

    Route::middleware('auth:api')->group(function(){
        Route::get('recupera-cambista', 'ApiAndroidController@recuperaCambista');

        /* Rotas para os jogos */
        Route::get('recupera-ligas-futebol', 'ApiAndroidController@recuperaLigasFutebol');
        Route::get('recupera-paises', 'ApiAndroidController@recuperaPaises');
        Route::get('recupera-ligas-pais/{id}', 'ApiAndroidController@recuperaLigasPais');

        Route::get('recupera-ligas-destaque', 'ApiAndroidController@recuperaLigasDestaque');
        Route::get('recupera-jogos-destaque', 'ApiAndroidController@recuperaJogosDestaque');
        Route::get('adiciona-aposta/{id}', 'ApiAndroidController@adicionarAposta');
       
        Route::get('recupera-jogos-principal', 'ApiAndroidController@recuperaJogosPrincipal');
        Route::get('recupera-bilhete/{codigo}', 'ApiAndroidController@recuperaBilhete');
    });
});
Route::prefix('v1')->group(function(){

    Route::get('recupera-bilhete/{codigo}', 'ApiAndroidController@recuperaBilhete');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
