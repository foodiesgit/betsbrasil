<html lang="en" class="js-focus-visible" data-js-focus-visible=""><head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <meta name="robots" content="index, nofollow">

    <link rel="stylesheet" href="/assets3/css/lite.css">

    <link rel="stylesheet" href="/assets3/css/style.css">

    <link href="/assets3/css/icons.css" rel="stylesheet" />



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



        .selecionado{

            background-color: #CA3B1B;

            color: #FFF !important;

            transition: .4s;

        }

    </style>



    <title>Novo BETS</title>



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

    </style>

</head>

<body>

    @include('lite.include')

    <div class="wrapper">

        <div style="color:#f9f9f9; font-size:12px; font-weight:33px; padding:10px 5px 5px; background-color: #96250c;">

            <div class="bets-table__teams-info">

                <?php

                    if(Auth::check()){

                        $sqlCreditos = DB::table('creditos')->where('idusuario', auth()->user()->id)->select(DB::raw("sum(saldo_apostas + saldo_liberado) as soma"), 'saldo_apostas', 'saldo_liberado')->get();



                        echo '

                        <div class="bets-table__teams-info-odd" style="text-align:right;">

                            <a href="#" style="color:#fff;">Meu Saldo</a>

                        </div>



                        <div class="bets-table__teams-info-odd" style="text-align:left;"><span style="font-size:13px; padding-left:5px;padding-right:5px;text-align:center;">→</span> <strong style="font-size:13px;">R$ '.number_format($sqlCreditos[0]->soma, 2, ',', '.' ).'</strong></div>

                        ';

                    }else{

                        echo '

                        <div class="bets-table__teams-info-odd" style="text-align:right;">

                            <a href="/lite/login" style="color:#fff;">Entre para ver o seu saldo</a>

                        </div>





                        ';

                    }

                ?>





            </div>

        </div>



        @yield('header-principal')



        @yield('horizontal-menu')



        <div class="hr"></div>



        <div class="user-login-reg__error"></div>



        <main class="main">

            <div class="flex-row-wrapper">

                <div class="selector-wrapper">

                    <select id="game-type-selector-date" name="sub_type_id" class="date-type-selector type-selector">

                        <option value="today" class="date-type-selector__option">Filtrar</option>

                        <option value="today" class="date-type-selector__option">Destaques Hoje</option>

                        <option value="tommorrow" class="date-type-selector__option"> Amanha</option>

                        <option value="allgames" class="date-type-selector__option">Todos</option>

                    </select>

                </div>

            </div>



            <div class="bets-table">

                <div class="bets-table-item-wrapper">

                    <!-- <div class="bets-table__teams-info-odd bets-table__teams-info-odd--empty">1 X 2</div> -->



                    <div class="bets-table__header">

                        <span class="bets-table__header-teams">Times</span>

                        <div class="bets-table__teams-info">

                            <div class="bets-table__teams-info-odd">1</div>

                            <div class="bets-table__teams-info-odd">X</div>

                            <div class="bets-table__teams-info-odd">2</div>



                            <div class="bets-table__teams-info-odd bets-table__teams-info-odd--empty"></div>

                            <div class="bets-table__teams-info-odd bets-table__teams-info-odd--empty"></div>

                        </div>

                    </div>



                    <ul class="bets-table__list" id="lista_jogos">





                    </ul>

                </div>

            </div>

        </main>



        @yield('footer')



        @yield('footer2')



        <a href="/lite/meu-cupom" class="float " >

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



  </div>



  <script src="/assets3/plugins/jquery/jquery.min.js"></script>

  <script src="/assets3/plugins/moment/moment.js"></script>

  <script src="/assets3/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

  <script src="/assets3/js/sticky.js"></script>

  <script src="/assets3/plugins/sidebar/sidebar.js"></script>

  <script src="/assets3/plugins/sidebar/sidebar-custom.js"></script>

  <script src="/assets3/js/custom.js"></script>

  <script src="/assets3/js/carrinho.js"></script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>



