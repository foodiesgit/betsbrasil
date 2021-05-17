
  @include('client.include_sbet')

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title>Team overview</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <script src="/cdn-cgi/apps/head/3ts2ksMwXvKRuG480KNifJ2_JNM.js"></script><link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600%7CRoboto:400,900">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/style.css">
  </head>


  <body>
    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="/images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-body">
        <div class="preloader-item"></div>
      </div>
    </div>
    @yield('main-header')
    <div class="page animated" style="animation-duration: 500ms;">

    <!-- Page-->
    <div class="">
    <section class="section section-sm bg-gray-100">      
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-12">
              <div class="row row-50">
              <div class="col-lg-8">
              <div class="player-info-corporate">
                    <div class="player-info-main">
                      <h4 class="player-info-title">Informações do bilhete</h4>
                      <!-- <p class="player-info-subtitle"></p> -->
                      <hr>
                      <div class="player-info-table">
                        <div class="table-custom-wrap">
                          <table class="table-custom">
                            <tbody>
                            <tr>
                              <?php $cliente = \App\User::find($aposta->idusuario);?>
                              <?php $cambista = \App\User::find($aposta->idcambista);?>
                              <th>Cliente: </th>
                              <th>{{($cliente ? $cliente->name : "Cliente não informado")}}</th>
                            </tr>
                            <tr>
                            <th>Cambista: </th>
                              <th>{{($cambista ? $cambista->name : "Cambista não informado")}}</th>
                              
                            </tr>
                            <tr>
                              <th>Codigo do bilhete</th>
                              <th>{{$aposta->codigo_unico}}</th>
                            </tr>
                            <tr>
                              <td>Total Apostado</td>
                              <td>R$ {{number_format($aposta->valor_apostado, 2,',','.')}}</td>
                            </tr>
                            <tr>
                              <td>Cotação</td>
                              <td>{{number_format($aposta->total_cotas, 2,',','.')}}</td>
                            </tr>
                            <tr>
                              <td>Possivel Retorno</td>
                              <td>R${{number_format($aposta->possivel_retorno, 2,',','.')}}</td>
                            </tr>
                            <tr>
                              <td>Data e hora</td>
                              <td>{{$aposta->created_at->format('d/m/Y H:i:s')}}</td>
                            <tr>
                        
                              <td>Status do Bilhete</td>

                              @if($aposta->status == 1)
                                <td>Aguardando Resultado</td>
                              @else @if($aposta->status == 2)
                                <td style="color:green">Ganhou</td>

                              @else @if($aposta->status == 5)
                              <td style="color:red">Cancelado</td>

                              @else
                                <td style="color:red">Perdeu</td>

                              @endif
                              @endif
                              @endif
                            </tr>
                          </tbody></table>
                        </div>
                      </div>
                      <hr>
                    </div>
                  </div>

              </div>
                  <!-- Heading Component-->
                  @foreach($jogos as $jogo)
                <div class="col-lg-8">

                  <!-- Game Result Bug-->
                  <article class="game-result">
                    <div class="game-info game-info-classic">
                      <p class="game-info-subtitle">{{$jogo->estadio}} - {{$jogo->city}} - {{$jogo->country}} 
                        <time datetime="{{$jogo->data}}">{{\Carbon\Carbon::create($jogo->data)->locale('pt_BR')->toDayDateTimeString()}}</time>
                      </p>
                      <h3 class="game-info-title">{{$jogo->nome_traduzido}}</h3>
                      <div class="game-info-main">
                        <div class="game-info-team game-info-team-first">
                          <figure><img src="https://assets.b365api.com/images/team/s/{{$jogo->homeImage}}.png" alt="" width="20" height="20">
                          </figure>
                          <div class="game-result-team-name">{{$jogo->homeNome}}</div>
                          <!-- <div class="game-result-team-country">USA</div> -->
                        </div>
                        <div class="game-info-middle">
                          <div class="game-result-score-wrap">
                            <div class="game-info-score game-result-team-win" id="homePlacar-{{$jogo->betid}}">0</div>
                            <div class="game-info-score" id="awayPlacar-{{$jogo->betid}}">0</div>
                          </div>
                          <div class="game-result-divider-wrap"><span class="game-info-team-divider">VS</span></div>
                        </div>
                        <div class="game-info-team game-info-team-second">
                          <figure><img src="https://assets.b365api.com/images/team/s/{{$jogo->awayImage}}.png" alt="" width="20" height="20">
                          </figure>
                          <div class="game-result-team-name">{{$jogo->awayNome}}</div>
                          <!-- <div class="game-result-team-country">Germany</div> -->
                        </div>
                      </div>

                      <div class="table-game-info-wrap"><span class="table-game-info-title">Sua Aposta<span></span></span>
                        <div class="table-game-info-main table-custom-responsive">
                          <table class="table-custom table-game-info">
                            <tbody>
                              <tr>
                                @if($jogo->ticketStatus == 0)
                                <td class="table-game-info-number">Aguardando Resultado</td>
                                @else @if($jogo->ticketStatus == 1)
                                 <td class="table-game-info-number" style="background-color:green; color:white">Ganhou</td>

                                @else
                                 <td class="table-game-info-number" style="background-color:red; color:white">Perdeu</td>

                                @endif
                                @endif

                                <td class="table-game-info-category">{{$jogo->titulo_traduzido}} - {{$jogo->name}}</td>
                                <td class="table-game-info-number">{{$jogo->odds}}</td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                      </br>
                      <!-- Table Game Info-->
                      <div class="table-game-info-wrap"><span class="table-game-info-title">Estatiticas da partida<span></span></span>
                        <div class="table-game-info-main table-custom-responsive">
                          <table class="table-custom table-game-info">
                            <tbody id="estatistica-{{$jogo->betid}}">
                              <tr>
                                <td class="table-game-info-number">0(0)</td>
                                <td class="table-game-info-category">Chutes (no Gol)</td>
                                <td class="table-game-info-number">0(0)</td>
                              </tr>
                              <tr>
                                <td class="table-game-info-number">0</td>
                                <td class="table-game-info-category">Gols</td>
                                <td class="table-game-info-number">0</td>
                              </tr>
                              <tr>
                                <td class="table-game-info-number">0</td>
                                <td class="table-game-info-category">Escanteios</td>
                                <td class="table-game-info-number">0</td>
                              </tr>
                              <tr>
                                <td class="table-game-info-number">0%</td>
                                <td class="table-game-info-category">Posse de Bola</td>
                                <td class="table-game-info-number">0%</td>
                              </tr>
                              <tr>
                                <td class="table-game-info-number">0</td>
                                <td class="table-game-info-category">Cartões Amarelos</td>
                                <td class="table-game-info-number">0</td>
                              </tr>
                              <tr>
                                <td class="table-game-info-number">0</td>
                                <td class="table-game-info-category">Cartões Amarelos</td>
                                <td class="table-game-info-number">0</td>
                              </tr>
                              <tr>
                                <td class="table-game-info-number">0</td>
                                <td class="table-game-info-category">Cartões Vermelhos</td>
                                <td class="table-game-info-number">0</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </article>

                </div>
                <div class="col-lg-4 d-none d-sm-block d-md-none d-lg-block" >
              <div class="row row-50">
                <div class="col-lg-6 col-lg-12">

                  <!-- Game Highlights-->
                  <div class="game-highlights " style="max-height:775px; overflow:auto; ">
                    <ul class="game-highlights-list" id="highlights-{{$jogo->betid}}">
                      <li>
                        <p class="game-highlights-title">Aguardando o Início da Partida
                        </p><span class="game-highlights-minute">0’</span>
                      </li>
                      <!-- <li>
                        <p class="game-highlights-title">Início da partida
                        </p><span class="game-highlights-minute">0’</span>
                      </li> -->
                      <!-- <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-orange-dark fa fa-exclamation"></span>Falta de Martin Pierto
                        </p>
                        <p class="game-highlights-description">Martin Pierto showed sharp reflexes but failed to score for his team.</p><span class="game-highlights-minute">12’</span>
                      </li>
                      <li class="team-primary">
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-primary fa fa-futbol-o"></span><span class="game-highlights-goal">Goooolll</span> (1-0)
                        </p>
                        <p class="game-highlights-description">Franklin Stevens scored with the right foot. Assisted by David Hawkins.</p><span class="game-highlights-minute">18’</span>
                      </li>
                      <li class="team2-blue">
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-blue-boston fa fa-futbol-o"></span><span class="game-highlights-goal">Goooolll</span> (1-1)
                        </p>
                        <p class="game-highlights-description">atletico’s defender James Peterson turned Hernandez’s cross into his own net.</p><span class="game-highlights-minute">21’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-orange fa fa-file"></span>Cartão Amarelo
                        </p>
                        <p class="game-highlights-description">Ernesto Wilson got his first yellow card just before the first time ended.</p><span class="game-highlights-minute">28’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-primary fa fa-life-ring"></span>Attempt saved
                        </p>
                        <p class="game-highlights-description">Harry Stevenson saved Rob Wilson’s attempt to score a goal.</p><span class="game-highlights-minute">31’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-blue-boston fa fa-hand-o-right"></span>Penalty Kick
                        </p>
                        <p class="game-highlights-description">Performed by Sam Schmidt, this penalty kick marks the beginning of the 2nd time.</p><span class="game-highlights-minute">47’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-primary fa fa-flag"></span>Offside of Chris Balleron
                        </p>
                        <p class="game-highlights-description">Chris Balleron received offside warning for touching the passed ball.</p><span class="game-highlights-minute">60’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-red-2 fa fa-file"></span>Red card
                        </p>
                        <p class="game-highlights-description">The referee showed red card to Joe Perkins on the 74th minute of the match.</p><span class="game-highlights-minute">74’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-primary fa fa-exchange"></span>Gary Cahill <span class="text-gray-500">for</span> jack windsor
                        </p>
                        <p class="game-highlights-description">Atletico replaces their first forward with Jack Windsor before the 2nd time ends.</p><span class="game-highlights-minute">86’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-blue-boston fa fa-clock-o"></span>The referee adds 4 minutes 
                        </p>
                        <p class="game-highlights-description">The referee adds 4 minutes to the second time to compensate goal celebration time.</p><span class="game-highlights-minute">89’</span>
                      </li>
                      <li>
                        <p class="game-highlights-title"><span class="icon icon-xxs icon-primary fa fa-flag-checkered"></span>End of the game
                        </p>
                        <p class="game-highlights-description">4 minutes later the referee announces the end of the game with a draw as a result.</p><span class="game-highlights-minute">94’</span>
                      </li> -->
                    </ul>
                  </div>
                </div>

              </div>
            </div>
            @endforeach
              </div>
            </div>

          </div>
        </div>
      </section>

    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="/js/core.min.js"></script>
    <script src="/js/script.js"></script>
 


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
      $(document).ready(function(e){
        $.ajax({

        url: '/ajax-verifica-bilhete/{{$aposta->codigo_unico}}',

        method: 'GET',

        success: function(res){
            $.each(res, function(i, res) {
                console.log(res)
                var placar =  res[0].ss.split('-')
                $('#homePlacar-'+res[0].bet365_id).html(placar[0]);
                $('#awayPlacar-'+res[0].bet365_id).html(placar[1]);
                $('#estatistica-'+res[0].bet365_id).html(
                '<tr>'+
                '<td class="table-game-info-number">'+res[0].stats.off_target[0]+'('+res[0].stats.on_target[0]+')</td>'+
                '<td class="table-game-info-category">Chutes (no Gol)</td>'+
                '<td class="table-game-info-number">'+res[0].stats.off_target[1]+'('+res[0].stats.on_target[1]+')</td>'+
                '</tr>'+
                '<tr>'+
                '<td class="table-game-info-number">'+res[0].stats.goals[0]+'</td>'+
                '<td class="table-game-info-category">Gols</td>'+
                '<td class="table-game-info-number">'+res[0].stats.goals[1]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td class="table-game-info-number">'+res[0].stats.corners[0]+'</td>'+
                '<td class="table-game-info-category">Escanteios</td>'+
                '<td class="table-game-info-number">'+res[0].stats.corners[1]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td class="table-game-info-number">'+res[0].stats.possession_rt[0]+'%</td>'+
                '<td class="table-game-info-category">Posse de Bola</td>'+
                '<td class="table-game-info-number">'+res[0].stats.possession_rt[1]+'%</td>'+
                '</tr>'+
                '<tr>'+
                '<td class="table-game-info-number">'+res[0].stats.yellowcards[0]+'</td>'+
                '<td class="table-game-info-category">Cartões Amarelos</td>'+
                '<td class="table-game-info-number">'+res[0].stats.yellowcards[1]+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td class="table-game-info-number">'+res[0].stats.redcards[0]+'</td>'+
                '<td class="table-game-info-category">Cartões Vermelhos</td>'+
                '<td class="table-game-info-number">'+res[0].stats.redcards[1]+'</td>'+
                '</tr>'
                );

                $.each(res[0].events, function(i, item) {
                    var valor =  item.text.split('-')
                    $('#highlights-'+res[0].bet365_id).append('<li>'+
                            '<p class="game-highlights-title">'+translate(valor[1])+' - ' +valor[2]+
                            '</p><span class="game-highlights-minute">'+translate(valor[0])+'</span>'+
                        '</li>');

                });
            });
            



        },error: function(err){



        },complete: function(){



        }

        });


        function translate(texto){
            var eng = ['Yellow Card','Red Card', 'Corner', 'Goal', '1st', '2nd', '3rd','4th', '5th', '6th' , '7th', '8th','9th','10th', 'Score After First Half ','Score After Full Time ',"Race to"]
            var port = ['Cartão Amarelo', 'Cartão Vermelho','Escanteio', 'Goooooll', '1°', '2°','3°', '4°', "5°", "6°","7°","8°","9°","10°","-", "Fim", "Corrida para "]
            var texto = texto.replace(eng[0], port[0])
            var texto =texto.replace(eng[1], port[1])
            var texto =texto.replace(eng[2], port[2])
            var texto =texto.replace(eng[3], port[3])
            var texto =texto.replace(eng[4], port[4])
            var texto =texto.replace(eng[5], port[5])
            var texto =texto.replace(eng[6], port[6])
            var texto =texto.replace(eng[7], port[7])
            var texto =texto.replace(eng[8], port[8])
            var texto =texto.replace(eng[9], port[9])
            var texto =texto.replace(eng[10], port[10])
            var texto =texto.replace(eng[11], port[11])
            var texto =texto.replace(eng[12], port[12])
            var texto =texto.replace(eng[13], port[13])
            var texto =texto.replace(eng[14], port[14])
            var texto =texto.replace(eng[15], port[15])
            var texto =texto.replace(eng[16], port[16])

            return texto;
        }
      });
    </script>
    </html>