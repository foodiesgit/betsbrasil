@include('client.include_sbet')


<link href="/assets3/css/icons.css" rel="stylesheet" />

<link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />

<link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

<link href="/assets3/css/style.css" rel="stylesheet" />

<link href="/assets3/css/style-dark.css" rel="stylesheet" />



<link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />

<link href="/assets3/switcher/demo.css" rel="stylesheet" />

<link href="/assets3/css/animate.css" rel="stylesheet" />

<link rel="stylesheet" href="/assets3/css/lite.css">
<link href="/assets3/css/floo.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<link href="/assets3/css/custom.css" rel="stylesheet" />
<style>
  a {
    text-decoration: none;
  }
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
@yield('main-header')
<div class="page animated" style="animation-duration: 500ms;">
      
      <!-- All Sports-->
      <section class="section section-sm bg-gray-100">
        <div class="container">
          <div class="row isotope-wrap row-30">
            <!-- Isotope Filters-->
            <div class="col-lg-12">
              <!-- <div class="isotope-filters isotope-filters-horizontal">
                <button class="isotope-filters-toggle button" data-custom-toggle="#isotope-filters" data-custom-toggle-hide-on-blur="true" data-custom-toggle-disable-on-blur="true">Select<span class="caret"></span></button>
                <ul class="isotope-filters-list" id="isotope-filters">
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link active" data-isotope-filter="*" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-01"></span></span><span class="isotope-filters-list-text">All sports</span> <span class="isotope-filters-list-count">29</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="football" data-isotope-group="gallery" href="#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-07"></span></span><span class="isotope-filters-list-text">Futebol</span> <span class="isotope-filters-list-count"></span></a></li> -->
                  <!-- <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="tennis" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-06"></span></span><span class="isotope-filters-list-text">Tennis</span> <span class="isotope-filters-list-count">4</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="basketball" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-04"></span></span><span class="isotope-filters-list-text">Basketball</span> <span class="isotope-filters-list-count">4</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="ice-hockey" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-08"></span></span><span class="isotope-filters-list-text">Ice Hockey</span> <span class="isotope-filters-list-count">3</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="volleyball" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-09"></span></span><span class="isotope-filters-list-text">Volleyball</span> <span class="isotope-filters-list-count">3</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="badminton" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-03"></span></span><span class="isotope-filters-list-text">Badminton</span> <span class="isotope-filters-list-count">4</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="baseball" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-05"></span></span><span class="isotope-filters-list-text">Baseball</span> <span class="isotope-filters-list-count">2</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="ping-pong" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-02"></span></span><span class="isotope-filters-list-text">Table Tennis</span> <span class="isotope-filters-list-count">2</span></a></li>
                  <li class="isotope-filters-list-item"><a class="isotope-filters-list-link" data-isotope-filter="cycling" data-isotope-group="gallery" href="https://livedemo00.template-help.com/wt_prod-19186/#"><span class="isotope-filters-list-img"><span class="sprite sprite-sport-icon-10"></span></span><span class="isotope-filters-list-text">Cycling</span> <span class="isotope-filters-list-count">2</span></a></li> 
                </ul>
                <div class="isotope-filters-info">
                  <p class="isotope-filters-info-text"> All Sports (29)</p>
                </div>
              </div> --> 
            </div>
            <!-- Isotope Content-->
            <div class="col-lg-8">
              <div class="row isotope row-30" data-isotope-layout="masonry" data-column-class=".col-1" data-isotope-group="gallery" style="position: relative; height: 3033px;">
                <div class="col-1 isotope-item isotope-sizer" style="position: absolute; left: 0px; top: 0px;"></div>
                <!-- Football-->
                <div class="col-lg-12 isotope-item" data-filter="football" style="position: absolute; left: 0px; top: 0px;">
                  <!-- Heading Component-->
                  <article class="heading-component">
                    <div class="heading-component-inner">
                      <h5 class="heading-component-title">Futebol
                      </h5>
                      <div>
                        <ul class="list-inline list-inline-xs">
                      
                        </ul>
                      </div>
                    </div>
                  </article>
                  <?php                                   
                    if( count($array_jogos_aba_futebol) > 0 ){

                        foreach( $array_jogos_aba_futebol as $dados ){
                            ; echo '<div class="sport-table-header"><img src="/assets/bandeiras/'.$dados['bandeira'].'" style="width: 24px; height: 24px; margin-right: 5px; ">'.$dados['pais'].'</div>';

                            foreach($dados['ligas'] as $dados){
                            if(count($dados['jogos']) > 0){

                                echo ' <div class="sport-table-header">'.$dados['liga'].'</div>';


                                foreach($dados['jogos'] as $jogos){

                                    echo '
                                    <div class="sport-table">
                                        <div class="sport-table-tr">
                                            <div class="row sport-row align-items-center row-15">
                                                <div class="col-sm-1 col-md-1 col-lg-1">
                                                    <div class="sport-table-icon">
                                                        '.$jogos['data'].' '.$jogos['hora'].'
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-md-4 col-lg-3">
                                                    <div class="sport-table-title">
                                                        <div class="sport-table-title-item sport-table-title-item-left">
                                                            <span class="sport-table-title-team">'.$jogos['oddhome_name'].' X</span>
                                                            <span class="sport-table-title-team">'.$jogos['oddaway_name'].'</span>
                                                        </div>
                                                        <div class="sport-table-title-item sport-table-title-item-right">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10 col-md-6 col-lg-7">
                                                    <div class="sport-table-wager">
                                                    
                                                        <a class="sport-table-wager-button cota-aposta" data-id="'.$jogos['oddhome_id'].'">
                                                        <span>1</span>
                                                        <span class="sport-table-wager-button-count">'.$jogos['oddhome_value'].'</span>
                                                       </a>

                                                        <a class="sport-table-wager-button cota-aposta" data-id="'.$jogos['odddraw_id'].'">
                                                        <span>X</span>
                                                        <span class="sport-table-wager-button-count">'.$jogos['odddraw_value'].'</span>
                                                        </a>

                                                        <a class="sport-table-wager-button cota-aposta" data-id="'.$jogos['oddaway_id'].'">
                                                        <span>2</span>
                                                        <span class="sport-table-wager-button-count">'.$jogos['oddaway_value'].'</span>
                                                        </a>
                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-1 col-lg-1">
                                                    <div class="sport-table-bonus moreOdds" data-id="'.$jogos['id'].'" data-toggle="modal" data-target="#sportModal" data-team-name="Arsenal" data-confrontation="Arsenal vs Everton" data-wager-count="2.83" data-score="1:0"><span class="sport-table-bonus-count">+'.$jogos['total_odds'].'</span><span class="sport-table-bonus-icon material-icons-chevron_right"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>';

                                }

                            }
                            }
                        

                        }

                    }

                ?>

                </div>

              </div>
            </div>
                      
        <div class="col-md-4 d-none d-lg-block d-xl-block"> 

                    <div class="player-info-main">
                        <h4 class="player-info-title">Informações do bilhete</h4>

                            {{ Form::open(['url' => '/finalizar-aposta', 'id' => 'form_finalizar_aposta']) }}

                            

                                <div class="card-body no-padding-xs">

                                    <div class="bet-slip">

                                        <!---->

                                        <div class="bet-slip__inner" id="bet-slip-inner">



                                        </div>



                                        <div class="bet-slip__item bet-slip__item--row" id="divvalor">

                                            <div class="bet-slip__item-footer bet-slip__item-footer--wide">

                                                <div class="bet-slip__bet-cont bet-slip__bet-cont--wide">

                                                    <input class="bet-slip__bet ng-untouched ng-pristine ng-invalid ca-input" formcontrolname="newstake" placeholder="R$ 0,00" value="R$ 0,00" type="text" id="newstake" name="newstake">
                                                    <input id="newstake_hidden" type="hidden" name="newstake_hidden">

                                                </div>

                                            </div>

                                        </div>



                                        <div class="bet-slip-total">

                                            <table class="bet-slip-total__table">

                                                <tbody>

                                                    <tr class="bet-slip-total__tr">

                                                        <th class="bet-slip-total__th">Sua Aposta</th>

                                                        <td class="bet-slip-total__td"><span id="slip_total_aposta">R$ 0,00</span></td>

                                                    </tr>



                                                    <tr class="bet-slip-total__tr">

                                                        <th class="bet-slip-total__th">Total Odds</th>

                                                        <td class="bet-slip-total__td"><span id="slip_total_odds">0.00</span></td>

                                                    </tr>



                                                    <tr class="bet-slip-total__tr">

                                                        <th class="bet-slip-total__th">Possível Retorno</th>

                                                        <td class="bet-slip-total__td"><span id="slip_total_retorno">R$ 0,00</span></td>



                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                        {{ Form::close() }}

                                        <button class="bet-slip__btn btn-primary" type="button" id="btn_finalizar_aposta" disabled="disabled">Efetuar Aposta</button>





                                        <!---->

                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>
          </div>
        </div>
      </section>
   

      <!-- Latest News-->

      <!-- Page Footer-->
      <footer class="section footer-classic footer-classic-dark">
    
        <div class="footer-classic-aside footer-classic-darken">
          <div class="container">
            <div class="layout-justify">
              <!-- Rights-->
              <p class="rights"><span>S-Bet</span><span>&nbsp;©&nbsp;</span><span class="copyright-year">2021</span><span>.&nbsp;</span><a class="link-underline" href="https://livedemo00.template-help.com/wt_prod-19186/privacy-policy.html">Privacy Policy</a></p>
              <nav class="nav-minimal">
               
              </nav>
            </div>
          </div>
        </div>
      </footer>
      <div class="modal modal-sport fade" id="sportModal" tabindex="-1" role="dialog" aria-labelledby="sportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sportModalTitle">Todas as apostas</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body" id="renderMoreOdds">
            </div>
            
          </div>
        </div>
      </div>

      <div class="modal modal-sport fade" id="sportModalCard" tabindex="-1" role="dialog" aria-labelledby="sportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sportModalTitle">Carrinho de apostas</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>

            </div>
            <div class="modal-body" >
            <div class="bet-slip">

