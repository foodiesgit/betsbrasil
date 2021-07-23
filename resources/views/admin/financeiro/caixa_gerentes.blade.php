

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
          <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-2' : 'col-xl-2')}} col-md-6">
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
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-2' : 'col-xl-2')}} col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Entradas Pendentes</h5>
                  <span class="h2 font-weight-bold mb-0" id="saldo1">R$ {{number_format($entradaPendente,2,',','.')}} </span>
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
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-2' : 'col-xl-2')}} col-md-6">
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
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-2' : 'col-xl-2')}} col-md-6">
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
        <div class="{{(Auth::user()->tipo_usuario == 4 ? 'col-xl-2' : 'col-xl-2')}} col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                  <span class="h2 font-weight-bold mb-0"id="saldo3">R$ {{number_format($total,2,',','.')}}</span>
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
        <?php 

          $saldo1 = 0;

          $saldo2 = 0;

          $saldo3 = 0;
        ?>
        @if(Auth::user()->tipo_usuario == 2)
        <div class="card">

            <div class="card-header d-block">

                <h4 class="card-title">Gerêntes</h4>

                <p class="mb-0 subtitle">Resumo dos Gerêntes Cadastrados</p>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                <table id="gerente" class="table align-items-center table-flush">

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
          @endif
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

            var table = $('#gerente').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/ajaxviewgerente",
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



