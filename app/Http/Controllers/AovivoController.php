<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Paises;

use App\Events;

use App\Times;

use App\Estadios;

use App\Odds;



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
                                $this->atualizaOdds($events->id);
    
                                $this->somaTotalOdds($events->id);
    
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
    public function somaTotalOdds($idevent){

        $sql = Odds::where('idevent', $idevent)->select(\DB::raw("count(*) as total"))->where('odds','>',0)->get();



        if(count($sql) > 0){

            foreach($sql as $dados){

                $event = Events::find($idevent);

                $event->total_odds = $dados->total;

                $event->save();

            }

        }

    }

    public function atualizaOdds($idevent){

        $events = Events::find($idevent);
        // dd('https://api.betsapi.com/v1/bet365/prematch?token='.config('app.API_TOKEN').'&FI='.$events->bet365_id.'');
        $response = \Http::get('https://api.betsapi.com/v1/bet365/prematch?token='.config('app.API_TOKEN').'&FI='.$events->bet365_id.'');

        if( $response->successful() ){
            
            $json = json_decode($response->body(), false);



            try{

                if($json->success != '1'){ throw new Exception('Erro ao consultar'); }



                # Inicia o grupo 4 -> Half
                if(isset($json->results[0]->main->sp)){

                    foreach($json->results[0]->main->sp as $key => $value){

                        $sql = OddsSubGrupo::where('titulo_original', $key)->get();
                        if(count($sql) < 1){
                            
                            $sql = new OddsSubGrupo;
                            $sql->titulo_original = $key;
                            $sql->status = 1;
                            $sql->save();
                            
                        }

                    }

                }
                if(isset($json->results[0]->half->sp)){

                    foreach($json->results[0]->half->sp as $key => $value){

                        $sql = OddsSubGrupo::where('titulo_original', $key)->get();
                        if(count($sql) > 0){

                            $idgrupo = $sql[0]->id;

                            if(count($json->results[0]->half->sp->$key) > 0){

                                foreach($json->results[0]->half->sp->$key as $item){

                                    $this->salvaOdds($idevent, $idgrupo, $item);

                                }

                            }

                        }else{
                            
                            $sql = new OddsSubGrupo;
                            $sql->titulo_original = $key;
                            $sql->status = 1;
                            $sql->save();
                            
                        }

                    }

                }



                # Inicia o grupo 3 -> Goals

                if(isset($json->results[0]->goals->sp)){

                    foreach($json->results[0]->goals->sp as $key => $value){

                        $sql = OddsSubGrupo::where('titulo_original', $key)->get();

                        if(count($sql) > 0){

                            $idgrupo = $sql[0]->id;



                            if(count($json->results[0]->goals->sp->$key) > 0){

                                foreach($json->results[0]->goals->sp->$key as $item){

                                    $this->salvaOdds($idevent,$idgrupo, $item);

                                }

                            }

                        }else{
                            
                            $sql = new OddsSubGrupo;
       
                            $sql->titulo_original = $key;
                            $sql->status = 1;
                            $sql->save();

                        }

                    }

                }







                # Incia do grupo 2 -> corners

                if(isset($json->results[0]->corners->sp)){

                    foreach($json->results[0]->corners->sp as $key => $value){

                        $sql = OddsSubGrupo::where('titulo_original', $key)->get();

                        if(count($sql) > 0){

                            $idgrupo = $sql[0]->id;



                            if(count($json->results[0]->corners->sp->$key) > 0){

                                foreach($json->results[0]->corners->sp->$key as $item){

                                    $this->salvaOdds($idevent, $idgrupo, $item);

                                }

                            }

                        }else{
                            
                            $sql = new OddsSubGrupo;
                            $sql->titulo_original = $key;
                            $sql->status = 1;
                            $sql->save();
                        
                        }

                    }

                }



                # Inicia as ODDS do Grupo 5 -> Main



                if(isset($json->results[0]->main->sp->full_time_result)){
                    
                    
                    $this->salvaOdds($idevent, 79, $json->results[0]->main->sp->full_time_result[0]);

                    $this->salvaOdds($idevent,79, $json->results[0]->main->sp->full_time_result[1]);

                    $this->salvaOdds($idevent,79, $json->results[0]->main->sp->full_time_result[2]);

                }



                if(isset($json->results[0]->main->sp->double_chance)){
                    
                    foreach($json->results[0]->main->sp->double_chance as $double_chance){
                        
                        $this->salvaOdds($idevent,80,$double_chance);


                    }

                }



                if(isset($json->results[0]->main->sp->correct_score)){

                    for($i = 0; $i < 50; $i++){

                        if(isset($json->results[0]->main->sp->correct_score[$i])){

                            $this->salvaOdds($idevent,81, $json->results[0]->main->sp->correct_score[$i]);

                        }

                    }

                }



                if(isset($json->results[0]->main->sp->half_time_full_time)){

                    for($i = 0; $i < 10; $i++){

                        if(isset($json->results[0]->main->sp->half_time_full_time[$i])){

                            $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[$i]);

                        }

                    }

                }



                if(isset($json->results[0]->main->sp->goals_over_under)){

                    foreach($json->results[0]->main->sp->goals_over_under as $goals){
                        
                        $this->salvaOdds($idevent,84, $goals);

                    }

                }



                if(isset($json->results[0]->main->sp->both_teams_to_score)){

                    $this->salvaOdds($idevent,85, $json->results[0]->main->sp->both_teams_to_score[0]);

                    $this->salvaOdds($idevent,85, $json->results[0]->main->sp->both_teams_to_score[1]);

                }



                if(isset($json->results[0]->main->sp->goal_line)){

                    foreach($json->results[0]->main->sp->goal_line as $result){
                        $this->salvaOdds($idevent,89, $result);

                    }

                }



                if(isset($json->results[0]->main->sp->draw_no_bet)){

                    $this->salvaOdds($idevent,92, $json->results[0]->main->sp->draw_no_bet[0]);

                    $this->salvaOdds($idevent,92, $json->results[0]->main->sp->draw_no_bet[1]);

                }



                if(isset($json->results[0]->main->sp->result_both_teams_to_score)){

                    foreach($json->results[0]->main->sp->result_both_teams_to_score as $result){
                        $this->salvaOdds($idevent,93, $result);

                    }

                }

            }catch(Exception $e){

                echo $e->getMessage();

            }

        }

    }

    public function salvaOdds($idevent, $idsubgrupo, $item){

        $odds = Odds::where('idbets', $item->id)->get();

        if(count($odds) > 0){ $odds = Odds::find($odds[0]->id); }else{ $odds = new Odds; }


        $name = "";
        if(isset($item->name)){

            $name = $item->name;

            $eng = ['Draw', 'Draw', 'or', 'Yes', 'No', '1st Half', '2nd Half', 'Over', 'Under', 'goals', 'Odd', 'Even', 'Exactly'];

            $pot = ['Empate', 'Empate', 'ou', 'Sim', 'Não', 'Primeiro Tempo', 'Segundo Tempo', 'Acima', 'Abaixo', 'gols', 'Impar', 'Par', 'Exatamente'];



            $name = str_replace($eng, $pot, $name);



            $odds->name = $name;

        }



        if(trim($item->odds) == ''){ $item_odds = 0.00; }else{ $item_odds = $item->odds; }



        $odds->odds = $item_odds;

        $odds->status = 1;

        $odds->idbets = $item->id;

        $odds->idsubgrupo = $idsubgrupo;

        $odds->idevent = $idevent;



        if(isset($item->header)){

            $header = $item->header;



            $eng = ['Draw', 'Draw', 'or', 'Yes', 'No', '1st Half', '2nd Half', 'Over', 'Under', 'goals', 'Odd', 'Even', 'Exactly'];

            $pot = ['Empate', 'Empate', 'ou', 'Sim', 'Não', 'Primeiro Tempo', 'Segundo Tempo', 'Acima', 'Abaixo', 'gols', 'Impar', 'Par', 'Exatamente'];



            $name = str_replace($eng, $pot, $header);



            $odds->header = $header;

        }


        $odds->save();

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

    public function showJogosAoVivo($id)
    {
        //
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