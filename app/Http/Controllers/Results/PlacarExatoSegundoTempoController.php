<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacarExatoSegundoTempoController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $palpite = explode($palpite,"-");
        $placar = explode($placar,"-");
        if($palpite[0] != "Outros"){
            if($palpite[0] == $placar[0]  && $palpite[1] == $placar[1]){
                if($tempo == 3){
                    if(floatval($placar[0]+$placar[1]) < floatval($palpite[1])){
                        $resultado = ['status' => "Ganhou", "ganhou"=> true];
                    }else{
                        $resultado = ['status',"Perdeu", "ganhou"=> false];
                    }
                }else{
                    $resultado = ['status' => "Aguardando", "ganhou"=> null];
                }
            }
        }else{
            if($palpite[0] == $placar[0]  && $palpite[1] == $placar[1]){
                if($tempo == 3){
                    if(floatval($placar[0]+$placar[1]) < floatval($palpite[1])){
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
}
