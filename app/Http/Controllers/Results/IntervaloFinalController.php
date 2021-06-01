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
        if($primeiro == $palpite[1]['home']->nome && $segundo == $palpite[1]['home']->nome){
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

        
        if($primeiro == $palpite[1]['home']->nome && $segundo == 'Empate'){
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

        if($primeiro == $palpite[1]['home']->nome && $segundo ==  $palpite[1]['away']->nome){
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

        if($primeiro == 'Empate' && $segundo ==  $palpite[1]['home']->nome){
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
        if($primeiro == 'Empate' && $segundo ==  $palpite[1]['away']->nome){
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

        if($primeiro == $palpite[1]['away']->nome && $segundo == $palpite[1]['away']->nome){
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

        
        if($primeiro == $palpite[1]['away']->nome && $segundo == 'Empate'){
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

        if($primeiro == $palpite[1]['away']->nome && $segundo ==  $palpite[1]['home']->nome){
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
