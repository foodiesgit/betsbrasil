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

            'jogos_destaque' => $array_pais

        ]);

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

        ->leftJoin('usuarios', 'usuarios.id', '=', 'cupom_aposta.idusuario')

        ->select('cupom_aposta.*', 'usuarios.id as idusuario', 'usuarios.nome', DB::raw("date_format(cupom_aposta.created_at, '%d/%m/%Y as %H:%i:%s') as data_aposta"))->get();



    if(count($cupomAposta) < 1){

        return redirect('/lite/minhas-apostas')->with('erro', 'Cupom não encontrado');

    }



    $cupomApostaItem = CupomApostaItem::leftJoin('events', 'events.id','=','cupom_aposta_item.idevent')

    ->leftJoin('odds', 'odds.id','=','cupom_aposta_item.idodds')

    ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

    ->leftJoin('ligas', 'ligas.id','=','events.idliga')

    ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')

    ->where('cupom_aposta_item.idcupom', $cupomAposta[0]->id)->select('cupom_aposta_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'odds.id as idodds', 'valor_momento', 'esportes.nome_traduzido as nome_esporte', 'ligas.nome_traduzido as nome_liga', 'cupom_aposta_item.valor_momento', 'cupom_aposta_item.status_resultado', 'events.data')->get();



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
    return \PDF::loadView('client.app_bilhete',  $data)
    // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
    ->stream('nome-arquivo-pdf-gerado.pdf');

    }

}

