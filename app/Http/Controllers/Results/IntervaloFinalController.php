<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntervaloFinalController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $npalpite =  explode("-",$palpite[0]);
        $resultado = ['status' => "Aguardando", "ganhou"=> null];
        $primeiro = trim($npalpite[0]);
        $segundo = trim($npalpite[1]);
        if($primeiro == "Casa" && $segundo == "Fora"){
            if($tempo == 3){
                if($placar->{1}->home >  $placar->{1}->away && ($placar->{1}->home + $placar->{2}->home) > ($placar->{1}->away + $placar->{2}->away)){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        
        if($primeiro == "Casa" && $segundo == 'Empate'){
            if($tempo == 3){
                if($placar->{1}->home >  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) == ($placar->{1}->away + $placar->{2}->away)){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                    $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        if($primeiro == "Casa" && $segundo ==  "Fora"){
            if($tempo == 3){
                if($placar->{1}->home >  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) < ($placar->{1}->away + $placar->{2}->away)){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        if($primeiro == 'Empate' && $segundo ==  "Casa"){
            if($tempo == 3){
                if($placar->{1}->home ==  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) > ($placar->{1}->away + $placar->{2}->away)){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($primeiro == 'Empate' && $segundo ==  'Empate'){
            if($tempo == 3){
                if($placar->{1}->home == $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) == ($placar->{1}->away + $placar->{2}->away)){

                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        if($primeiro == 'Empate' && $segundo ==  "Fora"){
            if($tempo == 3){
                if($placar->{1}->home ==  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) < ($placar->{1}->away + $placar->{2}->away)){

                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        if($primeiro == "Fora" && $segundo == "Fora"){
            if($tempo == 3){
                if($placar->{1}->home <  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) < ($placar->{1}->away + $placar->{2}->away)){
                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        
        if($primeiro == "Fora" && $segundo == 'Empate'){
            if($tempo == 3){
                if($placar->{1}->home <  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) == ($placar->{1}->away + $placar->{2}->away)){

                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }

        if($primeiro == "Fora" && $segundo ==  "Casa"){
            if($tempo == 3){
                if($placar->{1}->home <  $placar->{1}->away &&  ($placar->{1}->home + $placar->{2}->home) > ($placar->{1}->away + $placar->{2}->away)){

                    $resultado = ['status' => "Ganhou", "ganhou"=> true];
                }else{
                    $resultado = ['status' => "Perdeu", "ganhou"=> false];
                }
            }else{
                $resultado = ['status' => "Aguardando", "ganhou"=> null];
            }
        }
        return $resultado;
 
    }
}
