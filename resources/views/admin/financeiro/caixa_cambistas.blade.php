

    @include('admin.include')

@yield('header')
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
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-4' : 'col-xl-3')}} col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Entradas</h5>
                  <span class="h2 font-weight-bold mb-0" id="saldo1">R$ {{number_format($entrada,2,',','.')}} </span>
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
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-4' : 'col-xl-3')}} col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Saidas</h5>
                  <span class="h2 font-weight-bold mb-0"id="saldo2">R$ {{number_format($saida,2,',','.')}}</span>
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
        @if(Auth::user()->tipo_usuario == 2 ||Auth::user()->tipo_usuario == 3)
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-4' : 'col-xl-3')}} col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Comissões</h5>
                  <span class="h2 font-weight-bold mb-0"id="saldo3">R$ {{number_format($comissoes,2,',','.')}}</span>
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
        @endif
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-4' : 'col-xl-3')}} col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Sua Comissões</h5>
                  <span class="h2 font-weight-bold mb-0"id="saldo3">R$ {{number_format($comissao,2,',','.')}}</span>
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

    <h4 class="card-title">Cambistas</h4>

    <p class="mb-0 subtitle">Resumo dos Cambistas Cadastrados</p>

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

                    <td>Comissão</td>

                    <td>Status</td>

                    <td>Ações</td>

                </tr>

            </thead>

            <tbody>

               
                



            </tbody>

        </table>

    </div>

</div>

</div>
</div>



    @yield('footer')

<script type="text/javascript">

    $(document).ready(function(e){

        var saldo1 = $('input[name=saldo1]').val();

        var saldo2 = $('input[name=saldo2]').val();

        var saldo3 = $('input[name=saldo3]').val();



        $('#saldo1').html( saldo1 );

        $('#saldo2').html( saldo2 );

        $('#saldo3').html( saldo3 );

        var table = $('#cambista').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/ajaxviewcambista",
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

