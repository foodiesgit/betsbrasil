<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChanceDuplaPrimeiroTempoController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $placar = explode($placar, "-");
        if($palpite == "Casa ou Empate"){
            if($tempo == 3){
                if($placar[0] > $placar[1] || $placar[0] == $placar[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                     $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite == "Empate ou Fora"){
            if($tempo == 3){
                if($placar[1] > $placar[0] || $placar[0] == $placar[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                     $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($palpite == "Casa ou Fora"){
            if($tempo == 3){
                if($placar[0] > $placar[1] || $placar[0] < $placar[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                     $resultado = ['status',"Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        return Response()->json($resultado);
    }
}
