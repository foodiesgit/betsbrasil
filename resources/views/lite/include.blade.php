@section('header-principal')
<div class="main-header nav nav-item hor-header">
    <div class="container">
        <div class="main-header-left">
            <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
            <!-- sidebar-toggle-->
            <a class="header-brand" href="/">
                <img src="/logo_principal.png" class="desktop-dark" />
                <img src="/logo_principal.png" class="desktop-logo" />
                <img src="/logo_principal.png" class="desktop-logo-1" />
                <img src="/logo_principal.png" class="desktop-logo-dark" />
            </a>
            <div class="main-header-center ml-4">

            </div>
        </div>
        <!-- search -->
        <div class="main-header-right">
            <ul class="nav">

            </ul>
            <div class="nav nav-item navbar-nav-right ml-auto">



                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                        </svg>
                    </a>
                </div>
                <?php
                    if( Auth::check() ){
                        echo '
                        <div class="dropdown main-profile-menu nav nav-item nav-link">
                            <a class="profile-user d-flex" href=""><img alt="" src="https://www.spruko.com/demo/valex/Valex/assets/img/faces/6.jpg" /></a>
                            <div class="dropdown-menu">
                                <div class="main-header-profile bg-primary p-3">
                                    <div class="d-flex wd-100p">
                                        <div class="main-img-user"><img alt="" src="https://www.spruko.com/demo/valex/Valex/assets/img/faces/6.jpg" class="" /></div>
                                        <div class="ml-3 my-auto">
                                            <h6>'.auth()->user()->nome.'</h6>
                                            ';
                                            $tipousuario = auth()->user()->tipo_usuario;
                                            $usuario = '';

                                            if($tipousuario == 1){
                                                $usuario = 'Usuario';
                                            }elseif($tipousuario == 2){
                                                $usuario = 'Administrador';
                                            }elseif($tipousuario == 3){
                                                $usuario = 'Gerentes';
                                            }elseif($tipousuario == 4){
                                                $usuario = 'Cambistas';
                                            }

                                            $meusaldo = DB::table('creditos')->where('idusuario', auth()->user()->id)->get();
                                            $saldo_disponivel = 0;

                                            if(count($meusaldo) > 0){
                                                $saldo_disponivel = $meusaldo[0]->saldo_liberado + $meusaldo[0]->saldo_apostas;
                                            }

                                            echo'

                                            <span>R$ '.number_format($saldo_disponivel, 2, ',', '.').'</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="/minha-conta/meus-dados"><i class="bx bx-user-circle"></i>Meus Dados</a>
                                <a class="dropdown-item" href="/minha-conta/minhas-apostas"><i class="bx bx-cog"></i> Minhas Apostas</a>
                                <a class="dropdown-item" href="/minha-conta/sair"><i class="bx bx-log-out"></i> Sair</a>
                            </div>
                        </div>
                        ';
                    }
                ?>


            </div>
        </div>
    </div>
</div>
@stop

