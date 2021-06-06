<?php



namespace App\Http\Controllers;



use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Ixudra\Curl\Facades\Curl;

use Illuminate\Support\Str;

use Validator;

use DB;

use Session;

use Image;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Http;

use Carbon\Carbon;



use App\Usuarios;

use App\Creditos;

use App\Esportes;

use App\Paises;

use App\Ligas;

use App\GerentesCampos;

use App\LancamentosCaixa;

use App\Events;

use App\Times;

use App\Estadios;

use App\Odds;

use App\OddsGrupo;

use App\OddsSubGrupo;

use App\CarrinhoApostas;
use App\NovoCarrinhoItem;
use App\NovoCarrinho;

use App\CupomAposta;
use App\CambistasComissoes;

use App\CupomApostaItem;



class ApiAndroidController extends Controller{

    public function loginCambista(Request $request){

        $input = $request->all();



        if(Auth::attempt([

            'email' => $input['email'],

            'password' => $input['senha'],

            'tipo_usuario' => 4,

            'status' => 1

        ])){

            $user = Auth::user();

            $token = $user->createToken('BellagioEsportes')->accessToken;



            return response()->json([

                'status' => 'ok',

                'id' => $user->id,

                'name' => $user->name,

                'email' => $user->email,

                'token' => $token

            ]);

        }



        return response()->json([

            'status' => 'error'

        ]);

    }



    public function recuperaCambista(){

        if(!Auth::check()){

            return response()->json([

                'status' => 'erro'

            ]);

        }



        $user = Auth::user();



        return response()->json([

            'status' => 'ok',

            'id' => $user->id,

            'name' => $user->name,

            'email' => $user->email,

        ]);

    }



    public function recuperaLigasFutebol(){

        $sqlLigas = Ligas::where('status', 1)->groupBy('idpais')->orderBy('ligas.nome_traduzido','asc')->get();



        $arrayPaises = [];



        if(count($sqlLigas) > 0){

            foreach($sqlLigas as $dados){

                $sqlPais = Paises::where('status', 1)->where('id', $dados->idpais)->get();



                if(count($sqlPais) > 0){

                    foreach($sqlPais as $dados2){



                        $sqlLigas2 = Ligas::where('status', 1)->where('idpais', $dados2->id)->orderBy('nome_traduzido','asc')->get();

                        $arrayLigas = [];



                        if(count($sqlLigas2) > 0){

                            foreach($sqlLigas2 as $dados3){

                                $arrayLigas[] = [

                                    'id' => $dados3->id,

                                    'nome_traduzido' => $dados3->nome_traduzido

                                ];

                            }

                        }



                        $arrayPaises[] = [

                            'id' => $dados2->id,

                            'nome_traduzido' => $dados2->nome_traduzido,

                            'bandeira' => $dados2->bandeira,

                            'ligas' => $arrayLigas

                        ];

                    }

                }

            }

        }



        return response()->json([

            'status' => 'ok',

            'paises' => $arrayPaises

        ]);

    }



    public function recuperaTodasLigas(){



    }



    public function recuperaPaises(){

        $paises = Paises::where('status', 1)->orderBy('nome_traduzido', 'asc')->get();



        return response()->json([

            'paises' => $paises

        ]);

    }



    public function recuperaJogosPrincipal(){

        $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=','events.idliga')

            ->leftJoin('paises', 'paises.id','=','ligas.idpais')

            ->where('idesporte', 1)

            ->select('events.id', 'ligas.nome_traduzido as nome_liga','paises.nome_traduzido as nome_pais', 'paises.bandeira', 'total_odds',DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.idhome', 'events.idaway')->get();



            $array_jogos = [];



            if(count($jogos) > 0){

                foreach($jogos as $dados2){

                    $sql_time_home = Times::find($dados2->idhome);

                    $sql_time_away = Times::find($dados2->idaway);

                    $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();



                    if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                        $array_jogos[] = [

                            'id' => $dados2->id,

                            'data' => $dados2->data,

                            'hora' => $dados2->hora,

                            'home' => $sql_time_home->nome,

                            'away' => $sql_time_away->nome,

                            'total_odds' => $dados2->total_odds,

                            'oddhome_id' => $sql_odds_principal[0]->id,

                            'oddhome_value' => $sql_odds_principal[0]->odds,

                            'oddhome_name' => $sql_odds_principal[0]->name,

                            'odddraw_id' => $sql_odds_principal[1]->id,

                            'odddraw_value' => $sql_odds_principal[1]->odds,

                            'odddraw_name' => $sql_odds_principal[1]->name,

                            'oddaway_id' => $sql_odds_principal[2]->id,

                            'oddaway_value' => $sql_odds_principal[2]->odds,

                            'oddaway_name' => $sql_odds_principal[2]->name,

                            'liga' => $dados2->nome_liga,

                            'pais' => $dados2->nome_pais,

                            'bandeira' => $dados2->bandeira,

                            'esporte' => 'Futebol'

                        ];



                    }

                }

            }



        return response()->json([

            'jogos_destaque' => $array_jogos

        ]);





        $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

            ->where('idesporte', 1)

            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('100')->get();



        $array_jogos = [];



        if(count($jogos) > 0){

            foreach($jogos as $dados2){



                $sql_time_home = Times::find($dados2->idhome);

                $sql_time_away = Times::find($dados2->idaway);

                $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();





                if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                    $array_jogos[] = [

                        'id' => $dados2->id,

                        'data' => $dados2->data,

                        'hora' => $dados2->hora,

                        'home' => $sql_time_home->nome,

                        'away' => $sql_time_away->nome,

                        'total_odds' => $dados2->total_odds,

                        'oddhome_id' => $sql_odds_principal[0]->id,

                        'oddhome_value' => $sql_odds_principal[0]->odds,

                        'oddhome_name' => $sql_odds_principal[0]->name,

                        'odddraw_id' => $sql_odds_principal[1]->id,

                        'odddraw_value' => $sql_odds_principal[1]->odds,

                        'odddraw_name' => $sql_odds_principal[1]->name,

                        'oddaway_id' => $sql_odds_principal[2]->id,

                        'oddaway_value' => $sql_odds_principal[2]->odds,

                        'oddaway_name' => $sql_odds_principal[2]->name,

                    ];



                }

            }

        }



