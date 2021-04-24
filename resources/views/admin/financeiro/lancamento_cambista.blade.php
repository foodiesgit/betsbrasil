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

                            <h4>Cambistas</h4>

                            <span>Realizar um lançamento no caixa do cambista </span>

                        </div>

                    </div>

                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="javascript:void(0)">Cambistas</a></li>

                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Lançamento</a></li>

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

                        <div class="card">

                            <div class="card-header d-block">

                                <h4 class="card-title">Lançamento</h4>

                                <p class="mb-0 subtitle">Digite os dados para realizar um lançamento</p>

                            </div>

                            <div class="card-body">

                                {{ Form::open(['url' => 'admin/cambistas/caixa/lancamentos/'.$dados_usuario[0]->id.'', 'id' => 'form1']) }}

                                <div class="row">



                                    <div class="form-group col-lg-6 col-md-12">

                                        <label class="mb-1"><strong>Tipo de Lançamento*</strong></label>

                                        {{ Form::select('idtipo_lancamento', [

                                            '5' => 'Lançamento Saldo Liberado',

                                            '6' => 'Lançamento Saldo Bloqueado',

                                            '7' => 'Lançamento Saldo Aposta'

                                        ],null, ['class' => 'form-control form-control-lg '.( $errors->has('idtipo_lancamento') ? ' is-invalid' : '' )]) }}

                                        @error('idtipo_lancamento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                    </div>

                                    <div class="form-group col-lg-6 col-md-12">

                                        <label class="mb-1"><strong>Valor para lançamento</strong></label>

                                        {{ Form::text('valor', null, ['class' => 'form-control form-control-lg '.( $errors->has('valor') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o valor', 'id' => 'valor']) }}

                                        @error('valor')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                    </div>

                                </div>



                                

                                {{ Form::close() }}

                            </div>

                            <div class="card-footer">

                                <button class="btn btn-outline-primary" type="button" id="btn1">

                                    <i class="fa fa-save"></i> Salvar

                                </button>

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



    <script src="/assets2/js/jquery.maskMoney.min.js"></script>



    <script src="https://unpkg.com/imask"></script>



    <script type="text/javascript">

        var element = document.getElementById('cpf');

        var maskOptions = {

            mask: '000.000.000-00'

        };

        var mask = IMask(element, maskOptions);



        var element = document.getElementById('data_nascimento');

        var maskOptions = {

            mask: '00/00/0000'

        };

        var mask2 = IMask(element, maskOptions);

    </script>



    <script type="text/javascript">

        $(document).ready(function(e){

            $('#btn1').click(function(e){

                $('#btn1').attr('disabled', 'disabled');

                $('#form1').submit();

            });



            $('input[name=valor]').maskMoney({

                prefix: 'R$ ',

                thousands: '.',

                decimal: ','

            });

        });

    </script>



</body>

</html>

