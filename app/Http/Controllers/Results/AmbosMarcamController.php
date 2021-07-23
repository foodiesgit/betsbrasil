<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmbosMarcamController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $placar = explode("-",$placar);
        if(utf8_encode($palpite) == "Sim"){
            if($tempo == 3){
                if($placar[0] > 0 && $placar[1] > 0){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        elseif(utf8_encode($palpite) == "Nã£o"){
            if($tempo == 3){
                if($placar[0] > 0 && $placar[1] == 0 || $placar[1] > 0 && $placar[0] == 0 || $placar[0] == 0 && $placar[1] == 0 ){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }else{
            $resultado = ['status' => "Aguardando", "ganhou"=> null];
        }

        return $resultado;
 
    }
}
