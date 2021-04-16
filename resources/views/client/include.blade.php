@section('footer')

<div class="main-footer" style="position: fixed; bottom: 0px; width: 100%;">

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



    <div class="rodape">



        <a href="/"><div class="item">

            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 0.6); width: 36px; height: 36px; margin-right: 0px;">

                <path d="M0 0h24v24H0V0z" fill="none"></path>

                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"></path>

                <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"></path>

            </svg>



            <span class="texto">Home</span>

        </div></a>



        <a href="#" class="trigger_modal" data-target="#modal_carrinho" data-toggle="modal">

            <div class="item">

                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" style="fill: rgba(255, 255, 255, 0.6); width: 36px; height: 36px; margin-right: 0px;" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"></path><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"></path></svg>



                <span style="position: absolute; margin-left: 25px;"><span class="badge badge-danger" id="totalCupom">3</span></span>

                <span class="texto">Meu Cupom</span>

            </div>

        </a>

        <div class="item">

            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" style="fill: rgba(255, 255, 255, 0.6); width: 36px; height: 36px; margin-right: 0px;" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"></path><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"></path></svg>



            <span class="texto">Esportes A-Z</span>

        </div>



    </div>



    <!-- <div class="modal fade" id="modal_carrinho" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        ...

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <button type="button" class="btn btn-primary">Save changes</button>

      </div>

    </div>

  </div>

</div> -->



</div>

@stop



@section('corpo_carrinho')

<div class="ca-container corpo_carrinho">





</div>

@stop



@section('corpo_carrinho2')

<div class="ca-container corpo_carrinho">





</div>

@stop

@section('main-header')

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

                <input class="form-control" placeholder="Digite aqui para procura" type="search" id="search" /><button class="btn"><i class="fe fe-search"></i></button>
                <div class="autocomplete-suggestions">
                    <div class="autocomplete-suggestion"></div>
                </div>
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



                                                    <a href="/leagues/'.$dados2['id'].'" class="slide-item">'.$dados2['nome_liga'].'</a>

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

                            Todos os Esportes<i class="fe fe-chevron-down horizontal-icon"></i>

                        </a>

                        <ul class="sub-menu">

                            <?php

                            $esportes = App\Esportes::where('status', 1)->orderBy('nome_traduzido','asc')->get();



                            if(count($esportes) > 0){

                                foreach($esportes as $dados){

                                    echo '

                                        <a href="sports/'.$dados->id.'"><div class="list-group-item list-group-item-action flex-column align-items-start">

                                            <div class="d-flex w-100 justify-content-between">

                                                <h5 class="mb-2 tx-14"><i class="fa fa-star mr-2"></i> '.$dados->nome_traduzido.'</h5>



                                            </div>

                                        </div></a>

                                    ';

                                }

                            }

                            ?>

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

                                        <li aria-haspopup="true"><a href="/lite/login" class="slide-item">Entrar</a></li>

                                        <li aria-haspopup="true"><a href="/lite/cadastro" class="slide-item">Cadastrar</a></li>

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

