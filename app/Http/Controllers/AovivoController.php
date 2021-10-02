<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Paises;

use App\Events;

use App\Times;

use App\Estadios;

use App\Odds;
use App\Ligas;
use App\Esportes;
use App\NovoCarrinho;
use DB;
use App\OddsSubGrupo;
class AovivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        set_time_limit(-1);
        $i = 1;

        $sair = false;
           
            do{
                $response = \Http::get('https://api.b365api.com/v1/events/inplay?sport_id=1&token='.config('app.API_TOKEN'));
                if($response->successful()){
                    $json = json_decode($response->body(), false);
                    if(count($json->results) > 0){
    
    
    
                        foreach($json->results as $dados_json){
    
    
                            $events = Events::find($dados_json->id);
    
    
    
                            if($events == null){ $events = new Events; }
    
    
    
                            if(isset($dados_json->id)){
                                $data = \Carbon\Carbon::createFromTimestamp($dados_json->time, 'America/Sao_Paulo')->format('Y-m-d H:i:s'); 
                                $events->id = $dados_json->id;
    
                                $events->data_time = $dados_json->time;
                                $events->data = $data;
                                if($dados_json->time_status == 3){
                                    $events->inplay = 3;
                                }else if ($dados_json->time_status == 1){
                                    $events->inplay = 1;
                                }
    
                                $events->idliga = $dados_json->league->id;
    
    
    
                                //Verifica se o time Home ja esta cadastrado
    
                                $times = Times::find($dados_json->home->id);
    
    
    
                                if($times == null){
    
                                    $sqlPais = Paises::where('cc', $dados_json->home->cc)->get();
                                    // $idpais = 0;
                                    if(count($sqlPais) > 0){ $idpais = $sqlPais[0]->id; }else{ $idpais = 0; }
    
    
    
                                    $times = new Times;
    
                                    $times->id = $dados_json->home->id;
    
                                    $times->nome = $dados_json->home->name;
    
                                    $times->image_id = $dados_json->home->image_id;
    
                                    $times->idpais = $idpais;
    
                                    $times->save();
    
                                }
    
                                $events->idhome = $times->id;
    
    
    
                                //Verifica se o time Away ja esta cadastrado
    
                                $times = Times::find($dados_json->away->id);
    
                                if($times == null){
    
                                    $sqlPais = Paises::where('cc', $dados_json->away->cc)->get();
                                    // $idpais = 0;
    
    
                                    if(count($sqlPais) > 0){ $idpais = $sqlPais[0]->id; }else{ $idpais = 0; }
    
    
    
                                    $times = new Times;
    
                                    $times->id = $dados_json->away->id;
    
                                    $times->nome = $dados_json->away->name;
    
                                    $times->image_id = $dados_json->away->image_id;
    
                                    $times->idpais = $idpais;
    
                                    $times->save();
    
                                }
    
                                $events->idaway = $times->id;
    
                                if(isset($dados_json->id)){
                                  
                                    $events->bet365_id = isset($dados_json->bet365_id) ? $dados_json->bet365_id: 0;
    
                                }
    
    
    
                                if(isset($dados_json->extra->stadium_data->id)){
    
                                    $estadio = Estadios::find($dados_json->extra->stadium_data->id);
    
                                    if($estadio == null){ $estadio = new Estadios; }
    
    
                                    $estadio->id = $dados_json->extra->stadium_data->id;
    
                                    $estadio->name = $dados_json->extra->stadium_data->name;
    
                                    $estadio->city = $dados_json->extra->stadium_data->city;
    
                                    $estadio->country = $dados_json->extra->stadium_data->country;
    
                                    $estadio->capacity = $dados_json->extra->stadium_data->capacity;
    
                                    $estadio->googlecoords = $dados_json->extra->stadium_data->googlecoords;
    
                                    $estadio->save();
    
    
    
                                    $events->idestadio = $estadio->id;
    
                                }
    
    
    
                                $events->save();
                               
    
                            }
    
                        }
    
                    }else{
    
                        $sair = true;
    
                    }
    
                }else{
    
                    $sair = true;
    
                }
    
    
    
                if($i == 99){ $sair = true; }
    
    
    
                $i++;
    
            }while($sair == false);
    
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


                        $time = $evento->timer->tm;
                        
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
                            $time = $evento->timer->tm;
        
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
                            if(count($array_jogos) > 0){
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


        }
        $array_jogos_aba_futebol = asort($array_pais);

        // $date = \Carbon\Carbon::now();
        // $nextD = $date->addDay(1)->toDateTime();
        // $campeonatosDestaque = Ligas::where('status', 1)->where('destaque', 1)->get();

        // $paisesDestaque = Paises::where('status', 1)->where('destaque', 1)->get();

        // $esportes = Esportes::where('status', 1)->get();



        /*$jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('idesporte', 1)

            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga')->groupBy('idliga')->take('20')->get();

*/

        $array_jogos_aba_futebol = $array_pais;


        $sqlNovoCarrinho = NovoCarrinho::leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

            ->leftJoin('events', 'events.id','=','novo_carrinho_item.idevent')

            ->leftJoin('odds', 'odds.id','=','novo_carrinho_item.idodd')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select('novo_carrinho_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'valor_total_cotas', 'valor_total_apostado', 'odds.id as idodds', 'cota_momento')->where('session_id', session()->getId())->get();



        $total_carrinho = NovoCarrinho::where('session_id', session()->getId())->get();



        if(count($sqlNovoCarrinho) > 0){

            $i = 0;

            foreach($sqlNovoCarrinho as $dados){



                if($dados->idhome != ''){

                    $sql_time_home = Times::find($dados->idhome);

                    $sql_time_away = Times::find($dados->idaway);



                    $sqlNovoCarrinho[$i]->time_home = $sql_time_home->nome;

                    $sqlNovoCarrinho[$i]->time_away = $sql_time_away->nome;



                    $i++;

                }

            }

        }


        $data = [

            // 'jogos_aba_futebol' => $jogos_aba_futebol,

            'array_jogos_aba_futebol' => $array_jogos_aba_futebol,

            'sqlNovoCarrinho' => $sqlNovoCarrinho,

            'total_carrinho' => $total_carrinho

        ];  


        return view('client.aovivo', $data);

    }


    public function ajaxAoVivo(){
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

                        $sql_time_home = Times::find($jogos->idhome);

                        $sql_time_away = Times::find($jogos->idaway);

                        $time = $evento->timer->tm;

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
                                'placarHome' =>   (isset($placar[0]) ? $placar[0] : 0),
                                'placarAway' =>  (isset($placar[1]) ? $placar[1] : 0),
    
                                'total_odds' => $jogos->total_odds,
    
                                'oddhome_id' => $sql_odds_principal[0]->id,
    
                                'oddhome_value' =>$sql_odds_principal[0]->odds,
    
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
                            $time = $evento->timer->tm;
                            array_push($array_jogos,[
    
                                'id' => $jogos->jogoId,
    
                                'data' => $jogos->data,
    
                                'hora' => $jogos->hora,
                                'time' => substr($time,0,2),
    
                                'home' => $sql_time_home->nome,
    
                                'away' => $sql_time_away->nome,
                                'placarHome' =>   (isset($placar[0]) ? $placar[0] : 0),
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
                            if(count($array_jogos) > 0){
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


        }
        $array_pais;
        $dados = [
            'data' => $array_pais
        ];
        return Response()->json( $dados );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
