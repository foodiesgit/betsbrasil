<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TotalGolCasaController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $placar = explode($placar,"-");
        $palpite = explode($palpite," ");
        if($palpite[0] == "Abaixo"){
            if($tempo == 3){
                if(floatval($placar[0]) < floatval($palpite[1])){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite[0] == "Acima"){
            if($tempo == 3){
                if(floatval($placar[0]) > floatval($palpite[1])){
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