<div class="sidebar sidebar-right sidebar-animate ps">

                <div class="panel panel-primary card mb-0 box-shadow">

                    <div class="tab-menu-heading border-0 p-3">

                        <div class="card-title mb-0">Notifications</div>

                        <div class="card-options ml-auto">

                            <a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>

                        </div>

                    </div>

                    <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">

                        <div class="tabs-menu">

                            <!-- Tabs -->

                            <ul class="nav panel-tabs">

                                <li class="">

                                    <a href="#side1" class="active" data-toggle="tab"><i class="ion ion-md-chatboxes tx-18 mr-2"></i> Chat</a>

                                </li>

                                <li>

                                    <a href="#side2" data-toggle="tab"><i class="ion ion-md-notifications tx-18 mr-2"></i> Notifications</a>

                                </li>

                                <li>

                                    <a href="#side3" data-toggle="tab"><i class="ion ion-md-contacts tx-18 mr-2"></i> Friends</a>

                                </li>

                            </ul>

                        </div>

                        <div class="tab-content">

                            <div class="tab-pane active" id="side1">

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-primary brround avatar-md">CH</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>New Websites is Created</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">30 mins ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-danger brround avatar-md">N</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Prepare For the Next Project</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">2 hours ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-info brround avatar-md">S</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Decide the live Discussion</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">3 hours ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-warning brround avatar-md">K</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Meeting at 3:00 pm</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">4 hours ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-success brround avatar-md">R</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Prepare for Presentation</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">1 days ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-pink brround avatar-md">MS</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Prepare for Presentation</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">1 days ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center border-bottom p-3">

                                    <div class=""><span class="avatar bg-purple brround avatar-md">L</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Prepare for Presentation</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">45 mintues ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="list d-flex align-items-center p-3">

                                    <div class=""><span class="avatar bg-blue brround avatar-md">U</span></div>

                                    <a class="wrapper w-100 ml-3" href="#">

                                        <p class="mb-0 d-flex"><b>Prepare for Presentation</b></p>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="d-flex align-items-center">

                                                <i class="mdi mdi-clock text-muted mr-1"></i> <small class="text-muted ml-auto">2 days ago</small>

                                                <p class="mb-0"></p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                            <div class="tab-pane" id="side2">

                                <div class="list-group list-group-flush">

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3">

                                            <span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/12.jpg" style="background: url('../../assets/img/faces/12.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div>

                                            <strong>Madeleine</strong> Hey! there I' am available....

                                            <div class="small text-muted">3 hours ago</div>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3"><span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/1.jpg" style="background: url('../../assets/img/faces/1.jpg') center center;"></span></div>

                                        <div>

                                            <strong>Anthony</strong> New product Launching...

                                            <div class="small text-muted">5 hour ago</div>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3">

                                            <span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/2.jpg" style="background: url('../../assets/img/faces/2.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div>

                                            <strong>Olivia</strong> New Schedule Realease......

                                            <div class="small text-muted">45 mintues ago</div>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3">

                                            <span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/8.jpg" style="background: url('../../assets/img/faces/8.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div>

                                            <strong>Madeleine</strong> Hey! there I' am available....

                                            <div class="small text-muted">3 hours ago</div>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3">

                                            <span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/11.jpg" style="background: url('../../assets/img/faces/11.jpg') center center;"></span>

                                        </div>

                                        <div>

                                            <strong>Anthony</strong> New product Launching...

                                            <div class="small text-muted">5 hour ago</div>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3">

                                            <span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/6.jpg" style="background: url('../../assets/img/faces/6.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div>

                                            <strong>Olivia</strong> New Schedule Realease......

                                            <div class="small text-muted">45 mintues ago</div>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-3">

                                            <span class="avatar avatar-lg brround cover-image" data-image-src="../../assets/img/faces/9.jpg" style="background: url('../../assets/img/faces/9.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div>

                                            <strong>Olivia</strong> Hey! there I' am available....

                                            <div class="small text-muted">12 mintues ago</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane" id="side3">

                                <div class="list-group list-group-flush">

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/9.jpg" style="background: url('../../assets/img/faces/9.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Mozelle Belt</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/11.jpg" style="background: url('../../assets/img/faces/11.jpg') center center;"></span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Florinda Carasco</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/10.jpg" style="background: url('../../assets/img/faces/10.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Alina Bernier</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/2.jpg" style="background: url('../../assets/img/faces/2.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Zula Mclaughin</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/13.jpg" style="background: url('../../assets/img/faces/13.jpg') center center;"></span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Isidro Heide</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/12.jpg" style="background: url('../../assets/img/faces/12.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Mozelle Belt</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2"><span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/4.jpg" style="background: url('../../assets/img/faces/4.jpg') center center;"></span></div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Florinda Carasco</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2"><span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/7.jpg" style="background: url('../../assets/img/faces/7.jpg') center center;"></span></div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Alina Bernier</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2"><span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/2.jpg" style="background: url('../../assets/img/faces/2.jpg') center center;"></span></div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Zula Mclaughin</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/14.jpg" style="background: url('../../assets/img/faces/14.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Isidro Heide</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/11.jpg" style="background: url('../../assets/img/faces/11.jpg') center center;"></span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Florinda Carasco</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2"><span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/9.jpg" style="background: url('../../assets/img/faces/9.jpg') center center;"></span></div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Alina Bernier</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2">

                                            <span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/15.jpg" style="background: url('../../assets/img/faces/15.jpg') center center;">

                                                <span class="avatar-status bg-success"></span>

                                            </span>

                                        </div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Zula Mclaughin</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="mr-2"><span class="avatar avatar-md brround cover-image" data-image-src="../../assets/img/faces/4.jpg" style="background: url('../../assets/img/faces/4.jpg') center center;"></span></div>

                                        <div class=""><div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">Isidro Heide</div></div>

                                        <div class="ml-auto">

                                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="ps__rail-x" style="left: 0px; top: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>

                <div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>

            </div>

@stop

