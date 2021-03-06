


    @include('admin.include')

@yield('header')
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/> -->
<div class="main-content" id="panel">


    @yield('nav')

    <div class="header bg-dark pb-6">
    <div class="container-fluid">
        <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
            </nav>
            </div>
        </div>
        <!-- Card stats -->
        <div class="row">

        <div class="col-xl-4 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Entradas</h5>
                <span class="h2 font-weight-bold mb-0" >R$ {{number_format($entrada,2,',','.')}} </span>
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
        <div class="col-xl-4 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Saidas</h5>
                <span class="h2 font-weight-bold mb-0" ">R$ {{number_format($saida,2,',','.')}}</span>
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
            <!-- Card body -->
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Comiss??o do Cambista</h5>
                <span class="h2 font-weight-bold mb-0" ">R$ {{number_format($comissao,2,',','.')}}</span>
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
            <h3 class="mb-0">Historico de Transa????es</h3>
        </div>
        <div class="col text-right">
       
        </div>
    </div>
<!-- 
    <h4 class="card-title"></h4>

    <p class="mb-0 subtitle">Resumo dos Cambistas Cadastrados</p> -->

</div>

<div class="card-body">

    <div class="table-responsive">

        <table id="example" class="datatable table align-items-center table-flush">

            <thead>

                <tr>

                    <td>ID</td>
                    <td>Data</td>

                    <td>Tipo da Solicita????o</td>

                    <td>Saldo Anterior</td>

                    <td>Saldo</td>

                    <td>Novo Saldo</td>

                    <td>Status</td>

                    <td>A????es</td>

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

                                <td><span class="badge badge-danger">

                                    R$ '.number_format($dados->total_before,2,',','.').'

                                </span></td>

                                <td><span class="badge badge-success">

                                    R$ '.number_format($dados->amount,2,',','.').'

                                </span></td>

                                <td><span class="badge badge-info">

                                    R$ '.number_format($dados->total_after,2,',','.').'

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

                                        <a class="dropdown-item" href="/admin/cancelar-solicitacao/'.$dados->id.'">Cancelar Solicita????o</a>

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
                                    <a class="dropdown-item" href="/admin/aprovar-solicitaca/'.$dados->user_id.'">Aprovar Solicita????o</a>

                                    <a class="dropdown-item" href="/admin/rejeitar-solicitaca/'.$dados->user_id.'">Cancelar Solicita????o</a>

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

</div>


<div class="card">

<div class="card-header d-block">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Todos os Cambistas desse gerente</h3>
        </div>
        <div class="col text-right">
           
        </div>
    </div>
<!-- 
    <h4 class="card-title"></h4>

    <p class="mb-0 subtitle">Resumo dos Cambistas Cadastrados</p> -->

</div>

        <div class="card-body">

            <div class="table-responsive">

            <table id="cambista" class="table align-items-center table-flush">

                <thead>

                    <tr>

                        <td>ID</td>
                        <td>Nome</td>

                        <td>Email</td>

                        <td>Entrada</td>

                        <td>Saida</td>

                        <td>Comiss??o</td>

                        <td>Status</td>

                        <td>A????es</td>

                    </tr>

                </thead>

                <tbody>



                </tbody>

                </table>
            </div>

        </div>

    </div>
</div>
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

        var table = $('#cambista').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/ajaxviewcambistagerente",
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'entrada',
                    name: 'entrada',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'saida',
                    name: 'saida',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'comissao',
                    name: 'comissao',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'status',
                    name: 'comissao',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action'
                },
                
            ]
        });
    });

</script>

