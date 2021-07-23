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



class ApiController extends Controller {

    public function salvaOdds($idevent, $idsubgrupo, $item){
        $config =\DB::table('campos_fixos')->first();


        $odds = Odds::where('idbets', $item->id)->get();

        if(count($odds) > 0){ $odds = Odds::find($odds[0]->id); }else{ $odds = new Odds; }


        $name = "";
        if(isset($item->name)){

            $name = $item->name;

            $eng = ['Draw', 'Draw', ' or ', 'Yes', 'No', '1st Half', '2nd Half', 'Over', 'Under', 'goals', 'Odd', 'Even', 'Exactly'];

            $pot = ['Empate', 'Empate', ' ou ', 'Sim', 'Não', 'Primeiro Tempo', 'Segundo Tempo', 'Acima', 'Abaixo', 'gols', 'Impar', 'Par', 'Exatamente'];



            $name = str_replace($eng, $pot, $name);



            $odds->name = $name;

        }



        if(trim($item->odds) == ''){ $item_odds = 0.00; }else{ $item_odds = $item->odds; }


        if($item_odds < $config->nao_exibir_cotacao_menor && $config->nao_exibir_cotacao_menor != 0 ){

            $item_odds = $config->nao_exibir_cotacao_menor;

        }

        if($item_odds < $config->nao_exibir_cotacao_menor && $config->nao_exibir_cotacao_menor != 0 ){

            $item_odds = $config->nao_exibir_cotacao_menor;

        }
        $odds->odds = $item_odds;

        $odds->status = 1;

        $odds->idbets = $item->id;

        $odds->idsubgrupo = $idsubgrupo;

        $odds->idevent = $idevent;



        if(isset($item->header)){

            $header = $item->header;



            $eng = ['Draw', 'Draw', ' or ', 'Yes', 'No', '1st Half', '2nd Half', 'Over', 'Under', 'goals', 'Odd', 'Even', 'Exactly'];

            $pot = ['Empate', 'Empate', ' ou ', 'Sim', 'Não', 'Primeiro Tempo', 'Segundo Tempo', 'Acima', 'Abaixo', 'gols', 'Impar', 'Par', 'Exatamente'];



            $name = str_replace($eng, $pot, $header);



            $odds->header = $header;

        }


        $odds->save();

    }

    public function somaTotalOdds($idevent){

        $sql = Odds::where('idevent', $idevent)->select(DB::raw("count(*) as total"))->where('odds','>',0)->get();



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
        $response = Http::get('https://api.betsapi.com/v1/bet365/prematch?token='.config('app.API_TOKEN').'&FI='.$events->bet365_id.'');

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
                    $json->results[0]->main->sp->full_time_result[0]->name = 'Casa';
                    $json->results[0]->main->sp->full_time_result[1]->name = 'Empate';
                    $json->results[0]->main->sp->full_time_result[2]->name = 'Fora';
                    $this->salvaOdds($idevent, 79, $json->results[0]->main->sp->full_time_result[0]);

                    $this->salvaOdds($idevent,79, $json->results[0]->main->sp->full_time_result[1]);

                    $this->salvaOdds($idevent,79, $json->results[0]->main->sp->full_time_result[2]);

                }



                if(isset($json->results[0]->main->sp->double_chance)){
                        $json->results[0]->main->sp->double_chance[0]->name = 'Casa ou Empate';
                        $json->results[0]->main->sp->double_chance[1]->name = 'Empate ou Fora';
                        $json->results[0]->main->sp->double_chance[2]->name = 'Casa ou Fora';
                        $this->salvaOdds($idevent, 80, $json->results[0]->main->sp->double_chance[0]);

                        $this->salvaOdds($idevent,80, $json->results[0]->main->sp->double_chance[1]);
    
                        $this->salvaOdds($idevent,80, $json->results[0]->main->sp->double_chance[2]);
                        
                }



                if(isset($json->results[0]->main->sp->correct_score)){

                    for($i = 0; $i < 50; $i++){

                        if(isset($json->results[0]->main->sp->correct_score[$i])){

                            $this->salvaOdds($idevent,81, $json->results[0]->main->sp->correct_score[$i]);

                        }

                    }

                }



