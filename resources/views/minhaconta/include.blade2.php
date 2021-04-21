@section('main-header')
<div class="main-header nav nav-item hor-header">
    <div class="container">
        <div class="main-header-left">
            <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
            <!-- sidebar-toggle-->
            <a class="header-brand" href="/">
                <img src="../../assets/img/brand/logo-white.png" class="desktop-dark" />
                <img src="../../assets/img/brand/logo.png" class="desktop-logo" />
                <img src="../../assets/img/brand/favicon.png" class="desktop-logo-1" />
                <img src="../../assets/img/brand/favicon-white.png" class="desktop-logo-dark" />
            </a>
            <div class="main-header-center ml-4">
                <input class="form-control" placeholder="Digite aqui para procurar" type="search" /><button class="btn"><i class="fe fe-search"></i></button>
            </div>
        </div>
        <!-- search -->
        <div class="main-header-right">
            <ul class="nav">

            </ul>
            <div class="nav nav-item navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" />
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="pulse"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-left">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notificações</h6>
                            </div>
                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12">1 nova notificação</p>
                        </div>
                        <div class="main-notification-list Notification-scroll ps">
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-pink"><i class="la la-file-alt text-white"></i></div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">Teste de Notificação</h5>
                                    <div class="notification-subtext">14:30</div>
                                </div>
                                <div class="ml-auto"><i class="las la-angle-right text-right text-muted"></i></div>
                            </a>

                            <div class="ps__rail-x" style="left: 0px; top: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                        </div>
                        <div class="dropdown-footer"><a href="">Ver Todos</a></div>
                    </div>
                </div>
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
                            <li aria-haspopup="true"><a href="chart-morris.html" class="slide-item">Item 1</a></li>
                            <li aria-haspopup="true"><a href="chart-flot.html" class="slide-item">Item 2</a></li>
                            <li aria-haspopup="true"><a href="chart-chartjs.html" class="slide-item">Item 3</a></li>
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

@section('sidebar-right')

@stop
