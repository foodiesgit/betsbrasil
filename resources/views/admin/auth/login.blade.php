<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Admin</title>

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <!-- Custom Stylesheet -->

    <link href="/assets2/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

    <link href="/assets2/css/style.css" rel="stylesheet">

    <link href="/assets2/css/custom.css" rel="stylesheet">



    <link href="/assets2/vendor/glider/glider.css" rel="stylesheet">

</head>

@include('client.include_sbet')


<body class="" style="background-image: url('/assets3/img/932701.jpg'); height: 100vh; background-size: 'cover';">
<div class="page" style="animation-duration: 500ms; margin-top:10%;">

    <div class="container">
        <div class="authincation h-100">

            <div class="container h-100">

                <div class="row justify-content-center h-100 align-items-center">

                    <div class="col-md-6">

                        <div class="authincation-content">

                            <div class="row no-gutters">

                                <div class="col-xl-12">

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

                                    ?>

                                    <div class="auth-form">

                                        <h4 class="text-center mb-4">Entre na sua conta</h4>

                                        {{ Form::open(['url' => '/admin/login', 'id' => 'form1']) }}

                                            <div class="form-group">

                                                <label class="mb-1"><strong>Email</strong></label>

                                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Digite o seu email aqui']) }}

                                            </div>

                                            <div class="form-group">

                                                <label class="mb-1"><strong>Senha</strong></label>

                                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Digite a sua senha de acesso']) }}

                                            </div>

                                            <div class="form-row d-flex justify-content-between mt-4 mb-2">



                                                <div class="form-group">

                                                    <a href="/esqueceu-senha">Esqueçeu sua senha?</a>

                                                </div>

                                            </div>

                                            <div class="text-center">

                                                <button type="button" class="btn btn-primary btn-block" id="btn1">Entrar</button>

                                            </div>

                                        {{ Form::close() }}

                                        <div class="new-account mt-3">

                                            <p>Ainda não tem uma conta? <a class="text-primary" href="/cadastro">Cadastre-se</a></p>

                                        </div>

                                    </div>

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
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="/js/core.min.js"></script>
    <script src="/js/script.js"></script>
 




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

