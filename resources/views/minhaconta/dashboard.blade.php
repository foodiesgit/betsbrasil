<!DOCTYPE html>

<html lang="en" dir="ltr">

    <head>

        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="Description" content="NoboBets" />

        <meta name="Author" content="Novo Bets" />



        <!-- Title -->

        <title>Bets</title>



     
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />



        <link href="/assets3/css/icons.css" rel="stylesheet" />

        <link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />

        <link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

        <link href="/assets3/css/style.css" rel="stylesheet" />

        <link href="/assets3/css/style-dark.css" rel="stylesheet" />



        <link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />

        <link href="/assets3/switcher/demo.css" rel="stylesheet" />

        <link href="/assets3/css/animate.css" rel="stylesheet" />

        <link rel="stylesheet" href="/assets3/css/lite.css">
        <link href="/assets3/css/floo.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href="/assets3/css/custom.css" rel="stylesheet" />

    </head>

    <body class="main-body horizontal-color">

        @include('minhaconta.include')





        <div class="horizontalMenucontainer">

            <div id="global-loader" style="display: none;"><img src="/assets3/img/loader.svg" class="loader-img" alt="Loader" /></div>



            <div class="page">

            <!-- main-header opened -->

            @yield('main-header')

            <!-- /main-header -->

            <!--Horizontal-main -->

            @yield('horizontal-menu')

            <!--Horizontal-main -->







            <!-- main-content opened -->

            <div class="main-content horizontal-content">

                <!-- container opened -->

                <div class="container-fluid">

                    <!-- breadcrumb -->

                    <div class="breadcrumb-header justify-content-between">

                        <div class="my-auto">

                            <div class="d-flex">

                                <h4 class="content-title mb-0 my-auto">Dashboard</h4>

                                <span class="text-muted mt-1 tx-13 ml-2 mb-0"></span>

                            </div>

                        </div>

                    </div>

                    <!-- breadcrumb -->

                    <!-- row -->



                    <div class="row">

                        <div class="col-md-12">

                            <?php

                                if(Session::has('sucesso')){

                                    echo '<div class="alert alert-success">'.Session::get('sucesso').'</div>';

                                }

                                if(Session::has('erro')){

                                    echo '<div class="alert alert-danger">'.Session::get('erro').'</div>';

                                }

                            ?>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-lg-3">

                            <div class="card">

                                <div class="card-header bg-red">

                                    <h5 class="card-title">Resumo</h5>

                                    <h6 class="card-subtitle mb-2">Veja um resumo da sua conta</h6>

                                </div>

                                <div class="card-body">

                                    <div class="d-flex flex-column align-items-center justify-content-center">

                                        <div class="avatar avatar-xxl d-none d-sm-flex bg-danger rounded-circle"> AL </div>



                                        <h3 class="mg-t-20">Andre Luís</h3>

                                        <h4>R$ 25,00</h4>

                                    </div>



                                    <a href="minha-conta/meus-dados" style="margin-top: 50px;" class="btn btn-danger btn-block">Editar Meus Dados</a>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-9">

                            <div class="card">

                                <div class="card-header bg-red">

                                    <h5 class="card-title">Ultimas Apostas</h5>

                                    <h6 class="card-subtitle mb-2">Veja suas ultimas apostas</h6>

                                </div>

                                <div class="card-body">



                                    <div class="row">

                                        <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">

                                            <div class="card text-center">

                                                <div class="card-body ">

                                                    <div class="feature widget-2 text-center mt-0 mb-3">

                                                        <i class="ti-bar-chart project bg-primary-transparent mx-auto text-primary "></i>

                                                    </div>

                                                    <h6 class="mb-1 text-muted">Aposta em: 10/02/2021</h6>

                                                    <h3 class="font-weight-semibold">R$ 35,00</h3>



                                                    <h6 class="mt-3">Aguardando Resultado</h6>

                                                </div>

                                            </div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>

                    </div>





                    <!-- row closed -->

                </div>

                <!-- Container closed -->

            </div>

        </div>

        <!-- End Page -->


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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>



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