<div class="bet-slip__inner" id="bet-slip-inner-mobile">

</div>
<div class="bet-slip__item bet-slip__item--row" id="divvalormobile">

    <div class="bet-slip__item-footer bet-slip__item-footer--wide">

        <div class="bet-slip__bet-cont bet-slip__bet-cont--wide">

            <input class="bet-slip__bet ng-untouched ng-pristine ng-invalid ca-input" formcontrolname="newstake" placeholder="R$ 0,00" value="R$ 0,00" type="text" id="newstake_mobile" name="newstake">
            <input id="newstake_hidden_mobile" type="hidden" name="newstake_hidden_mobile">

        </div>

    </div>

</div>



<div class="bet-slip-total">

    <table class="bet-slip-total__table">

        <tbody>

            <tr class="bet-slip-total__tr">

                <th class="bet-slip-total__th">Sua Aposta</th>

                <td class="bet-slip-total__td"><span id="slip_total_aposta_mobile">R$ 0,00</span></td>

            </tr>



            <tr class="bet-slip-total__tr">

                <th class="bet-slip-total__th">Total Odds</th>

                <td class="bet-slip-total__td"><span id="slip_total_odds_mobile">0.00</span></td>

            </tr>



            <tr class="bet-slip-total__tr">

                <th class="bet-slip-total__th">Possível Retorno</th>

                <td class="bet-slip-total__td"><span id="slip_total_retorno_mobile">R$ 0,00</span></td>



            </tr>

        </tbody>

    </table>

