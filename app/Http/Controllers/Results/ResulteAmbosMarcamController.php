<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResulteAmbosMarcamController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $palpite = explode($palpite, " ");
        if($palpite[0] == "1/2" && $palpite[1] == "Sim"){
            if($tempo == 3){
                if($placar[0] > $placar[1] || $placar[0] < $placar[1] && $placar[0] > 0 && $placar[1] > 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        //não
        if($palpite[0] == "1/2" && $palpite[1] == "Não"){
            if($tempo == 3){
                if($placar[0] > $placar[1] || $placar[0] < $placar[1] && $placar[0] == 0 && $placar[1] == 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        //Empate Ambos marcam
        if($palpite[0] == "X" && $palpite[1] == "Sim"){
            if($tempo == 3){
                if($placar[0] == $placar[1]  && $placar[0] > 0 && $placar[1] > 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status', "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        //Empate Não Ambos marcam
        if($palpite[0] == "X" && $palpite[1] == "Não"){
            if($tempo == 3){
                if($placar[0] == $placar[1]  && $placar[0] == 0 && $placar[1] == 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        //Casa Ambos marcam
        if($palpite[0] == "1" && $palpite[1] == "Sim"){
            if($tempo == 3){
                if($placar[0] > $placar[1]  && $placar[0] > 0 && $placar[1] > 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        //Fora Ambos marcam
        if($palpite[0] == "1" && $palpite[1] == "Sim"){
            if($tempo == 3){
                if($placar[0] < $placar[1]  && $placar[0] > 0 && $placar[1] > 0){
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