@section('horizontal-menu')
<div class="sticky" style="margin-bottom: -53.2969px;">
    <div class="horizontal-main hor-menu clearfix side-header">
        <div class="horizontal-mainwrapper container clearfix">
            <!--Nav-->
            <nav class="horizontalMenu clearfix">
                <div class="horizontal-overlapbg"></div>
                <ul class="horizontalMenu-list">
                    <li aria-haspopup="true">
                        <a href="/" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"></path>
                                <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"></path>
                            </svg>
                            Principal
                        </a>
                    </li>

                    <!-- <li aria-haspopup="true" class="sub-menu-sub"><span class="horizontalMenu-click02"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span><a href="#">Forms</a> <ul class="sub-menu"> <li aria-haspopup="true"><a href="form-elements.html" class="slide-item">Form Elements</a></li> <li aria-haspopup="true"><a href="form-advanced.html" class="slide-item">Advanced Forms</a></li> <li aria-haspopup="true"><a href="form-layouts.html" class="slide-item">Form Layouts</a></li> <li aria-haspopup="true"><a href="form-validation.html" class="slide-item">Form Validation</a></li> <li aria-haspopup="true"><a href="form-wizards.html" class="slide-item">Form Wizards</a></li> <li aria-haspopup="true"><a href="form-editor.html" class="slide-item">WYSIWYG Editor</a></li> </ul> </li> -->



                    <li aria-haspopup="true">
                        <span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                        <a href="#" class="sub-icon">
                            <img src="https://img.icons8.com/wired/64/000000/football2.png" style="width: 24px; height: 24px; margin-right: 5px;">
                            Futebol <i class="fe fe-chevron-down horizontal-icon"></i>
                        </a>
                        <ul class="sub-menu">
                    <?php
                        $campeonatosDestaque = App\Ligas::where('ligas.status', 1)->where('ligas.destaque', 1)
                            ->leftJoin('paises', 'paises.id','=','ligas.idpais')
                            ->select("ligas.id", "ligas.nome_traduzido", "paises.bandeira", "paises.id as idpais", "paises.nome_traduzido as nome_pais")
                            ->groupBy('idpais')->get();

                        $array_pais = [];
                        if(count($campeonatosDestaque) > 0){
                            foreach($campeonatosDestaque as $dados){
                                $c = App\Ligas::where('ligas.status', 1)->where('ligas.destaque', 1)
                                    ->where('idpais', $dados->idpais)
                                    ->leftJoin('paises', 'paises.id','=','ligas.idpais')
                                    ->select("ligas.id", "ligas.nome_traduzido", "paises.nome_traduzido as nome_pais")->get();

                                $array_ligas = [];


                                if(count($c) > 0){
                                    foreach($c as $dados2){
                                        $array_ligas[] = [
                                            'id' => $dados2->id,
                                            'nome_liga' => $dados2->nome_traduzido,
                                        ];
                                    }
                                }

                                $array_pais[] = [
                                    'id' => $dados->id,
                                    'nome' => $dados->nome_pais,
                                    'bandeira' => $dados->bandeira,
                                    'ligas' => $array_ligas
                                ];
                            }
                        }


                        if(count($array_pais) > 0){
                            foreach($array_pais as $dados){

                                $totalEvents = DB::table('events')->where('idliga', $dados['id'])->where('data','>',date('Y-m-d H:i:s'))->select(DB::raw("count(*) as total"))->get();

                                echo '
                                <li aria-haspopup="true">
                                    <span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                                    <a href="#" class="sub-icon">
                                        <img src="/assets/bandeiras/'.$dados['bandeira'].'" style="width: 24px; height: 24px; margin-right: 5px;">
                                        '.$dados['nome'].'<i class="fe fe-chevron-down horizontal-icon"></i>
                                    </a>
                                    <ul class="sub-menu">';

                                        if(count($dados['ligas']) > 0){
                                            foreach($dados['ligas'] as $dados2){
                                                echo '<li aria-haspopup="true">

                                                    <a href="/lite/leagues/'.$dados2['id'].'" class="slide-item">'.$dados2['nome_liga'].'</a>
                                                </li>';
                                            }
                                        }
                                    echo '</ul>
                                </li>
                                ';


                            }
                        }
                        echo '</ul></li>'
                    ?>
                    <li aria-haspopup="true">
                        <span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                        <a href="#" class="sub-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"></path>
                                <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"></path>
                            </svg>
                            Menu Teste<i class="fe fe-chevron-down horizontal-icon"></i>
                        </a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="#" class="slide-item">Item 1</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item">Item 2</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item">Item 3</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true">
                        <span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                        <a href="#" class="sub-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"></path>
                                <path
                                    d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"
                                ></path>
                            </svg>
                            <?php
                                if (\Auth::check()) {
                                    echo 'Minha Conta <i class="fe fe-chevron-down horizontal-icon"></i>';
                                }else{
                                    echo 'Login / Cadastro <i class="fe fe-chevron-down horizontal-icon"></i>';
                                }
                            ?>
                        </a>
                        <ul class="sub-menu">
                            <?php
                                if(\Auth::check()){
                                    echo '
                                        <li aria-haspopup="true"><a href="/minha-conta/dashboard" class="slide-item">Minha Conta</a></li>
                                    ';
                                }else{
                                    echo '
                                        <li aria-haspopup="true"><a href="/login" class="slide-item">Entrar</a></li>
                                        <li aria-haspopup="true"><a href="/cadastro" class="slide-item">Cadastrar</a></li>
                                    ';
                                }
                            ?>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!--Nav-->
        </div>
    </div>
</div>
@stop

@section('header')
<header class="header header--after-log-in" style="width: 100% !important;">
  <div class="header-wrapper header-wrapper--after-log-in">
      <div class="header__first-mobile">
          <div class="header__burger">
              <a href="/lite/menu" class="header__burger-link" role="button">Menu</a>
          </div>
          <div class="header__logo">
              <a href="/lite" class="header__logo-link">
                  <img alt="Logo" class="header__logo-img" src="/logo_principal.png">
              </a>
          </div>
      </div>
      <div class="header__block">
          <div class="header__top">
              <?php
                if(Auth::check()){

                }else{
                    echo '
                    <a href="/lite/login" role="button" class="header__btn-link">Entrar</a>
                    ';
                }
              ?>

          </div>
      </div>
  </div>

        <!-- <div class="header__top header__top--after-log-in">
          <a href="./login-page.html" role="button" class="header__btn-link header__btn-link--after-log-in" > My account </a>
          <a href="./register-page.html" role="button" class="header__btn-link header__btn-link--after-log-in" >  My bets  </a>
        </div>   -->
  <div class="main__header-search">

      <form method="GET" action="/lite/pesquisa" class="header-search__form" style="height: auto;">
        <input name="params" value="[]" hidden="true" type="text">
        <input name="search" type="text" placeholder="Digite para pesquisar" class="header-search__input">
        <button type="submit" class="header-search__submit-btn">Procurar</button>
      </form>
    </div>

  <div class="hr"></div>
