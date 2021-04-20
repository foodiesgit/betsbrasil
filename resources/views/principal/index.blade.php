<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="Description" content="NoboBets" />
        <meta name="Author" content="Novo Bets" />

        <!-- Title -->
        <title>Bets</title>

        <link rel="icon" href="/assets3/img/brand/favicon.png" type="image/x-icon" />
        <link href="/assets3/css/icons.css" rel="stylesheet" />
        <link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />
        <link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />
        <link href="/assets3/css/style.css" rel="stylesheet" />
        <link href="/assets3/css/animate.css" rel="stylesheet" />
        <!--<link href="/assets3/css/custom.css" rel="stylesheet" /> -->
        <link href="/assets3/css/floo.css" rel="stylesheet" />

        <style>[_nghost-c0]{box-sizing:border-box}[_nghost-c0]   *[_ngcontent-c0], [_nghost-c0]   [_ngcontent-c0]::after, [_nghost-c0]   [_ngcontent-c0]::before{box-sizing:inherit}[_nghost-c0]   a[_ngcontent-c0], [_nghost-c0]   a[_ngcontent-c0]:hover, [_nghost-c0]   a[_ngcontent-c0]:visited{text-decoration:none}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__track[_ngcontent-c0]{position:absolute;background:#ccc;overflow:hidden;opacity:0;transition:opacity .3s ease}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__track_visible[_ngcontent-c0]{opacity:1}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__track_position_vertical[_ngcontent-c0]{top:0;right:0;bottom:0;width:3px}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__track_position_horizontal[_ngcontent-c0]{right:0;bottom:0;left:0;height:3px}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__knob[_ngcontent-c0]{position:absolute;top:50%;width:3px;height:10px;background:#000}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__knob_position_vertical[_ngcontent-c0]{top:50%;width:3px;height:10px}.scrollbar_theme_default[_ngcontent-c0]   .scrollbar__knob_position_horizontal[_ngcontent-c0]{left:50%;width:10px;height:3px}</style>

        <style type="text/css">@keyframes tawkMaxOpen{0%{opacity:0;transform:translate(0, 30px);;}to{opacity:1;transform:translate(0, 0px);}}@-moz-keyframes tawkMaxOpen{0%{opacity:0;transform:translate(0, 30px);;}to{opacity:1;transform:translate(0, 0px);}}@-webkit-keyframes tawkMaxOpen{0%{opacity:0;transform:translate(0, 30px);;}to{opacity:1;transform:translate(0, 0px);}}#y8fYR8U-1614904162695{outline:none!important;visibility:visible!important;resize:none!important;box-shadow:none!important;overflow:visible!important;background:none!important;opacity:1!important;filter:alpha(opacity=100)!important;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity1)!important;-moz-opacity:1!important;-khtml-opacity:1!important;top:auto!important;right:10px!important;bottom:90px!important;left:auto!important;position:fixed!important;border:0!important;min-height:0!important;min-width:0!important;max-height:none!important;max-width:none!important;padding:0!important;margin:0!important;-moz-transition-property:none!important;-webkit-transition-property:none!important;-o-transition-property:none!important;transition-property:none!important;transform:none!important;-webkit-transform:none!important;-ms-transform:none!important;width:auto!important;height:auto!important;display:none!important;z-index:2000000000!important;background-color:transparent!important;cursor:auto!important;float:none!important;border-radius:unset!important;pointer-events:auto!important}#ulGsB7N-1614904162699.open{animation : tawkMaxOpen .25s ease!important;}</style>
    </head>
    <body class="main-body horizontal-color body--right-eye">
        @include('principal.include')

        <app-root ng-version="7.2.0">
    <div class="content">
        <app-page-wrapper>
            <div class="wrapper">
                <aside class="aside-menu aside-menu--fixed">
                    @yield('app-aside-menu')
                </aside>
                <div class="main">
                    @yield('app-header')
                    <div class="main__block">
                        <aside class="aside-left">
                            <app-sports-list-leagues>
                                <div class="sports-list sports-list--leagues">
                                    <div class="sports-list__header"><p class="sports-list__title">Ligas</p></div>
                                    <div class="sports-list__body">
                                        <app-sports-list-leagues-item>
                                            <a class="sports-list__item">
                                                <figure class="sports-list__figure">
                                                    <img class="sports-list__img" src="https://content.flooks.com/content/Icons/Leagues/17.png?t=1607711661000" />
                                                </figure>

                                                <p class="sports-list__item-title">Premier League</p>
                                                <p class="sports-list__count">+15</p>
                                            </a>
                                        </app-sports-list-leagues-item>

                                    </div>
                                </div>
                            </app-sports-list-leagues>
                            <!---->
                            <app-sports-list-countries>
                                <div class="sports-list sports-list--countries">
                                    <div class="sports-list__header">
                                        <p class="sports-list__title">
                                            Países
                                        </p>
                                    </div>
                                    <!---->
                                    <div class="sports-list__body">
                                        <!----><!---->
                                        <app-sports-list-countries-item>
                                            <a class="sports-list__item">
                                                <figure class="sports-list__figure">
                                                    <img alt="" class="sports-list__img" src="https://content.flooks.com/content/Icons/Locations/1.png?t=1607711661000" />
                                                </figure>
                                                <p class="sports-list__item-title">Inglaterra <span class="sports-list__more-btn-arrow icon-arrow-down"></span></p>
                                                <p class="sports-list__count">+62</p>
                                            </a>
                                        </app-sports-list-countries-item>
                                    </div>
                                    <!---->
                                    <a class="sports-list__more-btn">
                                        Mais Países
                                        <span class="sports-list__more-btn-arrow icon-arrow-down"></span>
                                    </a>
                                </div>
                            </app-sports-list-countries>
                        </aside>
                        <div class="main__content">
                            <router-outlet></router-outlet>
                            <app-home>
                                <app-main-slider><!----></app-main-slider>

<section class="light-block light-block--main">
    <app-games-feed-header>
        <header class="light-block__header">
            <h2 class="light-block__title light-block__title--wrapper">
                <span class="light-block__title-span">Destaques</span>
            </h2>
            <div class="light-block__header-right-wrapper">

            </div>
        </header>
    </app-games-feed-header>
    <div class="light-block__body">
        <div class="light-block-tabs">
            <button class="light-block-tabs__item light-block-tabs__item--active" type="button">Hoje</button>
            <button class="light-block-tabs__item" type="button">Amanhã</button>
            <button class="light-block-tabs__item" type="button">Mostrar todos</button>

            <div class="light-block-tabs__right-wrapper">
                <span>Conteúdo Direita</span>
            </div>
        </div>
        <app-home-games>
            <app-games-by-country>
            <section class="bets-cont">
                <table class="bets">
                    <thead>
                        <tr class="bets__tr bets__tr--aligning">
                            <th class="bets__th bets__th--date"></th>
                            <th class="bets__th bets__th--clubs"></th>
                            <th class="bets__th bets__th--score-empty"></th>

                            <th class="bets__th bets__th--selection bets__th--selection-1" data-mode=""></th>
                            <th class="bets__th bets__th--selection bets__th--selection-1" data-mode=""></th>
                            <th class="bets__th bets__th--selection bets__th--selection-1" data-mode=""></th>

                            <th class="bets__th bets__th--selection bets__th--selection-2" data-mode=""></th>
                            <th class="bets__th bets__th--selection bets__th--selection-2" data-mode=""></th>
                            <th class="bets__th bets__th--stat"></th>
                            <th class="bets__th bets__th--bets"></th>
                        </tr>

                        <tr class="bets__tr">
                            <th class="bets__th bets__th--league" colspan="3">
                                <div class="bets__league-block">
                                    <div class="bets__country"><!----><!----></div>
                                    <!---->
                                </div>
                                <!---->
                            </th>
                            <!----><!----><!----><!---->
                            <th class="bets__th bets__th--selection bets__th--selection-1" colspan="3" data-mode="">3 WAY</th>
                            <!---->
                            <th class="bets__th bets__th--selection bets__th--selection-2" colspan="2" data-mode="">BOTH TEAMS TO SCORE</th>
                            <!---->
                            <th class="bets__th bets__th--stat">Stat</th>
                            <th class="bets__th bets__th--bets">+</th>
                        </tr>
                        <tr class="bets__tr bets__tr--head">
                            <th></th>
                            <th></th>
                            <th></th>
                            <!----><!----><!----><!----><!---->
                            <th class="bets__th bets__th--selection bets__th--selection-1" data-mode="">1</th>
                            <th class="bets__th bets__th--selection bets__th--selection-1" data-mode="">X</th>
                            <th class="bets__th bets__th--selection bets__th--selection-1" data-mode="">2</th>
                            <!----><!----><!---->
                            <th class="bets__th bets__th--selection bets__th--selection-2" data-mode="">YES</th>
                            <th class="bets__th bets__th--selection bets__th--selection-2" data-mode="">NO</th>
                            <!----><!---->
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr app-game-row="" class="bets__tr bets__tr--flex-column-mobile">
                            <td class="bets__td bets__td--date">
                                <div class="bets__date-time">
                                    <!---->
                                    <p class="bets__time">17:00</p>
                                    <!---->
                                    <p class="bets__date">05 Mar</p>
                                </div>
                                <!---->
                                <p class="bets__id"><span class="bets__id-caption">ID:</span><span class="bets__id-value">3826</span></p>
                                <!---->
                            </td>
                            <td class="bets__td bets__td--clubs">
                                <div class="bets__clubs">
                                    <!---->
                                    <div class="bets__clubs-logos">
                                        <!---->
                                        <figure class="bets__clubs-figure"><img alt="" class="bets__clubs-img" src="https://ls.sportradar.com/ls/crest/big/2828.png" /></figure>
                                        <!---->
                                        <figure class="bets__clubs-figure"><img alt="" class="bets__clubs-img" src="https://ls.sportradar.com/ls/crest/big/2819.png" /></figure>
                                    </div>
                                    <!---->
                                    <div class="bets__clubs-names">
                                        <p class="bets__clubs-name">Valencia CF</p>
                                        <p class="bets__clubs-name">Villarreal CF</p>
                                    </div>
                                </div>
                                <div class="bets__clubs-mobile">
                                    <div class="bets__club-wrapper">
                                        <figure class="bets__clubs-figure">
                                            <!---->
                                            <img alt="" class="bets__clubs-img" src="https://ls.sportradar.com/ls/crest/big/2828.png" />
                                        </figure>
                                        <!---->
                                        <p class="bets__clubs-name">Valencia CF</p>
                                    </div>
                                    <div class="bets__club-wrapper">
                                        <figure class="bets__clubs-figure">
                                            <!---->
                                            <img alt="" class="bets__clubs-img" src="https://ls.sportradar.com/ls/crest/big/2819.png" />
                                        </figure>
                                        <!---->
                                        <p class="bets__clubs-name">Villarreal CF</p>
                                    </div>
                                </div>
                            </td>
                            <td class="bets__td bets__td--score bets__td--empty"><!----></td>
                            <!----><!----><!---->
                            <td class="bets__td bets__td--selection bets__td--selection-1" data-mode="">
                                <button class="bets__btn" type="button">
                                    <!---->
                                    <span class="bets__btn-selection-odd"> 3.91 </span>
                                </button>
                            </td>
                            <td class="bets__td bets__td--selection bets__td--selection-1" data-mode="">
                                <button class="bets__btn" type="button">
                                    <!---->
                                    <span class="bets__btn-selection-odd"> 3.37 </span>
                                </button>
                            </td>
                            <td class="bets__td bets__td--selection bets__td--selection-1" data-mode="">
                                <button class="bets__btn" type="button">
                                    <!---->
                                    <span class="bets__btn-selection-odd"> 2.14 </span>
                                </button>
                            </td>
                            <td class="bets__td bets__td--selection bets__td--selection-2" data-mode="">
                                <button class="bets__btn" type="button">
                                    <!---->
                                    <span class="bets__btn-selection-odd"> 1.90 </span>
                                </button>
                            </td>
                            <td class="bets__td bets__td--selection bets__td--selection-2" data-mode="">
                                <button class="bets__btn" type="button">
                                    <!---->
                                    <span class="bets__btn-selection-odd"> 1.98 </span>
                                </button>
                            </td>
                            <!---->
                            <td class="bets__td bets__td--stat">
                                <!---->
                                <a class="bets__stat bets__stat--active" target="_blank" href="https://s5.sir.sportradar.com/flooks/en/1/season/8/h2h/2828/2819/match/23360835"><span class="icon-limits icon-limits--active"></span></a>
                                <!---->
                            </td>
                            <td class="bets__td bets__td--bets">
                                <!---->
                                <button class="bets__more" type="button">+93</button>
                            </td>
                            <!----><!----><!----><!---->
                            <div class="bets__market">
                                <h4 class="bets__market-headline">3 WAY</h4>
                                <!---->
                                <div class="bets__market-selections">
                                    <!---->
                                    <div class="bets__market-selection bets__market-selection--3">
                                        <p class="bets__market-selection-name">1</p>
                                        <!----><!----><!---->
                                        <button class="bets__btn" type="button">
                                            <!---->
                                            <span class="bets__btn-selection-odd"> 3.91 </span>
                                        </button>
                                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                    </div>
                                    <div class="bets__market-selection bets__market-selection--3">
                                        <p class="bets__market-selection-name">X</p>
                                        <!----><!----><!----><!----><!----><!---->
                                        <button class="bets__btn" type="button">
                                            <!---->
                                            <span class="bets__btn-selection-odd"> 3.37 </span>
                                        </button>
                                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                    </div>
                                    <div class="bets__market-selection bets__market-selection--3">
                                        <p class="bets__market-selection-name">2</p>
                                        <!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                        <button class="bets__btn" type="button">
                                            <!---->
                                            <span class="bets__btn-selection-odd"> 2.14 </span>
                                        </button>
                                        <!----><!----><!----><!----><!----><!----><!---->
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="bets__market">
                                <h4 class="bets__market-headline">BOTH TEAMS TO SCORE</h4>
                                <!---->
                                <div class="bets__market-selections">
                                    <!---->
                                    <div class="bets__market-selection bets__market-selection--2">
                                        <p class="bets__market-selection-name">YES</p>
                                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                        <button class="bets__btn" type="button">
                                            <!---->
                                            <span class="bets__btn-selection-odd"> 1.90 </span>
                                        </button>
                                        <!----><!----><!----><!---->
                                    </div>
                                    <div class="bets__market-selection bets__market-selection--2">
                                        <p class="bets__market-selection-name">NO</p>
                                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                        <button class="bets__btn" type="button">
                                            <!---->
                                            <span class="bets__btn-selection-odd"> 1.98 </span>
                                        </button>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                            <!---->
                        </tr>
                    </tbody>

                        <!---->
                        <!-- <button class="top-matches__more-btn" type="button">More</button> -->
                    </table>
                </section>
            </app-games-by-country>
            <!---->
        </app-home-games>
        <!----><!----><!---->
    </div>
</section>

                            </app-home>
                        </div>
                        <div class="aside-right">
                            <app-betslip>
                                <!---->
                                <section class="light-block light-block--bet-slip">
    <header class="light-block__header light-block__header--bet-slip">
        <h3 class="light-block__title light-block__title--bet-slip">BetSlip</h3>
        <button class="light-block__close light-block__close--bet-slip" type="button"><span class="icon-lost icon-lost--bet-slip"></span></button>
    </header>
    <form class="light-block__body light-block__body--bet-slip ng-untouched ng-pristine ng-invalid" novalidate="">
        <div class="bet-slip">
            <!---->
            <div class="bet-slip__inner">
                <!----><!---->
                <app-betslip-item>
                    <div class="bet-slip__item">
                        <button class="bet-slip__item-close" type="button"></button>
                        <div class="bet-slip__item-inner">
                            <div class="bet-slip__teams">
                                <div class="bet-slip__team">
                                    <!---->
                                    <figure class="bet-slip__team-figure"><img alt="" class="bet-slip__team-img" src="https://ls.sportradar.com/ls/crest/big/2828.png" /></figure>
                                    <!----><!---->
                                    <p class="bet-slip__team-name">Valencia CF</p>
                                </div>
                                <!---->
                                <div class="bet-slip__team">
                                    <!---->
                                    <figure class="bet-slip__team-figure"><img alt="" class="bet-slip__team-img" src="https://ls.sportradar.com/ls/crest/big/2819.png" /></figure>
                                    <!---->
                                    <p class="bet-slip__team-name">Villarreal CF</p>
                                </div>
                            </div>
                            <!---->
                            <div class="bet-slip__info">
                                <!---->
                                <p class="bet-slip__outcome">Market: <span>1x2</span></p>
                            </div>
                            <!----><!---->
                            <div class="bet-slip__info">
                                <!---->
                                <p class="bet-slip__outcome">Your pick: <b>Valencia CF</b></p>
                                <!----><!---->
                                <p class="bet-slip__odds">3.9</p>
                            </div>
                        </div>
                    </div>
                </app-betslip-item>
                <!---->
                <app-betslip-item>
                    <div class="bet-slip__item">
                        <button class="bet-slip__item-close" type="button"></button>
                        <div class="bet-slip__item-inner">
                            <div class="bet-slip__teams">
                                <div class="bet-slip__team">
                                    <!---->
                                    <figure class="bet-slip__team-figure"><img alt="" class="bet-slip__team-img" src="https://ls.sportradar.com/ls/crest/big/2530.png" /></figure>
                                    <!----><!---->
                                    <p class="bet-slip__team-name">Schalke 04</p>
                                </div>
                                <!---->
                                <div class="bet-slip__team">
                                    <!---->
                                    <figure class="bet-slip__team-figure"><img alt="" class="bet-slip__team-img" src="https://ls.sportradar.com/ls/crest/big/2556.png" /></figure>
                                    <!---->
                                    <p class="bet-slip__team-name">FSV Mainz</p>
                                </div>
                            </div>
                            <!---->
                            <div class="bet-slip__info">
                                <!---->
                                <p class="bet-slip__outcome">Market: <span>1x2</span></p>
                            </div>
                            <!----><!---->
                            <div class="bet-slip__info">
                                <!---->
                                <p class="bet-slip__outcome">Your pick: <b>draw</b></p>
                                <!----><!---->
                                <p class="bet-slip__odds">3.68</p>
                            </div>
                        </div>
                    </div>
                </app-betslip-item>
            </div>
            <!----><!---->
            <div class="bet-slip__item">
                <div class="bet-slip__item-footer">
                    <div class="bet-slip__bet-cont"><input class="bet-slip__bet ng-untouched ng-pristine ng-invalid" formcontrolname="stake" placeholder="10 - 20000" type="text" /></div>
                </div>
            </div>
            <!---->
            <div class="bet-slip-total">
                <table class="bet-slip-total__table">
                    <tbody>
                        <tr class="bet-slip-total__tr">
                            <th class="bet-slip-total__th">Stake</th>
                            <td class="bet-slip-total__td">0 KSH</td>
                        </tr>
                        <tr class="bet-slip-total__tr">
                            <th class="bet-slip-total__th">Total Odds</th>
                            <td class="bet-slip-total__td">14.35</td>
                        </tr>
                        <!---->
                        <tr class="bet-slip-total__tr">
                            <!----><!---->
                        </tr>
                        <tr class="bet-slip-total__tr">
                            <th class="bet-slip-total__th">Withholding Tax</th>
                            <td class="bet-slip-total__td">0.00 KSH</td>
                        </tr>
                        <tr class="bet-slip-total__tr">
                            <th class="bet-slip-total__th">Possible Payout</th>
                            <td class="bet-slip-total__td">0.00 KSH</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!----><!---->
            <p class="bet-slip__error">Please login</p>
            <button class="bet-slip__btn" type="submit" disabled="">Place bet</button><button class="bet-slip__clear" type="button"><span class="bet-slip__clear-icon icon-lost"></span> Clear betslip</button>
            <!---->
        </div>
    </form>
</section>

                                <!---->
                            </app-betslip>

                        </div>
                    </div>
                    <app-footer>
                        @yield('footer')

                    </app-footer>
                </div>
            </div>
        </app-page-wrapper>
    </div>
    <app-popups>
        <div class="popups"><!----></div>
    </app-popups>
</app-root>

        <script src="/assets3/plugins/jquery/jquery.min.js"></script>
        <script src="/assets3/plugins/moment/moment.js"></script>

        <!-- <script src="/assets3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
        <script src="/assets3/switcher/js/switcher.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>

        <script src="/assets3/js/carrinho.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function(e){
                $('.ca-input').maskMoney({
                    prefix: '', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true
                });
            });
        </script>
    </div>
    <div class="main-navbar-backdrop"></div>
</body>


</html>
