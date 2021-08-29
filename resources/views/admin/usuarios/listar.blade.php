
    @include('admin.include')

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

        @yield('nav')

        <div class="header bg-dark pb-6">
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
        <div class="card">

        <div class="card-header d-block">

            <h4 class="card-title">Usuários</h4>

            <p class="mb-0 subtitle">Lista de todos os usuários cadastrados na plataforma</p>

        </div>

        <!--  <div class="card-body"> Class da divisoria -->
		<div>
            <div class="table-responsive">

                <!-- <table id="example" class="datatable table align-items-center table-flush"> -->
				<table class="table table-striped table-bordered table-sm tabela">
                    <thead>

                        <tr>

                            <td scope="col" class="sort"><center>Nome</td>

                            <td scope="col" class="sort"><center>Email</td>

                            <td scope="col" class="sort"><center>Créditos</td>

                            <td scope="col" class="sort"><center>Status</td>

                            <td scope="col" class="sort"><center>Ações</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if(count($sql) > 0){

                                foreach($sql as $dados){

                                    $status = '';



                                    if($dados->status == 1){

                                        $status = '<span class="badge badge-success">Ativo</div>';

                                    }elseif($dados->status == 2){

                                        $status = '<span class="badge badge-danger">Suspenso</span>';

                                    }



                                    echo '

                                    <tr>

                                        <td><center>'.$dados->name.'</td>

                                        <td><center>'.$dados->email.'</td>

                                        <td>

                                            <span><center>Bloqueado: <b>R$ '.number_format($dados->saldo_bloqueado,2,',','.').'</b></span><br>

                                            <span><center>Liberado: <b> R$ '.number_format($dados->saldo_liberado,2,',','.').'</b></span>

                                        </td>

                                        <td>'.$status.'</td>

                                        <td>

                                            <div class="dropdown">

                                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
					
                                                <center><svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                                </button>

                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="/admin/usuarios/editar/'.$dados->id.'">Editar</a>



                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                    ';

                                }

                            }

                        ?>
                                                    <!-- // // <a class="dropdown-item" href="/admin/usuarios/apostas/'.$dados->id.'">Apostas</a>

// <a class="dropdown-item" href="/admin/usuarios/saques/'.$dados->id.'">Saques</a> -->
                    </tbody>

                </table>

            </div>

        </div>
        <p class="mb-0 subtitle">&nbsp;</p>                            
        </div>
    </div>
</div>


@yield('footer')