</header>
@stop

@section('header-sports')
<!-- <nav class="header-sports">
<ul class="header-sports__list" style="overflow-x: scroll !important;">
  <li class="header-sports__item header-sports__item--active">
        <form action="/lite/sports/1">
      <button class="header-sports__item-link">
        <img src="/assets3/img/images/1.png?t=1607711661000" alt="" class="sports-svg">
      </button>
    </form>
  </li>





      </ul>
  </nav> -->
@stop

@section('footer')
<style type="text/css">
        .rodape{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            background-color: #CA3B1B;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .rodape .item{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .rodape .item .texto{
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }
    </style>
<section class="users-footer">
    <div class="rodape">

        <a href="/lite"><div class="item">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 0.6); width: 36px; height: 36px; margin-right: 0px;">
                <path d="M0 0h24v24H0V0z" fill="none"></path>
                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"></path>
                <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"></path>
            </svg>

            <span class="texto">Home</span>
        </div></a>

        <a href="/lite/minhas-apostas" class="trigger_modal" data-toggle="modal">
            <div class="item">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" style="fill: rgba(255, 255, 255, 0.6); width: 36px; height: 36px; margin-right: 0px;" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"></path><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"></path></svg>

                <!-- <span style="position: absolute; margin-left: 25px;"><span class="badge badge-danger" id="totalCupom">3</span></span> -->
                <span class="texto">Minhas Apostas</span>
            </div>
        </a>
        <div class="item">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" style="fill: rgba(255, 255, 255, 0.6); width: 36px; height: 36px; margin-right: 0px;" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"></path><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"></path></svg>

            <span class="texto">Minha Conta</span>
        </div>

    </div>

    <!-- <nav class="users-footer__nav">
        <ul class="users-footer__list">
            <li class="users-footer__item">
                <a href="/lite" class="users-footer__link">
                    <div class="users-footer__img-wrapper">
                        <img src="/assets3/img/images/simple-house-thin.svg?t=1607711661000" alt="" class="users-footer__img">
                    </div>
                    <span class="users-footer__link-txt">Home</span>
                </a>
            </li>
            <li class="users-footer__item">
                <a href="/lite/minhas-apostas" class="users-footer__link">
                    <div class="users-footer__img-wrapper">
                        <img src="/assets3/img/images/invoice.svg?t=1607711661000" alt="" class="users-footer__img">
                    </div>
                    <span class="users-footer__link-txt">Minhas Apostas</span>
                </a>
            </li>

            <li class="users-footer__item">
                <a href="/lite/minha-conta" class="users-footer__link">
                    <div class="users-footer__img-wrapper">
                        <img src="/assets3/img/images/user-profile.svg?t=1607711661000" alt="" class="users-footer__img">
                    </div>
                    <span class="users-footer__link-txt my-account">Minha Conta</span>
                </a>
            </li>
        </ul>
    </nav> -->
</section>
@stop

@section('footer2')
<section class="footer-bottom-text-wrapper">
    <nav>
        <ul class="users-footer-menu-list">
            <li class="users-footer-menu-item">
                <a href="#" class="users-footer-menu-link" >FAQs</a>
            </li>
            <li class="users-footer-menu-item">
                <a href="#" class="users-footer-menu-link" >
                    Política de Privacidade
                </a>
            </li>
            <li class="users-footer-menu-item">
                <a href="#" class="users-footer-menu-link" >
                    Termos e Condições
                </a>
            </li>
            <li class="users-footer-menu-item">
                <a href="#" class="users-footer-menu-link" >
                    Regulamento
                </a>
            </li>
            <li class="users-footer-menu-item">
                <a href="#" class="users-footer-menu-link" >
                    Jogo Responsável
                </a>
            </li>
            <li class="users-footer-menu-item">
                <a href="#" class="users-footer-menu-link" >
                    Contato / Suporte
                </a>
            </li>


        </ul>
    </nav>
    <!--<ul class="users-footer-menu-list">
        <li class="footer-bottom-text" style="color: #000;">
            Criado e Desenvolvido por ABC
        </li>
    </ul>
    <div class="line"></div>
    <p class="footer-bottom-text" style="color: #000;">Texto com Informações para o rodapé da página</p>-->

</section>
@stop
