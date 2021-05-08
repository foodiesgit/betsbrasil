
    @include('client.include_sbet')


        @yield('main-header')

        <style>



@media print{

    .main-header{

        display: none;

    }

    .upheader{

        display: none;

    }

    .sticky{

        display: none;

    }

    .jumps-prevent{

        display: none;

    }

    .users-footer{

        display: none;

    }

    .footer-bottom-text-wrapper{

        display: none;

    }

    .btn_imprimir{

        display: none;

    }

    .betslip-page{

        visibility: visible !important;

    }

}

</style>


        <style type="text/css">

            .dashed_hr{

                width: 100%;

                height: 1px;

                border-bottom: 1px dashed #000;

                margin-top: .5rem;

                margin-bottom: .5rem;

            }

        </style>


<div class="page animated" style="animation-duration: 500ms;">

        <div class="hr"></div>



        <div class="user-login-reg__error"></div>



        <div class="">

            <div class="betslip-page">

                <h4 class="light-block__title light-block__title--bet-slip text-center" style="color: #000;">

                    Cupom #{{ $cupomAposta[0]->codigo_unico }}

                </h4>



                <div class="light-block__body light-block__body--bet-slip ng-untouched ng-pristine ng-invalid siprint" novalidate="" style="font-size: 12px; margin-top: 3rem; padding: .25rem .5rem 2rem .5rem;">

                    <div class="row">



                        <div class="col-12">

                            <h5 class="text-center">Bellagio Esportes</h5>

                            <div class="dashed_hr"></div>



                            <div class="d-flex flex-column">

                                <span>Data: {{ $cupomAposta[0]->data_aposta }}</span>

                                <span>Código: {{ $cupomAposta[0]->codigo_unico }}</span>

                                <span>Colaborador:

                                    <?php

                                        if($cupomAposta[0]->idcambista != ''){

                                            $sqlCambista = DB::table('usuarios')->where('id', $cupomAposta[0]->idcambista)->get();



                                            if(count($sqlCambista) > 0){

                                                echo $sqlCambista[0]->nome;

                                            }

                                        }

                                    ?>

                                </span>

                                <span>Cliente: {{ $cupomAposta[0]->nome }}</span>

                            </div>



                            <div class="dashed_hr"></div>



                            <div class="d-flex flex-row justify-content-between">

                                <span>Aposta</span>

                                <span>Cotação</span>

                            </div>



                            <div class="dashed_hr"></div>



                            <?php

                                $total_aposta = 0;

                                if(count($cupomApostaItem) > 0){

                                    foreach($cupomApostaItem as $dados){

                                        if($dados->status_resultado == 0){

                                            $status = 'Não Conferido';

                                        }elseif($dados->status_resultado == 1){

                                            $status = 'Ganhou';

                                        }elseif($dados->status_resultado == 2){

                                            $status = 'Perdeu';

                                        }



                                        $total_aposta++;



                                        echo '

                                        <div class="d-flex flex-column flex-start">

                                            <span><b>'.$dados->nome_esporte.' - '.$dados->nome_liga.'</b></span>

                                            <span>'.$dados->time_home.' x '.$dados->time_away.'</span>

                                            <span><b>'.$dados->subgrupo.'</b></span>

                                            <div class="d-flex flex-row justify-content-between">

                                                <span>'.$dados->name.'</span>

                                                <span>'.$dados->valor_momento.'</span>

                                            </div>

                                            <div class="d-flex flex-row justify-content-between">

                                                <span>Status</span>

                                                <span>'.$status.'</span>

                                            </div>

                                        </div>

                                        <div class="dashed_hr"></div>

                                        ';

                                    }

                                }

                            ?>









                            <div class="d-flex flex-row justify-content-between">

                                <span>Quantidade de Apostas</span>

                                <span>{{ $total_aposta }}</span>

                            </div>

                            <div class="d-flex flex-row justify-content-between">

                                <span>Cotação</span>

                                <span>{{ $cupomAposta[0]->total_cotas }}</span>

                            </div>

                            <div class="d-flex flex-row justify-content-between">

                                <span>Valor Apostado</span>

                                <span>R$ {{ number_format($cupomAposta[0]->valor_apostado,2,',','.') }}</span>

                            </div>

                            <div class="d-flex flex-row justify-content-between">

                                <span>Possível Retorno</span>

                                <span>R$ {{ number_format($cupomAposta[0]->possivel_retorno,2,',','.') }}</span>

                            </div>



                            <div class="dashed_hr"></div>



                            <div class="d-flex flex-row justify-content-center">

                                <h3>

                                    <?php

                                        $sqlStatus = DB::table('status_cupom_aposta')->where('id', $cupomAposta[0]->status)->get();



                                        if(count($sqlStatus) > 0){

                                            if($sqlStatus[0]->id == 2){

                                                echo '<span class="badge badge-success">'.$sqlStatus[0]->status_cupom.'</span>';

                                            }elseif($sqlStatus[0]->id == 3){

                                                echo '<span class="badge badge-danger">'.$sqlStatus[0]->status_cupom.'</span>';

                                            }else{

                                                echo '<span class="badge badge-info">'.$sqlStatus[0]->status_cupom.'</span>';

                                            }

                                        }

                                    ?>

                                </h3>

                            </div>



                            <div class="d-flex flex-row justify-content-center" style="margin-top: 20px;">

                                <a href="#" class="btn btn-sm btn-primary" id="btn_imprimir"><i class="fa fa-print"></i>Imprimir</a>

                            </div>

                        </div>



                        <?php

                        $sql = [];

                            if(count($sql) > 0){

                                foreach($sql as $dados){

                                    echo '

                                    <div class="col-12">

                                        <div class="card card-purple">

                                            <div class="card-header pb-0" style="padding-left: .5rem;

                                                padding-right: .5rem;

                                                padding-top: .5rem;">

                                                <h5 class="card-title">#'.$dados->codigo_unico.'</h5>

                                                <h6 class="card-subtitle mb-2 text-muted">'.$dados->data_aposta.'</h6>

                                            </div>

                                            <div class="card-body" style="padding: 0px;">

                                                <div class="bet-slip-total" style="padding: .5rem;">

                                                    <table class="bet-slip-total__table">

                                                        <tbody>

                                                            <tr class="bet-slip-total__tr">

                                                                <th class="bet-slip-total__th">Sua Aposta</th>

                                                                <td class="bet-slip-total__td">R$ '.number_format($dados->valor_apostado,2,',','.').'</td>

                                                            </tr>



                                                            <tr class="bet-slip-total__tr">

                                                                <th class="bet-slip-total__th">Total Odds</th>

                                                                <td class="bet-slip-total__td">

                                                                    '.$dados->total_cotas.'

                                                                </td>

                                                            </tr>



                                                            <tr class="bet-slip-total__tr">

                                                                <th class="bet-slip-total__th">Possível Retorno</th>

                                                                <td class="bet-slip-total__td">

                                                                    R$ '.number_format($dados->possivel_retorno,2,',','.').'

                                                                </td>

                                                            </tr>

                                                        </tbody>

                                                    </table>';



                                                    if($dados->status == 1){

                                                        echo '<span class="badge badge-warning" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';

                                                    }elseif($dados->status == 2){

                                                        echo '<span class="badge badge-success" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';

                                                    }elseif($dados->status == 3){

                                                        echo '<span class="badge badge-danger" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';

                                                    }elseif($dados->status == 4){

                                                        echo '<span class="badge badge-info" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';

                                                    }





                                                    echo '

                                                </div>

                                            </div>

                                            <div class="card-footer" style="padding: .5rem;">

                                                <a href="/lite/minhas-apostas/visualizar-cupom/'.$dados->codigo_unico.'" class="btn btn-sm btn-info">+ detalhes</a>

                                            </div>

                                        </div>

                                    </div>

                                    ';

                                }

                            }

                        ?>



                    </div>

                </div>

            </div>


  </div>
</div>



  <script src="/assets3/plugins/jquery/jquery.min.js"></script>

  <script src="/assets3/plugins/moment/moment.js"></script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>

  <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="/js/core.min.js"></script>
    <script src="/js/script.js"></script>
 


<script type="text/javascript">

    $(document).ready(function(e){

        $('.ca-input').maskMoney({

            prefix: '', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true

        });



        $('#btn_imprimir').click(function(e){

            window.print();

        });

    });

</script>



</body>

</html>