<script type="text/javascript">

    $(document).ready(function(e){

        $('.ca-input').maskMoney({

            prefix: '', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true

        });



        $.ajax({

            url: '/ajax/recupera-jogos-destaque',

            method: 'GET',

            success: function(res){

                console.log(res);

                if(res.status == 'ok'){

                    $.each(res.response, function(i, itempais) {

                        $('#lista_jogos').append('<h5 style="margin-top: 15px;"><img src="/assets/bandeiras/'+itempais.bandeira+'" style="width: 24px; height: 24px; margin-right: 5px;">'+itempais.pais+'</h5>');



                        $.each(itempais.ligas, function(i, item) {



                            $('#lista_jogos').append('<h6 style="margin-top: 10px;">'+item.liga+'</h6>');



                            $.each(item.jogos, function(j, subitem) {

                                $('#lista_jogos').append('<li class="bets-table__item" id="game'+subitem.id+'">'+

                                    '<div class="bets-table__item-top">'+

                                        '<div class="bets-table-sport">'+

                                            '<div class="bets-table-sport-img-wrapper">'+

                                                '<img class="bets-table-sport-img" src="/assets3/img/images/futebol.svg" alt="">'+

                                            '</div>'+

                                            '<span class="bets-table-sport-name">Futebol</span>'+

                                            '<span class="bets-table-sport-beetwen">−</span>'+

                                            '<span class="bets-table-sport-comp-type" style="overflow: hidden;">'+item.liga+'</span>'+

                                            '<span class="bets-table-sport-coma"> &shy; </span>'+

                                        '</div>'+

                                        '<div class="bets-table-timeline">'+

                                            '<div class="bets-table-date-time">'+

                                                '<span class="bets-table-date-time__hours">'+subitem.data+', '+subitem.hora+'</span>'+

                                            '</div>'+

                                        '</div>'+

                                    '</div>'+

                                    '<div class="bets-table__item-bottom">'+

                                        '<div class="player-team">'+

                                            '<a href="#">'+

                                                '<span class="player-team__first player-team__item">'+subitem.home+'</span>'+

                                                '<span class="player-team__second player-team__item">'+subitem.away+'</span>'+

                                            '</a>'+

                                        '</div>'+

                                        '<div class="bets-table-odds-wrapper">'+

                                            '<a class="odds-val__item cota-aposta" style="text-decoration: none;" href="#" data-id="'+subitem.oddhome_id+'" data-idevent="'+subitem.id+'">'+

                                                ''+subitem.oddhome_value+''+

                                            '</a>'+

                                            '<a class="odds-val__item cota-aposta" style="text-decoration: none;" href="#" data-id="'+subitem.odddraw_id+'" data-idevent="'+subitem.id+'">'+

                                                ''+subitem.odddraw_value+''+

                                            '</a>'+

                                            '<a class="odds-val__item cota-aposta" style="text-decoration: none;" href="#" data-id="'+subitem.oddaway_id+'" data-idevent="'+subitem.id+'">'+

                                                ''+subitem.oddaway_value+''+

                                            '</a>'+

                                            '<div class="more-markets">'+

                                                '<a href="/lite/ver-evento/'+subitem.id+'" class="more-markets--inside">'+

                                                '    +'+subitem.total_odds+''+

                                                '</a>'+

                                            '</div>'+

                                        '</div>'+

                                    '</div>'+

                                '</li>');

                            });

                        });

                    });



                    /*$.each(res.response, function(i, item) {

                        console.log(item);



                        $.each(item.jogos, function(j, subitem) {

                            $('#lista_jogos').append('<li class="bets-table__item" id="game'+subitem.id+'">'+

                                '<div class="bets-table__item-top">'+

                                    '<div class="bets-table-sport">'+

                                        '<div class="bets-table-sport-img-wrapper">'+

                                            '<img class="bets-table-sport-img" src="/assets3/img/images/futebol.svg" alt="">'+

                                        '</div>'+

                                        '<span class="bets-table-sport-name">Futebol</span>'+

                                        '<span class="bets-table-sport-beetwen">−</span>'+

                                        '<span class="bets-table-sport-comp-type" style="overflow: hidden;">'+item.liga+'</span>'+

                                        '<span class="bets-table-sport-coma"> &shy; </span>'+

                                    '</div>'+

                                    '<div class="bets-table-timeline">'+

                                        '<div class="bets-table-date-time">'+

                                            '<span class="bets-table-date-time__hours">'+subitem.data+', '+subitem.hora+'</span>'+

                                        '</div>'+

                                    '</div>'+

                                '</div>'+

                                '<div class="bets-table__item-bottom">'+

                                    '<div class="player-team">'+

                                        '<a href="#">'+

                                            '<span class="player-team__first player-team__item">'+subitem.home+'</span>'+

                                            '<span class="player-team__second player-team__item">'+subitem.away+'</span>'+

                                        '</a>'+

                                    '</div>'+

                                    '<div class="bets-table-odds-wrapper">'+

                                        '<a class="odds-val__item cota-aposta" style="text-decoration: none;" href="#" data-id="'+subitem.oddhome_id+'" data-idevent="'+subitem.id+'">'+

                                            ''+subitem.oddhome_value+''+

                                        '</a>'+

                                        '<a class="odds-val__item cota-aposta" style="text-decoration: none;" href="#" data-id="'+subitem.odddraw_id+'" data-idevent="'+subitem.id+'">'+

                                            ''+subitem.odddraw_value+''+

                                        '</a>'+

                                        '<a class="odds-val__item cota-aposta" style="text-decoration: none;" href="#" data-id="'+subitem.oddaway_id+'" data-idevent="'+subitem.id+'">'+

                                            ''+subitem.oddaway_value+''+

                                        '</a>'+

                                        '<div class="more-markets">'+

                                            '<a href="/lite/ver-evento/'+subitem.id+'" class="more-markets--inside">'+

                                            '    +'+subitem.total_odds+''+

                                            '</a>'+

                                        '</div>'+

                                    '</div>'+

                                '</div>'+

                            '</li>');

                        });

                    });*/

                }

            },error: function(err){



            },complete: function(){

                $.ajax({

                    url: '/ajax/carrinho/recupera-carrinho',

                    method: 'GET',

                    success: function(res){

                        $('.cota-aposta').removeClass('selecionado');



                        console.log('recuperaCarrinho');

                        console.log(res);

                        if(res.status == 'ok'){

                            $.each(res.response, function(i, item) {

                                $('.cota-aposta[data-id='+item.idodds+']').addClass('selecionado');

                            });

                        }

                    },error: function(err){



                    },complete: function(){



                    }

                });

            }

        });

    });

</script>



</body>

</html>

