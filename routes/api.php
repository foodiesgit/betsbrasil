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
        Route::get('recupera-carrinho', 'ApiAndroidController@recuperarCarrinho');
        Route::post('finalizar-aposta', 'ApiAndroidController@postFinalizarAposta');

        /* Rotas para os jogos */
        Route::get('recupera-ligas-futebol', 'ApiAndroidController@recuperaLigasFutebol');
        Route::get('recupera-paises', 'ApiAndroidController@recuperaPaises');
        Route::get('recupera-ligas-pais/{id}', 'ApiAndroidController@recuperaLigasPais');

        Route::get('recupera-ligas-destaque', 'ApiAndroidController@recuperaLigasDestaque');
        Route::get('recupera-more-odds', 'ApiAndroidController@moreOdds');
        Route::get('adiciona-aposta/{id}', 'ApiAndroidController@adicionarAposta');
       
        Route::get('recupera-jogos-principal', 'ApiAndroidController@recuperaJogosPrincipal');
        Route::get('remover-jogos/{id}', 'ApiAndroidController@removeSelection');
        Route::get('recupera-bilhete/{codigo}', 'ApiAndroidController@recuperaBilhete');
    });
});
Route::prefix('v1')->group(function(){
   

    Route::get('recupera-bilhete/{codigo}', 'ApiAndroidController@recuperaBilhete');
});

Route::get('remove-selection/{id},', 'ApiAndroidController@removeSelection');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
