<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('ajax')->group(function(){
    Route::get('recupera-jogos-destaque', 'AjaxController@recuperaJogosDestaque');
    Route::get('carrinho/adicionar-aposta', 'AjaxController@adicionarAposta');
    Route::get('carrinho/recupera-carrinho', 'AjaxController@recuperaCarrinho');
    Route::get('recupera-jogos-liga/{id}', 'AjaxController@recuperaJogosLiga');
    Route::get('search', 'AjaxController@search');
    Route::get('moreOdds', 'AjaxController@moreOdds');


});

// Route::prefix('lite')->group(function(){
//     Route::get('/', 'LiteController@viewIndex');
//     Route::get('/ver-evento/{id}', 'LiteController@verEventoById');
//     Route::get('/leagues/{id}', 'LiteController@verEventosPorLiga');
//     Route::get('/meu-cupom', 'LiteController@viewMeuCupom');
//     Route::get('/atualizar-aposta', 'LiteController@viewAtualizarAposta');
//     Route::get('limpar-apostas', 'LiteController@limparApostas');
//     Route::post('finalizar-aposta', 'LiteController@postFinalizarAposta');
//     Route::get('remove-selection/{id}', 'LiteController@removeSelection');

//     Route::get('/login', 'LiteController@viewLogin');
//     Route::post('/login', 'LiteController@postLogin');

//     Route::get('/cadastrar', 'LiteController@viewCadastro');
//     Route::post('/cadastrar', 'LiteController@potsCadastro');

//     Route::get('/sports/{id}', 'ClientController@viewJogosPorEsporte');

//     /* Rotas para a conta do usuário */
//     Route::get('minhas-apostas', 'LiteController@viewMinhasApostas');
//     Route::get('minhas-apostas/visualizar-cupom/{codigo_unico}', 'LiteController@viewVisualizarApostaById');

// });

Route::prefix('operacao-carrinho')->group(function(){
    Route::get('recuperar-carrinho', 'CarrinhoController@recuperarCarrinho');
});

Route::get('layout', 'ClientController@viewLayout');

Route::get('/', 'ClientController@viewIndex');
Route::get('/{date}', 'ClientController@viewIndexData');
Route::get('/events/{idevent}', 'ClientController@viewEvent');
Route::get('/leagues/{id}', 'ClientController@viewJogosPorLiga');
Route::get('sports/{id}', 'ClientController@viewJogosPorEsporte');
Route::get('jogos-ao-vivo', 'AovivoController@showJogosAoVivo');
Route::get('regulamentacao', 'ClientController@viewRegulamentacao');
Route::get('/verifica-bilhete/{bilhete}', 'ClientController@resultBilhete');
Route::get('/ajax-verifica-bilhete/{bilhete}', 'ClientController@ajaxResultBilhete');
Route::get('/ajax-atualiza-aovivo', 'AovivoController@index');
Route::get('ajax/atualiza-aovivo', 'AovivoController@ajaxAoVivo');

Route::get('teste', 'ClientController@teste');

Route::get('/atualizar-aposta', 'ClientController@viewAtualizarAposta');
Route::get('remove-selection/{id}', 'ClientController@removeSelection');
Route::post('finalizar-aposta', 'ClientController@postFinalizarAposta');
#Operações do Carrinho
Route::get('/carrinho/adicionar-aposta', 'ClientController@ajaxAdicionarApostaCarrinho');
Route::get('/carrinho/atualiza-aposta', 'ClientController@atualizaAposta');
Route::get('/carrinho/excluir-aposta', 'ClientController@excluirAposta');

Route::get('/carrinho/colocar-aposta', 'ClientController@colocarAposta');
Route::get('/carrinho/recupera-carrinho', 'ClientController@ajaxRecuperaApostasCarrinho');
Route::get('ver-cupom/{random}', 'ClientController@verCupom');
Route::get('verifica-bilhete', 'ClientController@verificaBilhete');

// Route::get('login', 'MinhaContaController@viewLogin');
// Route::post('login', 'MinhaContaController@postLogin');
Route::get('cadastro', 'MinhaContaController@viewCadastro');
Route::post('cadastro', 'MinhaContaController@postCadastro');
Route::get('minhas-apostas', 'MinhaContaController@viewMinhasApostas');
Route::get('minhas-apostas/visualizar-cupom/{codigo_unico}', 'MinhaContaController@viewVisualizarApostaById');
Route::get('result', 'ResultController@result');

Route::prefix('minha-conta')->group(function(){
    Route::get('dashboard', 'MinhaContaController@viewDashboard');
});

Route::prefix('api')->group(function(){
    Route::get('recupera-ligas-por-esporte', 'ApiController@viewRecuperaLigasPorEsporte');
    Route::get('recupera-upcoming-events/{idesporte}/{pais}', 'ApiController@recuperaUpcomingEvents');
    Route::get('atualiza-odds/{idevent}', 'ApiController@atualizaOdds');

    Route::get('retorna-json', 'ApiController@retornaJson');
});

