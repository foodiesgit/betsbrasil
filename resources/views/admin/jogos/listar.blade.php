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
                                <h4 class="card-title">Filtro</h4>
                                <p class="mb-0 subtitle">Selecione uma data para filtrar</p>
                            </div>
                            <div class="card-body">
                            {{ Form::model($filtro, ['url' => ['admin/jogos/listar', ''], 'id' => 'form1', 'method' => 'GET']) }}
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="mb-1"><strong>Data Inicial</strong></label>
                                        {{ Form::text('dataInicio', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="mb-1"><strong>Data Final</strong></label>
                                        {{ Form::text('dataFinal', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label class="mb-1"><strong>Pais</strong></label>
                                        <?php
                                            $sqlPaises = DB::table('paises')->orderBy('nome_traduzido', 'asc')->where('status', 1)->get();
                                            $arrayPaises = [];

                                            if(count($sqlPaises) > 0){
                                                foreach($sqlPaises as $dados){
                                                    $arrayPaises[$dados->id] = $dados->nome.' - '.$dados->nome_traduzido;
                                                }
                                            }
                                        ?>
                                        {{ Form::select('filtro_pais', $arrayPaises, null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label class="mb-1"><strong>Esporte</strong></label>
                                        <?php
                                            $sqlEsportes = DB::table('esportes')->orderBy('nome_traduzido', 'asc')->where('status', 1)->get();
                                            $arrayEsportes = [];

                                            if(count($sqlEsportes) > 0){
                                                foreach($sqlEsportes as $dados){
                                                    $arrayEsportes[$dados->id] = $dados->nome_traduzido;
                                                }
                                            }
                                        ?>
                                        {{ Form::select('filtro_esporte', $arrayEsportes, null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label class="mb-1"><strong>Ligas</strong></label>
                                        <?php
                                            $sqlLigas = DB::table('ligas')->orderBy('nome_original', 'asc')->where('status', 1)->get();
                                            $arrayLigas = [];

                                            $arrayLigas[''] = '# Selecione uma liga';

                                            if(count($sqlLigas) > 0){
                                                foreach($sqlLigas as $dados){
                                                    $arrayLigas[$dados->id] = $dados->nome_traduzido;
                                                }
                                            }
                                        ?>
                                        {{ Form::select('filtro_liga', $arrayLigas, null, ['class' => 'form-control']) }}
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
                        <div class="card" style="height: auto;">
                            <div class="card-header d-block">
                                <h4 class="card-title">Todos os Eventos</h4>
                                <p class="mb-0 subtitle">Visualizar Eventos</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display">
                                        <thead>
                                            <tr>
                                                <td>Data</td>
                                                <td>Pais</td>
                                                <td>Esporte</td>
                                                <td>Liga</td>
                                                <td>Times</td>

                                                <td>Status</td>
                                                <td>Ações</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                if(count($sql) > 0){
                                                    foreach($sql as $dados){
                                                        $status = '';

                                                        $time1 = DB::table('times')->where('id', $dados->idhome)->get();
                                                        $time2 = DB::table('times')->where('id', $dados->idaway)->get();

                                                        $time_home = '';
                                                        $time_away = '';

                                                        if(count($time1) > 0){
                                                            $time_home = $time1[0]->nome;
                                                        }
                                                        if(count($time2) > 0){
                                                            $time_away = $time2[0]->nome;
                                                        }

                                                        if($dados->status == 1){
                                                            $status = '<span class="badge badge-info">Aguardando Inicio</span>';
                                                        }elseif($dados->status == 2){
                                                            $status = '<span class="badge badge-primary">Ao Vivo</span>';
                                                        }elseif($dados->status == 3){
                                                            $status = '<span class="badge badge-info">Interrompido</span>';
                                                        }elseif($dados->status == 4){
                                                            $status = '<span class="badge badge-dark">Encerrado</span>';
                                                        }else{
                                                            $status = '<span class="badge badge-danger">'.$dados->status.'</span>';
                                                        }

                                                        echo '
                                                        <tr>
                                                            <td>'.$dados->data_evento.'</td>
                                                            <td>'.$dados->nome_pais.'</td>
                                                            <td>'.$dados->nome_esporte.'</td>
                                                            <td>'.$dados->nome_liga.'</td>
                                                            <td>
                                                                <span class="badge badge-success">'.$time_home.'</span><br>
                                                                <span class="badge badge-warning">'.$time_away.'</span>
                                                            </td>

                                                            <td>'.$status.'</td>
                                                            <td>
            													<div class="dropdown">
            														<button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
            															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
            														</button>
                                                                    <div class="dropdown-menu">';

                                                                    echo '<a class="dropdown-item" href="/admin/jogos/visualizar-apostas/'.$dados->id.'">Visualizar Apostas</a>';
                                                                    /*if($dados->status != 5){
                                                                        echo '<a class="dropdown-item" href="/admin/jogos/desabilitar/'.$dados->id.'">Desabilitar</a>';
                                                                    }else{
                                                                        echo '<a class="dropdown-item" href="/admin/jogos/habilitar/'.$dados->id.'">Habilitar</a>';
                                                                    }*/
            														echo '
            														</div>
            													</div>
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
