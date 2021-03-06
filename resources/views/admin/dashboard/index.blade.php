


    @include('admin.include')

@yield('header')
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/> -->
<div class="main-content" id="panel">


    @yield('nav')
    <?php $config =\DB::table('campos_fixos')->first(); ?>

<div class="header bg-dark pb-6">
  <div class="container-fluid">
    <div class="header-body">
    <style>
     .tabela {
        margin: 50px auto;
        width:75%
     }
     body {
    font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    </style>  
      <!-- <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
          </nav>
        </div>
      </div> -->
      <!-- Card stats -->
      <div class="row">
     @if(Auth::user()->tipo_usuario == 1)
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Saldo Disponível</h5>
                  <span class="h2 font-weight-bold mb-0" id="saldo1">R$ 0,00</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Saldo Disponível para Saque</h5>
                  <span class="h2 font-weight-bold mb-0"id="saldo2">R$ 0,00</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Saldo Bloqueado</h5>
                  <span class="h2 font-weight-bold mb-0"id="saldo3">R$ 0,00</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @else
      @endif
      </div>
    </div>
    </div>
  </div>


<div class="container-fluid mt--6">
@yield('alert')

<div class="card">

<div class="card-header d-block">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Historico de Transações</h3>
        </div>
        <div class="col text-right">
        @if(Auth::user()->tipo_usuario ==1)
            <button  type="button"  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-saldo">Adicionar Saldo</button>
            <button  type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-saque">Solicitar Saque</button>
        @endif
        </div>
    </div>
<!-- 
    <h4 class="card-title"></h4>

    <p class="mb-0 subtitle">Resumo dos Cambistas Cadastrados</p> -->

</div>

<div>
<!-- <div class="card-body"> -->
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered table-sm tabela">
		<!-- <table id="example" class="datatable table align-items-center table-flush"> -->
            <thead>

                <tr>

                    <td><center>ID</td>
                    <td><center>Data</td>

                    <td><center>Tipo da Solicitação</td>

                    <td><center>Saldo Anterior</td>

                    <td><center>Saldo</td>

                    <td><center>Novo Saldo</td>

                    <td><center>Status</td>

                    <td><center>Ações</td>

                </tr>

            </thead>

            <tbody>

                <?php

                    use Illuminate\Support\Facades\Auth;

                    $saldo1 = 0;

                    $saldo2 = 0;

                    $saldo3 = 0;



                    if(count($historic) > 0){

                        foreach($historic as $dados){

                            $status = '';



                            if($dados->status == 1){

                                $status = '<span class="badge badge-success">Aprovado</div>';

                            }elseif($dados->status == 0){

                                $status = '<span class="badge badge-danger">Aguardando</span>';

                            }
                            elseif($dados->status == 3){

                                $status = '<span class="badge badge-danger">Cancelada pelo Usuario</span>';

                            }else{
                                $status = '<span class="badge badge-danger">Recusado</span>';

                            }



                            $saldo1 = $saldo1 + $dados->saldo_apostas;

                            $saldo2 = $saldo2 + $dados->saldo_liberado;

                            $saldo3 = $saldo3 + $dados->saldo_bloqueado;



                            echo '

                            <tr>

                                <td>'.$dados->user_id_transaction.'</td>
                                <td>'.\Carbon\Carbon::parse($dados->date)->format('d/m/Y').'</td>

                                <td>'.$dados->type.'</td>

                                <td><b><span>

                                    R$ '.number_format($dados->total_before,2,',','.').'

                                </span></td>

                                <td><b><span>

                                    R$ '.number_format($dados->amount,2,',','.').'

                                </span></td>

                                <td><b><span>

                                    <center>R$ '.number_format($dados->total_after,2,',','.').'

                                </span></td>

                                <td>'.$status.'</td>

                               
                            ';
                            if(Auth::user()->tipo_usuario != 2){
                                echo '<td>

                                <div class="dropdown">

                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                    </button>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="/admin/cancelar-solicitacao/'.$dados->id.'">Cancelar Solicitação</a>

                                    </div>

                                </div>
                                </td>';

                            }else{
                               
                              echo '<td>
                              <div class="dropdown">

                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/admin/aprovar-solicitacao/'.$dados->user_id.'">Aprovar Solicitação</a>

                                    <a class="dropdown-item" href="/admin/rejeitar-solicitacao/'.$dados->user_id.'">Cancelar Solicitação</a>

                                </div>

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
<br>
</div>


<div class="card">


</div>
</div>
@if(Auth::user()->tipo_usuario ==1)
<div class="modal fade" id="modal-saldo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitação de deposito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="card bg-secondary shadow border-0">
                <form action="/admin/deposit" method="post"> 
                @csrf
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small>Informe um valor para efetuar sua solicitação de deposito</small>
                    </div>

                      <div class="input-group input-group-alternative">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                          </div>
                          <input class="form-control"   id="recarrega-saldo" name="recarrega-saldo" type="text">
                          <input class="form-control"  id="recarrega-saldo-hidden"name="recarrega-saldo-hidden" type="hidden">
                      </div>
                      <div class="text-center text-muted mb-4" style="padding:10px">
                        <?php echo $config->rodape_cupom; ?>
                      </div>
                    
                    </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Solicitar Saldo</button>
        </form>

      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-saque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitação de saque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="card bg-secondary shadow border-0">
            <form action="/admin/saque" method="post"> 
                @csrf
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small>Informe um valor para efetuar sua solicitação de saque</small>
                    </div>
                    <form role="form">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                </div>
                                <input class="form-control"   id="saque-saldo" name="saque-saldo" type="text">
                                <input class="form-control"  id="saque-saldo-hidden"name="saque-saldo-hidden" type="hidden">

                            </div>
                        </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Solicitar Saldo</button>
        </form>

      </div>
    </div>
  </div>
</div>
@endif
<input type="hidden" name="saldo1" value="R$ {{ number_format($sql['saldo_apostas'],2,',','.') }}" />

<input type="hidden" name="saldo2" value="R$ {{ number_format($sql['saldo_liberado'],2,',','.') }}" />

<input type="hidden" name="saldo3" value="R$ {{ number_format($sql['saldo_bloqueado'],2,',','.') }}" />

    @yield('footer')

<script src="/assets2/js/jquery.maskMoney.min.js"></script>

<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">

    $(document).ready(function(e){

        var saldo1 = $('input[name=saldo1]').val();

        var saldo2 = $('input[name=saldo2]').val();

        var saldo3 = $('input[name=saldo3]').val();



        $('#saldo1').html( saldo1 );

        $('#saldo2').html( saldo2 );

        $('#saldo3').html( saldo3 );


        $('input[name=recarrega-saldo]').maskMoney({

            prefix: 'R$ ',

            thousands: '.',

            decimal: ','

        });
        
        $('input[name=saque-saldo]').maskMoney({

            prefix: 'R$ ',

            thousands: '.',

            decimal: ','

        });

        $('#recarrega-saldo').on('keyup', function(e) {
            e.preventDefault();

            var valor = $(this).val();

            valor = valor.replace("R$ ", "");

            valor = valor.replace(".", "");

            valor = valor.replace(",", ".");



            valor = parseFloat(valor);
            $('#recarrega-saldo-hidden').val(valor)
		});
        $('#saque-saldo').on('keyup', function(e) {
            e.preventDefault();

            var valor = $(this).val();

            valor = valor.replace("R$ ", "");

            valor = valor.replace(".", "");

            valor = valor.replace(",", ".");



            valor = parseFloat(valor);
            $('#saque-saldo-hidden').val(valor)
		});
    });

</script>

