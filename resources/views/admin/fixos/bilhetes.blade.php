
    @include('admin.include')
    @yield('nav')
    @yield('header')


    <div class="main-content" id="panel">
    
    <style>
     .tabela {
        margin: 50px auto;
        width:70%
     }
     body {
    font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    </style>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <div class="header bg-dark pb-6">
        </div>

    <div class="container-fluid mt--6">
        <div class="card">

        <div class="card">

<div class="card-header d-block">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Todos os Bilhetes</h3>
        </div>
        <div class="col text-right">
        </div>
    </div>
<!-- 
    <h4 class="card-title"></h4>

    <p class="mb-0 subtitle">Resumo dos Cambistas Cadastrados</p> -->
</div>

<div>

    <div class="table-responsive">
    <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
        <table id="example" class="table table-striped table-bordered table-sm tabela">
            <thead>

                <tr>

                    <td><center>ID</td>
                    <td><center>Data</td>

                    <td><center>Cliente</td>
                    <td><center>Cambista</td>

                    <td><center>Valor Apostado</td>

                    <td><center>Valor de Retorno</td>

                    <td><center>Cotação</td>

                    <td><center>Status</td>

                    <td><center>Ações</td>

                </tr>

            </thead>

            <tbody id="myTable">

                <?php
                    if(count($bilhetes) > 0){
                        foreach($bilhetes as $dados){
                            $cambista = \App\User::find($dados->idcambista); 
                            $cliente = \App\User::find($dados->idusuario); 
                            $status = '';
                            if($dados->status == 1){

                                $status = '<center><span class="badge badge-success">Aguardando Resultado</div>';

                            }elseif($dados->status == 4){

                                $status = '<center><span class="badge badge-primary">Pré-bilhete</span>';

                            }
                            elseif($dados->status == 2){

                                $status = '<center><span class="badge badge-info">Vencedor</span>';

                            }
                            elseif($dados->status == 5){

                              $status = '<center><span class="badge badge-danger">Cancelado</span>';

                          }else{
                                $status = '<center><span class="badge badge-danger">Perdeu</span>';

                            }

                            echo '

                            <tr>

                                <td><center>'.$dados->codigo_unico.'</td>
                                <td><center>'.\Carbon\Carbon::parse($dados->created_at)->format('d/m/Y H:m:i').'</td>

                                <td><center>'.($dados->name == '' || is_null($dados->name) ? ($cliente ? $cliente->name : "Cliente não informado") : $dados->name).'</td>
                                <td><center>'.($cambista ? $cambista->name : "X").'</td>

                                <td><center><b>

                                    R$ '.number_format($dados->valor_apostado,2,',','.').'

                                </td></b>

                                <td><center><b>

                                    R$ '.number_format($dados->possivel_retorno,2,',','.').'

                                </td></b>

                                <td><center>

                                    '.$dados->total_cotas.'

                                </td>

                                <td>'.$status.'</td>

                               
                            ';
                            if(Auth::user()->tipo_usuario != 2){
                                echo '<td>

                                <div class="dropdown">

                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                    </button>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" target="_blank" href="/verifica-bilhete/'.$dados->codigo_unico.'">Ver bilhete</a>
                                        <a class="dropdown-item" target="_blank" href="/minhas-apostas/visualizar-cupom/'.$dados->codigo_unico.'">Ver Cupom</a>';
                                        if($dados->created_at->addMinutes(20) > \Carbon\Carbon::now() && $dados->status != 5){
                                          echo '<a class="dropdown-item"  href="/admin/cancelar-bilhete/'.$dados->id.'">Cancelar Bilhete</a>';
    
                                        }

                                    echo '</div>

                                </div>
                                </td>';

                            }else{
                               
                              echo '<td><center>
                              <div class="dropdown">

                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/verifica-bilhete/'.$dados->codigo_unico.'">Ver bilhete</a>
                                    <a class="dropdown-item" target="_blank" href="/minhas-apostas/visualizar-cupom/'.$dados->codigo_unico.'">Ver Cupom</a>';
                                    if( $dados->status != 5){
                                      echo '<a class="dropdown-item"  href="/admin/cancelar-bilhete/'.$dados->id.'">Cancelar Bilhete</a>';

                                    }

                                  
                                echo '</div>

                            </div>
                            </td>';
                            }
                            echo '</tr>';

                        }

                    }

                ?>



                



            </tbody>

        </table>

    </div>

</div>

</div>
</div>

        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@yield('footer')