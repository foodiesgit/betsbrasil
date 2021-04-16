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
                            <h4>Caixa Gerentes</h4>
                            <span>Resumo</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Gerentes</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Caixa</a></li>
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

                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="widget-stat card bg-info">
                                    <div class="card-body p-4">
                                        <div class="media">
                                            <span class="mr-3">
                                                <i class="flaticon-381-diamond"></i>
                                            </span>
                                            <div class="media-body text-white text-right">
                                                <p class="mb-1">Saldo Disponível para Apostas</p>
                                                <h3 class="text-white" id="saldo1">R$ 0,00</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="widget-stat card bg-success">
                                    <div class="card-body p-4">
                                        <div class="media">
                                            <span class="mr-3">
                                                <i class="flaticon-381-diamond"></i>
                                            </span>
                                            <div class="media-body text-white text-right">
                                                <p class="mb-1">Saldo Disponível para Saque</p>
                                                <h3 class="text-white" id="saldo2">R$ 0,00</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="widget-stat card bg-danger">
                                    <div class="card-body p-4">
                                        <div class="media">
                                            <span class="mr-3">
                                                <i class="flaticon-381-diamond"></i>
                                            </span>
                                            <div class="media-body text-white text-right">
                                                <p class="mb-1">Saldo Bloqueado</p>
                                                <h3 class="text-white" id="saldo3">R$ 0,00</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                        <div class="card">
                            <div class="card-header d-block">
                                <h4 class="card-title">Gerêntes</h4>
                                <p class="mb-0 subtitle">Resumo dos Gerêntes Cadastrados</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display">
                                        <thead>
                                            <tr>
                                                <td>Nome</td>
                                                <td>Email</td>
                                                <td>Saldo Bloqueado</td>
                                                <td>Saldo Liberado</td>
                                                <td>Saldo Apostas</td>
                                                <td>Status</td>
                                                <td>Ações</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $saldo1 = 0;
                                                $saldo2 = 0;
                                                $saldo3 = 0;

                                                if(count($sql) > 0){
                                                    foreach($sql as $dados){
                                                        $status = '';

                                                        if($dados->status == 1){
                                                            $status = '<span class="badge badge-success">Ativo</div>';
                                                        }elseif($dados->status == 0){
                                                            $status = '<span class="badge badge-danger">Inativo</span>';
                                                        }

                                                        $saldo1 = $saldo1 + $dados->saldo_apostas;
                                                        $saldo2 = $saldo2 + $dados->saldo_liberado;
                                                        $saldo3 = $saldo3 + $dados->saldo_bloqueado;

                                                        echo '
                                                        <tr>
                                                            <td>'.$dados->nome.'</td>
                                                            <td>'.$dados->email.'</td>
                                                            <td><span class="badge badge-danger">
                                                                R$ '.number_format($dados->saldo_bloqueado,2,',','.').'
                                                            </span></td>
                                                            <td><span class="badge badge-success">
                                                                R$ '.number_format($dados->saldo_liberado,2,',','.').'
                                                            </span></td>
                                                            <td><span class="badge badge-info">
                                                                R$ '.number_format($dados->saldo_apostas,2,',','.').'
                                                            </span></td>
                                                            <td>'.$status.'</td>
                                                           
                                                            <td>
            													<div class="dropdown">
            														<button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
            															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
            														</button>
            														<div class="dropdown-menu">
            															<a class="dropdown-item" href="/admin/gerentes/caixa/lancamentos/'.$dados->idusuario.'">Realizar Lançamento</a>
                                                                        <a class="dropdown-item" href="/admin/gerentes/caixa/historico/'.$dados->idusuario.'">Histórico Financeiro</a>
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

        <input type="hidden" name="saldo1" value="R$ {{ number_format($saldo1,2,',','.') }}" />
        <input type="hidden" name="saldo2" value="R$ {{ number_format($saldo2,2,',','.') }}" />
        <input type="hidden" name="saldo3" value="R$ {{ number_format($saldo3,2,',','.') }}" />
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

    <script type="text/javascript">
        $(document).ready(function(e){
            var saldo1 = $('input[name=saldo1]').val();
            var saldo2 = $('input[name=saldo2]').val();
            var saldo3 = $('input[name=saldo3]').val();

            $('#saldo1').html( saldo1 );
            $('#saldo2').html( saldo2 );
            $('#saldo3').html( saldo3 );
        });
    </script>

</body>
</html>