                if(isset($json->results[0]->main->sp->half_time_full_time)){

                   
                    if(isset($json->results[0]->main->sp->half_time_full_time[0])){
                        $json->results[0]->main->sp->half_time_full_time[0]->name = "Casa - Casa";
                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[0]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[1])){
                        $json->results[0]->main->sp->half_time_full_time[1]->name = "Casa - Empate";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[1]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[2])){
                        $json->results[0]->main->sp->half_time_full_time[2]->name = "Casa - Fora";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[2]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[3])){
                        $json->results[0]->main->sp->half_time_full_time[3]->name = "Empate - Casa";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[3]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[4])){
                        $json->results[0]->main->sp->half_time_full_time[4]->name = "Empate - Empate";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[4]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[5])){
                        $json->results[0]->main->sp->half_time_full_time[5]->name = "Empate - Fora";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[5]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[6])){
                        $json->results[0]->main->sp->half_time_full_time[6]->name = "Fora - Casa";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[6]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[7])){
                        $json->results[0]->main->sp->half_time_full_time[7]->name = "Fora - Empate";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[7]);

                    }
                    if(isset($json->results[0]->main->sp->half_time_full_time[8])){
                        $json->results[0]->main->sp->half_time_full_time[8]->name = "Fora - Fora";

                        $this->salvaOdds($idevent,82, $json->results[0]->main->sp->half_time_full_time[8]);

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
                    if(isset($json->results[0]->main->sp->draw_no_bet[0])){
                        $json->results[0]->main->sp->draw_no_bet[0]->name = "Casa";

                        $this->salvaOdds($idevent,92, $json->results[0]->main->sp->draw_no_bet[0]);

                    }
                    if(isset($json->results[0]->main->sp->draw_no_bet[1])){
                        $json->results[0]->main->sp->draw_no_bet[1]->name = "Fora";
                        $this->salvaOdds($idevent,92, $json->results[0]->main->sp->draw_no_bet[1]);

                    }
                    

                }



                if(isset($json->results[0]->main->sp->result_both_teams_to_score)){
                    $json->results[0]->main->sp->result_both_teams_to_score[0]->name = "Casa";
                    $json->results[0]->main->sp->result_both_teams_to_score[1]->name = "Fora";
                    $json->results[0]->main->sp->result_both_teams_to_score[2]->name = "Empate";
                    foreach($json->results[0]->main->sp->result_both_teams_to_score as $result){
                        $this->salvaOdds($idevent,93, $result);
                    }

                }

            }catch(Exception $e){

                echo $e->getMessage();

            }

        }

    }

    public function recuperaUpcomingEvents($idesporte){
        set_time_limit(-1);
        // $responsePaises = Http::get('https://betsapi.com/docs/samples/countries.json');
        // if( $responsePaises->successful() ){
        //     $json = json_decode($responsePaises->body(), false);
        //     foreach( $json->results as $paises){
                $i = 1;
        
                $sair = false;
        
        
        
                do{
                    $response = Http::get('https://api.b365api.com/v1/events/upcoming?sport_id='.$idesporte.'&token='.config('app.API_TOKEN').'&page='.$i);
                    
        
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
        
        //     }
        // }
        
    }

    public function viewRecuperaLigasPorEsporte(){

        for($i = 1; $i < 100; $i++){

            $response = Http::get('https://api.betsapi.com/v1/league?token='.config('app.API_TOKEN').'&LNG_ID=22&sport_id=1&page='.$i.'');



            if($response->successful()){

                $json = json_decode($response->body(), false);



                echo '<h1>Linha: '.$i.' - Total:'.count($json->results).'</h1>';



                if(count($json->results) == 0){

                    break;

                    exit;

                }

                if(count($json->results) > 0){

                    foreach($json->results as $dados_json){

                        //verifica o pais

                        $sqlPais = Paises::where('cc', $dados_json->cc)->get();

                        if(count($sqlPais) > 0){ $idpais = $sqlPais[0]->id; }else{ $idpais = 0; }



                        try{

                            $ligas = new Ligas;

                            $ligas->id = $dados_json->id;

                            $ligas->nome_original = $dados_json->name;
                            $ligas->nome_traduzido = $dados_json->name;

                            $ligas->idpais = $idpais;

                            $ligas->idesporte = 1;

                            $ligas->has_league_table = $dados_json->has_leaguetable;

                            $ligas->has_toplist = $dados_json->has_toplist;

                            $ligas->status = 1;

                            $ligas->save();

                        }catch(\Exception $e){



                        }

                    }

                }

            }

        }



    }

    public function RecuperaTimesPorEsporte(){

        for($i = 1; $i < 100; $i++){

            $response = Http::get('https://api.b365api.com/v1/team?token='.config('app.API_TOKEN').'&sport_id=1&page='.$i.'');



            if($response->successful()){

                $json = json_decode($response->body(), false);



                echo '<h1>Linha: '.$i.' - Total:'.count($json->results).'</h1>';



                if(count($json->results) == 0){

                    break;

                    exit;

                }

                if(count($json->results) > 0){

                    foreach($json->results as $dados_json){

                        //verifica o pais

                        $sqlPais = Paises::where('cc', $dados_json->cc)->get();

                        if(count($sqlPais) > 0){ $idpais = $sqlPais[0]->id; }else{ $idpais = 0; }



                        try{

                            $ligas = new Times();

                            $ligas->id = $dados_json->id;

                            $ligas->nome = $dados_json->name;
                            $ligas->image_id = $dados_json->image_id;

                            $ligas->idpais = $idpais;
                            $ligas->save();

                        }catch(\Exception $e){



                        }

                    }

                }

            }

        }



    }


}

