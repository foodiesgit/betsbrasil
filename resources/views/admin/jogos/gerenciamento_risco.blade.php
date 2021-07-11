
    @include('admin.include')

        @yield('header')
        <div class="main-content" id="panel">
        @yield('nav')
        <div class="content-body btn-page">

<div class="container-fluid">

    <!-- row -->

    <div class="row">

        <div class="col-lg-12">
        @yield('alert')

            <div class="card" style="height: auto;">

                <div class="card-header d-block">

                    <h4 class="card-title">Resultado</h4>

                    <p class="mb-0 subtitle"></p>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="example" class="display">

                            <thead>

                                <tr>

                                    <td>Código do Bilhete</td>

                                    <td>Valor Apostado</td>

                                    <td>Possível Retorno</td>

                                    <td>Apostas em Aberto</td>



                                    <td>Verificar Bilhete</td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php



                                    if(count($sql) > 0){

                                        foreach($sql as $dados){
                                            dd($dados);
                                    

                                            $status = '';



                                            $sqlItem = App\CupomApostaItem::where('idcupom', $dados->id)

                                                ->select('*')->get();



                                            $apostas_aberto = 0;

                                            $apostas_total = 0;

                                            $arrayIgual = [];



                                            if(count($sqlItem) > 0){

                                                foreach($sqlItem as $dados2){



                                                    $apostas_total++;

                                                    if($dados2->status_conferido == 0){

                                                        $apostas_aberto++;

                                                    }



                                                    $arrayIgual[] = $dados2->idodds;

                                                }

                                            }



                                            $sqlIgual = App\CupomAposta::leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')

                                                ->select(DB::raw("count(*) as total"))

                                                ->where('cupom_aposta.valor_apostado', $dados->valor_apostado)

                                                ->whereIn('idodds', $arrayIgual)->get();



                                            if(count($sqlIgual) > 0){

                                                foreach($sqlIgual as $dados3){



                                                }

                                            }



                                            echo '

                                            <tr>

                                                <td>'.$dados->codigo_unico.'</td>

                                                <td>R$ '.number_format($dados->valor_apostado,2,',','.').'</td>

                                                <td>R$ '.number_format($dados->possivel_retorno,2,',','.').'</td>

                                                <td>'.$apostas_aberto.'/'.$apostas_total.'</td>

                                                <td>

                                                    <a class="btn btn-sm btn-primary" target="_blank" href="/verifica-bilhete/'.$dados->codigo_unico.'">Visualizar</a>

                                                </td>

                                            </tr>

                                            ';

                                        }

                                    }

                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>

        </div>



    </div>

</div>

</div>

        <div>
        @yield('footer')


    <!-- Required vendors -->


	<script src="/assets2/vendor/apexchart/apexchart.js"></script>

    <script src="/assets2/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script src="/assets2/js/plugins-init/datatables.init.js"></script>



    <script src="/assets2/vendor/moment/moment.min.js"></script>

    <script src="/assets2/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="/assets2/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>

    <script src="/assets2/vendor/jquery-asColor/jquery-asColor.min.js"></script>

    <script src="/assets2/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>

    <script src="/assets2/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>

    <script src="/assets2/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <script src="/assets2/vendor/pickadate/picker.js"></script>

    <script src="/assets2/vendor/pickadate/picker.time.js"></script>

    <script src="/assets2/vendor/pickadate/picker.date.js"></script>



    <script type="text/javascript">

        $(document).ready(function(e){

            $('input[name=dataInicio]').pickadate({

                format: 'dd/mm/yyyy'

            });

            $('input[name=dataFinal]').pickadate({

                format: 'dd/mm/yyyy'

            });



            $('#btn1').click(function(e){

                $(this).attr('disabled', 'disabled');

                $('#form1').submit();

            });

        });

    </script>



</body>

</html>

