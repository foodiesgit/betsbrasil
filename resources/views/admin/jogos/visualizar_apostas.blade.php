<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin - Bets</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="/assets2/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/assets2/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/assets2/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="/assets2/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="/assets2/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <link href="/assets2/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets2/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="/assets2/vendor/pickadate/themes/default.date.css">
    <link href="/assets2/css/style.css" rel="stylesheet">

</head>

<body>
    @include('admin.include')

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        @yield('nav-header')

		@yield('chatbox')

        @yield('header')

        @yield('sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body btn-page">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Listar Jogos</h4>
                            <span>Visualize os próximos jogos</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Jogos</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Listar</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            if(Session::has('sucesso')){
                                echo '
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                    '.Session::get('sucesso').'
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                                        <span><i class="mdi mdi-close"></i></span>
                                    </button>
                                </div>
                                ';
                            }

                            if(Session::has('erro')){
                                echo '
                                <div class="alert alert-danger solid alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    '.Session::get('erro').'
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                                        <span><i class="mdi mdi-close"></i></span>
                                    </button>
                                </div>
                                ';
                            }

                            if( $errors->any() ){
                                echo '
                                <div class="alert alert-danger solid alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    <strong>Ocorreu um erro ao cadastrar. Verifique os campos destacados e tente novamente</strong>
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                                        <span><i class="mdi mdi-close"></i></span>
                                    </button>';
                                    echo '<ul style="margin-top: 20px;">';
                                    foreach($errors->all() as $error){
                                        echo '<li>'.$error.'</li>';
                                    }
                                    echo '</ul>';
                                    echo '
                                </div>';
                            }
                        ?>

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
                										<h3 class="text-white">R$ {{ number_format($apostas[0]->soma,2,',','.') }}</h3>
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
                                                            <td>'.$dados->soma.'</td>
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


        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">

            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="/assets2/vendor/global/global.min.js"></script>
	<script src="/assets2/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/assets2/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="/assets2/js/custom.min.js"></script>
	<script src="/assets2/js/deznav-init.js"></script>

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
