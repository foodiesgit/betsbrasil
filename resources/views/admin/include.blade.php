@section('header')
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <meta name="description" content="Painel de Controle">
  <?php $config =\DB::table('campos_fixos')->first(); ?>
    <!-- Site Title-->
    <title>{{$config->nome_banca}} - Painel de Controle</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../../favicon.ico">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets4/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets4/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets4/css/argon.css?v=1.1.0" type="text/css">
  <link href="/assets2/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <link href="/assets2/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
  <link href="/assets2/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">


  <link href="/assets2/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">

  <link href="/assets2/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

  <link rel="stylesheet" href="/assets2/vendor/pickadate/themes/default.css">

  <link rel="stylesheet" href="/assets2/vendor/pickadate/themes/default.date.css">
</head>

<body>
<?php $user =\Auth::user();

?>
           
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="/">
          <img src="/logo_principal.png" class="navbar-brand-img" alt="..."> 
        </a>
        <div class="ml-auto">
          <div>

          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
          @if($user->tipo_usuario == 1)
            <li class="nav-item">
                <a href="/" class="nav-link">
                <i class="ni ni-shop text-primary"></i>
                Início</a>
            </li>
            @else
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                <i class="ni ni-shop text-primary"></i>
                Início</a>
            </li>
            @endif
            @if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-circle-08 text-orange"></i>
                <span class="nav-link-text">Usuarios</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/admin/usuarios/listar" class="nav-link">Listar</a>
                  </li>
                </ul>
              </div>
            </li>
            @endif
			@if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="/admin/caixa">
                <i class="ni ni-box-2 text-default"></i>
                <span class="nav-link-text">Caixa</span>
              </a>
            </li>
            @endif
			@if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-boxg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-boxg">
                <i class="ni ni-box-2 text-default"></i>
                <span class="nav-link-text">Caixa Gerentes</span>
              </a>
              <div class="collapse" id="navbar-boxg">
                <ul class="nav nav-sm flex-column">
                <li class="nav-item"><a href="/admin/gerentes/caixa" class="nav-link">Dashboard</a></li>

                <li class="nav-item"><a href="/admin/gerentes/caixa/historico" class="nav-link">Movimentações</a></li>
                </ul>
              </div>
            </li>
            @endif
			@if($user->tipo_usuario == 2|| $user->tipo_usuario == 3)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-boxc" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-boxc">
                <i class="ni ni-box-2  text-default"></i>
                <span class="nav-link-text">Caixa Cambistas</span>
              </a>
              <div class="collapse" id="navbar-boxc">
                <ul class="nav nav-sm flex-column">

                <li class="nav-item"><a href="/admin/cambistas/caixa" class="nav-link">Dashboard</a></li>
                @if($user->tipo_usuario == 2)
                  <li class="nav-item"><a href="/admin/cambistas/caixa/historico" class="nav-link">Movimentações</a></li>
                @endif
                </ul>
              </div>
            </li>
            @endif
            @if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                <i class="ni ni-ui-04 text-info"></i>
                <span class="nav-link-text">Gerênciar API de jogos</span>
              </a>
              <div class="collapse" id="navbar-components">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/admin/api/esportes/listar" class="nav-link">Esportes</a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/api/paises/listar" class="nav-link">Paises</a>

                  </li>
                  <li class="nav-item">
                      <a href="/admin/api/ligas/listar" class="nav-link">Ligas</a>
                  </li>
                </ul>
              </div>
            <li>
            @endif
            @if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
                <i class="ni ni-briefcase-24 text-pink"></i>
                <span class="nav-link-text">Gerentes</span>
              </a>
              <div class="collapse" id="navbar-forms">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/admin/gerentes/cadastrar" class="nav-link">Cadastrar</a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/gerentes/listar" class="nav-link">Listar</a>
                  </li>
                </ul>
              </div>
            </li>
            @endif
            @if($user->tipo_usuario == 2||$user->tipo_usuario == 3)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-tables" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-tables">
                <i class="ni ni-single-02 text-default"></i>
                <span class="nav-link-text">Cambistas</span>
              </a>
              <div class="collapse" id="navbar-tables">
                <ul class="nav nav-sm flex-column">

                <li class="nav-item"><a href="/admin/cambistas/cadastrar" class="nav-link">Cadastrar</a></li>

                <li class="nav-item"><a href="/admin/cambistas/listar" class="nav-link">Listar</a></li>
                </ul>
              </div>
            </li>
            @endif
            @if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="#navbar-jogos" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-jogos">
                <i class="ni ni-user-run text-default"></i>
                <span class="nav-link-text">Jogos</span>
              </a>
              <div class="collapse" id="navbar-jogos">

                <ul class="nav nav-sm flex-column">
                
                    <li class="nav-item"><a href="/admin/jogos/listar"  class="nav-link">Listar Jogos</a></li>

                    <li class="nav-item"><a href="/admin/jogos/mapa-aposta"  class="nav-link">Mapa de Apostas</a></li>

                    <li class="nav-item"><a href="/admin/jogos/gerenciamento-risco"  class="nav-link">Gerênciamento de Risco</a></li>
                </ul>
              </div>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/admin/fixos/bilhetes">
                <i class="ni ni-single-copy-04 text-default"></i>
                <span class="nav-link-text">Bilhetes</span>
              </a>
            </li>
            @if($user->tipo_usuario == 4)
            <li class="nav-item">
              <a class="nav-link" href="/admin/validar-bilhete">
                <i class="ni ni-single-copy-04 text-default"></i>
                <span class="nav-link-text">Validar Bilhete</span>
              </a>
            </li>
            @endif
            @if($user->tipo_usuario == 2)
            <li class="nav-item">
              <a class="nav-link" href="/admin/fixos">
                <i class="ni ni-support-16 text-default"></i>
                <span class="nav-link-text">Configurações</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/admin/logout">
                <i class="text-default"></i>
                <span class="nav-link-text">Sair</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  @stop

@section('nav')
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-dark border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <button type="button" class="btn btn-primary">Menu</button>
                <!-- <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div> -->
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle d-none d-sm-block d-md-none" >
                   <!-- <img alt="Image placeholder" src="https://lh3.googleusercontent.com/proxy/bPJQH3mYRKMUavgYsREBMa_mJakqwusyy4wtcgttUFHUpczHG0f31QDZ77fk2cVSbBRSl55fkhgbuaHD4kIS1741kdj93yIZLjbLGAPqCWM3mvaOUmeAQiSAXKWVFBX_H8eJ239ClFdE7A"> -->
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{$user->name}}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bem vindo de Volta!</h6>
                </div>

                <div class="dropdown-divider"></div>
                <a href="/admin/logout" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Sair</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
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
@section('footer')
  

  <!-- Core -->
  <script src="/assets4/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets4/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets4/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets4/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets4/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="/assets4/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="/assets4/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="/assets4/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="/assets4/js/demo.min.js"></script>
  <script src="/assets2/vendor/moment/moment.min.js"></script>

    <script src="/assets2/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="/assets2/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>

    <script src="/assets2/vendor/jquery-asColor/jquery-asColor.min.js"></script>

    <script src="/assets2/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>

    <script src="/assets2/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>

    <script src="/assets2/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <script src="/assets2/vendor/pickadate/picker.js"></script>

    <script src="/assets2/vendor/pickadate/picker.time.js"></script>

    <script src="/assets2/vendor/pickadate/picker.date.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready(function(e){
        $('.datatable').DataTable();


      });

    </script>
</body>

</html>
@stop
