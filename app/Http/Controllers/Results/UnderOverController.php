<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnderOverController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $placar = explode("-",$placar);
        if($palpite[0] == "Over"){
            if($tempo == 3){
                if($placar[0] + $placar[1] > $palpite[1]){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        elseif($palpite[0] == "Under"){
            if($tempo == 3){
                if($placar[0] + $placar[1] < $palpite[1] ){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }else{
            return null;
        }

        return $resultado;
 
    }
}
