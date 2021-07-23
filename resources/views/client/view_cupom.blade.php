<!DOCTYPE html>

<html lang="en" dir="ltr">

    <head>

        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="Description" content="" />

        <meta name="Author" content="" />



        <!-- Title -->

        <title>Bets</title>



        <link rel="icon" href="/assets3/img/brand/favicon.png" type="image/x-icon" />

        <link href="/assets3/css/icons.css" rel="stylesheet" />

        <link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />

        <link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

        <link href="/assets3/css/style.css" rel="stylesheet" />

        <link href="/assets3/css/style-dark.css" rel="stylesheet" />

        <link href="/assets3/css/skin-modes.css" rel="stylesheet" />

        <link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />

        <link href="/assets3/switcher/demo.css" rel="stylesheet" />

        <link href="/assets3/css/animate.css" rel="stylesheet" />



        <link href="/assets3/css/custom.css" rel="stylesheet" />

    </head>

    <body class="main-body horizontal-color">

        @include('client.include_sbet')





        <div class="horizontalMenucontainer">

            <div id="global-loader" style="display: none;"><img src="/assets3/img/loader.svg" class="loader-img" alt="Loader" /></div>


            <!-- main-header opened -->

            @yield('main-header')

            <!-- /main-header -->

            <!--Horizontal-main -->

            <!--Horizontal-main -->



            <div class="modal show" id="modal_carrinho" aria-hidden="true">

                <div class="modal-dialog modal-lg" role="document">

                    <div class="modal-content modal-content-demo">

                        <div class="modal-header"> <h6 class="modal-title">Meu Cupom de Apostas</h6><button aria-label="Close" class="close" data-dismiss="modal"   type="button"><span aria-hidden="true">×</span></button>

                        </div>

                        <div class="modal-body" id="cc2">

                            @yield('corpo_carrinho2')

                        </div>

                    </div>

                </div>

            </div>





            <!-- main-content opened -->

            <div class="main-content horizontal-content pd-b-50">

                <!-- container opened -->

                <div class="container-fluid">

                    <!-- breadcrumb -->

                    <div class="breadcrumb-header justify-content-between">

                        <div class="my-auto">

                            <div class="d-flex">

                                <h4 class="content-title mb-0 my-auto">Cupom de Aposta</h4>

                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">{{ $cupomAposta[0]->codigo_unico }}</span>

                            </div>

                        </div>

                    </div>

                    <!-- breadcrumb -->

                    <!-- row -->



                    <style type="text/css">



                    </style>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card">

                                <div class="card-header bg-red">

                                    <h5 class="card-title">Meu Cupom</h5>

                                    <h6 class="card-subtitle mb-2">Visualizar Cupom de Aposta</h6>

                                </div>

                                <div class="card-body no-padding-xs">

                                    <div class="row">

                                        <div class="col-sm-12">

                                            <?php

                                                $sqlOperador = DB::table('usuarios')->where('id', $cupomAposta[0]->idcambista)->get();

                                                $sqlUsuario = DB::table('usuarios')->where('id', $cupomAposta[0]->idusuario)->get();



                                                $nomeOperador = 'Não Vinculado';

                                                $nomeUsuario = 'Não Vinculado';



                                                if(count($sqlOperador) > 0){

                                                    $nomeOperador = $sqlOperador[0]->nome;

                                                }



                                                if(count($sqlUsuario) > 0){

                                                    $nomeUsuario = $sqlOperador[0]->nomeUsuario;

                                                }

                                            ?>



                                            <table class="table">

                                                <tr>

                                                    <td width="35%">Código</td>

                                                    <td>{{ $cupomAposta[0]->codigo_unico }}</td>

                                                </tr>

                                                <tr>

                                                    <td width="35%">Operador</td>

                                                    <td>{{ $nomeOperador }}</td>

                                                </tr>

                                                <tr>

                                                    <td width="35%">Cliente</td>

                                                    <td>{{ $nomeUsuario }}</td>

                                                </tr>

                                                <tr>

                                                    <td width="35%">Data</td>

                                                    <td>{{ $cupomAposta[0]->data_aposta }}</td>

                                                </tr>

                                                <tr>

                                                    <td width="35%">Valor Apostado</td>

                                                    <td>R$ {{ number_format($cupomAposta[0]->valor_apostado,2,',','.') }}</td>

                                                </tr>

                                                <tr>

                                                    <td width="35%">Prêmio</td>

                                                    <td>R$ {{ number_format($cupomAposta[0]->possivel_retorno,2,',','.') }}</td>

                                                </tr>

                                                <tr>

                                                    <td width="35%">Situação</td>

                                                    <td>{{ $cupomAposta[0]->status_cupom }}</td>

                                                </tr>

                                            </table>



                                            <h4 class="text-center">Minhas Seleções</h4>



                                            <?php

                                                if(count($cupomAposta) > 0){

                                                    foreach($cupomAposta as $dados){

                                                        $sql_time_home = App\Times::find($dados->idhome);

                                                        $sql_time_away = App\Times::find($dados->idaway);



                                                        $status_item = '';



                                                        if($dados->status_conferido == 0){

                                                            $status_item = 'Aguardando Resultado';

                                                        }else{

                                                            if($dados->status_resultado == 1){

                                                                $status_item = 'Ganhou';

                                                            }else{

                                                                $status_item = 'Perdeu';

                                                            }

                                                        }



                                                        echo '<div class="d-flex flex-column pd-t-20 pd-b-20 pd-r-10 pd-l-10 bd-b">

                                                            <span class="">'.$dados->nome_liga.'</span>

                                                            <span class="">'.$sql_time_home->nome.' x '.$sql_time_away->nome.'</span>

                                                            <span class=""><b>'.$dados->name_odds_subgrupo.'</b></span>

                                                            <span class="d-flex flex-row justify-content-between">

                                                                <span>'.$dados->name_odds.'</span>

                                                                <span>'.$dados->valor_momento_item.'</span>

                                                            </span>

                                                            <span class="d-flex flex-row justify-content-between">

                                                                <span><b>Status</b> </span>

                                                                <span>'.$status_item.'</span>

                                                            </span>

                                                        </div>';

                                                    }

                                                }

                                            ?>



                                            <div class="cupom_info pd-t-20 pd-b-20 pd-r-10 pd-l-10">

                                                <?php

                                                    $sqlRodape = DB::table('campos_fixos')->where('id', 1)->get();



                                                    if(count($sqlRodape) > 0){

                                                        echo '<span>'.$sqlRodape[0]->rodape_cupom.'</span>';

                                                    }

                                                ?>

                                                <span>Observação do Cupom</span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="card-footer">

                                    <a href="#" class="btn btn-primary">Imprimir</a>

                                </div>

                            </div>

                        </div>

                        <!-- <div class="col-lg-3 d-none d-lg-block">

                            <div class="card">

                                <div class="card-header bg-red">

                                    <h5 class="card-title">Cupom</h5>

                                    <h6 class="card-subtitle mb-2">Meu Cupom de Apostas</h6>

                                </div>

                                <div class="card-body" id="cc">

                                    @yield('corpo_carrinho');

                                </div>

                            </div>

                        </div> -->

                    </div>

                    <!-- row closed -->

                </div>

                <!-- Container closed -->

            </div>

            <!--/Sidebar-right-->



            <!-- Message Modal -->

           

            </div>

            <!-- modal -->

            <!-- Footer opened -->

            @yield('footer')

            <!-- Footer closed -->



        <!-- End Page -->



        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>



        <script src="/assets3/plugins/jquery/jquery.min.js"></script>

        <script src="/assets3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="/assets3/plugins/ionicons/ionicons.js"></script>

        <script src="/assets3/plugins/moment/moment.js"></script>

        <script src="/assets3/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

        <script src="/assets3/plugins/perfect-scrollbar/p-scroll.js"></script>

        <script src="/assets3/js/eva-icons.min.js"></script>

        <script src="/assets3/plugins/rating/jquery.rating-stars.js"></script>

        <script src="/assets3/plugins/rating/jquery.barrating.js"></script>

        <script src="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

        <script src="/assets3/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <script src="/assets3/js/sticky.js"></script>

        <script src="/assets3/plugins/sidebar/sidebar.js"></script>

        <script src="/assets3/plugins/sidebar/sidebar-custom.js"></script>

        <script src="/assets3/js/custom.js"></script>

        <script src="/assets3/switcher/js/switcher.js"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>



        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



        <script src="/assets3/js/carrinho.js"></script>



        <script type="text/javascript">

            $(document).ready(function(e){

                $('.ca-input').maskMoney({

                    prefix: '', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true

                });





            });

        </script>

    </div>

    <div class="main-navbar-backdrop"></div>

</body>





</html>