</div>






{{ Form::close() }}

<button class="bet-slip__btn" type="button" id="btn_finalizar_aposta_mobile" disabled="disabled">Colocar Aposta</button>

</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="float d-block d-sm-none d-xs-none d-md-block d-lg-none d-xl-none"  data-bs-toggle="modal" data-bs-target="#sportModalCard">
    <?php

    $totalItensCupom = DB::table('novo_carrinho')

        ->leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

        ->where('session_id', session()->getId())->select(DB::raw("count(*) as total"))->get();



    if(count($totalItensCupom) > 0){

        $total = $totalItensCupom[0]->total;

    }else{

        $total = 0;

    }

    ?>

    <span style="position: absolute; margin-left: 25px;"><span class="badge badge-danger" id="totalCupom">{{$total}}</span></span>

    <img src="/assets3/img/images/invoice.svg" height="32" width="32" class="my-float" style="margin-top: 14px !important;">

    </a>
  </div>
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>

    <script src="/assets3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/autocomplete.js"></script>                                               
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script type="text/javascript">

$(document).ready(function(e){

    $('#search').on('keyup keydown',function(e){ 

    var query = $('#search').val();

    $.ajax({

        url: '/ajax/search',

        method: 'GET',

        data: {

            query: query

        },

        success: function(res){
            $('.item').parent().remove();
            $('.liga').parent().remove();
            
            res.map((item => {
                $('#tab1').append(
                '<div class="panel tabela-apostas"> '+
                    '<div class="item">'+

                        '<div class="item-data d-none d-lg-flex">'+

                            '<span class="hora">'+item.data+'</span>'+

                            '<span class="data">'+item.hora+'</span>'+

                        '</div>'+

                        '<div class="d-none d-lg-flex item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                            '<span class="time-home">'+item.homeNome+'</span>'+

                            '<span class="time-away">'+item.awayNome+'</span>'+

                        '</div>'+

                        '<div class="d-md-none">'+

                            '<div class="item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                            '<span class="time-home">'+item.homeNome+'</span>'+

                            '<span class="time-away">'+item.awayNome+'</span>'+

                                '<div class="item-data">'+

                                    '<span class="hora">'+item.data+' as '+item.hora+'</span>'+



                                '</div>'+

                            '</div>'+

                        '</div>'+

                        '<div class="item-cotas">'+

                            '<span class="cota cota-normal cota-aposta" data-id="'+item.oddhome_id+'">'+item.oddhome_value+'</span>'+

                            '<span class="cota cota-normal cota-aposta" data-id="'+item.odddraw_id+'">'+item.odddraw_value+'</span>'+

                            '<span class="cota cota-normal cota-aposta" data-id="'+item.oddaway_id+'">'+item.oddaway_value+'</span>'+

                        '</div>'+

                        '<div class="item-acoes d-none d-lg-flex">'+

                            '<span>+'+item.total_odds+'</span>'+

                        '</div>'+

                    '</div>'+

                    '</div>')
            }));
        },error: function(err){
        },complete: function(){
        }

        });    
    });
    $('#search-mobile').on('keyup',function(){
        var query = $('#search-mobile').val();
        if(query.length > 2){
            $.ajax({

                url: '/ajax/search',

                method: 'GET',

                data: {

                    query: query

                },

                success: function(res){
                    $('.item').parent().remove();
                    $('.liga').parent().remove();
                    
                    res.map((item => {
                        $('#tab1').append(
                        '<div class="panel tabela-apostas"> '+
                            '<div class="item">'+

                                '<div class="item-data d-none d-lg-flex">'+

                                    '<span class="hora">'+item.data+'</span>'+

                                    '<span class="data">'+item.hora+'</span>'+

                                '</div>'+

                                '<div class="d-none d-lg-flex item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                                    '<span class="time-home">'+item.homeNome+'</span>'+

                                    '<span class="time-away">'+item.awayNome+'</span>'+

                                '</div>'+

                                '<div class="d-md-none">'+

                                    '<div class="item-times click_ir_jogo" data-id="'+item.id+'" style="cursor: pointer;">'+

                                    '<span class="time-home">'+item.homeNome+'</span>'+

                                    '<span class="time-away">'+item.awayNome+'</span>'+

                                        '<div class="item-data">'+

                                            '<span class="hora">'+item.data+' as '+item.hora+'</span>'+



                                        '</div>'+

                                    '</div>'+

                                '</div>'+

                                '<div class="item-cotas">'+

                                    '<span class="cota cota-normal cota-aposta" data-id="'+item.oddhome_id+'">'+item.oddhome_value+'</span>'+

                                    '<span class="cota cota-normal cota-aposta" data-id="'+item.odddraw_id+'">'+item.odddraw_value+'</span>'+

                                    '<span class="cota cota-normal cota-aposta" data-id="'+item.oddaway_id+'">'+item.oddaway_value+'</span>'+

                                '</div>'+

                                '<div class="item-acoes d-none d-lg-flex">'+

                                    '<span>+'+item.total_odds+'</span>'+

                                '</div>'+

                            '</div>'+

                            '</div>')
                    }));
                },error: function(err){
                },complete: function(){
                }

            });
        }
    });
    $('.ca-input').maskMoney({

        prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true

    });



    $('#divvalor').hide();



    $('#btn2').click(function(e){

        $(this).attr('disabled', 'disabled');

        $('#form2').submit();

    });

    
                  
    $('.moreOdds').click(function(e){

var id = $(this).data('id');

$('#renderMoreOdds').html('');

$.ajax({

url: '/ajax/moreOdds',

method: 'GET',

data: {

    id: id

},

success: function(res){
    $('#renderMoreOdds').append(
        '<div class="header-banner header-banner-wrapper" style="margin-bottom: 3rem;">'+

        '<div class="refresh-btns-wrapper">'+

            '<a href="#" class="refresh-btn refresh-btn--back banner-back-page">'+

                '<i class="fa fa-arrow-back"></i>'+

            '</a>'+

        '</div>'+

        '<span class="header-banner__liga" style="margin-bottom: 2rem; color:black;">'+res.event[0].nome_traduzido+'</span>'+

        '<div class="match-wrapper">'+

            '<span class="header-banner__date">'+res.event[0].data_format+'</span>'+

            '<div class="commands-info__wrapper match-data--heading">'+

                '<span class="commands-info__command" style="color:black;">'+res.home.nome+'</span>'+

                '<span class="commands-info__command vs" style="color:black;">VS </span>'+

                '<span class="commands-info__command" style="color:black;">'+res.away.nome+'</span>'+

            '</div>'+

            '<span class="header-banner__time  ">'+res.event[0].hora_format+'<span class="header-banner__time--red"></span> </span>'+

       '</div>'+

        '</div>');
    $('#renderMoreOdds').append(
        '<div class="panel panel-primary tabs-style-1" style="background-color: #FFF">'+

            '<div class=" tab-menu-heading">'+

                '<div class="tabs-menu1">'+

                    '<ul class="nav panel-tabs main-nav-line" id="tabOdds">'+

                    
                    '</ul>'+

                '</div>'+

            '</div>'+

        '</div>');
        $('#renderMoreOdds').append(
        '<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">'+

            '<div id="moreOddsContent">'+
            '</div>'+
        '</div>');

        var i = 0;
        var group = 0;
        var active = '';
         res.odds_grupo.map((item => {
            i++;
            var odd_s = ''
            item.sub_grupo.map((items => {
                
                if(items.odds.length > 0) {
                    group++;
                    $('#moreOddsContent').append(
                    '<div class="card card-danger">'+

                        '<div class="card-header pb-0">'+

                            '<h5 class="card-title mb-0 pb-0">'+items.titulo_traduzido+'</h5>'+

                        '</div>'+

                    '<div class="card-body" id="oddsId'+group+'"></div></div>'
                    );

                    items.odds.map((item =>{
                        var primeiro_odd = items.odds[0].idbets;
                        if(primeiro_odd[0] == 'P'){

                            if(item.idbets[0] == 'P'){
                                desenhaOdds(items.odds, group);
                            }

                        }else{

                            $('#oddsId'+group).append(
                                '<div class="sport-table-wager-button item_aposta cota-aposta d-block d-sm-none d-none d-sm-block d-md-none" data-id="'+item.id+'" data-idevent="'+item.idevent+'">'+

                                    '<span class="time">'+item.name+'</span>'+

                                    '<span class="cotas">'+item.odds+'</span>'+

                                '</div>'+
                                '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+item.id+'" data-idevent="'+item.idevent+'">'+

                                '<span class="time">'+item.name+'</span>'+

                                '<span class="cotas">'+item.odds+'</span>'+

                                '</div>'
                            );
                        }
                    }));
                }

            }));
        }));

},error: function(err){
},complete: function(){
}

});

});

function desenhaOdds(odds, group){

if(odds[0].idsubgrupo == 84){

    $('#oddsId'+group).append('<div class="linha_aposta">'+

            '<div class="header_aposta"><span></span></div>'+

            '<div class="header_aposta"><span>Mais</span></div>'+

            '<div class="header_aposta"><span>Menos</span></div>'+

    '</div>'+



        '<div class="linha_aposta">'+
               '<div class="item_aposta" style="background:black;">'+

                    '<span class="time">'+odds[0].name+'</span>'+

                '</div>'+

                '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[1].id+'" data-idevent="'+odds[1].idevent+'" >'+

                    '<span class="cotas " ><b>'+odds[1].odds+'</b></span>'+

                '</div>'+

                '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[2].id+'" data-idevent="'+odds[2].idevent+'" >'+

                    '<span class="cotas " ><b>'+odds[2].odds+'</b></span>'+

                '</div>'+

        '</div>');



}else if(odds[0].idsubgrupo == 93){

      $('#oddsId'+group).append('<div class="linha_aposta">'+


            '<div class="header_aposta"><span></span></div>'+

            '<div class="header_aposta"><span>Sim</span></div>'+

            '<div class="header_aposta"><span>Não</span></div>'+

    '</div>'+
    '<div class="linha_aposta">'+

        '<div class="item_aposta"><span class="time">'+odds[0].name+'</span></div>'+

        '<div class="sport-table-wager-button item_aposta  cota-aposta" data-id="'+odds[3].id+'" data-idevent="'+odds[3].idevent+'"><span class="cotas" >'+odds[3].odds+'</span></div>'+

        '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[6].id+'" data-idevent="'+odds[6].idevent+'"><span class="cotas " >'+odds[6].odds+'</span></div>'+

    '</div>'+

    '<div class="linha_aposta">'+

        '<div class="sport-table-wager-button item_aposta"><span class="time">'+odds[1].name+'</span></div>'+

        '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[4].id+'" data-idevent="'+odds[4].idevent+'"><span class="cotas " >'+odds[4].odds+'</span></div>'+

        '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[7].id+'" data-idevent="'+odds[7].idevent+'"><span class="cotas " >'+odds[7].odds+'</span></div>'+

    '</div>'+

   '<div class="linha_aposta">'+

        '<div class="item_aposta"><span class="time">'+odds[2].name+'</span></div>'+

        '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[5].id+'" data-idevent="'+odds[5].idevent+'"><span class="cotas " >'+odds[5].odds+'</span></div>'+

        '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[8].id+'" data-idevent="'+odds[8].idevent+'"><span class="cotas " >'+odds[8].odds+'</span></div>'+

    '</div>');


}else{

      $('#oddsId'+group).append('<div class="linha_aposta">'+

            '<div class="header_aposta"><span></span></div>'+

            '<div class="header_aposta"><span>Mais</span></div>'+

            '<div class="header_aposta"><span>Menos</span></div>'+

     '</div>'+



        '<div class="linha_aposta">'+

                '<div class="item_aposta">'+

                    '<span class="time">'+odds[0].name+'</span>'+

                '</div>'+

                '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[1].id+'" data-idevent="'+odds[1].idevent+'">'+

                    '<span class="cotas " ><b>'+odds[1].odds+'</b></span>'+

                '</div>'+

                '<div class="sport-table-wager-button item_aposta cota-aposta" data-id="'+odds[2].id+'" data-idevent="'+odds[2].idevent+'">'+

                    '<span class="cotas " ><b>'+odds[2].odds+'</b></span>'+

                '</div>'+


     '</div>');

}

}
    $('.retirar_aposta').click(function(e){

        var id = $(this).attr('data-id');



        window.location.href = '/remove-selection/' + id;

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



    $('#btn_finalizar_aposta_mobile').click(function(e){

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

                $('#btn_finalizar_aposta_mobile').removeAttr('disabled');

            }

        });

    });

    $('body').on('keyup', '#newstake', function(e){

        e.preventDefault();



        var valor = $(this).val();

        valor = valor.replace("R$ ", "");

        valor = valor.replace(".", "");

        valor = valor.replace(",", ".");



        valor = parseFloat(valor);

        $('#newstake_hidden').val(valor)
        $('#newstake_hidden_mobile').val(valor)

        if( valor > 0.00 ){

            var totalcotas = $('#slip_total_odds').html();

            totalcotas = parseFloat(totalcotas);



            var total = valor * totalcotas;

            console.log(total);



            $('#slip_total_aposta').html( $('#newstake').val() );

            $('#slip_total_retorno').html( new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(total));



            $('#btn_finalizar_aposta').removeAttr('disabled', 'disabled');

        }else{

            $('#btn_finalizar_aposta').attr('disabled');

        }

    });

    $('body').on('keyup', '#newstake_mobile', function(e){

            e.preventDefault();



            var valor = $(this).val();

            valor = valor.replace("R$ ", "");

            valor = valor.replace(".", "");

            valor = valor.replace(",", ".");



            valor = parseFloat(valor);

            $('#newstake_hidden').val(valor)


            if( valor > 0.00 ){

                var totalcotas = $('#slip_total_odds').html();

                totalcotas = parseFloat(totalcotas);



                var total = valor * totalcotas;

                console.log(total);



                $('#slip_total_aposta_mobile').html( $('#newstake_mobile').val() );

                $('#slip_total_retorno_mobile').html( new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(total));

                $('#btn_finalizar_aposta_mobile').removeAttr('disabled', 'disabled');

            }else{

                console.log("valor = 0");

                $('#btn_finalizar_aposta_mobile').attr('disabled');

            }

        });

    $('body').on('click', '.cota-aposta', function(e){

        e.preventDefault();



        var id = $(this).attr('data-id');

        $(this).addClass('active');
        

        $.ajax({

            url: '/ajax/carrinho/adicionar-aposta',

            method: 'GET',

            data: {

                id: id

            },

            success: function(res){



                if(res.status == 'ok'){

                    var total = $('#totalCupom').html();

                    total = parseInt(total);



                    if(res.acao == 'select'){

                        $('.cota-aposta[data-idevent='+res.idevent+']').removeClass('active');

                        $('.cota-aposta[data-id='+id+']').addClass('active');

                    }else if(res.acao == 'unselect'){

                        $('.cota-aposta[data-id='+id+']').removeClass('active');

                    }



                    var geral = 0;

                    geral = parseInt(geral);

                    $.each( $('.active'), function(i, item) {

                        geral++;

                    });



                    $('#totalCupom').html( geral );

                }

            },error: function(err){



            },complete: function(){

                recuperaCarrinho();

            }

        });

    });



    function recuperaCarrinho(){

        $.ajax({

            url: '/operacao-carrinho/recuperar-carrinho',

            method: 'GET',

            success: function(res){

                $('.cota-aposta').removeClass('active');



                if(res.status == 'ok'){

                    $('#bet-slip-inner').html('');
                    $('#bet-slip-inner-mobile').html('');

                    $('#newstake').val( res.valor_total_apostado_format );

                    $('#newstake-mobile').val( res.valor_total_apostado_format );

                    $('#slip_total_aposta_mobile').html( res.valor_total_apostado_format );
                    $('#slip_total_aposta').html( res.valor_total_apostado_format );


                    $('#slip_total_odds').html( res.valor_total_cotas );
                    $('#slip_total_odds_mobile').html( res.valor_total_cotas );


                    $('#slip_total_retorno_mobile').html( res.possivel_retorno_format );

                    $('#slip_total_retorno_mobile').html( res.possivel_retorno_format );


                    var total_de_apostas = 0;



                    $.each(res.response, function(i, item) {

                        total_de_apostas++;

                        $('#btn_finalizar_aposta').removeAttr('disabled', 'disabled');

                        $('#btn_finalizar_aposta_mobile').removeAttr('disabled', 'disabled');



                        $('.cota-aposta[data-id='+item.idodds+']').addClass('active');

                        $('#divvalor').show();
                        $('#divvalormobile').show();



                        $('#bet-slip-inner').append('<app-betslip-item>'+

                            '<div class="bet-slip__item">'+

                                '<a href="/remove-selection/'+item.id+'" class="bet-slip__item-close" type="button"></a>'+

                                '<div class="bet-slip__item-inner">'+

                                    '<div class="bet-slip__teams">'+

                                        '<div class="bet-slip__team">'+

                                            '<p class="bet-slip__team-name">'+item.time_home+'</p>'+

                                        '</div>'+

                                        '<div class="bet-slip__team">'+

                                            '<p class="bet-slip__team-name">'+item.time_away+'</p>'+

                                        '</div>'+

                                    '</div>'+

                                    '<div class="bet-slip__info">'+

                                        '<p class="bet-slip__outcome">Aposta: <span>'+item.subgrupo+'</span></p>'+

                                    '</div>'+

                                    '<div class="bet-slip__info">'+

                                        '<p class="bet-slip__outcome">Sua aposta: <b>'+item.name+'</b></p>'+

                                        '<p class="bet-slip__odds">'+item.cota_momento+'</p>'+

                                    '</div>'+

                                '</div>'+

                            '</div>'+

                        '</app-betslip-item>');

                   

                    $('#bet-slip-inner-mobile').append('<app-betslip-item>'+

                            '<div class="bet-slip__item">'+

                                '<a href="/remove-selection/'+item.id+'" class="bet-slip__item-close" type="button"></a>'+

                                '<div class="bet-slip__item-inner">'+

                                    '<div class="bet-slip__teams">'+

                                        '<div class="bet-slip__team">'+

                                            '<p class="bet-slip__team-name">'+item.time_home+'</p>'+

                                        '</div>'+

                                        '<div class="bet-slip__team">'+

                                            '<p class="bet-slip__team-name">'+item.time_away+'</p>'+

                                        '</div>'+

                                    '</div>'+

                                    '<div class="bet-slip__info">'+

                                        '<p class="bet-slip__outcome">Aposta: <span>'+item.subgrupo+'</span></p>'+

                                    '</div>'+

                                    '<div class="bet-slip__info">'+

                                        '<p class="bet-slip__outcome">Sua aposta: <b>'+item.name+'</b></p>'+

                                        '<p class="bet-slip__odds">'+item.cota_momento+'</p>'+

                                    '</div>'+

                                '</div>'+

                            '</div>'+

                        '</app-betslip-item>');

                    });
                    if(total_de_apostas == 0){

                        $('#bet-slip-inner').html('<p class="text-center">Nenhuma aposta selecionada</p>');

                    }



                }

            },error: function(err){



            },complete: function(){



            }

        });

    }



    recuperaCarrinho();





    /*$.ajax({

        url: '/ajax/carrinho/recupera-carrinho',

        method: 'GET',

        success: function(res){

            $('.cota-aposta').removeClass('selecionado');



            console.log('recuperaCarrinho');

            console.log(res);

            if(res.status == 'ok'){

                $('#bet-slip-inner').html('');



                $.each(res.response, function(i, item) {

                    $('.cota-aposta[data-id='+item.idodds+']').addClass('selecionado');



                    $('#bet-slip-inner').append('<app-betslip-item>'+

                        '<div class="bet-slip__item">'+

                            '<button class="bet-slip__item-close" type="button"></button>'+

                            '<div class="bet-slip__item-inner">'+

                                '<div class="bet-slip__teams">'+

                                    '<div class="bet-slip__team">'+

                                        '<p class="bet-slip__team-name">'+item.time_home+'</p>'+

                                    '</div>'+

                                    '<div class="bet-slip__team">'+

                                        '<p class="bet-slip__team-name">'+item.time_away+'</p>'+

                                    '</div>'+

                                '</div>'+

                                '<div class="bet-slip__info">'+

                                    '<p class="bet-slip__outcome">Aposta: <span>'+item.subgrupo+'</span></p>'+

                                '</div>'+

                                '<div class="bet-slip__info">'+

                                    '<p class="bet-slip__outcome">Sua aposta: <b>'+item.name+'</b></p>'+

                                    '<p class="bet-slip__odds">'+item.cota_momento+'</p>'+

                                '</div>'+

                            '</div>'+

                        '</div>'+

                    '</app-betslip-item>');

                });

            }

        },error: function(err){



        },complete: function(){



        }

    });*/

});

</script>
  </body>
</html>