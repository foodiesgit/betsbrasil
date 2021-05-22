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

use App\CupomAposta;

use App\CupomApostaItem;

use App\NovoCarrinho;

use App\NovoCarrinhoItem;



class AjaxController extends Controller{

    public function recuperaJogosLiga($id){

        $jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('ligas.id', $id)

            ->where('idesporte', 1)->where('ligas.status', 1)

            ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->take('20')->get();



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

                    'idliga' => $dados->idliga,

                    'liga' => $dados->nome_traduzido,

                    'jogos' => $array_jogos

                ];

            }

        }



        $array_jogos_aba_futebol = $array_ligas;



        $liga = Ligas::find($id);



        return response()->json([

            'status' => 'ok',

            'response' => $array_jogos_aba_futebol

        ]);

    }

    public function search(Request $request){
        $q = $request->all();
        if(isset($q['query'])){
            $jogos = Events::join('times as home', 'home.id', '=','events.idhome')
            ->join('times as away', 'away.id', '=','events.idaway')
            ->where(function($query) use($q) {
                $query->where('data', '>', date('Y-m-d H:i:s'));
                $query->where('home.nome','like', '%'.$q['query'].'%');
                $query->orwhere('away.nome','like', '%'.$q['query'].'%');
                $query->orwhere('data','like', '%'.$q['query'].'%');
            })
          
            // ->orWhere(function($query) use($q) {
            //     $query->where('ligas.nome','like', '%'.$q['query'].'%');
            // })
            ->where('data', '>', date('Y-m-d H:i:s'))
            // ->where('idesporte', 1)
            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id as betid', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds', 'away.nome as awayNome','home.nome as homeNome')->take(100)
            ->get();

            foreach ($jogos as $jogo) {
                
                $sql_odds_principal = Odds::where('idevent', $jogo['betid'])->get();
                if(count($sql_odds_principal) > 0){
                    $jogo['oddhome_id'] = $sql_odds_principal[0]->id;

                    $jogo['oddhome_value'] = $sql_odds_principal[0]->odds;
    
                    $jogo['oddhome_name'] = $sql_odds_principal[0]->name;
    
                    $jogo['odddraw_id'] = $sql_odds_principal[1]->id;
    
                    $jogo['odddraw_value'] = $sql_odds_principal[1]->odds;
    
                    $jogo['odddraw_name'] = $sql_odds_principal[1]->name;
    
                    $jogo['oddaway_id'] = $sql_odds_principal[2]->id;
    
                    $jogo['oddaway_value'] = $sql_odds_principal[2]->odds;
    
                    $jogo['oddaway_name'] = $sql_odds_principal[2]->name;
                }else{
                    $jogo['oddhome_id'] = '';

                    $jogo['oddhome_value'] = 0;
    
                    $jogo['oddhome_name'] = 'Casa';
    
                    $jogo['odddraw_id'] = '';
    
                    $jogo['odddraw_value'] = 0;
    
                    $jogo['odddraw_name'] = 'Empate';
    
                    $jogo['oddaway_id'] = '';
    
                    $jogo['oddaway_value'] = 0;
    
                    $jogo['oddaway_name'] = 'Fora';
                }

            }
            return Response()->json(['suggestions' => ['value'=> '1', 'data' => $jogos]]);
        }
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
    public function recuperaJogosDestaque_BKP(Request $request){

        $jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('idesporte', 1)//->where('ligas.status', 1)

            ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->take('20')->get();





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



        return response()->json([

            'status' => 'ok',

            'response1' => $array_jogos_aba_futebol

        ]);

    }



    public function recuperaJogosDestaque(Request $request){

        $sql1 = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

            ->where('idesporte', 1)//->where('ligas.status', 1)

            ->select('events.idliga', 'paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->get();



        $array_pais = [];



        if(count($sql1) > 0){

            foreach($sql1 as $dados1){

                $jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                    ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

                    ->where('idesporte', 1)->where('ligas.status', 1)->where('ligas.idpais', $dados1->idpais)

                    ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->get();





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

                //fim



                $array_pais[] = [

                    'id' => $dados1->idpais,

                    'pais' => $dados1->nome_traduzido,

                    'bandeira' => $dados1->bandeira,

                    'ligas' => $array_ligas

                ];

            }

        }



        return response()->json([

            'status' => 'ok',

            'response' => $array_pais

        ]);



    }



    public function adicionarAposta(Request $request){

        $input = $request->all();
 
        $id = $input['id'];
        $config =\DB::table('campos_fixos')->first(); 


        $novoCarrinho = NovoCarrinho::where('session_id', session()->getId())->get();



        if(count($novoCarrinho) > 0){

            $idcarrinho = $novoCarrinho[0]->id;

        }else{

            $novoCarrinho = new NovoCarrinho;

            $novoCarrinho->session_id = session()->getId();

            $novoCarrinho->valor_total_cotas = 0;

            $novoCarrinho->valor_total_apostado = 0;

            $novoCarrinho->save();



            $idcarrinho = $novoCarrinho->id;

        }



        $item = NovoCarrinhoItem::where('idcarrinho', $idcarrinho)->where('idodd', $id)->get();



        if(count($item) > 0){

            //ja tem essa selecão, então remove

            NovoCarrinhoItem::where('id', $item[0]->id)->delete();



            return response()->json([

                'status' => 'ok',

                'acao' => 'unselect'

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

            'valor_total_cotas' =>  $multiplicacao

        ]);

        return response()->json([

            'status' => 'ok',

            'acao' => 'select',

            'idevent' => $sqlodd[0]->idevent

        ]);

    }



    public function recuperaCarrinho(Request $request){
        $config =\DB::table('campos_fixos')->first(); 

        $sql = NovoCarrinho::leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

            ->leftJoin('events', 'events.id','=','novo_carrinho_item.idevent')

            ->leftJoin('odds', 'odds.id','=','novo_carrinho_item.idodd')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select('novo_carrinho_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'valor_total_cotas', 'valor_total_apostado', 'odds.id as idodds', 'novo_carrinho_item.cota_momento')

            ->where('session_id', session()->getId())->get();



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



        $sqlTotal = NovoCarrinho::where('session_id', session()->getId())->get();



        $valor_total_cotas = 0;

        $valor_total_apostado = 0;

       

        if(count($sqlTotal) > 0){

            $valor_total_cotas = $sqlTotal[0]->valor_total_cotas;

            $valor_total_apostado = ($sqlTotal[0]->valor_total_apostado  >  $config->premio_maximo &&  $config->premio_maximo != 0 ? $config->premio_maximo : $sqlTotal[0]->valor_total_apostado);

        }

        $valor_total_cotas = ($valor_total_cotas < $config->cotacao_minima &&  $config->cotacao_minima != 0 ? $config->cotacao_minima:  $valor_total_cotas);

        $valor_total_cotas =  ( $valor_total_cotas > $config->cotacao_maxima &&  $config->cotacao_maxima != 0 ? $config->cotacao_maxima:  $valor_total_cotas);

        return response()->json([

            'status' => 'ok',

            'response' => $sql,

            'valor_total_cotas' => $valor_total_cotas,

            'valor_total_apostado' => $valor_total_apostado,

            'valor_total_apostado_format' => 'R$ '.number_format($valor_total_apostado,2,',','.')

        ]);

    }

}

