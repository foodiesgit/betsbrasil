<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NumeroGolsController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $placar = explode($placar,"-");
        if($palpite == "Ímpar"){
            if($tempo == 3){
                if(floatval(($placar[0]+$placar[1])/2) != 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite == "Par"){
            if($tempo == 3){
                if(floatval(($placar[0]+$placar[1])/2) == 0){
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
