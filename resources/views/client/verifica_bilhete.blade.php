<!DOCTYPE html>

<html lang="en" dir="ltr">

    <head>

        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template" />

        <meta name="Author" content="Spruko Technologies Private Limited" />

        <meta

            name="Keywords"

            content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"

        />

        <!-- Title -->

        <title>Bets</title>



        <link rel="icon" href="/assets3/img/brand/favicon.png" type="image/x-icon" />

        <link href="/assets3/css/icons.css" rel="stylesheet" />

        <link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />

        <link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

        <link href="/assets3/css/style.css" rel="stylesheet" />

        <link href="/assets3/css/style-dark.css" rel="stylesheet" />



        <link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />

        <link href="/assets3/switcher/demo.css" rel="stylesheet" />

        <link href="/assets3/css/animate.css" rel="stylesheet" />



        <link href="/assets3/css/custom.css" rel="stylesheet" />

        <link href="/assets3/css/floo.css" rel="stylesheet" />

    </head>

    <body class="main-body horizontal-color">

        @include('client.include')





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

                                    <h5 class="card-title">Verificar Bilhete</h5>

                                    <h6 class="card-subtitle mb-2"></h6>

                                </div>

                                <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Codigo do Bilhete</label>
                                    <input type="text" class="form-control" id="codigo_bilhete" aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">Informe o codigo de acesso que se encontra em seu bilhete</small>
                                    </br>
                                    <button type="submit" class="btn btn-primary">Verificar</button>
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



    </div>

    <div class="main-navbar-backdrop"></div>

</body>





</html>

