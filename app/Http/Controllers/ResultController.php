<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CupomAposta;
use App\CupomApostaItem;
use App\Events;
class ResultController extends Controller
{
    public function Result(Request $request){
        $now = \Carbon\Carbon::now(); 

        $apostas = CupomAposta::where('cupom_aposta.status', 1)->get();
        foreach ($apostas as $aposta){
            $jogos = CupomApostaItem::join('events', 'cupom_aposta_item.idevent', '=', 'events.id')->where('idcupom',  $aposta->id)->where('status_resultado', 0)->orwhere('status_resultado', 1)->orwhere('status_resultado', 2)->get();

            foreach($jogos as $jogo){
                if($jogo->data < $now){
                    $response = \Http::get('https://api.b365api.com/v1/bet365/result?token='.config('app.API_TOKEN').'&event_id='.$jogo->idevent);
                    if( $response->successful() ){
                        $response = json_decode($response->body());
                        dd($response);
                    }
                }
            }
        }

    }
}
