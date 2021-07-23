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
        <div class="betslip-page">
            <header class="light-block__header light-block__header--bet-slip">
                <h3 class="light-block__title light-block__title--bet-slip">
                    Meu Cupom
                </h3>
                <a href="/lite" class="light-block__close light-block__close--bet-slip" type="button">
                    <span class="icon-lost icon-lost--bet-slip"></span>
                </a>
            </header>

            <div class="light-block__body light-block__body--bet-slip ng-untouched ng-pristine ng-invalid" novalidate="">
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

                <div class="bet-slip">
                    <div class="bet-slip__inner">
                        <?php
                            if(count($sql) > 0){
                                foreach($sql as $dados){

                                    echo '
                                    <div class="bet-slip__item">
                                        <a href="/lite/remove-selection/'.$dados['id'].'" class="bet-slip__item-close" type="button"></a>
                                        <div class="bet-slip__item-inner">
                                            <div class="bet-slip__teams">
                                                <div class="bet-slip__team">
                                                    <p class="bet-slip__team-name">'.$dados['time_home'].'</p>
                                                </div>
                                                vs
                                                <div class="bet-slip__team">
                                                    <p class="bet-slip__team-name">'.$dados['time_away'].'</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bet-slip__info">
                                            <p class="bet-slip__outcome">Mercado: <span>'.$dados['subgrupo'].'</span></p>
                                        </div>

                                        <div class="bet-slip__info">
                                            <p class="bet-slip__outcome">Sua Escolha: <b>'.$dados['name'].'</b></p>
                                            <p class="bet-slip__odds">
                                                '.$dados['cota_momento'].'
                                            </p>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        ?>
                    </div>
                </div>

                <?php
                    $valor_total_apostado = 0;
                    $valor_total_cotas = 0;

                    if(count($total_carrinho) > 0){
                        $valor_total_apostado = $total_carrinho[0]->valor_total_apostado;
                        $valor_total_cotas = $total_carrinho[0]->valor_total_cotas;
                    }
                ?>

                <?php if(count($sql) == 0){
                    echo '<p class="text-center">Nenhuma aposta no momento</p>';
                } ?>

                <?php if(count($sql) > 0){ ?>

                <form method="get" action="/lite/atualizar-aposta" id="form2">
                    <div class="bet-slip__item bet-slip__item--row">
                        <div class="bet-slip__item-footer bet-slip__item-footer--wide">
                            <div class="bet-slip__bet-cont bet-slip__bet-cont--wide">
                                <input class="bet-slip__bet ng-untouched ng-pristine ng-invalid ca-input" formcontrolname="newstake" placeholder="Valor Mínimo: R$ 10,00" value="R$ {{ number_format($valor_total_apostado,2,',','.') }}" type="text" id="newstake" name="newstake">
                            </div>
                        </div>

                        <button class="refresh-btn banner-refresh" id="btn2">
                            <img src="https://flooks.com/lite/images/refresh.png" alt="" srcset="">
                        </button>
                    </div>
                </form>


                <div class="bet-slip-total">
                    <table class="bet-slip-total__table">
                        <tbody>
                            <tr class="bet-slip-total__tr">
                                <th class="bet-slip-total__th">Sua Aposta</th>
                                <td class="bet-slip-total__td">R$ {{ number_format($valor_total_apostado,2,',','.') }}</td>
                            </tr>

                            <tr class="bet-slip-total__tr">
                                <th class="bet-slip-total__th">Total Odds</th>
                                <td class="bet-slip-total__td">
                                    {{ $valor_total_cotas }}
                                </td>
                            </tr>

                            <tr class="bet-slip-total__tr">
                                <th class="bet-slip-total__th">Possível Retorno</th>
                                <td class="bet-slip-total__td">
                                    R$ {{ number_format( ($valor_total_cotas * $valor_total_apostado),2,',','.' ) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            <?php } ?>

                {{ Form::open(['url' => '/lite/finalizar-aposta', 'id' => 'form_finalizar_aposta']) }}
                    <input hidden="true" formcontrolname="stake" placeholder="10 - 20000" value="10" type="text" id="stake" name="stake">
                    <input hidden="true" placeholder="10 - 20000" value="" type="text" id="newstakevalue" name="newstakevalue">

                    <?php
                        if($valor_total_apostado > 0){
                            echo '<button class="bet-slip__btn" type="button" id="btn_finalizar_aposta">Colocar Aposta</button>';
                        }
                    ?>

                    <?php if($valor_total_apostado > 0){ ?>
                    <a href="#" class="bet-slip__clear" type="button" id="btn_limpar_aposta">
                        <center><span class="bet-slip__clear-icon icon-lost"></span> Limpar Apostas</center>
                    </a>
                <?php } ?>
                {{ Form::close() }}


      </div>
    </div>

        @yield('footer')

        @yield('footer2')


  </div>

  <script src="/assets3/plugins/jquery/jquery.min.js"></script>
  <script src="/assets3/plugins/moment/moment.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript">
      $(document).ready(function(e){
          $('.ca-input').maskMoney({
              prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true
          });

          $('#btn2').click(function(e){
              $(this).attr('disabled', 'disabled');
              $('#form2').submit();
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

          $('#btn_limpar_aposta').click(function(e){
              $(this).attr('disabled', 'disabled');

              Swal.fire({
                  title: 'Limpar todas as apostas?',
                  text: "Confirma que deseja reverter todas as apostas?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Confirmar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = '/lite/limpar-apostas';
                  }
              });
          });
      });
  </script>

</body>
</html>
