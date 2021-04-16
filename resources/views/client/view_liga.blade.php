<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template" />
        <meta name="Author" content="Spruko Technologies Private Limited" />
        <meta
            name="Keywords"
            content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"
        />
        <!-- Title -->
        <title>Bets</title>

        <link rel="icon" href="/assets3/img/brand/favicon.png" type="image/x-icon" />
        <link href="/assets3/css/icons.css" rel="stylesheet" />
        <link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />
        <link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />
        <link href="/assets3/css/style.css" rel="stylesheet" />
        <link href="/assets3/css/style-dark.css" rel="stylesheet" />

        <link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />
        <link href="/assets3/switcher/demo.css" rel="stylesheet" />
        <link href="/assets3/css/animate.css" rel="stylesheet" />

        <link href="/assets3/css/custom.css" rel="stylesheet" />
        <link href="/assets3/css/floo.css" rel="stylesheet" />
    </head>
    <body class="main-body horizontal-color">
        @include('client.include')


        <div class="horizontalMenucontainer">
            <div id="global-loader" style="display: none;"><img src="/assets3/img/loader.svg" class="loader-img" alt="Loader" /></div>

            <div class="page">
            <!-- main-header opened -->
            @yield('main-header')
            <!-- /main-header -->
            <!--Horizontal-main -->
            @yield('horizontal-menu')
            <!--Horizontal-main -->



            <!-- main-content opened -->
            <div class="main-content horizontal-content">
                <!-- container opened -->
                <div class="container-fluid">
                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">Ligas</h4>
                                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ $liga->nome_traduzido }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- breadcrumb -->
                    <!-- row -->

                    <style type="text/css">

                    </style>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header bg-red">
                                    <h5 class="card-title">{{ $liga->nome_traduzido }}</h5>
                                    <h6 class="card-subtitle mb-2">Próximos jogos</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if( count($array_jogos_aba_futebol) > 0 ){
                                            foreach( $array_jogos_aba_futebol as $dados ){
                                                echo '
                                                    <h5 class="mb-10">'.$dados['liga'].'</h5>
                                                ';

                                                if(count($dados['jogos']) > 0){
                                                    foreach($dados['jogos'] as $jogos){

                                                        echo '<div class="panel tabela-apostas">
                                                        <div class="item">
                                                            <div class="item-data d-none d-lg-flex">
                                                                <span class="hora">'.$jogos['hora'].'</span>
                                                                <span class="data">'.$jogos['data'].'</span>
                                                            </div>
                                                            <div class="d-none d-lg-flex item-times click_ir_jogo" data-id="'.$jogos['id'].'" style="cursor: pointer;">
                                                                <span class="time-home">'.$jogos['oddhome_name'].'</span>
                                                                <span class="time-away">'.$jogos['oddaway_name'].'</span>
                                                            </div>
                                                            <div class="d-md-none">
                                                                <div class="item-times click_ir_jogo" data-id="'.$jogos['id'].'" style="cursor: pointer;">
                                                                    <span class="time-home">'.$jogos['oddhome_name'].'</span>
                                                                    <span class="time-away">'.$jogos['oddaway_name'].'</span>
                                                                    <div class="item-data">
                                                                        <span class="hora">'.$jogos['hora'].' as '.$jogos['data'].'</span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-cotas">
                                                                <span class="cota cota-normal cota-aposta" data-id="'.$jogos['oddhome_id'].'">'.$jogos['oddhome_value'].'</span>
                                                                <span class="cota cota-normal cota-aposta" data-id="'.$jogos['odddraw_id'].'">'.$jogos['odddraw_value'].'</span>
                                                                <span class="cota cota-normal cota-aposta" data-id="'.$jogos['oddaway_id'].'">'.$jogos['oddaway_value'].'</span>
                                                            </div>
                                                            <div class="item-acoes d-none d-lg-flex">
                                                                <span>+'.$jogos['total_odds'].'</span>
                                                            </div>
                                                        </div>
                                                        </div>';
                                                    }
                                                }
                                            }
                                        }else{
                                            echo '<p class="text-center"><b>Nenhuma aposta disponível</b></p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header bg-red">
                                    <h5 class="card-title">Meu Cupom</h5>
                                    <h6 class="card-subtitle mb-2"></h6>
                                </div>
                                <div class="card-body no-padding-xs">
                                    <div class="bet-slip">
                                        <!---->
                                        <div class="bet-slip__inner" id="bet-slip-inner">

                                        </div>

                                        <div class="bet-slip__item bet-slip__item--row" id="divvalor">
                                            <div class="bet-slip__item-footer bet-slip__item-footer--wide">
                                                <div class="bet-slip__bet-cont bet-slip__bet-cont--wide">
                                                    <input class="bet-slip__bet ng-untouched ng-pristine ng-invalid ca-input" formcontrolname="newstake" placeholder="R$ 0,00" value="R$ 0,00" type="text" id="newstake" name="newstake">
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

                                        {{ Form::open(['url' => '/finalizar-aposta', 'id' => 'form_finalizar_aposta']) }}

                                        {{ Form::close() }}
                                        <button class="bet-slip__btn" type="button" id="btn_finalizar_aposta" disabled="disabled">Colocar Aposta</button>


                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- row closed -->
                </div>
                <!-- Container closed -->
            </div>
            <!-- main-content closed -->
            <!-- Sidebar-right-->
            @yield('sidebar-right')
            <!--/Sidebar-right-->

            <!-- Message Modal -->


        </div>
        <!-- End Page -->

        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

        <script src="/assets3/plugins/jquery/jquery.min.js"></script>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script type="text/javascript">
            $(document).ready(function(e){
                $('.ca-input').maskMoney({
                    prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true
                });

                $('#divvalor').hide();

                $('#btn2').click(function(e){
                    $(this).attr('disabled', 'disabled');
                    $('#form2').submit();
                });

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

                $('body').on('keyup', '#newstake', function(e){
                    e.preventDefault();

                    var valor = $(this).val();
                    valor = valor.replace("R$ ", "");
                    valor = valor.replace(".", "");
                    valor = valor.replace(",", ".");

                    valor = parseFloat(valor);
                    console.log(valor);
                    if( valor > 0.00 ){
                        var totalcotas = $('#slip_total_odds').html();
                        totalcotas = parseFloat(totalcotas);

                        var total = valor * totalcotas;
                        console.log(total);

                        $('#slip_total_aposta').html( $('#newstake').val() );
                        $('#slip_total_retorno').html( new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(total));

                        $('#btn_finalizar_aposta').removeAttr('disabled', 'disabled');
                    }else{
                        console.log("valor = 0");
                        $('#btn_finalizar_aposta').attr('disabled');
                    }
                });

                $('body').on('click', '.cota-aposta', function(e){
                    e.preventDefault();

                    var id = $(this).attr('data-id');

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
                                    $('.cota-aposta[data-idevent='+res.idevent+']').removeClass('selecionado');
                                    $('.cota-aposta[data-id='+id+']').addClass('selecionado');
                                }else if(res.acao == 'unselect'){
                                    $('.cota-aposta[data-id='+id+']').removeClass('selecionado');
                                }

                                var geral = 0;
                                geral = parseInt(geral);
                                $.each( $('.selecionado'), function(i, item) {
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
                            $('.cota-aposta').removeClass('selecionado');

                            if(res.status == 'ok'){
                                $('#bet-slip-inner').html('');
                                $('#newstake').val( res.valor_total_apostado_format );

                                $('#slip_total_aposta').html( res.valor_total_apostado_format );
                                $('#slip_total_odds').html( res.valor_total_cotas );
                                $('#slip_total_retorno').html( res.possivel_retorno_format );

                                var total_de_apostas = 0;

                                $.each(res.response, function(i, item) {
                                    total_de_apostas++;
                                    $('#btn_finalizar_aposta').removeAttr('disabled', 'disabled');

                                    $('.cota-aposta[data-id='+item.idodds+']').addClass('selecionado');
                                    $('#divvalor').show();

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
    </div>
    <div class="main-navbar-backdrop"></div>
</body>


</html>
