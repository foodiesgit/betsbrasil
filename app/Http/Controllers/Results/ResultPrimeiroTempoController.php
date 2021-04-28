<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultPrimeiroTempoController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $placar = explode($placar,"-");
        if($palpite == "1"){
            if($tempo == 3){
                if($placar[0] > $placar[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite == "x"){
            if($tempo == 3){
                if($placar[0] == $placar[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite == "2"){
            if($tempo == 3){
                if($placar[0] < $placar[1]){
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