Route::prefix('admin')->group(function(){
    Route::get('login', 'AdminController@viewLogin');
    Route::post('login', 'AdminController@postLogin');

    Route::group(['middleware' => 'authAdmin'], function(){
        Route::get('dashboard', 'AdminController@viewDashboard');
        Route::get('usuarios/listar', 'AdminController@viewListarUsuarios');
        Route::get('usuarios/editar/{id}', 'AdminController@viewEditarUsuarios');
        Route::post('usuarios/editar/{id}', 'AdminController@postEditarUsuarios');
        Route::get('logout', 'AdminController@logout');
        Route::get('ajaxviewcambista', 'AdminController@ajaxViewCaixaCambista');
        Route::get('ajaxviewcambistagerente', 'AdminController@ajaxViewCaixaCambistaGerente');
        
        Route::get('ajaxviewgerente', 'AdminController@ajaxViewCaixaGerente');
        Route::get('fechar/caixa/gerente/{id}', 'AdminController@fecharCaixaGerente');
        Route::get('fechar/caixa/cambista/{id}', 'AdminController@fecharCaixaCambista');
        Route::get('ver/cambista/{id}', 'AdminController@viewCambista');
        Route::get('ver/gerente/{id}', 'AdminController@viewGerente');
        /*Gerênciar API */
        Route::get('api/esportes/listar', 'AdminController@viewListarEsportes');
        Route::get('api/esportes/editar/{id}', 'AdminController@viewEditarEsportes');
        Route::post('api/esportes/editar/{id}', 'AdminController@postEditarEsportes');
        Route::get('api/paises/listar', 'AdminController@viewListarPaises');
        Route::get('api/paises/editar/{id}', 'AdminController@viewEditarPaises');
        Route::post('api/paises/editar/{id}', 'AdminController@postEditarPaises');
        Route::get('api/ligas/listar', 'AdminController@viewListarLigas');
        Route::get('api/ligas/editar/{id}', 'AdminController@viewEditarLigas');
        Route::post('api/ligas/editar/{id}', 'AdminController@postEditarLigas');

        /* Gerentes */
        Route::get('gerentes/listar', 'AdminController@viewListarGerentes');
        Route::get('gerentes/cadastrar', 'AdminController@viewCadastrarGerentes');
        Route::post('gerentes/cadastrar', 'AdminController@postCadastrarGerentes');
        Route::get('gerentes/editar/{id}', 'AdminController@viewEditarGerentes');
        Route::post('gerentes/editar/{id}', 'AdminController@postEditarGerentes');
        Route::get('gerentes/caixa', 'AdminController@viewCaixaGerentes');
        Route::get('gerentes/caixa/lancamentos/{id}', 'AdminController@viewLancamentoCaixaGerente');
        Route::post('gerentes/caixa/lancamentos/{id}', 'AdminController@postLancamentoCaixaGerente');
        Route::get('gerentes/caixa/historico/{id}', 'AdminController@viewHistoricoLancamentos');
        Route::get('gerentes/caixa/historico', 'AdminController@viewHistoricoLancamentosGerentes');

        Route::get('cambistas/listar', 'AdminController@viewListarCambistas');
        Route::get('cambistas/cadastrar', 'AdminController@viewCadastrarCambistas');
        Route::post('cambistas/cadastrar', 'AdminController@postCadastrarCambistas');
        Route::get('cambistas/editar/{id}', 'AdminController@viewEditarCambistas');
        Route::post('cambistas/editar/{id}', 'AdminController@postEditarCambistas');
        Route::get('cambistas/caixa', 'AdminController@viewCaixaCambistas');
        Route::get('cambistas/caixa/lancamentos/{id}', 'AdminController@viewLancamentoCaixaCambista');
        Route::post('cambistas/caixa/lancamentos/{id}', 'AdminController@postLancamentoCaixaCambista');
        Route::get('cambistas/caixa/historico/{id}', 'AdminController@viewHistoricoLancamentosCambistas');
        Route::get('cambistas/caixa/historico', 'AdminController@viewHistoricoLancamentosCambistasGeral');
        Route::get('usuarios/saques', 'AdminController@viewHistoricoLancamentosUsuariosGeral');
        Route::get('usuarios/saques/{id}', 'AdminController@viewHistoricoLancamentosUsuario');

        Route::get('jogos/listar', 'AdminController@viewListarJogos');
        Route::get('jogos/mapa-aposta', 'AdminController@viewMapaAposta');
        Route::get('jogos/gerenciamento-risco', 'AdminController@viewGerenciamentoRisco');
        Route::get('jogos/desabilitar/{id}', 'AdminController@desabilitarJogo');
        Route::post('jogos/habilitar/{id}', 'AdminController@habilitarJogo');

        Route::post('deposit', 'AdminController@deposit');
        Route::post('saque', 'AdminController@saque');
        Route::get('cancelar-solicitacao/{id}', 'AdminController@cancelarSolicitacao');
        Route::get('cancelar-bilhete/{id}', 'AdminController@cancelarBilhete');
        Route::get('rejeitar-solicitacao/{id}', 'AdminController@rejeitarSolicitacao');
        Route::get('aprovar-solicitacao/{id}', 'AdminController@aprovarSolicitacao');
        Route::get('validar-bilhete', 'AdminController@viewValidarBilhete');
        Route::post('validar-bilhete', 'AdminController@postValidarBilhete');

        Route::get('jogos/visualizar-apostas/{id}', 'AdminController@visualizarAposta');

        Route::get('fixos', 'AdminController@viewFixos');
        Route::post('fixos', 'AdminController@postFixos');
    });
});
