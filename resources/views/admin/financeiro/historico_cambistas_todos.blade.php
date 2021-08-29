

@include('admin.include')

@yield('header')
<div class="main-content" id="panel">

@yield('nav')



<div class="content-body btn-page">

<div class="container-fluid">

<style>
     .tabela {
        margin: 50px auto;
        width:70%
     }
</style>  

    <!-- row -->

    <div class="row">

        <div class="col-lg-12">

        @yield('alert')


            <div class="card" style="height: auto;">

                <div class="card-header d-block">

                    <h4 class="card-title">Filtro</h4>

                    <p class="mb-0 subtitle">Selecione uma data para filtrar</p>

                </div>

                <div class="card-body">

                {{ Form::model($datas, ['url' => ['admin/cambistas/caixa/historico', ''], 'id' => 'form1', 'method' => 'GET']) }}

                    <div class="row">

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1 tabela"><strong>Data Inicial</strong></label>

                            {{ Form::text('dataInicio', null, ['class' => 'form-control']) }}

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1 tabela"><strong>Data Final</strong></label>

                            {{ Form::text('dataFinal', null, ['class' => 'form-control']) }}

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-sm-12">

                            <button type="button" name="btn1" id="btn1" class="btn btn-info">

                                <i class="fa fa-filter mr-1"></i> Filtrar

                            </button>

                        </div>

                    </div>

                {{ Form::close() }}

                </div>

            </div>

            <div class="card">

                <div class="card-header d-block">

                    <h4 class="card-title">Todos os Cambistas</h4>

                    <p class="mb-0 subtitle">Lançamentos Efetuados</p>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                    <table class="table table-striped table-bordered table-sm tabela">

                            <thead class="thead-light">

                                <tr>

                                <td scope="col" class="sort"><center>Data</td>

                                <td scope="col" class="sort"><center>Tipo de Lançamento</td>

                                <td scope="col" class="sort"><center>Cambistas</td>

                                <td scope="col" class="sort"><center>Valor</td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                    $saldo1 = 0;

                                    $saldo2 = 0;

                                    $saldo3 = 0;



                                    $total1 = 0;

                                    $total2 = 0;

                                    $total3 = 0;

                                    $total4 = 0;

                                    $total5 = 0;

                                    $total6 = 0;

                                    $total7 = 0;

                                    $total8 = 0;

                                    $total9 = 0;



                                    if(count($sql) > 0){

                                        foreach($sql as $dados){

                                            $status = '';



                                            if($dados->idtipo_lancamento == 1){

                                                $total1 = $total1 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 2){

                                                $total2 = $total2 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 3){

                                                $total3 = $total3 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 4){

                                                $total4 = $total4 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 5){

                                                $total5 = $total5 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 6){

                                                $total6 = $total6 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 7){

                                                $total7 = $total7 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 8){

                                                $total8 = $total8 + $dados->valor;

                                            }elseif($dados->idtipo_lancamento == 9){

                                                $total9 = $total9 + $dados->valor;

                                            }



                                            echo '

                                            <tr>

                                                <td><center>'.$dados->data_lancamento.'</td>

                                                <td><center>'.$dados->tipo_lancamento.'</td>

                                                <td><center>'.$dados->nome.'</td>


                                                <td><center>R$ '.number_format($dados->valor,2,',','.').'</td>

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



<input type="hidden" name="total1" value="R$ {{ number_format($total1,2,',','.') }}" />

<input type="hidden" name="total2" value="R$ {{ number_format($total2,2,',','.') }}" />

<input type="hidden" name="total3" value="R$ {{ number_format($total3,2,',','.') }}" />

<input type="hidden" name="total4" value="R$ {{ number_format($total4,2,',','.') }}" />

<input type="hidden" name="total5" value="R$ {{ number_format($total5,2,',','.') }}" />

<input type="hidden" name="total6" value="R$ {{ number_format($total6,2,',','.') }}" />

<input type="hidden" name="total7" value="R$ {{ number_format($total7,2,',','.') }}" />

<input type="hidden" name="total8" value="R$ {{ number_format($total8,2,',','.') }}" />

<input type="hidden" name="total9" value="R$ {{ number_format($total9,2,',','.') }}" />



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

