<html lang="en" class="js-focus-visible" data-js-focus-visible=""><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="robots" content="index, nofollow">
    <link rel="stylesheet" href="/assets3/css/lite.css">
    <link rel="stylesheet" href="/assets3/css/style.css">

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
</head>
<body style="height: 100vh;">
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
            <?php
                $sql_time_home = App\Times::find($event[0]->idhome);
                $sql_time_away = App\Times::find($event[0]->idaway);
            ?>
            <div class="header-banner header-banner-wrapper" style="margin-bottom: 3rem;">
                <div class="refresh-btns-wrapper">
                    <a href="#" class="refresh-btn refresh-btn--back banner-back-page">
                        <i class="fa fa-arrow-back"></i>
                    </a>
                </div>
                <span class="header-banner__liga " style="margin-bottom: 2rem;">{{ $event[0]->nome_traduzido }}</span>
                <div class="match-wrapper">
                    <span class="header-banner__date">{{ $event[0]->data_format }}</span>
                    <div class="commands-info__wrapper match-data--heading">
                        <span class="commands-info__command">{{ $sql_time_home->nome }}</span>
                        <span class="commands-info__command vs">VS </span>
                        <span class="commands-info__command">{{ $sql_time_away->nome }}</span>
                    </div>
                    <span class="header-banner__time  ">{{ $event[0]->hora_format }}<span class="header-banner__time--red"></span> </span>
                </div>
            </div>

            <div class="panel panel-primary tabs-style-1" style="background-color: #FFF">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1">
                        <ul class="nav panel-tabs main-nav-line">
                            <?php
                            $i = 0;
                            if(count($odds_grupo) > 0){
                                foreach($odds_grupo as $dados){
                                    $i++;

                                    if($i == 1){
                                        echo '<li class="nav-item">
                                            <a href="#tab'.$i.'" class="nav-link active" data-toggle="tab">'.$dados->nome_traduzido.'</a>
                                            </li>';
                                    }else{
                                        echo '<li class="nav-item">
                                            <a href="#tab'.$i.'" class="nav-link" data-toggle="tab">'.$dados->nome_traduzido.'</a>
                                            </li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                    <div class="tab-content">
                        <?php
                        $i = 0;
                        if(count($odds_grupo) > 0){
                            foreach($odds_grupo as $dados){
                                $i++;
                                if($i == 1){ $active = 'active'; }else{ $active = ''; }

                                echo '<div id="tab'.$i.'" class="tab-pane '.$active.'">';

                                $consulta = DB::table('odds_subgrupo')->where('idgrupo', $dados->id)->where('status', 1)->get();

                                if(count($consulta) > 0){
                                    foreach($consulta as $dados_consulta){
                                        $odds = DB::table('odds')->where('idsubgrupo', $dados_consulta->id)->where('status',1)->where('idevent', $event[0]->id)->get();

                                        if(count($odds) > 0){
                                            echo '
                                                <div class="card card-danger">
                                                    <div class="card-header pb-0">
                                                        <h5 class="card-title mb-0 pb-0">'.$dados_consulta->titulo_traduzido.'</h5>
                                                    </div>
                                                    <div class="card-body">';
                                                        $primeiro_odd = $odds[0]->idbets;
                                                        if($primeiro_odd[0] == 'P'){
                                                            //odd é diferente
                                                            desenhaOdds($odds);
                                                        }else{
                                                            //odd é normal
                                                            echo '<div class="linha_aposta">';

                                                            foreach($odds as $dados_odds){


                                                                echo '
                                                                    <div class="item_aposta cota-aposta" data-id="'.$dados_odds->id.'" data-idevent="'.$dados_odds->idevent.'">
                                                                        <span class="time">'.$dados_odds->name.'</span>
                                                                        <span class="cotas">'.$dados_odds->odds.'</span>
                                                                    </div>
                                                                ';
                                                            }

                                                            echo '</div>';
                                                        }
                                                    echo '</div>
                                                </div>';
                                        }
                                    }
                                }



                                echo '</div>';

                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                function desenhaOdds($odds){
                    if($odds[0]->idsubgrupo == 84){
                        echo '<div class="linha_aposta">';
                            echo '
                                <div class="header_aposta"><span></span></div>
                                <div class="header_aposta"><span>Mais</span></div>
                                <div class="header_aposta"><span>Menos</span></div>
                            ';
                        echo '</div>';

                            echo '<div class="linha_aposta">';
                                echo '
                                    <div class="item_aposta">
                                        <span class="time">'.$odds[0]->name.'</span>
                                    </div>
                                    <div class="item_aposta cota-aposta" data-id="'.$odds[1]->id.'" data-idevent="'.$odds[1]->idevent.'">
                                        <span class="cotas " ><b>'.$odds[1]->odds.'</b></span>
                                    </div>
                                    <div class="item_aposta cota-aposta" data-id="'.$odds[2]->id.'" data-idevent="'.$odds[2]->idevent.'">
                                        <span class="cotas " ><b>'.$odds[2]->odds.'</b></span>
                                    </div>
                                ';
                            echo '</div>';

                    }elseif($odds[0]->idsubgrupo == 93){
                        echo '<div class="linha_aposta">';
                            echo '
                                <div class="header_aposta"><span></span></div>
                                <div class="header_aposta"><span>Sim</span></div>
                                <div class="header_aposta"><span>Não</span></div>
                            ';
                        echo '</div>';

                        echo '
                        <div class="linha_aposta">
                            <div class="item_aposta"><span class="time">'.$odds[0]->name.'</span></div>
                            <div class="item_aposta cota-aposta" data-id="'.$odds[3]->id.'" data-idevent="'.$odds[3]->idevent.'"><span class="cotas" >'.$odds[3]->odds.'</span></div>
                            <div class="item_aposta cota-aposta" data-id="'.$odds[6]->id.'" data-idevent="'.$odds[6]->idevent.'"><span class="cotas " >'.$odds[6]->odds.'</span></div>
                        </div>
                        <div class="linha_aposta">
                            <div class="item_aposta"><span class="time">'.$odds[1]->name.'</span></div>
                            <div class="item_aposta cota-aposta" data-id="'.$odds[4]->id.'" data-idevent="'.$odds[4]->idevent.'"><span class="cotas " >'.$odds[4]->odds.'</span></div>
                            <div class="item_aposta cota-aposta" data-id="'.$odds[7]->id.'" data-idevent="'.$odds[7]->idevent.'"><span class="cotas " >'.$odds[7]->odds.'</span></div>
                        </div>
                        <div class="linha_aposta">
                            <div class="item_aposta"><span class="time">'.$odds[2]->name.'</span></div>
                            <div class="item_aposta cota-aposta" data-id="'.$odds[5]->id.'" data-idevent="'.$odds[5]->idevent.'"><span class="cotas " >'.$odds[5]->odds.'</span></div>
                            <div class="item_aposta cota-aposta" data-id="'.$odds[8]->id.'" data-idevent="'.$odds[8]->idevent.'"><span class="cotas " >'.$odds[8]->odds.'</span></div>
                        </div>
                        ';
                    }else{
                        echo '<div class="linha_aposta">';
                            echo '
                                <div class="header_aposta"><span></span></div>
                                <div class="header_aposta"><span>Mais</span></div>
                                <div class="header_aposta"><span>Menos</span></div>
                            ';
                        echo '</div>';

                            echo '<div class="linha_aposta">';
                                echo '
                                    <div class="item_aposta">
                                        <span class="time">'.$odds[0]->name.'</span>
                                    </div>
                                    <div class="item_aposta cota-aposta" data-id="'.$odds[1]->id.'" data-idevent="'.$odds[1]->idevent.'">
                                        <span class="cotas " ><b>'.$odds[1]->odds.'</b></span>
                                    </div>
                                    <div class="item_aposta cota-aposta" data-id="'.$odds[2]->id.'" data-idevent="'.$odds[2]->idevent.'">
                                        <span class="cotas " ><b>'.$odds[2]->odds.'</b></span>
                                    </div>
                                ';
                            echo '</div>';
                    }
                }
                ?>
            </div>
        </main>

        @yield('footer')

        @yield('footer2')

        <a href="/lite/meu-cupom" class="float">
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

  <style type="text/css">
    .tab-content, .tab input{
        display: block !important;
    }
  </style>

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
  <script src="/assets3/js/carrinho.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(e){
        $('.ca-input').maskMoney({
            prefix: '', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true
        });

        /*$.ajax({
            url: '/ajax/recupera-jogos-destaque',
            method: 'GET',
            success: function(res){
                if(res.status == 'ok'){
                    $.each(res.response, function(i, item) {
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
                    });
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
        });*/
    });
</script>

</body>
</html>
