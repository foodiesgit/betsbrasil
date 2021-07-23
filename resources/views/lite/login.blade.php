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
        <section class="user-login-reg">
            <div class="user-login-reg__top">
                <a href="/lite" class="user-login-reg-close-btn-link">
                    <img src="/assets3/img/images/close_login.png" alt="" class="user-login-reg-close-btn-img">
                </a>

                <h2 class="user-login-reg__title">Login</h2>

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

                {{ Form::open(['url' => '/lite/login', 'class' => 'user-login-reg__form']) }}
                    <label class="user-login-reg__lable">Email</label>
                    <input required="" type="text" name="email" class="user-login-reg__input">
                    <label class="user-login-reg__lable">Senha</label>
                    <input required="" type="password" name="password" class="user-login-reg__input" placeholder="Digite sua senha">

                    <button type="submit" class="user-login-reg__submit-btn">Entrar</button>
                {{ Form::close() }}

            </div>

            <a href="/lite/esqueceu-senha" class="user-login-reg__forgot-pass-link user-login-reg-link">Esqueceu sua senha?</a>
            <div class="user-login-reg__register">
                <span class="user-login-reg__register-text">Ainda não é cadastrado?  </span>
                <a href="/lite/cadastrar" class="user-login-reg__register-link user-login-reg-link">Cadastrar</a>
            </div>
        </section>




        @yield('footer')

        @yield('footer2')


  </div>

  <script src="/assets3/plugins/jquery/jquery.min.js"></script>
  <script src="/assets3/plugins/moment/moment.js"></script>

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
