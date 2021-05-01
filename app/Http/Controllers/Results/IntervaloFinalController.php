<?php

namespace App\Http\Controllers\Results;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntervaloFinalController extends Controller
{
    public function index($placar, $palpite, $tempo){
        $npalpite =  explode("-",$palpite[0]);

        if(trim($npalpite[0]) == $palpite[1]['home']->nome && trim($npalpite[0]) == $palpite[1]['home']->nome){
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

        
        if(trim($npalpite[0]) == $palpite[1]['home']->nome && trim($npalpite[0]) == 'Empate'){
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

        if(trim($npalpite[0]) == $palpite[1]['home']->nome && trim($npalpite[0]) ==  $palpite[1]['away']->nome){
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

        if(trim($npalpite[0]) == 'Empate' && trim($npalpite[0]) ==  $palpite[1]['home']->nome){
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
        if(trim($npalpite[0]) == 'Empate' && trim($npalpite[0]) ==  'Empate'){
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
        if(trim($npalpite[0]) == 'Empate' && trim($npalpite[0]) ==  $palpite[1]['away']->nome){
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

        if(trim($npalpite[0]) == $palpite[1]['away']->nome && trim($npalpite[0]) == $palpite[1]['away']->nome){
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

        
        if(trim($npalpite[0]) == $palpite[1]['away']->nome && trim($npalpite[0]) == 'Empate'){
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

        if(trim($npalpite[0]) == $palpite[1]['away']->nome && trim($npalpite[0]) ==  $palpite[1]['home']->nome){
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
