<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmbosMarcamPrimeiroTempoController extends Controller
{
    public function index($placar, $palpite, $tempo){
    $placar = explode($placar, "-");
        if($palpite == "Sim"){
            if($tempo == 3){
                if($placar[0] > 0 && $placar[1] > 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                   $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite == "Não"){
            if($tempo == 3){
                if($placar[0] > 0 && $placar[1] == 0 || $placar[1] > 0 && $placar[0] == 0 || $placar[0] == 0 && $placar[1] == 0 ){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                   $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
    }
}
