<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TotalGolsExatoSegundoTempoController extends Controller
{
    public function index($placar, $palpite, $tempo){

        $placar = explode($placar,"-");
        $palpite = explode($palpite," ");
        if($palpite[0] == "0"){
            if($tempo == 3){
                if($placar[0]+$placar[1] == 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite[1] == "+"){
            if($tempo == 3){
                if($palpite[0] == $placar[0]+$placar[1] || $palpite[0] < $placar[0]+$placar[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }else{
            if($tempo == 3){
                if($placar[0]+$placar[1] == $palpite[0]){
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