        return response()->json([

            'jogos_destaque' => $array_jogos

        ]);

    }



    public function recuperaJogosDestaque(){

            $date = \Carbon\Carbon::now();
            
            $nextD = $date->addDay(1)->toDateTime();

    
    
            $sql1 = Events::where('data', '>=', date('Y-m-d H:i:s'))->where('data','<=', date('Y-m-d').' 23:59:59')->orderBy('data', 'asc')
    
            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
    
            ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')
    
            ->where('idesporte', 1)//->where('ligas.status', 1)
    
            ->select('events.idliga', 'paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->paginate(4);
    
    
    
            $array_pais = [];
    
    
            if(count($sql1) == 0){
                    
                $sql1 = Events::whereDate('data', '>=',date('Y-m-d H:i:s'))->where('data','<=', date('Y-m-d').' 23:59:59')->orderBy('data', 'asc')
    
                ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
    
                ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')
    
                ->where('idesporte', 1)//->where('ligas.status', 1)
    
                ->select('events.idliga', 'paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->paginate(4);
    
    
            }
            if(count($sql1) > 0){
    
            foreach($sql1 as $dados1){
    
                $jogos_aba_futebol = Events::where('data', '>=', date('Y-m-d H:i:s'))->where('data','<=', date('Y-m-d').' 23:59:59')->orderBy('data', 'asc')
    
                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
    
                    ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')
    
                    ->where('idesporte', 1)->where('ligas.status', 1)->where('ligas.idpais', $dados1->idpais)
    
                    ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->get();
    
    
                
                if(count($jogos_aba_futebol) == 0){
                    $jogos_aba_futebol = Events::where('data', '>=', date('Y-m-d H:i:s'))->where('data','<=', $nextD)->orderBy('data', 'asc')
    
                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
    
                    ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')
    
                    ->where('idesporte', 1)->where('ligas.status', 1)->where('ligas.idpais', $dados1->idpais)
    
                    ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->get();
    
                }
                    
    
    
                $array_ligas = [];
    
    
    
                if(count($jogos_aba_futebol) > 0){
    
                    foreach($jogos_aba_futebol as $dados){
    
    
    
                        $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->where('data','<=', date('Y-m-d').' 23:59:59')  ->orderBy('data', 'asc')
    
                            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
    
                            ->where('idesporte', 1)->where('idliga', $dados->idliga)
    
                            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();
    
                        if(count($jogos) == 0){
                            $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->where('data','<=', $nextD)  ->orderBy('data', 'asc')
    
                            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
    
                            ->where('idesporte', 1)->where('idliga', $dados->idliga)
    
                            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();
    
    
                        }
                        $array_jogos = [];
    
                        if(count($jogos) > 0){
    
                            foreach($jogos as $dados2){
    
    
    
                                $sql_time_home = Times::find($dados2->idhome);
    
                                $sql_time_away = Times::find($dados2->idaway);
    
                                $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();
    
                                if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){
    
                                    $array_jogos[] = [
    
                                        'id' => $dados2->id,
    
                                        'data' => $dados2->data,
    
                                        'hora' => $dados2->hora,
    
                                        'home' => $sql_time_home->nome,
    
                                        'away' => $sql_time_away->nome,
    
                                        'total_odds' => $dados2->total_odds,
    
                                        'oddhome_id' => $sql_odds_principal[0]->id,
    
                                        'oddhome_value' => $sql_odds_principal[0]->odds,
    
                                        'oddhome_name' => $sql_odds_principal[0]->name,
    
                                        'odddraw_id' => $sql_odds_principal[1]->id,
    
                                        'odddraw_value' => $sql_odds_principal[1]->odds,
    
                                        'odddraw_name' => $sql_odds_principal[1]->name,
    
                                        'oddaway_id' => $sql_odds_principal[2]->id,
    
                                        'oddaway_value' => $sql_odds_principal[2]->odds,
    
                                        'oddaway_name' => $sql_odds_principal[2]->name,
    
                                    ];
    
    
    
                                }
    
                            }
    
                        }
    
    
                        if(count($array_jogos) > 0){
                            $array_ligas[] = [
    
                                'id' => $dados->idliga,
        
                                'liga' => $dados->nome_traduzido,
        
                                'jogos' => $array_jogos
        
                            ];
                        }

    
                    }
    
                }
    
                //fim
    
    
                if(count($array_ligas) > 0){
                    $array_pais[] = [
    
                        'id' => $dados1->idpais,
        
                        'pais' => $dados1->nome_traduzido,
        
                        'bandeira' => $dados1->bandeira,
        
                        'ligas' => $array_ligas
        
                    ];
                }
              
    
            }
    
            }
    
    
            $array_jogos_aba_futebol = $array_pais;
          
    
            $data = [
                'jogos_destaque' => $array_jogos_aba_futebol,
            ];  
           
            return Response()->json($data);
    

    }



    public function recuperaLigasPais(Request $request, $id){

        $input = $request->all();



        $sql = Ligas::where('idpais', $id)->where('ligas.status', 1)->orderBy('destaque', 'desc')->orderBy('nome_traduzido', 'asc')

            ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')

            ->select('ligas.*', 'esportes.nome_traduzido as nome_esporte')->groupBy('idesporte')->get();



        if(count($sql) > 0){

            foreach($sql as $dados){

                $sql2 = Ligas::where('idpais', $id)->where('ligas.status', 1)->orderBy('destaque', 'desc')->orderBy('nome_traduzido', 'asc')

                    ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')->where('idesporte', $dados->idesporte)

                    ->select('ligas.*', 'esportes.nome_traduzido as nome_esporte')->get();



                $array_ligas = [];

                if(count($sql2) > 0){

                    foreach($sql2 as $dados2){

                        $array_ligas[] = $dados2;

                    }

                }



                $array_esportes[] = [

                    'idesporte' => $dados->idesporte,

                    'nome_esporte' => $dados->nome_esporte,

                    'ligas' => $array_ligas

                ];

            }

        }



        return response()->json([

            $array_esportes

        ]);

    }


    public function recuperaBilhete(Request $request) {

        
        $cupomAposta = CupomAposta::where('codigo_unico', $request->codigo)

        ->leftJoin('users as usuario', 'usuario.id', '=', 'cupom_aposta.idusuario')
        ->leftJoin('users as cambista', 'cambista.id','=','cupom_aposta.idcambista')
        ->select('cupom_aposta.*', 'usuario.id as idusuario', 'usuario.name', 'cambista.id as idcambista', 'cambista.name as cambistaName', DB::raw("date_format(cupom_aposta.created_at, '%d/%m/%Y as %H:%i:%s') as data_aposta"))->first();


    if(!$cupomAposta){

        return redirect('/lite/minhas-apostas')->with('erro', 'Cupom não encontrado');

    }



    $cupomApostaItem = CupomApostaItem::leftJoin('events', 'events.id','=','cupom_aposta_item.idevent')

    ->leftJoin('odds', 'odds.id','=','cupom_aposta_item.idodds')

    ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

    ->leftJoin('ligas', 'ligas.id','=','events.idliga')

    ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')

    ->where('cupom_aposta_item.idcupom', $cupomAposta->id)->select('cupom_aposta_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'odds.id as idodds', 'valor_momento', 'esportes.nome_traduzido as nome_esporte', 'ligas.nome_traduzido as nome_liga', 'cupom_aposta_item.valor_momento', 'cupom_aposta_item.status_resultado', 'events.data')->get();



    if(count($cupomApostaItem) > 0){

        $i = 0;

        foreach($cupomApostaItem as $dados){

            if($dados->idhome != ''){

                $sql_time_home = Times::find($dados->idhome);

                $sql_time_away = Times::find($dados->idaway);



                $cupomApostaItem[$i]->time_home = $sql_time_home->nome;
                $cupomApostaItem[$i]->time_home = $sql_time_home->nome;

                $cupomApostaItem[$i]->time_away = $sql_time_away->nome;



                $i++;

            }

        }

    }



    $data = [

        'cupomAposta' => $cupomAposta,

        'cupomApostaItem' => $cupomApostaItem

    ];
    return \PDF::loadView('client.app_bilhete', $data)->stream('nome-arquivo-pdf-gerado.pdf');

    }

    public function adicionarAposta(Request $request){

        $input = $request->all();

        $id = $request->id;
        $config =\DB::table('campos_fixos')->first(); 


        $novoCarrinho = NovoCarrinho::where('session_id', auth()->user()->id)->get();



        if(count($novoCarrinho) > 0){

            $idcarrinho = $novoCarrinho[0]->id;

        }else{

            $novoCarrinho = new NovoCarrinho;

            $novoCarrinho->session_id = auth()->user()->id;

            $novoCarrinho->valor_total_cotas = 0;

            $novoCarrinho->valor_total_apostado = 0;

            $novoCarrinho->save();



            $idcarrinho = $novoCarrinho->id;

        }



        $item = NovoCarrinhoItem::where('idcarrinho', $idcarrinho)->where('idodd', $id)->get();



        if(count($item) > 0){

            //ja tem essa selecão, então remove

            NovoCarrinhoItem::where('id', $item[0]->id)->delete();

            $novoCarrinho = NovoCarrinho::where('session_id', auth()->user()->id)->get();


            return response()->json([

                'status' => 'ok',

                'acao' => 'unselect',
                'carrinho' => $novoCarrinho,
                

            ]);

        }else{



            $sqlodd = Odds::leftJoin('events', 'events.id','=','odds.idevent')

                ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

                ->where('odds.id', $id)->select('odds.id', 'odds.idevent', 'odds.name', 'odds.odds','odds_subgrupo.titulo_traduzido as subgrupo')->get();



            if(count($sqlodd) < 1){

                return response()->json([

                    'status' => 'erro',

                    'mensagem' => 'Odd não encontrada'

                ]);

            }



            $e = NovoCarrinhoItem::where('idevent', $sqlodd[0]->idevent)->get();



            if(count($e) > 0){

                NovoCarrinhoItem::where('id', $e[0]->id)->delete();

            }


            $item = new NovoCarrinhoItem;

            $item->idcarrinho = $idcarrinho;

            $item->idevent = $sqlodd[0]->idevent;

            $item->idodd = $sqlodd[0]->id;

            $item->cota_momento = $sqlodd[0]->odds;

            $item->save();

        }



        //faz a multiplicacao das cotas e atualiza o carrinho

        $itensCarrinho = NovoCarrinhoItem::leftJoin('novo_carrinho', 'novo_carrinho.id','=','novo_carrinho_item.idcarrinho')

            ->select("novo_carrinho_item.*")->where('session_id', auth()->user()->id)->get();



        $multiplicacao = 1;

        $soma = 0;



        if(count($itensCarrinho) > 0){

            foreach($itensCarrinho as $dados){

                $multiplicacao = $multiplicacao * $dados->cota_momento;

                $soma = $soma + $dados->cota_momento;

            }

        }



        NovoCarrinho::where('session_id', auth()->user()->id)->update([

            'valor_total_cotas' =>  $multiplicacao

        ]);
        $novoCarrinho = NovoCarrinho::where('session_id', auth()->user()->id)->get();
        return response()->json([

            'status' => 'ok',

            'acao' => 'select',

            'idevent' => $sqlodd[0]->idevent,
            'carrinho' => $novoCarrinho,

        ]);

    }

    public function recuperarCarrinho(){
        $config =\DB::table('campos_fixos')->first(); 

        $sql = NovoCarrinho::leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

            ->leftJoin('events', 'events.id','=','novo_carrinho_item.idevent')

            ->leftJoin('odds', 'odds.id','=','novo_carrinho_item.idodd')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select('novo_carrinho_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo','events.id as jogoId', 'events.idhome', 'events.idaway', 'valor_total_cotas', 'valor_total_apostado', 'odds.id as idodds', 'novo_carrinho_item.cota_momento')

            ->where('session_id', auth()->user()->id)
            ->where('novo_carrinho_item.id','!=', null)
            ->get();



        if(count($sql) > 0){

            $i = 0;

            foreach($sql as $dados){



                $sql_time_home = Times::find($dados->idhome);

                $sql_time_away = Times::find($dados->idaway);



                if($sql_time_home != null){ $sql[$i]->time_home = $sql_time_home->nome; }

                if($sql_time_away != null){ $sql[$i]->time_away = $sql_time_away->nome; }





                $i++;

            }

        }else{

            return response()->json([

                'status' => 'ok',

                'response' => []

            ]);

        }



        $sqlTotal = NovoCarrinho::where('session_id',auth()->user()->id)->get();



        $valor_total_cotas = 0;

        $valor_total_apostado = 0;



        if(count($sqlTotal) > 0){

            $valor_total_cotas = $sqlTotal[0]->valor_total_cotas;

            $valor_total_apostado = $sqlTotal[0]->valor_total_apostado;

        }



        $possivel_retorno = $valor_total_apostado * $valor_total_cotas;

        $possivel_retorno = ($possivel_retorno > $config->premio_maximo &&  $config->premio_maximo != 0 ? $config->premio_maximo: $possivel_retorno);


        $valor_total_cotas =  ( $valor_total_cotas > $config->cotacao_maxima &&  $config->cotacao_maxima != 0 ? $config->cotacao_maxima:  $valor_total_cotas);



        return response()->json([

            'status' => 'ok',

            'response' => $sql,

            'valor_total_cotas' => $valor_total_cotas,

            'valor_total_apostado' => $valor_total_apostado,

            'possivel_retorno' => $possivel_retorno,

            'possivel_retorno_format' => 'R$ '.number_format($possivel_retorno,2,',','.'),

            'valor_total_apostado_format' => 'R$ '.number_format($valor_total_apostado,2,',','.'),
            'config' => $config

        ]);

    }

    public function postFinalizarAposta(Request $request){

        $input = $request->all();
       
        $config =\DB::table('campos_fixos')->first();

        $sql = NovoCarrinho::where('session_id',  auth()->user()->id)->get();

        // dd($input);
        if(count($sql) < 1){

            return Response()->json(['error' => true, 'message' =>  'Cupom de aposta esta vazio']);

        }
        if(!isset( $request->newstake_hidden) ||   $request->newstake_hidden == 0 || is_null( $request->newstake_hidden)){
            return Response()->json(['error' => true, 'message' =>  'Você não pode fazer uma aposta com valor vazio']);

        }


        $sqlItem = NovoCarrinhoItem::join('events', 'novo_carrinho_item.idevent', 'events.id')->where('novo_carrinho_item.idcarrinho', $sql[0]->id)->get();

        // foreach ($sqlItem as $jogo){

        //     if($jogo->inplay){
        //         $response = \Http::get('https://api.b365api.com/v1/event/view?token=&LNG_ID=22&event_id='.$jogo->bet365_id.'&token='.config('app.API_TOKEN'));
        //         if( $response->successful() ){
        //             $response = json_decode($response->body());

        //             if($response->results[0]->timer){
        //                 $time = $response->results[0]->timer->tm * 60 +  $response->results[0]->timer->ts;
        //                 if($time > 30){
        //                     $sqlItem = NovoCarrinhoItem::destroy($jogo->id);
        //                     return Response()->json(['error' => true, 'message' => 'Bilhete não pode ser validado pois os jogos já começaram']);
        //                 }
        //             }
        //         }else{
        //             $sqlItem = NovoCarrinhoItem::destroy($jogo->id);

        //             return Response()->json(['error' => true, 'message' => 'Bilhete não pode ser validado pois os jogos já começaram']);
        //         }
        //     }else{
        //         if($jogo->data < \Carbon\Carbon::now()){
        //             $sqlItem = NovoCarrinhoItem::destroy($jogo->id);

        //             return Response()->json(['error' => true, 'message' => 'Bilhete não pode ser validado pois os jogos já começaram']);
        //        }
        //     }
          
        // }


        if(count($sqlItem) < 1){

            return Response()->json(['error' => true, 'message' => 'Cupom de aposta esta vazio']);

        }

        if(count($sqlItem) < $config->quantidade_minima_jogos && $config->quantidade_minima_jogos != 0 ){

            return Response()->json(['error' => true, 'message' => 'A quantidade minima de jogos por bilhete é:'.$config->quantidade_minima_jogos]);

        }

        if($sql[0]->valor_total_cotas < $config->cotacao_minima && $config->cotacao_minima != 0 ){


            return Response()->json(['error' => true, 'message' => 'A quantidade minima da cotação:'.number_format($config->cotacao_minima,2,'.',',')]);

        }
   
        /*if( !Auth::check() ){

            return redirect('/lite/login')->with('erro', 'Digite o seu email e senha para continuar');

        }*/



        #Verifica se o cliente esta logado

        if( Auth::check() ){

            if( auth()->user()->status != 1 ){

                return Response()->json(['error' => true, 'message' => 'Usuario invalido']);


            }



            //verifica o total da aposta

            $valor_total_cotas = $sql[0]->valor_total_cotas;
            if(isset( $request->newstake_hidden) ||  $request->newstake_hidden != 0 ){
                $valor_total_apostado =  $request->newstake_hidden;
            }else{
                $valor_total_apostado = $request->newstake_hidden;

            }

            if($config->valor_minimo_aposta >  $valor_total_apostado && $config->valor_minimo_aposta != 0){
                return Response()->json(['error' => true, 'message' => 'O Valor minimo para aposta é: R$ '.number_format($config->valor_minimo_aposta,2,',','.')]);
            
            }
            if($config->valor_maximo_aposta <  $valor_total_apostado && $config->valor_maximo_aposta != 0){
                return Response()->json(['error' => true, 'message' => 'O Valor maximo para aposta é: R$ '.number_format($config->valor_maximo_aposta,2,',','.')]);
            
            }
            $creditos = Creditos::where('idusuario', auth()->user()->id)->select(DB::raw("sum(saldo_apostas + saldo_liberado) as soma"), 'saldo_apostas', 'saldo_liberado')->get();



            if(count($creditos) > 0){

                if(Auth::user()->tipo_usuario == 1 && $creditos[0]->soma < $valor_total_apostado ){

                    return Response()->json(['error' => true, 'message' => 'Créditos insuficientes para realizar a aposta']);

                }else{



                    //return redirect('/lite/meu-cupom')->with('erro', 'Créditos insuficientes para realizar a aposta');



                    $saldo_apostas = $creditos[0]->saldo_apostas;

                    $saldo_liberado = $creditos[0]->saldo_liberado;

                    $diferenca = 0;



                    $total = $sql[0]->valor_total_apostado;



                    if( $saldo_apostas < $total ){

                        $diferenca = $total - $saldo_apostas;

                    }



                    try{

                        DB::beginTransaction();



                        if($diferenca > 0){

                            Creditos::where('idusuario', auth()->user()->id)->update([

                                'saldo_apostas' => '0',

                                'saldo_liberado' => DB::raw("(saldo_liberado - ".$diferenca.")")

                            ]);

                        }


                        //faz a aposta real

                        $cupomAposta = new CupomAposta;

                        $cupomAposta->idusuario = auth()->user()->id;

                        $cupomAposta->status = 1;

                        $cupomAposta->valor_apostado = $valor_total_apostado;

                        $cupomAposta->possivel_retorno = 0;

                        $cupomAposta->retorno_real = 0;

                        $cupomAposta->codigo_unico = substr(uniqid(), 0, 8);

                        $cupomAposta->save();



                        $total_apostado = 0;

                        $possivel_retorno = 0;



                        foreach($sqlItem as $dados){



                            $cupomApostaItem = new CupomApostaItem;

                            $cupomApostaItem->idcupom = $cupomAposta->id;

                            $cupomApostaItem->idevent = $dados->idevent;

                            $cupomApostaItem->idodds = $dados->idodd;

                            $cupomApostaItem->valor_momento = $dados->cota_momento;

                            $cupomApostaItem->valor_apostado = 0;

                            $cupomApostaItem->status_conferido = 0;

                            $cupomApostaItem->status_resultado = 0;

                            $cupomApostaItem->save();



                            $temp = $dados->valor_momento * $dados->valor_apostado;

                            $total_apostado = $total_apostado + $dados->valor_apostado;

                            $possivel_retorno = $possivel_retorno + $temp;

                        }



                        $cupomAposta = CupomAposta::find($cupomAposta->id);

                        $cupomAposta->valor_apostado = $valor_total_apostado;
                        if($sql[0]->valor_total_cotas > $config->cotacao_maxima && $config->cotacao_maxima != 0 ){
                
                            $cupomAposta->possivel_retorno = $valor_total_apostado * $config->cotacao_maxima;

                            $cupomAposta->total_cotas = $config->cotacao_maxima;
                
                
                        }else{
                            
                            $cupomAposta->possivel_retorno = $valor_total_apostado * $sql[0]->valor_total_cotas;

                            $cupomAposta->total_cotas = $sql[0]->valor_total_cotas;

                        }

                        if($config->premio_maximo < ($valor_total_apostado * $cupomAposta->total_cotas) && $config->premio_maximo != 0 ){
                            $cupomAposta->possivel_retorno = $config->premio_maximo;
                        }

                        $cupomAposta->save();

                        if(Auth::user()->tipo_usuario == 4){
                            if($cupomAposta) {
                                $cupomAposta->idcambista = Auth::user()->id;
                                $cupomAposta->status = 1;
                                $cupomAposta->save();
            
                                $jogos = CupomApostaItem::where('idcupom', $cupomAposta->id)->count();
    
                                if(Auth::user()->idgerente){
                                    $comissaoGerente = GerentesCampos::where('idusuario',Auth::user()->idgerente)->first();
                                    $porcentagem = $comissaoGerente->comissao / 100;
                                    $comissao = $cupomAposta->valor_apostado * $comissaoGerente->porcentagem;
                                    $credito = Creditos::where('idusuario', Auth::user()->idgerente)->first();
                                    $credito->saldo_liberado =  $credito->saldo_liberado + $comissao;
                                    $credito->save();
                                }
                                $comissoes = CambistasComissoes::where('idusuario', Auth::user()->id)->first();
            
                                if($comissoes){
                                    if($jogos == 1){ $porcentagem = $comissoes->comissao1jogo / 100; }
                                    if($jogos == 2){ $porcentagem = $comissoes->comissao2jogo / 100; }
                                    if($jogos == 3){ $porcentagem = $comissoes->comissao3jogo / 100; }
                                    if($jogos == 4){ $porcentagem = $comissoes->comissao4jogo / 100; }
                                    if($jogos == 5){ $porcentagem = $comissoes->comissao5jogo / 100; }
                                    if($jogos == 6){ $porcentagem = $comissoes->comissao6jogo / 100; }
                                    if($jogos == 7){ $porcentagem = $comissoes->comissao7jogo / 100; }
                                    if($jogos >= 8){ $porcentagem = $comissoes->comissao7jogo / 100; }
                                    $comissao = $cupomAposta->valor_apostado * $porcentagem;
                                    $credito = Creditos::where('idusuario', Auth::user()->id)->first();
                                    $credito->saldo_liberado = $credito->saldo_liberado + $comissao;
                                    $credito->save();
                                    
                                }
                                
            
                            }
                        }
                      


                        NovoCarrinho::where('session_id',  auth()->user()->id)->delete();

                        NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->delete();



                        DB::commit();

                        return Response()->json(['error' => false, "bilhete" => ['ticket' => $cupomAposta, 'jogos' => $jogos]]);


                        // return redirect('/minhas-apostas/visualizar-cupom/'.$cupomAposta->codigo_unico.'')->with('sucesso', 'Sua aposta foi efetuada com sucesso');

                    }catch(Exception $e){

                        DB::rollback();

                    }

                }

            }

        }else{

            return Response()->json(['error' => true, 'message' => 'Você precisa está logado']);


        }

    }

    public function removeSelection(Request $request){
        $input = $request->all();

        $sql = NovoCarrinhoItem::leftJoin('novo_carrinho', 'novo_carrinho.id','=','novo_carrinho_item.idcarrinho')->where('session_id', auth()->user()->id)->where('novo_carrinho_item.id', $request->id)->delete();


        $itensCarrinho = NovoCarrinhoItem::leftJoin('novo_carrinho', 'novo_carrinho.id','=','novo_carrinho_item.idcarrinho')

            ->select("novo_carrinho_item.*")->where('session_id', session()->getId())->get();



        $multiplicacao = 1;

        $soma = 0;


        if(count($itensCarrinho) > 0){

            foreach($itensCarrinho as $dados){

                $multiplicacao = $multiplicacao * $dados->cota_momento;

                $soma = $soma + $dados->cota_momento;

            }

        }



        NovoCarrinho::where('session_id', session()->getId())->update([

            'valor_total_cotas' => $multiplicacao

        ]);



        if($soma == 0){

            NovoCarrinho::where('session_id', session()->getId())->delete();

        }



        return Response()->json('Removido com sucesso');

    }

    public function moreOdds(Request $request){
        $data = $request->all();
        $event = Events::where('events.id',  $data['id'])->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

        ->select('events.*', 'ligas.nome_traduzido', DB::raw("date_format(events.data, '%d %M') as data_format"), DB::raw("date_format(events.data, '%H:%i') as hora_format"))->get();


        $sql_odds_principal = Odds::where('idevent',  $data['id'])->where('idsubgrupo', 79)->get();



        $odds_grupos = OddsGrupo::orderBy('id', 'desc')->get();



        foreach($event as $dados){

            $eng = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $pot = ['Jan', 'Fev', 'Mar', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];



            $data = str_replace($eng, $pot, $dados->data_format);

            $event[0]->data_format = $data;

        }
        $sql_time_home = Times::find($event[0]->idhome);

        $sql_time_away = Times::find($event[0]->idaway);

        foreach($odds_grupos as $odd_grupo){
            $consulta = DB::table('odds_subgrupo')->where('idgrupo', $odd_grupo->id)->where('status', 1)->get();

            foreach($consulta as $sub_grupo){
                $odds = DB::table('odds')->where('idsubgrupo', $sub_grupo->id)->where('status',1)->where('idevent', $event[0]['id'])->get();
                $sub_grupo->odds = $odds->toArray();
            }

            $odd_grupo['sub_grupo'] =  $consulta->toArray();
         }
        $dados = [

            'event' => $event,
            'home' => $sql_time_home,
            'away' => $sql_time_away,
            'sql_odds_principal' => $sql_odds_principal,

            'odds_grupo' => $odds_grupos

        ];
 
        return Response()->json($dados);

    }
    public function postValidarBilhete(Request $request){
    
        if(Auth::user()->tipo_usuario != 1){
            try {
                $aposta = CupomAposta::where('codigo_unico', $request->bilhete)->where('status', 4)->first();
                if($aposta) {


                    $jogos = CupomApostaItem::join('events', 'cupom_aposta_item.idevent', 'events.id')->where('idcupom', $aposta->id)->get();

                    foreach ($jogos as $jogo){

                        if($jogo->inplay){
                            $response = \Http::get('https://api.b365api.com/v1/event/view?token=&LNG_ID=22&event_id='.$jogo->bet365_id.'&token='.config('app.API_TOKEN'));
                            if( $response->successful() ){
                                $response = json_decode($response->body());

                                if($response->results[0]->timer){
                                    $time = $response->results[0]->timer->tm * 60 +  $response->results[0]->timer->ts;
                                    if($time > 30){
                                        return Response()->json(['error' => true, 'message' => 'Bilhete não pode ser validado pois os jogos já começaram']);
                                    }
                                }
                            }else{
                                return Response()->json(['error' => true, 'message' => 'Bilhete não pode ser validado pois os jogos já começaram']);
                            }
                        }else{
                            if($jogo->data < \Carbon\Carbon::now()){
                                return Response()->json(['error' => true, 'message' => 'Bilhete não pode ser validado pois os jogos já começaram']);
                           }
                        }
                      
                    }
                    DB::beginTransaction();
                    $aposta->idcambista = Auth::user()->id;
                    $aposta->status = 1;
                    $aposta->save();

                    $jogos = CupomApostaItem::where('idcupom', $aposta->id)->count();

                    if(Auth::user()->idgerente){
                       $comissaoGerente = GerentesCampos::where('idusuario',Auth::user()->idgerente)->first();
                       $porcentagem = $comissaoGerente->comissao / 100;
                       $comissao = $aposta->valor_apostado * $comissaoGerente->porcentagem;
                       $credito = Creditos::where('idusuario', Auth::user()->idgerente)->first();
                       $credito->saldo_liberado =  $credito->saldo_liberado + $comissao;
                       $credito->save();
                    }
                    $comissoes = CambistasComissoes::where('idusuario', Auth::user()->id)->first();

                    if($comissoes){
                        if($jogos == 1){ $porcentagem = $comissoes->comissao1jogo / 100; }
                        if($jogos == 2){ $porcentagem = $comissoes->comissao2jogo / 100; }
                        if($jogos == 3){ $porcentagem = $comissoes->comissao3jogo / 100; }
                        if($jogos == 4){ $porcentagem = $comissoes->comissao4jogo / 100; }
                        if($jogos == 5){ $porcentagem = $comissoes->comissao5jogo / 100; }
                        if($jogos == 6){ $porcentagem = $comissoes->comissao6jogo / 100; }
                        if($jogos == 7){ $porcentagem = $comissoes->comissao7jogo / 100; }
                        if($jogos >= 8){ $porcentagem = $comissoes->comissao7jogo / 100; }
                        $comissao = $aposta->valor_apostado * $porcentagem;
                        $credito = Creditos::where('idusuario', Auth::user()->id)->first();
                        $credito->saldo_liberado = $credito->saldo_liberado + $comissao;
                        $credito->save();
                        
                    }
                    
                    DB::commit();
                    return Response()->json(['error' => false, 'message' => 'Bilhete Validado com sucesso']);
                    
                }else{
                    return Response()->json(['error' => true, 'message' => 'Bilhete não encontrado ou já validado']);

                    
                }
            } catch (\Throwable $th) {
                
                DB::rollback();
             
            }
           
        }else{
            return Response()->json(['error' => true, 'message' => 'Sem Permissão']);

            

        }
        

    }
    public function viewIndexData(Request $request){
        $date = \Carbon\Carbon::now();

        $nextD = $date->addDay(1)->toDateTime();
      
        /*$jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('idesporte', 1)

            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga')->groupBy('idliga')->take('20')->get();

*/
        if( $request->date <= date('Y-m-d')){
            return Response()->json(['error' => true, 'message' => 'Data Invalida']);
        }
        $sql1 = Events::whereDate('data', '>=', $request->date)->where('data','<=', $request->date.' 23:59:59')->orderBy('data', 'asc')

        ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

        ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

        ->where('idesporte', 1)//->where('ligas.status', 1)

        ->select('events.idliga', 'paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->paginate(4);



        $array_pais = [];


        if(count($sql1) == 0){
                
            $sql1 = Events::whereDate('data', '>=', $request->date)->where('data','<=', $request->date.' 23:59:59')->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

            ->where('idesporte', 1)//->where('ligas.status', 1)

            ->select('events.idliga', 'paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->get();


        }
        if(count($sql1) > 0){

        foreach($sql1 as $dados1){

            $jogos_aba_futebol = Events::whereDate('data', '>=', $request->date)->where('data','<=', $request->date.' 23:59:59')->orderBy('data', 'asc')

                ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

                ->where('idesporte', 1)->where('ligas.status', 1)->where('ligas.idpais', $dados1->idpais)

                ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->get();


            
            if(count($jogos_aba_futebol) == 0){
                $jogos_aba_futebol = Events::whereDate('data', '>=', $request->date)->where('data','<=', $request->date.' 23:59:59')->orderBy('data', 'asc')

                ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

                ->where('idesporte', 1)->where('ligas.status', 1)->where('ligas.idpais', $dados1->idpais)

                ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->get();

            }
                


            $array_ligas = [];



            if(count($jogos_aba_futebol) > 0){

                foreach($jogos_aba_futebol as $dados){



                    $jogos = Events::whereDate('data', '>=', $request->date)->where('data','<=', $request->date.' 23:59:59')->orderBy('data', 'asc')

                        ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                        ->where('idesporte', 1)->where('idliga', $dados->idliga)

                        ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();

                    if(count($jogos) == 0){
                        $jogos = Events::whereDate('data', '>=', $request->date)->where('data','<=', $request->date.' 23:59:59')->orderBy('data', 'asc')

                        ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                        ->where('idesporte', 1)->where('idliga', $dados->idliga)

                        ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();


                    }
                    $array_jogos = [];

                    if(count($jogos) > 0){

                        foreach($jogos as $dados2){



                            $sql_time_home = Times::find($dados2->idhome);

                            $sql_time_away = Times::find($dados2->idaway);

                            $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();

                            if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                                $array_jogos[] = [

                                    'id' => $dados2->id,

                                    'data' => $dados2->data,

                                    'hora' => $dados2->hora,

                                    'home' => $sql_time_home->nome,

                                    'away' => $sql_time_away->nome,

                                    'total_odds' => $dados2->total_odds,

                                    'oddhome_id' => $sql_odds_principal[0]->id,

                                    'oddhome_value' => $sql_odds_principal[0]->odds,

                                    'oddhome_name' => $sql_odds_principal[0]->name,

                                    'odddraw_id' => $sql_odds_principal[1]->id,

                                    'odddraw_value' => $sql_odds_principal[1]->odds,

                                    'odddraw_name' => $sql_odds_principal[1]->name,

                                    'oddaway_id' => $sql_odds_principal[2]->id,

                                    'oddaway_value' => $sql_odds_principal[2]->odds,

                                    'oddaway_name' => $sql_odds_principal[2]->name,

                                ];



                            }

                        }

                    }



                    $array_ligas[] = [

                        'id' => $dados->idliga,

                        'liga' => $dados->nome_traduzido,

                        'jogos' => $array_jogos

                    ];

                }

            }

            //fim



            $array_pais[] = [

                'id' => $dados1->idpais,

                'pais' => $dados1->nome_traduzido,

                'bandeira' => $dados1->bandeira,

                'ligas' => $array_ligas

            ];

        }

        }


        $array_jogos_aba_futebol = $array_pais;
      



        $data = [
            'array_jogos_aba_futebol' => $array_jogos_aba_futebol,

            'data' => $request->date

        ];  
       
        return Response()->json($data);

    }
    public function viewJogosPorLiga($id){

        $jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('ligas.id', $id)

            ->where('idesporte', 1)->where('ligas.status', 1)

            ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->paginate(10);



        $array_ligas = [];



        if(count($jogos_aba_futebol) > 0){

            foreach($jogos_aba_futebol as $dados){



                $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                    ->where('idesporte', 1)->where('idliga', $dados->idliga)

                    ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();



                $array_jogos = [];



                if(count($jogos) > 0){

                    foreach($jogos as $dados2){



                        $sql_time_home = Times::find($dados2->idhome);

                        $sql_time_away = Times::find($dados2->idaway);

                        $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();



                        if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                            $array_jogos[] = [

                                'id' => $dados2->id,

                                'data' => $dados2->data,

                                'hora' => $dados2->hora,

                                'home' => $sql_time_home->nome,

                                'away' => $sql_time_away->nome,

                                'total_odds' => $dados2->total_odds,

                                'oddhome_id' => $sql_odds_principal[0]->id,

                                'oddhome_value' => $sql_odds_principal[0]->odds,

                                'oddhome_name' => $sql_odds_principal[0]->name,

                                'odddraw_id' => $sql_odds_principal[1]->id,

                                'odddraw_value' => $sql_odds_principal[1]->odds,

                                'odddraw_name' => $sql_odds_principal[1]->name,

                                'oddaway_id' => $sql_odds_principal[2]->id,

                                'oddaway_value' => $sql_odds_principal[2]->odds,

                                'oddaway_name' => $sql_odds_principal[2]->name,

                            ];

                        }

                    }

                }



                $array_ligas[] = [

                    'id' => $dados->idliga,

                    'liga' => $dados->nome_traduzido,

                    'jogos' => $array_jogos

                ];

            }

        }



        $array_jogos_aba_futebol = $array_ligas;



        $liga = Ligas::find($id);



        $data = [

            'array_ligas' => $array_ligas,

            'array_jogos_aba_futebol' => $array_jogos_aba_futebol,

            'liga' => $liga

        ];



        return Response()->json($data);

    }

    public function showJogosAoVivo(){
        $response = \Http::get('https://api.b365api.com/v1/events/inplay?sport_id=1&LNG_ID=22&token='.config('app.API_TOKEN'));
        $array_pais = [];
        $array_jogos = [];
        $array_ligas = [];
        $pais_id = 0;
        $liga_id = 0;
        if( $response->successful() ){
            $response = json_decode($response->body());
            foreach($response->results as $evento){

                $paises = DB::table('paises')
                ->where('cc', $evento->league->cc)
                ->select('paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->first();


                if($paises){
                    $jogos = Events::orderBy('data', 'asc')
                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
                    ->where('idesporte', 1)
                    ->where('idliga', $evento->league->id)
                    ->where('events.bet365_id', $evento->bet365_id)
                    ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id as jogoId', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->first();
                  
                    if($jogos) {


                        $time = $evento->timer->tm * 60 + $evento->timer->ts;
                        
                        $sql_time_home = Times::find($jogos->idhome);

                        $sql_time_away = Times::find($jogos->idaway);
                        $placar = explode('-', $evento->ss);
    
                        $sql_odds_principal = Odds::where('idevent', $jogos->jogoId)->where('idsubgrupo', 79)->get();
                        if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){
    
                            array_push($array_jogos,[
    
                                'id' => $jogos->jogoId,
    
                                'data' => $jogos->data,
                                'time' => substr($time,0,2),
    
                                'hora' => $jogos->hora,
    
                                'home' => $sql_time_home->nome,
    
                                'away' => $sql_time_away->nome,
                                'placarHome' =>  (isset($placar[0]) ? $placar[0] : 0),
                                'placarAway' =>  (isset($placar[1]) ? $placar[1] : 0),
                                'total_odds' => $jogos->total_odds,
    
                                'oddhome_id' => $sql_odds_principal[0]->id,
    
                                'oddhome_value' => $sql_odds_principal[0]->odds,
    
                                'oddhome_name' => $sql_odds_principal[0]->name,
    
                                'odddraw_id' => $sql_odds_principal[1]->id,
    
                                'odddraw_value' => $sql_odds_principal[1]->odds,
    
                                'odddraw_name' => $sql_odds_principal[1]->name,
    
                                'oddaway_id' => $sql_odds_principal[2]->id,
    
                                'oddaway_value' => $sql_odds_principal[2]->odds,
    
                                'oddaway_name' => $sql_odds_principal[2]->name,
    
                            ]);

                           
                        }
                        if($liga_id != $evento->league->id){
    
                        array_push($array_ligas, [
    
                            'id' =>  $evento->league->id,
    
                            'liga' =>  $evento->league->name,
    
                            'jogos' => $array_jogos
    
                        ]);
                        }
                        if($pais_id != $paises->idpais){
                            $pais_id = $paises->idpais;
                            $array_ligas = [];
                            $array_jogos = [];
                            $placar = explode('-', $evento->ss);

                            $sql_odds_principal = Odds::where('idevent', $jogos->jogoId)->where('idsubgrupo', 79)->get();
                            if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){
                            $time = $evento->timer->tm * 60 + $evento->timer->ts;
        
                            array_push($array_jogos,[
    
                                'id' => $jogos->jogoId,
    
                                'data' => $jogos->data,
                                'time' => substr($time,0,2),
    
                                'hora' => $jogos->hora,
    
                                'home' => $sql_time_home->nome,
    
                                'away' => $sql_time_away->nome,
                                'placarHome' =>  (isset($placar[0]) ? $placar[0] : 0),
                                'placarAway' =>  (isset($placar[1]) ? $placar[1] : 0),
                                'total_odds' => $jogos->total_odds,
    
                                'oddhome_id' => $sql_odds_principal[0]->id,
    
                                'oddhome_value' => $sql_odds_principal[0]->odds,
    
                                'oddhome_name' => $sql_odds_principal[0]->name,
    
                                'odddraw_id' => $sql_odds_principal[1]->id,
    
                                'odddraw_value' => $sql_odds_principal[1]->odds,
    
                                'odddraw_name' => $sql_odds_principal[1]->name,
    
                                'oddaway_id' => $sql_odds_principal[2]->id,
    
                                'oddaway_value' => $sql_odds_principal[2]->odds,
    
                                'oddaway_name' => $sql_odds_principal[2]->name,
    
                            ]);
                            }
                            array_push($array_ligas, [
    
                                'id' =>  $evento->league->id,
        
                                'liga' =>  $evento->league->name,
        
                                'jogos' => $array_jogos
        
                            ]);
                            array_push($array_pais, [
    
                                'id' => $paises->idpais,
                
                                'pais' => $paises->nome_traduzido,
                
                                'bandeira' => $paises->bandeira,
                
                                'ligas' => $array_ligas
                
                            ]);
                        }
                    }

                }
         
            }


        }

        $array_jogos_aba_futebol = $array_pais;



        $data = [

            // 'jogos_aba_futebol' => $jogos_aba_futebol,

            'jogos_destaque' => $array_jogos_aba_futebol,



        ];  


       return response()->json($data);

    }
}

