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



        <link rel="icon" href="http://novobets.tk/favicon.ico" type="image/x-icon" />



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
    <style>
            .float{

                position:fixed;

                width:60px;

                height:60px;

                bottom:40px;

                right:40px;

                background-color:#fff;

                color:#FFF;

                border-radius:50px;

                text-align:center;

                box-shadow: 2px 2px 3px #999;

            }
            

        .my-float{

        margin-top:11px;

        }

    </style>
    <style type="text/css">

        @font-face {

            font-weight: 400;

            font-style:  normal;

            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Book-cd7d2bcec649b1243839a15d5eb8f0a3.woff2') format('woff2');

        }



        @font-face {

            font-weight: 500;

            font-style:  normal;

            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Medium-d74eac43c78bd5852478998ce63dceb3.woff2') format('woff2');

        }



        @font-face {

            font-weight: 700;

            font-style:  normal;

            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Bold-83b8ceaf77f49c7cffa44107561909e4.woff2') format('woff2');

        }



        @font-face {

            font-weight: 900;

            font-style:  normal;

            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Black-bf067ecb8aa777ceb6df7d72226febca.woff2') format('woff2');

        }



        .main{

            background-color: #FFF !important;

        }

        .linha_aposta{

        display: flex;

        flex-direction: row;

        flex-wrap: wrap;

        justify-content: flex-start;

        align-items: center;

        transition: .3s;

        }

        .linha_aposta .header_aposta{

        display: flex;

        flex: 1 33%;

        flex-direction: row;

        align-items: center;

        justify-content: spance-between;

        padding: 10px 15px;

        }

        .linha_aposta .header_aposta span{

        font-weight: 500;

        color: #808080;

        }

        .item_aposta{

        display: flex;

        flex: 1 33%;

        align-items: center;

        flex-direction: row;

        justify-content: space-between;

        padding: 10px 15px;

        transition: .3s;

        border: 1px solid #d7d7d7;

        cursor: pointer;

        }

        .item_aposta:hover{

        background-color: #e8e8e8;

        transition: .3s;

        }



        .item_aposta_diferenciado{

        display: flex;

        flex: 1 33%;

        align-items: center;

        flex-direction: row;

        justify-content: space-between;

        padding: 20px 25px;

        transition: .3s;

        border: 1px solid #d7d7d7;

        cursor: pointer;

        }

        .item_aposta_diferenciado:hover{

        background-color: #e8e8e8;

        transition: .3s;

        }



        .item_aposta .cotas{

        font-weight: bold;

        }



        @media (max-width: 991.98px){

        .item_aposta{

        flex: 1 50%;

        }

        }

        @media (max-width: 767.98px) {

        .item_aposta{

        flex: 1 100%;

        }



        }

        </style>
    <body class="main-body horizontal-color">

        @include('client.include')





        <div class="horizontalMenucontainer">

            <!-- <div id="global-loader"><img src="/assets3/img/loader.gif" class="loader-img" alt="Loader" width="10%"/></div> -->



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

                                <h4 class="content-title mb-0 my-auto"></h4>

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



                    <style type="text/css">



                    </style>

                    <div class="row">



                    </div>

                    <div class="row">

                        <!-- <div class="col-lg-3 d-none d-lg-block">





                            <div class="card-header bg-red">

                                <h5 class="card-title">Esportes</h5>

                                <h6 class="card-subtitle mb-2">Aposte por Esportes</h6>

                            </div>

                            <div class="card-body pd-0">

                                <div class="list-group">

                                <?php

                                    /*if(count($esportes) > 0){

                                        foreach($esportes as $dados){

                                            echo '

                                                <a href="sports/'.$dados->id.'"><div class="list-group-item list-group-item-action flex-column align-items-start">

                                                    <div class="d-flex w-100 justify-content-between">

                                                        <h5 class="mb-2 tx-14"><i class="fa fa-star mr-2"></i> '.$dados->nome_traduzido.'</h5>



                                                    </div>

                                                </div></a>

                                            ';

                                        }

                                    }*/

                                ?>

                                </div>

                            </div>



                        </div>-->



                        <div class="col-lg-9 col-sm-12">

                            <div class="card">

                                <div class="card-header bg-red">

                                    <h5 class="card-title">Mais Apostados</h5>

                                    <h6 class="card-subtitle mb-2"></h6>

                                </div>

                                <div class="card-body no-padding-xs">

                                    <div class="panel panel-primary tabs-style-1">

                                        <div class="tab-menu-heading">

                                            <div class="tabs-menu1">

                                                <ul class="nav nav-tabs main-nav-line"  role="tablist">

                                                    <li class="nav-item">

                                                        <a href="#tab1" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Futebol</a>

                                                    </li>

                                                </ul>

                                            </div>

                                        </div>







                                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">

                                            <div id="tab1">

                                                <div>
                                                    <?php
                                                        
                                                        if( count($array_jogos_aba_futebol) > 0 ){

                                                            foreach( $array_jogos_aba_futebol as $dados ){

                                                                echo '
                                                                    <h5 class="mb-10 liga" style="
                                                                    background: black;
                                                                    padding: 10px;
                                                                    color: white;
                                                                    border-radius: 3px;
                                                                    ">'.$dados['liga'].'</h5>

                                                                ';



                                                                if(count($dados['jogos']) > 0){

                                                                    foreach($dados['jogos'] as $jogos){



                                                                        echo '<div class="panel tabela-apostas">

                                                                        <div class="item">

                                                                            <div class="item-data d-none d-lg-flex">

                                                                                <span class="hora">'.$jogos['hora'].'</span>

                                                                                <span class="data">'.$jogos['data'].'</span>

                                                                            </div>

                                                                            <div class="d-none d-lg-flex item-times click_ir_jogo" data-id="'.$jogos['id'].'" style="cursor: pointer;">

                                                                                <span class="time-home">'.$jogos['oddhome_name'].'</span>

                                                                                <span class="time-away">'.$jogos['oddaway_name'].'</span>

                                                                            </div>

                                                                            <div class="d-md-none">

                                                                                <div class="item-times click_ir_jogo" data-id="'.$jogos['id'].'" style="cursor: pointer;">

                                                                                    <span class="time-home">'.$jogos['oddhome_name'].'</span>

                                                                                    <span class="time-away">'.$jogos['oddaway_name'].'</span>

                                                                                    <div class="item-data">

                                                                                        <span class="hora">'.$jogos['data'].' as '.$jogos['hora'].'</span>



                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="item-cotas btn-group">

                                                                                <span type="button" class="cota cota-normal cota-aposta" data-id="'.$jogos['oddhome_id'].'">'.$jogos['oddhome_value'].'</span>

                                                                                <span type="button" class="cota cota-normal cota-aposta" data-id="'.$jogos['odddraw_id'].'">'.$jogos['odddraw_value'].'</span>

                                                                                <span type="button" class="cota cota-normal cota-aposta" data-id="'.$jogos['oddaway_id'].'">'.$jogos['oddaway_value'].'</span>


                                                                                <span type="button" class="cota cota-normal cota-aposta bg-white border-none moreOdds" style="color:black; border:none;"  data-id="'.$jogos['id'].'" data-bs-toggle="modal" data-bs-target="#moreOdds">+'.$jogos['total_odds'].'</span>


                                                                            </div>
                                                                            
                                                                           
                                                                        </div>

                                                                        </div>';

                                                                    }

                                                                }

                                                            }

                                                        }

                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="col-md-3 d-none d-lg-block d-xl-block" >

                            <div class="card">

                                <div class="card-header bg-red">

                                    <h5 class="card-title" style="color: white;">Meu Cupom</h5>

                                    <h6 class="card-subtitle mb-2"></h6>

                                </div>

                                <div class="card-body no-padding-xs">

                                    <div class="bet-slip">

                                        <!---->

                                        <div class="bet-slip__inner" id="bet-slip-inner">



                                        </div>



                                        <div class="bet-slip__item bet-slip__item--row" id="divvalor">

                                            <div class="bet-slip__item-footer bet-slip__item-footer--wide">

                                                <div class="bet-slip__bet-cont bet-slip__bet-cont--wide">

                                                    <input class="bet-slip__bet ng-untouched ng-pristine ng-invalid ca-input" formcontrolname="newstake" placeholder="R$ 0,00" value="R$ 0,00" type="text" id="newstake" name="newstake">

                                                </div>

                                            </div>

                                        </div>



                                        <div class="bet-slip-total">

                                            <table class="bet-slip-total__table">

                                                <tbody>

                                                    <tr class="bet-slip-total__tr">

                                                        <th class="bet-slip-total__th">Sua Aposta</th>

                                                        <td class="bet-slip-total__td"><span id="slip_total_aposta">R$ 0,00</span></td>

                                                    </tr>



                                                    <tr class="bet-slip-total__tr">

                                                        <th class="bet-slip-total__th">Total Odds</th>

                                                        <td class="bet-slip-total__td"><span id="slip_total_odds">0.00</span></td>

                                                    </tr>



                                                    <tr class="bet-slip-total__tr">

                                                        <th class="bet-slip-total__th">Possível Retorno</th>

                                                        <td class="bet-slip-total__td"><span id="slip_total_retorno">R$ 0,00</span></td>



                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>



                                        {{ Form::open(['url' => '/finalizar-aposta', 'id' => 'form_finalizar_aposta']) }}



                                        {{ Form::close() }}

                                        <button class="bet-slip__btn" type="button" id="btn_finalizar_aposta" disabled="disabled">Colocar Aposta</button>





                                        <!---->

                                    </div>

                                </div>

                            </div>

                        </div>


                        <a class="float d-block d-sm-none d-xs-none d-md-block d-lg-none d-xl-none"  data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenSm">
                        <?php

                        $totalItensCupom = DB::table('novo_carrinho')

                            ->leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

                            ->where('session_id', session()->getId())->select(DB::raw("count(*) as total"))->get();



                        if(count($totalItensCupom) > 0){

                            $total = $totalItensCupom[0]->total;

                        }else{

                            $total = 0;

                        }

                        ?>

                        <span style="position: absolute; margin-left: 25px;"><span class="badge badge-danger" id="totalCupom">{{$total}}</span></span>

                        <img src="/assets3/img/images/invoice.svg" height="32" width="32" class="my-float" style="margin-top: 14px !important;">

                        </a>
                        <div class="modal fade" id="moreOdds" tabindex="-1" aria-labelledby="exampleModalFullscreenSmLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen-sm-down">
                                <div class="modal-content">
                                <div class="modal-header bg-red">
                                    <h5 class="modal-title h4" id="exampleModalFullscreenSmLabel"  style="color: white;">Outras Cotações</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="renderMoreOdds">
                                
                                </div>
                            </div>
                        </div>

                    </div>
                        <div class="modal fade" id="exampleModalFullscreenSm" tabindex="-1" aria-labelledby="exampleModalFullscreenSmLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen-sm-down">
                                <div class="modal-content">
                                <div class="modal-header bg-red">
                                    <h5 class="modal-title h4" id="exampleModalFullscreenSmLabel"  style="color: white;">Meu Cupom</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="bet-slip">

                                <div class="bet-slip__inner" id="bet-slip-inner-mobile">

                                </div>
                                <div class="bet-slip__item bet-slip__item--row" id="divvalormobile">

                                    <div class="bet-slip__item-footer bet-slip__item-footer--wide">

                                        <div class="bet-slip__bet-cont bet-slip__bet-cont--wide">

                                            <input class="bet-slip__bet ng-untouched ng-pristine ng-invalid ca-input" formcontrolname="newstake" placeholder="R$ 0,00" value="R$ 0,00" type="text" id="newstake_mobile" name="newstake">

                                        </div>

                                    </div>

                                </div>



                                <div class="bet-slip-total">

                                    <table class="bet-slip-total__table">

                                        <tbody>

                                            <tr class="bet-slip-total__tr">

                                                <th class="bet-slip-total__th">Sua Aposta</th>

                                                <td class="bet-slip-total__td"><span id="slip_total_aposta_mobile">R$ 0,00</span></td>

                                            </tr>



                                            <tr class="bet-slip-total__tr">

                                                <th class="bet-slip-total__th">Total Odds</th>

                                                <td class="bet-slip-total__td"><span id="slip_total_odds_mobile">0.00</span></td>

                                            </tr>



                                            <tr class="bet-slip-total__tr">

                                                <th class="bet-slip-total__th">Possível Retorno</th>

                                                <td class="bet-slip-total__td"><span id="slip_total_retorno_mobile">R$ 0,00</span></td>



                                            </tr>

                                        </tbody>

                                    </table>

                                </div>



                                {{ Form::open(['url' => '/finalizar-aposta', 'id' => 'form_finalizar_aposta']) }}



                                {{ Form::close() }}

                                <button class="bet-slip__btn" type="button" id="btn_finalizar_aposta_mobile" disabled="disabled">Colocar Aposta</button>

                                </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- row closed -->

                </div>

                <!-- Container closed -->

            </div>

            <!-- main-content closed -->

            <!-- Sidebar-right-->

            @yield('sidebar-right')

            <!--/Sidebar-right-->



            <!-- Message Modal -->



            <!-- Footer opened -->





            <!-- Footer closed -->

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

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="/assets/autocomplete.js"></script>                                               
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        <!-- <script src="/assets3/js/carrinho.js"></script> -->



        <script type="text/javascript">

            $(document).ready(function(e){
            

                $('#search').on('keyup',function(){
                    var query = $('#search').val();
                    if(query.length > 2){
                        $.ajax({

                            url: '/ajax/search',
   
                            method: 'GET',

                            data: {

                                query: query

                            },

                            success: function(res){
                                $('.item').parent().remove();
                                $('.liga').parent().remove();
                                
                                res.map((item => {
                                    $('#tab1').append(
                                    '<div class="panel tabela-apostas"> '+
                                        '<div class="item">'+

                                            '<div class="item-data d-none d-lg-flex">'+

                                                '<span class="hora">'+item.data+'</span>'+

                                                '<span class="data">'+item.hora+'</span>'+

                                            '</div>'+

                                            '<div class="d-none d-lg-flex item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                                                '<span class="time-home">'+item.homeNome+'</span>'+

                                                '<span class="time-away">'+item.awayNome+'</span>'+

                                            '</div>'+

                                            '<div class="d-md-none">'+

                                                '<div class="item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                                                '<span class="time-home">'+item.homeNome+'</span>'+

                                                '<span class="time-away">'+item.awayNome+'</span>'+

                                                    '<div class="item-data">'+

                                                        '<span class="hora">'+item.data+' as '+item.hora+'</span>'+



                                                    '</div>'+

                                                '</div>'+

                                            '</div>'+

                                            '<div class="item-cotas">'+

                                                '<span class="cota cota-normal cota-aposta" data-id="'+item.oddhome_id+'">'+item.oddhome_value+'</span>'+

                                                '<span class="cota cota-normal cota-aposta" data-id="'+item.odddraw_id+'">'+item.odddraw_value+'</span>'+

                                                '<span class="cota cota-normal cota-aposta" data-id="'+item.oddaway_id+'">'+item.oddaway_value+'</span>'+

                                            '</div>'+

                                            '<div class="item-acoes d-none d-lg-flex">'+

                                                '<span>+'+item.total_odds+'</span>'+

                                            '</div>'+

                                        '</div>'+

                                        '</div>')
                                }));
                            },error: function(err){
                            },complete: function(){
                            }

                        });
                    }
                });
                $('#search-mobile').on('keyup',function(){
                    var query = $('#search-mobile').val();
                    if(query.length > 2){
                        $.ajax({

                            url: '/ajax/search',
   
                            method: 'GET',

                            data: {

                                query: query

                            },

                            success: function(res){
                                $('.item').parent().remove();
                                $('.liga').parent().remove();
                                
                                res.map((item => {
                                    $('#tab1').append(
                                    '<div class="panel tabela-apostas"> '+
                                        '<div class="item">'+

                                            '<div class="item-data d-none d-lg-flex">'+

                                                '<span class="hora">'+item.data+'</span>'+

                                                '<span class="data">'+item.hora+'</span>'+

                                            '</div>'+

                                            '<div class="d-none d-lg-flex item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                                                '<span class="time-home">'+item.homeNome+'</span>'+

                                                '<span class="time-away">'+item.awayNome+'</span>'+

                                            '</div>'+

                                            '<div class="d-md-none">'+

                                                '<div class="item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                                                '<span class="time-home">'+item.homeNome+'</span>'+

                                                '<span class="time-away">'+item.awayNome+'</span>'+

                                                    '<div class="item-data">'+

                                                        '<span class="hora">'+item.data+' as '+item.hora+'</span>'+



                                                    '</div>'+

                                                '</div>'+

                                            '</div>'+

                                            '<div class="item-cotas">'+

                                                '<span class="cota cota-normal cota-aposta" data-id="'+item.oddhome_id+'">'+item.oddhome_value+'</span>'+

                                                '<span class="cota cota-normal cota-aposta" data-id="'+item.odddraw_id+'">'+item.odddraw_value+'</span>'+

                                                '<span class="cota cota-normal cota-aposta" data-id="'+item.oddaway_id+'">'+item.oddaway_value+'</span>'+

                                            '</div>'+

                                            '<div class="item-acoes d-none d-lg-flex">'+

                                                '<span>+'+item.total_odds+'</span>'+

                                            '</div>'+

                                        '</div>'+

                                        '</div>')
                                }));
                            },error: function(err){
                            },complete: function(){
                            }

                        });
                    }
                });
                $('.ca-input').maskMoney({

                    prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true

                });



                $('#divvalor').hide();



                $('#btn2').click(function(e){

                    $(this).attr('disabled', 'disabled');

                    $('#form2').submit();

                });

                
                $('.moreOdds').click(function(e){

                    var id = $(this).data('id');

                    $('#renderMoreOdds').html('');

                    $.ajax({

                    url: '/ajax/moreOdds',

                    method: 'GET',

                    data: {

                        id: id

                    },

                    success: function(res){
                        $('#renderMoreOdds').append(
                            '<div class="header-banner header-banner-wrapper" style="margin-bottom: 3rem;">'+

                            '<div class="refresh-btns-wrapper">'+

                                '<a href="#" class="refresh-btn refresh-btn--back banner-back-page">'+

                                    '<i class="fa fa-arrow-back"></i>'+

                                '</a>'+

                            '</div>'+

                            '<span class="header-banner__liga" style="margin-bottom: 2rem; color:black;">'+res.event[0].nome_traduzido+'</span>'+

                            '<div class="match-wrapper">'+

                                '<span class="header-banner__date">'+res.event[0].data_format+'</span>'+

                                '<div class="commands-info__wrapper match-data--heading">'+

                                    '<span class="commands-info__command" style="color:black;">'+res.home.nome+'</span>'+

                                    '<span class="commands-info__command vs" style="color:black;">VS </span>'+

                                    '<span class="commands-info__command" style="color:black;">'+res.away.nome+'</span>'+

                                '</div>'+

                                '<span class="header-banner__time  ">'+res.event[0].hora_format+'<span class="header-banner__time--red"></span> </span>'+

                           '</div>'+

                            '</div>');
                        $('#renderMoreOdds').append(
                            '<div class="panel panel-primary tabs-style-1" style="background-color: #FFF">'+

                                '<div class=" tab-menu-heading">'+

                                    '<div class="tabs-menu1">'+

                                        '<ul class="nav panel-tabs main-nav-line" id="tabOdds">'+

                                        
                                        '</ul>'+

                                    '</div>'+

                                '</div>'+

                            '</div>');
                            $('#renderMoreOdds').append(
                            '<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">'+

                                '<div id="moreOddsContent">'+
                                '</div>'+
                            '</div>');

                            var i = 0;
                            var group = 0;
                            var active = '';
                             res.odds_grupo.map((item => {
                                i++;
                               
                                item.sub_grupo.map((items => {
                                    
                                    if(items.odds.length > 0) {
                                        group++;
                                        $('#moreOddsContent').append(
                                        '<div class="card card-danger">'+

                                            '<div class="card-header pb-0">'+

                                                '<h5 class="card-title mb-0 pb-0">'+items.titulo_traduzido+'</h5>'+

                                            '</div>'+

                                        '<div class="card-body" id="oddsId'+group+'"></div></div>'
                                        );

                                        items.odds.map((item =>{
                                            var primeiro_odd = items.odds[0].idbets;

                                            if(primeiro_odd[0] == 'P'){

                                                //odd é diferente

                                                desenhaOdds(items.odds, group);

                                            }else{

                                                $('#oddsId'+group).append(
                                                    '<div class="item_aposta cota-aposta" style="background:black;" data-id="'+item.id+'" data-idevent="'+item.idevent+'">'+

                                                        '<span class="time">'+item.name+'</span>'+

                                                        '<span class="cotas">'+item.odds+'</span>'+

                                                    '</div>'
                                                );
                                            }
                                        }));
                                    }

                                }));
                            }));

                    },error: function(err){
                    },complete: function(){
                    }

                    });

                });
                
                function desenhaOdds(odds, group){

                    if(odds[0].idsubgrupo == 84){

                        $('#oddsId'+group).append('<div class="linha_aposta">'+

                                '<div class="header_aposta"><span></span></div>'+

                                '<div class="header_aposta"><span>Mais</span></div>'+

                                '<div class="header_aposta"><span>Menos</span></div>'+

                        '</div>'+



                            '<div class="linha_aposta">'+
                                   '<div class="item_aposta" style="background:black;">'+

                                        '<span class="time">'+odds[0].name+'</span>'+

                                    '</div>'+

                                    '<div class="item_aposta cota-aposta" data-id="'+odds[1].id+'" data-idevent="'+odds[1].idevent+'" style="background:black;">'+

                                        '<span class="cotas " ><b>'+odds[1].odds+'</b></span>'+

                                    '</div>'+

                                    '<div class="item_aposta cota-aposta" data-id="'+odds[2].id+'" data-idevent="'+odds[2].idevent+'" style="background:black;">'+

                                        '<span class="cotas " ><b>'+odds[2].odds+'</b></span>'+

                                    '</div>'+

                            '</div>');



                    }else if(odds[0].idsubgrupo == 93){

                          $('#oddsId'+group).append('<div class="linha_aposta">'+


                                '<div class="header_aposta"><span></span></div>'+

                                '<div class="header_aposta"><span>Sim</span></div>'+

                                '<div class="header_aposta"><span>Não</span></div>'+

                        '</div>'+
                        '<div class="linha_aposta">'+

                            '<div class="item_aposta" style="background:black;"><span class="time">'+odds[0].name+'</span></div>'+

                            '<div class="item_aposta cota-aposta" data-id="'+odds[3].id+'" data-idevent="'+odds[3].idevent+'" style="background:black;"><span class="cotas" >'+odds[3].odds+'</span></div>'+

                            '<div class="item_aposta cota-aposta" data-id="'+odds[6].id+'" data-idevent="'+odds[6].idevent+'" style="background:black;"><span class="cotas " >'+odds[6].odds+'</span></div>'+

                        '</div>'+

                        '<div class="linha_aposta">'+

                            '<div class="item_aposta" style="background:black;"><span class="time">'+odds[1].name+'</span></div>'+

                            '<div class="item_aposta cota-aposta" data-id="'+odds[4].id+'" data-idevent="'+odds[4].idevent+'" style="background:black;"><span class="cotas " >'+odds[4].odds+'</span></div>'+

                            '<div class="item_aposta cota-aposta" data-id="'+odds[7].id+'" data-idevent="'+odds[7].idevent+'" style="background:black;"><span class="cotas " >'+odds[7].odds+'</span></div>'+

                        '</div>'+

                       '<div class="linha_aposta">'+

                            '<div class="item_aposta" style="background:black;"><span class="time">'+odds[2].name+'</span></div>'+

                            '<div class="item_aposta cota-aposta" data-id="'+odds[5].id+'" data-idevent="'+odds[5].idevent+'" style="background:black;"><span class="cotas " >'+odds[5].odds+'</span></div>'+

                            '<div class="item_aposta cota-aposta" data-id="'+odds[8].id+'" data-idevent="'+odds[8].idevent+'" style="background:black;"><span class="cotas " >'+odds[8].odds+'</span></div>'+

                        '</div>');


                    }else{

                          $('#oddsId'+group).append('<div class="linha_aposta">'+

                                '<div class="header_aposta"><span></span></div>'+

                                '<div class="header_aposta"><span>Mais</span></div>'+

                                '<div class="header_aposta"><span>Menos</span></div>'+

                         '</div>'+



                            '<div class="linha_aposta">'+

                                    '<div class="item_aposta" style="background:black;">'+

                                        '<span class="time">'+odds[0].name+'</span>'+

                                    '</div>'+

                                    '<div class="item_aposta cota-aposta" data-id="'+odds[1].id+'" data-idevent="'+odds[1].idevent+'" style="background:black;">'+

                                        '<span class="cotas " ><b>'+odds[1].odds+'</b></span>'+

                                    '</div>'+

                                    '<div class="item_aposta cota-aposta" data-id="'+odds[2].id+'" data-idevent="'+odds[2].idevent+'" style="background:black;">'+

                                        '<span class="cotas " ><b>'+odds[2].odds+'</b></span>'+

                                    '</div>'+


                         '</div>');

                    }

                    }

                $('.retirar_aposta').click(function(e){

                    var id = $(this).attr('data-id');



                    window.location.href = '/remove-selection/' + id;

                });

                $('#btn_finalizar_aposta').click(function(e){

                    $(this).attr('disabled', 'disabled');



                    Swal.fire({

                        title: 'Confirma essa aposta?',

                        text: "Tem certeza que deseja colocar essa aposta?",

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#3085d6',

                        cancelButtonColor: '#d33',

                        confirmButtonText: 'Confirmar'

                    }).then((result) => {

                        if (result.isConfirmed) {

                            $('#form_finalizar_aposta').submit();

                        }else{

                            $('#btn_finalizar_aposta').removeAttr('disabled');

                        }

                    });

                });



                $('#btn_finalizar_aposta_mobile').click(function(e){

                    $(this).attr('disabled', 'disabled');

                    Swal.fire({

                        title: 'Confirma essa aposta?',

                        text: "Tem certeza que deseja colocar essa aposta?",

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#3085d6',

                        cancelButtonColor: '#d33',

                        confirmButtonText: 'Confirmar'

                    }).then((result) => {

                        if (result.isConfirmed) {

                            $('#form_finalizar_aposta').submit();

                        }else{

                            $('#btn_finalizar_aposta_mobile').removeAttr('disabled');

                        }

                    });

                });

                $('body').on('keyup', '#newstake', function(e){

                    e.preventDefault();



                    var valor = $(this).val();

                    valor = valor.replace("R$ ", "");

                    valor = valor.replace(".", "");

                    valor = valor.replace(",", ".");



                    valor = parseFloat(valor);

                    console.log(valor);

                    if( valor > 0.00 ){

                        var totalcotas = $('#slip_total_odds').html();

                        totalcotas = parseFloat(totalcotas);



                        var total = valor * totalcotas;

                        console.log(total);



                        $('#slip_total_aposta').html( $('#newstake').val() );

                        $('#slip_total_retorno').html( new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(total));



                        $('#btn_finalizar_aposta').removeAttr('disabled', 'disabled');

                    }else{

                        console.log("valor = 0");

                        $('#btn_finalizar_aposta').attr('disabled');

                    }

                });

                $('body').on('keyup', '#newstake_mobile', function(e){

                        e.preventDefault();



                        var valor = $(this).val();

                        valor = valor.replace("R$ ", "");

                        valor = valor.replace(".", "");

                        valor = valor.replace(",", ".");



                        valor = parseFloat(valor);

                        console.log(valor);

                        if( valor > 0.00 ){

                            var totalcotas = $('#slip_total_odds').html();

                            totalcotas = parseFloat(totalcotas);



                            var total = valor * totalcotas;

                            console.log(total);



                            $('#slip_total_aposta_mobile').html( $('#newstake_mobile').val() );

                            $('#slip_total_retorno_mobile').html( new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(total));

                            $('#btn_finalizar_aposta_mobile').removeAttr('disabled', 'disabled');

                        }else{

                            console.log("valor = 0");

                            $('#btn_finalizar_aposta_mobile').attr('disabled');

                        }

                    });

                $('body').on('click', '.cota-aposta', function(e){

                    e.preventDefault();



                    var id = $(this).attr('data-id');

                    $(this).addClass('selecionado');
                    

                    $.ajax({

                        url: '/ajax/carrinho/adicionar-aposta',

                        method: 'GET',

                        data: {

                            id: id

                        },

                        success: function(res){



                            if(res.status == 'ok'){

                                var total = $('#totalCupom').html();

                                total = parseInt(total);



                                if(res.acao == 'select'){

                                    $('.cota-aposta[data-idevent='+res.idevent+']').removeClass('selecionado');

                                    $('.cota-aposta[data-id='+id+']').addClass('selecionado');

                                }else if(res.acao == 'unselect'){

                                    $('.cota-aposta[data-id='+id+']').removeClass('selecionado');

                                }



                                var geral = 0;

                                geral = parseInt(geral);

                                $.each( $('.selecionado'), function(i, item) {

                                    geral++;

                                });



                                $('#totalCupom').html( geral );

                            }

                        },error: function(err){



                        },complete: function(){

                            recuperaCarrinho();

                        }

                    });

                });



                function recuperaCarrinho(){

                    $.ajax({

                        url: '/operacao-carrinho/recuperar-carrinho',

                        method: 'GET',

                        success: function(res){

                            $('.cota-aposta').removeClass('selecionado');



                            if(res.status == 'ok'){

                                $('#bet-slip-inner').html('');
                                $('#bet-slip-inner-mobile').html('');

                                $('#newstake').val( res.valor_total_apostado_format );

                                $('#newstake-mobile').val( res.valor_total_apostado_format );

                                $('#slip_total_aposta_mobile').html( res.valor_total_apostado_format );
                                $('#slip_total_aposta').html( res.valor_total_apostado_format );


                                $('#slip_total_odds').html( res.valor_total_cotas );
                                $('#slip_total_odds_mobile').html( res.valor_total_cotas );


                                $('#slip_total_retorno_mobile').html( res.possivel_retorno_format );

                                $('#slip_total_retorno_mobile').html( res.possivel_retorno_format );


                                var total_de_apostas = 0;



                                $.each(res.response, function(i, item) {

                                    total_de_apostas++;

                                    $('#btn_finalizar_aposta').removeAttr('disabled', 'disabled');

                                    $('#btn_finalizar_aposta_mobile').removeAttr('disabled', 'disabled');



                                    $('.cota-aposta[data-id='+item.idodds+']').addClass('selecionado');

                                    $('#divvalor').show();
                                    $('#divvalormobile').show();



                                    $('#bet-slip-inner').append('<app-betslip-item>'+

                                        '<div class="bet-slip__item">'+

                                            '<a href="/remove-selection/'+item.id+'" class="bet-slip__item-close" type="button"></a>'+

                                            '<div class="bet-slip__item-inner">'+

                                                '<div class="bet-slip__teams">'+

                                                    '<div class="bet-slip__team">'+

                                                        '<p class="bet-slip__team-name">'+item.time_home+'</p>'+

                                                    '</div>'+

                                                    '<div class="bet-slip__team">'+

                                                        '<p class="bet-slip__team-name">'+item.time_away+'</p>'+

                                                    '</div>'+

                                                '</div>'+

                                                '<div class="bet-slip__info">'+

                                                    '<p class="bet-slip__outcome">Aposta: <span>'+item.subgrupo+'</span></p>'+

                                                '</div>'+

                                                '<div class="bet-slip__info">'+

                                                    '<p class="bet-slip__outcome">Sua aposta: <b>'+item.name+'</b></p>'+

                                                    '<p class="bet-slip__odds">'+item.cota_momento+'</p>'+

                                                '</div>'+

                                            '</div>'+

                                        '</div>'+

                                    '</app-betslip-item>');

                               

                                $('#bet-slip-inner-mobile').append('<app-betslip-item>'+

                                        '<div class="bet-slip__item">'+

                                            '<a href="/remove-selection/'+item.id+'" class="bet-slip__item-close" type="button"></a>'+

                                            '<div class="bet-slip__item-inner">'+

                                                '<div class="bet-slip__teams">'+

                                                    '<div class="bet-slip__team">'+

                                                        '<p class="bet-slip__team-name">'+item.time_home+'</p>'+

                                                    '</div>'+

                                                    '<div class="bet-slip__team">'+

                                                        '<p class="bet-slip__team-name">'+item.time_away+'</p>'+

                                                    '</div>'+

                                                '</div>'+

                                                '<div class="bet-slip__info">'+

                                                    '<p class="bet-slip__outcome">Aposta: <span>'+item.subgrupo+'</span></p>'+

                                                '</div>'+

                                                '<div class="bet-slip__info">'+

                                                    '<p class="bet-slip__outcome">Sua aposta: <b>'+item.name+'</b></p>'+

                                                    '<p class="bet-slip__odds">'+item.cota_momento+'</p>'+

                                                '</div>'+

                                            '</div>'+

                                        '</div>'+

                                    '</app-betslip-item>');

                                });
                                if(total_de_apostas == 0){

                                    $('#bet-slip-inner').html('<p class="text-center">Nenhuma aposta selecionada</p>');

                                }



                            }

                        },error: function(err){



                        },complete: function(){



                        }

                    });

                }



                recuperaCarrinho();





                /*$.ajax({

                    url: '/ajax/carrinho/recupera-carrinho',

                    method: 'GET',

                    success: function(res){

                        $('.cota-aposta').removeClass('selecionado');



                        console.log('recuperaCarrinho');

                        console.log(res);

                        if(res.status == 'ok'){

                            $('#bet-slip-inner').html('');



                            $.each(res.response, function(i, item) {

                                $('.cota-aposta[data-id='+item.idodds+']').addClass('selecionado');



                                $('#bet-slip-inner').append('<app-betslip-item>'+

                                    '<div class="bet-slip__item">'+

                                        '<button class="bet-slip__item-close" type="button"></button>'+

                                        '<div class="bet-slip__item-inner">'+

                                            '<div class="bet-slip__teams">'+

                                                '<div class="bet-slip__team">'+

                                                    '<p class="bet-slip__team-name">'+item.time_home+'</p>'+

                                                '</div>'+

                                                '<div class="bet-slip__team">'+

                                                    '<p class="bet-slip__team-name">'+item.time_away+'</p>'+

                                                '</div>'+

                                            '</div>'+

                                            '<div class="bet-slip__info">'+

                                                '<p class="bet-slip__outcome">Aposta: <span>'+item.subgrupo+'</span></p>'+

                                            '</div>'+

                                            '<div class="bet-slip__info">'+

                                                '<p class="bet-slip__outcome">Sua aposta: <b>'+item.name+'</b></p>'+

                                                '<p class="bet-slip__odds">'+item.cota_momento+'</p>'+

                                            '</div>'+

                                        '</div>'+

                                    '</div>'+

                                '</app-betslip-item>');

                            });

                        }

                    },error: function(err){



                    },complete: function(){



                    }

                });*/

            });

        </script>

    </div>

    <div class="main-navbar-backdrop"></div>

</body>





</html>

