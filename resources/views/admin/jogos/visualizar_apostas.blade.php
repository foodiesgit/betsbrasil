

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

                                <h4 class="card-title">Resumo</h4>

                                <p class="mb-0 subtitle">Resumo das Apostas</p>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-xl-4 col-lg-6 col-sm-6">

                						<div class="widget-stat card bg-info">

                							<div class="card-body p-4">

                								<div class="media">



                									<div class="media-body text-white text-center">

                										<p class="mb-1">Data do Jogo</p>

                										<h3 class="text-white">{{ $apostas[0]->data_evento }}</h3>

                									</div>

                								</div>

                							</div>

                						</div>

                                    </div>



                                    <div class="col-xl-4 col-lg-6 col-sm-6">

                						<div class="widget-stat card bg-success">

                							<div class="card-body p-4">

                								<div class="media">



                									<div class="media-body text-white text-center">

                										<p class="mb-1">Total Apostado</p>

                										<h3 class="text-white">R$ {{ number_format($total_apostado,2,',','.') }}</h3>

                									</div>

                								</div>

                							</div>

                						</div>

                                    </div>



                                    <div class="col-xl-4 col-lg-6 col-sm-6">

                						<div class="widget-stat card bg-primary">

                							<div class="card-body p-4">

                								<div class="media">



                									<div class="media-body text-white text-center">

                										<p class="mb-1">Qtd Apostas</p>

                										<h3 class="text-white">{{ $apostas[0]->total }}</h3>

                									</div>

                								</div>

                							</div>

                						</div>

                                    </div>



                                </div>

                            </div>

                        </div>

                        <div class="card" style="height: auto;">

                            <div class="card-header d-block">

                                <h4 class="card-title">Apostas por tipo</h4>

                                <p class="mb-0 subtitle">Todas as apostas efetuadas por tipo</p>

                            </div>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table id="example" class="display">

                                        <thead>

                                            <tr>

                                                <td>Tipo de Aposta</td>

                                                <td>Opção</td>

                                                <td>Quantidade</td>

                                                <td>Valor Apostado</td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php



                                                if(count($tipos) > 0){

                                                    foreach($tipos as $dados){

                                                        echo '

                                                        <tr>

                                                            <td>'.$dados->titulo_traduzido.'</td>

                                                            <td>'.$dados->name.'</td>

                                                            <td>'.$dados->total.'</td>

                                                            <td>R$ '.number_format($dados->soma,2,',','.').'</td>

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
</div>

        @yield('footer')




        <!--**********************************

            Content body start

        ***********************************-->





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

