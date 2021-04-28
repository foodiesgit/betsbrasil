<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultMatchController extends Controller
{
    public function index($placar, $palpite, $tempo){
        if(!is_null($placar)) {
            $placar = explode($placar, "-");

            if($palpite == "CASA"){
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
           
            if($palpite == "EMPATE"){
    
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
            if($palpite == "FORA"){
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
        }else{
            $resultado = ['status' => "Aguardando", "ganhou"=> null];
        }
     
        return $resultado;
    }
}
