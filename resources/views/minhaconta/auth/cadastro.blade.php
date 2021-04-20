<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Apostas</title>

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <!-- Custom Stylesheet -->

    <link href="/assets2/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

    <link href="/assets2/css/style.css" rel="stylesheet">

    <link href="/assets2/css/custom.css" rel="stylesheet">



    <link href="/assets2/vendor/glider/glider.css" rel="stylesheet">

</head>



<body class="" style="background-image: url('/assets3/img/932701.jpg'); height: 100vh; background-size: 'cover';">

    <div class="authincation h-100">

        <div class="container h-100">

            <div class="row justify-content-center h-100 align-items-center">

                <div class="col-md-6">

                    <div class="authincation-content">

                        <div class="row no-gutters">

                            <div class="col-xl-12">

                                <div class="modal-header">

                                    <a href="/"><button aria-label="Close" class="close" data-dismiss="modal" type="button">

                                        <span aria-hidden="true">×</span>

                                    </button></a>

                                </div>



                                <div class="auth-form">

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

                                    <h4 class="text-center mb-4">Crie sua conta</h4>

                                    {{ Form::open(['url' => '/cadastro', 'id' => 'form1']) }}

                                        <div class="form-group">

                                            <label class="mb-1"><strong>Nome Completo*</strong></label>

                                            {{ Form::text('nome', null, ['class' => 'form-control form-control-lg '.( $errors->has('nome') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o seu nome completo']) }}

                                            @error('nome')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                        </div>

                                        <div class="form-group">

                                            <label class="mb-1"><strong>CPF</strong></label>

                                            {{ Form::text('cpf', null, ['id' => 'cpf', 'class' => 'form-control form-control-lg '.( $errors->has('cpf') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o seu CPF']) }}

                                            @error('cpf')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                        </div>

                                        <div class="form-group">

                                            <label class="mb-1"><strong>Telefone</strong></label>

                                            {{ Form::text('telefone', null, ['id' => 'cpf', 'class' => 'form-control form-control-lg '.( $errors->has('telefone') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o seu telefone com DDD']) }}

                                            @error('telefone')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                        </div>

                                        <div class="form-group">

                                            <label class="mb-1"><strong>Data de Nascimento*</strong></label>

                                            {{ Form::text('data_nascimento', null, ['id' => 'data_nascimento', 'class' => 'form-control form-control-lg '.( $errors->has('data_nascimento') ? ' is-invalid' : '' ), 'placeholder' => 'Ex.: 01/06/1977']) }}

                                            @error('data_nascimento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                        </div>

                                        <div class="form-group">

                                            <label class="mb-1"><strong>Email*</strong></label>

                                            {{ Form::text('email', null, ['class' => 'form-control form-control-lg '.( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o seu email']) }}

                                            @error('email')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                        </div>

                                        <div class="form-group">

                                            <label class="mb-1"><strong>Senha*</strong></label>

                                            {{ Form::password('password', ['class' => 'form-control form-control-lg '.( $errors->has('password') ? ' is-invalid' : '' ), 'placeholder' => 'Digite uma senha de acesso']) }}

                                            @error('password')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                        </div>



                                        <div class="text-center mt-5">

                                            <button type="button" class="btn btn-primary btn-block" id="btn1">Cadastrar</button>

                                        </div>

                                    {{ Form::close() }}

                                    <div class="new-account mt-5">

                                        <p>Já tem uma conta? <a class="text-primary" href="/login">Entrar</a></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!--**********************************

        Scripts

    ***********************************-->

    <!-- Required vendors -->

    <script src="/assets2/vendor/global/global.min.js"></script>

	<script src="/assets2/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <script src="/assets2/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="/assets2/js/custom.min.js"></script>

	<script src="/assets2/js/deznav-init.js"></script>

	<script src="/assets2/vendor/apexchart/apexchart.js"></script>

    <script src="/assets2/vendor/glider/glider.js"></script>

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

        });

    </script>

</body>

</html>

