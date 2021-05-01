<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CupomAposta;
use App\CupomApostaItem;
use App\Events;
use App\OddsSubGrupo;
use App\Times;
use App\Odds;
class ResultController extends Controller
{
    public function Result(Request $request){
        $now = \Carbon\Carbon::now(); 
        $apostas = CupomAposta::where('cupom_aposta.status', 1)->get();

        foreach ($apostas as $aposta){
            $jogos = CupomApostaItem::join('events', 'cupom_aposta_item.idevent', '=', 'events.id')->join('odds', 'cupom_aposta_item.idodds', '=', 'odds.id')->where('idcupom',  $aposta->id)->where('status_resultado', 0)->orwhere('status_resultado', 1)->orwhere('status_resultado', 2)->get();
            $win = 0;
            $total_jogos = $jogos->count();
            $derrota = 0;
            $finalizado = 0;
            foreach($jogos as $jogo){
                if($jogo->data < $now){
                    // dd('https://api.betsapi.com/v1/bet365/prematch?token='.config('app.API_TOKEN').'&FI='.$jogo->bet365_id.'');
                    $response = \Http::get('https://api.b365api.com/v1/bet365/result?token='.config('app.API_TOKEN').'&event_id='.$jogo->bet365_id);
                    if( $response->successful() ){
                        $response = json_decode($response->body());
                        $home = Times::find($jogo->idhome);
                        $away = Times::find($jogo->idaway);
                        if($jogo->idsubgrupo == 79 ){ //Match Result
                            if($jogo->name == "Empate"){
                                $result =  app(\App\Http\Controllers\Results\ResultMatchController::class)->index($response->results[0]->ss, 'EMPATE', $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }else{

                                }
                            }
                            if($jogo->name == $home->nome){
                                $result =  app(\App\Http\Controllers\Results\ResultMatchController::class)->index($response->results[0]->ss, 'CASA', $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }else{

                                }
                            }
                            if($jogo->name == $away->nome){
                                $result =  app(\App\Http\Controllers\Results\ResultMatchController::class)->index($response->results[0]->ss, 'FORA', $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }else{

                                }
                            }
                        }
                        if($jogo->idsubgrupo == 80 ){ //DOUBLE CHANCE
                            if($jogo->name == "Empate"){
                                $result =  app(\App\Http\Controllers\Results\DuplachanceController::class)->index($response->results[0]->ss, 'EMPATE', $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }else{

                                }
                               
                            }
                            if($jogo->name == $home->nome){
                                $result =  app(\App\Http\Controllers\Results\DuplachanceController::class)->index($response->results[0]->ss, 'CASA', $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }else{

                                }
                            }
                            if($jogo->name == $away->nome){
                                $result =  app(\App\Http\Controllers\Results\DuplachanceController::class)->index($response->results[0]->ss, 'FORA', $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }
                            }
                        }
                        if($jogo->idsubgrupo == 81 ){ //CORRECT_SCORE
                            $result =  app(\App\Http\Controllers\Results\PlacarExatoController::class)->index($response->results[0]->ss, 'EMPATE', $response->results[0]->time_status); 
                            if($result['ganhou'] == true){
                                $win++; 
                            }else if($result['ganhou'] == false){
                                $derrota++;
                            }else{

                            }
                        }
                        if($jogo->idsubgrupo == 82){
                            if(isset($response->results[0]->scores)){
                                $result =  app(\App\Http\Controllers\Results\IntervaloFinalController::class)->index($response->results[0]->scores, [$jogo->name, ['home' =>  $home, 'away' => $away]], $response->results[0]->time_status); 
                                if($result['ganhou'] == true){
                                    $win++; 
                                }else if($result['ganhou'] == false){
                                    $derrota++;
                                }else{

                                }
                            }
                        }

                        if($jogo->idsubgrupo == 85){
                            $result =  app(\App\Http\Controllers\Results\AmbosMarcamController::class)->index($response->results[0]->ss,ucfirst(strtolower($jogo->name)), $response->results[0]->time_status); 
                            if($result['ganhou'] == true){
                                $win++; 
                            }else if($result['ganhou'] == false){
                                $derrota++;
                            }else{

                            }
                        }

                        if($jogo->idsubgrupo == 84){
                            $odd = Odds::where('idbets', 'PC'.$jogo->idbets)->first();
                            $result =  app(\App\Http\Controllers\Results\UnderOverController::class)->index($response->results[0]->ss,[ucfirst(strtolower($jogo->header)), $odd->name], $response->results[0]->time_status); 
                            if($result['ganhou'] == true){
                                $win++; 
                            }else if($result['ganhou'] == false){
                                $derrota++;
                            }else{

                            }
                        }

                        if($response->results[0]->time_status == 3){
                            $finalizado = 1;
                        }
                        // if($jogo->idsubgrupo == "CHANCE DUPLA"){
                        //     $quebrapalpite = explode("OU",$jogo->name);
                            
                        //     if(trim($quebrapalpite[0])== "X" && trim($quebrapalpite[1]) ==  trim(strtoupper($explode[1]))){
                        //         $npalpite = "Empate ou Fora";
                        //     }
                        //     if(trim($quebrapalpite[0]) == trim(strtoupper($explode[0])) && trim($quebrapalpite[1]) ==  "X"){
                        //         $npalpite = "Casa ou Empate";
                        //     }
                        //     if(trim($quebrapalpite[0])== trim(strtoupper($explode[0])) && trim($quebrapalpite[1]) ==  trim(strtoupper($explode[1])) ){
                        //         $npalpite = "Casa ou Fora";
                        //     }
                        
                        //     $response =  app(\App\Http\Controllers\Results\DuplachanceController::class)->index($response->results[0]->ss,$npalpite, $response->results[0]->time_status); 
                        //     echo "Status: ".$response['status'];
                        
                        // }
      
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "NÚMEROS DE GOLS"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\NumeroGolsController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "RESULTADO DA PARTIDA"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\ResultadoPartidaController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "NÚMERO DE GOLS - ÌMPAR/PAR"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\NumeroGolsController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "AMBOS MARCAM - 1 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\AmbosMarcamPrimeiroTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - CASA 1 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsCasaPrimeiroTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - FORA 1 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsForaPrimeiroTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - FORA 2 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsForaSegundoTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - CASA 2 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsCasaSegundoTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "RESULTADO DA PARTIDA E AMBOS MARCAM"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   // if($jogo->idsubgrupo == "RESULTADO NO INTERVALO"){
                          
                    //   // 	$response =  app(\App\Http\Controllers\Results\ResultPrimeiroTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //   // 	echo "Status: ".$response['status'];
                    //   // 	if($response['ganhou'] == true){
                    //   // 		$ganhou++;
                    //   // 	}
                    //   // }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - 1 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsExatoPrimeiroTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - 2 TEMPO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolsExatoSegundoTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - FORA"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolForaController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "TOTAL DE GOLS EXATO - CASA"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\TotalGolCasaController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    //   if($jogo->idsubgrupo == "CHANCE DUPLA - INTERVALO"){
                          
                    //       $response =  app(\App\Http\Controllers\Results\ChanceDuplaPrimeiroTempoController::class)->index($response->results[0]->ss,trim(ucfirst(strtolower($jogo->name))), $response->results[0]->time_status); 
                    //       echo "Status: ".$response['status'];
                    //       if($response['ganhou'] == true){
                    //           $ganhou++;
                    //       }
                    //   }
                    }
                } 
            }
            if($finalizado){
                if($win == $total_jogos){
                    $aposta->status = 2;
                    $aposta->save();
                }else{
                    $aposta->status = 3;
                    $aposta->save();
                }
            }
        }

    }
}
