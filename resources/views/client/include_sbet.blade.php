@yield('main-header')
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="Description" content="NoboBets" />

    <meta name="Author" content="Novo Bets" />

    <meta charset="utf-8">

    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600%7CRoboto:400,900">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fonts.css?16">
    <link rel="stylesheet" href="/css/style.css?ss">
  </head>
  <body>
    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="/images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <!-- <div class="preloader">
      <div class="preloader-body">
        <div class="preloader-item"></div>
      </div>
    </div> -->
    <!-- Page-->
    <div class="page">
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
                    <a class="brand" href="index.html">
                        <img class="brand-logo-dark" src="/logo_principal.png" alt="" width="106" height="41"/>
                        <img class="brand-logo-light" src="/logo_principal.png" alt="" width="106" height="41"/>
                    </a>
                  </div>
                  <!-- RD Navbar Search-->
                  <div class="rd-navbar-search">
                    <button class="rd-navbar-search-toggle" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                    <form class="rd-search" action="search-results.html" data-search-live="rd-search-results-live" method="GET">
                      <div class="form-wrap">
                        <label class="form-label" for="rd-navbar-search-form-input">Enter your search request here...</label>
                        <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                        <div class="rd-search-results-live" id="rd-search-results-live"></div>
                      </div>
                      <button class="rd-search-form-submit fl-budicons-launch-search81" type="submit"></button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="rd-navbar-main-bottom rd-navbar-darker">
                <div class="rd-navbar-main-container container">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav"> 
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="/">Início</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="/jogos-ao-vivo">Ao Vivo</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="/verifica-bilhete">Verifica Bilhete</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="/regulamentacao">Regulamento</a>
                    </li>
                  </ul>
                  <div class="rd-navbar-main-element">
                    <ul class="list-inline list-inline-sm">
                      <li><a class="icon icon-xs fa fa-facebook" href="#"></a></li>
                      <li><a class="icon icon-xs fa fa-twitter" href="#"></a></li>
                      <li><a class="icon icon-xs fa fa-google-plus" href="#"></a></li>
                      <li><a class="icon icon-xs fa fa-instagram" href="#"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>