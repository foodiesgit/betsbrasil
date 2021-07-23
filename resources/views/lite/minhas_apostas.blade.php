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

        <div class="wrapper">
            <div class="betslip-page">
                <h3 class="light-block__title light-block__title--bet-slip" style="color: #000;">
                    Minhas Apostas
                </h3>

                <div class="light-block__body light-block__body--bet-slip ng-untouched ng-pristine ng-invalid" novalidate="">
                    <div class="row">
                        <?php
                            if(count($sql) > 0){
                                foreach($sql as $dados){
                                    echo '
                                    <div class="col-12">
                                        <div class="card card-purple">
                                            <div class="card-header pb-0" style="padding-left: .5rem;
                                                padding-right: .5rem;
                                                padding-top: .5rem;">
                                                <h5 class="card-title">#'.$dados->codigo_unico.'</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">'.$dados->data_aposta.'</h6>
                                            </div>
                                            <div class="card-body" style="padding: 0px;">
                                                <div class="bet-slip-total" style="padding: .5rem;">
                                                    <table class="bet-slip-total__table">
                                                        <tbody>
                                                            <tr class="bet-slip-total__tr">
                                                                <th class="bet-slip-total__th">Sua Aposta</th>
                                                                <td class="bet-slip-total__td">R$ '.number_format($dados->valor_apostado,2,',','.').'</td>
                                                            </tr>

                                                            <tr class="bet-slip-total__tr">
                                                                <th class="bet-slip-total__th">Total Odds</th>
                                                                <td class="bet-slip-total__td">
                                                                    '.$dados->total_cotas.'
                                                                </td>
                                                            </tr>

                                                            <tr class="bet-slip-total__tr">
                                                                <th class="bet-slip-total__th">Possível Retorno</th>
                                                                <td class="bet-slip-total__td">
                                                                    R$ '.number_format($dados->possivel_retorno,2,',','.').'
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>';

                                                    if($dados->status == 1){
                                                        echo '<span class="badge badge-warning" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';
                                                    }elseif($dados->status == 2){
                                                        echo '<span class="badge badge-success" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';
                                                    }elseif($dados->status == 3){
                                                        echo '<span class="badge badge-danger" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';
                                                    }elseif($dados->status == 4){
                                                        echo '<span class="badge badge-info" style="margin-top: .5rem;">'.$dados->status_cupom.'</span>';
                                                    }


                                                    echo '
                                                </div>
                                            </div>
                                            <div class="card-footer" style="padding: .5rem;">
                                                <a href="/lite/minhas-apostas/visualizar-cupom/'.$dados->codigo_unico.'" class="btn btn-sm btn-info">+ detalhes</a>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>

        @yield('footer')

        @yield('footer2')
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


    });
</script>

</body>
</html>
