
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <?php $config =\DB::table('campos_fixos')->first(); ?>
    <!-- Site Title-->
    <title>{{$config->nome_banca}}</title>
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="Description" content="NoboBets" />

    <meta name="Author" content="Novo Bets" />

    <meta charset="utf-8">

    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600%7CRoboto:400,900">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fonts.css?16">
    <link rel="stylesheet" href="/css/style.css?ss">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="/images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-body">
        <div class="preloader-item"></div>
      </div>
    </div>
    <!-- Page-->
    <style>

    a {
        text-decoration: none;
      }
    </style>
    @section('main-header')
      <!-- Page Header-->
      <header class="section page-header rd-navbar-dark">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="166px" data-xl-stick-up-offset="166px" data-xxl-stick-up-offset="166px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-panel">
              <!-- RD Navbar Toggle-->
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-main"><span></span></button>
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel-inner container">
                <div class="rd-navbar-panel-item rd-navbar-panel-item-left">
                  <ul class="list-inline list-inline-sm">
                  </ul>
                </div>
                <div class="rd-navbar-collapse rd-navbar-panel-item rd-navbar-panel-item-right">
                  <ul class="list-inline list-inline-bordered">
                    @if(isset(Auth::user()->id))
                        <li><a class="link link-icon link-icon-left link-classic" href="/admin/dashboard">
                        <span class="icon fl-bigmug-line-login12"></span>
                        <span class="link-icon-text">Minha Conta</span></a></li>
                    @else
                        <li><a class="badge badge-primary" href="/cadastro">Cadastra-se</a></li>
                        <li><a class="badge badge-primary" href="/admin/login">Login</a></li>
                    @endif
                  </ul>
                </div>
                <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
              </div>
            </div>
            <div class="rd-navbar-main">
              <div class="rd-navbar-main-top">
                <div class="rd-navbar-main-container container">
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand">
                    <!-- Brand-->
                    <a class="brand" href="/">
                        <img class="brand-logo-dark" src="/logo_principal.png" alt="" width="106" height="41"/>
                        <img class="brand-logo-light" src="/logo_principal.png" alt="" width="106" height="41"/>
                    </a>
                  </div>
                  <!-- RD Navbar Search-->
                </div>
              </div>
              <div class="rd-navbar-main-bottom rd-navbar-darker">
                <div class="rd-navbar-main-container container">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav"> 
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="/">Início</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="/jogos-ao-vivo">Ao Vivo</a></li>
                    <li class="rd-nav-item d-lg-block d-lg-none d-xl-block d-xl-none">
                      <a class="rd-nav-link" href="/data/{{\Carbon\Carbon::now()->addDay(1)->locale('pt_BR')->format('Y-m-d')}}">Jogos do dia {{\Carbon\Carbon::now()->addDay(1)->locale('pt_BR')->format('d/m/Y')}}</a>
                    </li>
                    <li class="rd-nav-item d-lg-block d-lg-none d-xl-block d-xl-none">
                      <a class="rd-nav-link" href="/data/{{\Carbon\Carbon::now()->addDay(2)->locale('pt_BR')->format('Y-m-d')}}">Jogos do dia {{\Carbon\Carbon::now()->addDay(2)->locale('pt_BR')->format('d/m/Y')}}
                      </a>
                    </li>
                    <li class="rd-nav-item d-lg-block d-lg-none d-xl-block d-xl-none">
                      <a class="rd-nav-link" href="/data/{{\Carbon\Carbon::now()->addDay(3)->locale('pt_BR')->format('Y-m-d')}}">Jogos do dia {{\Carbon\Carbon::now()->addDay(3)->locale('pt_BR')->format('d/m/Y')}}</a>
                    </li>
                    <li class="rd-nav-item">
                    <a class="rd-nav-link" href="#">Campeonatos</a>
                  
                    <article class="rd-menu rd-navbar-megamenu rd-megamenu-2-columns context-light">
                      <div class="rd-megamenu-main">
                          <div class="rd-megamenu-item rd-megamenu-item-nav">
                            <!-- Heading Component-->

                            <div class="rd-megamenu-list-outer">


                              <ul class="rd-megamenu-list">
                              <?php

                                $campeonatosDestaque = App\Ligas::where('ligas.status', 1)

                                    ->leftJoin('paises', 'paises.id','=','ligas.idpais')

                                    ->select("ligas.id", "ligas.nome_traduzido", "paises.bandeira", "paises.id as idpais", "paises.nome_traduzido as nome_pais")

                                    ->groupBy('idpais')->get();



                                $array_pais = [];

                                if(count($campeonatosDestaque) > 0){

                                    foreach($campeonatosDestaque as $dados){

                                        $c = App\Ligas::where('ligas.status', 1)

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



                                                if(count($dados['ligas']) > 0){

                                                    foreach($dados['ligas'] as $dados2){
                                                      echo '<li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="/leagues/'.$dados2['id'].'">'.$dados2['nome_liga'].'</a></li>';

                                                    }

                                                }

                    


                                    }

                                }

                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                    </article>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="/verifica-bilhete">Verifica Bilhete</a>
                    </li>
                   <li class="rd-nav-item "><a class="rd-nav-link" href="/regulamentacao">Regulamento</a></li>

                    @if(isset(Auth::user()->id))
                          <li class="rd-nav-item"><a class="rd-nav-link" href="/admin/dashboard">Minha Conta</a></li>
                      @else
                          <li class="rd-nav-item"><a class="rd-nav-link" href="/cadastro">Cadastra-se</a></li>
                          <li class="rd-nav-item"><a class="rd-nav-link" href="/admin/login">Login</a></li>
                      @endif
                  </ul>
                  <div class="rd-navbar-main-element">
                    <ul class="list-inline list-inline-sm d-xl-none d-lg-none d-md-none ">
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      @stop

 @section('alert')
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
@stop
