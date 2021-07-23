

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
              <li class="breadcrumb-item"><a href="#">Listar</a></li>

            </ol>
          </nav>
        </div>
      </div>
      <!-- Card stats -->
      <div class="row">
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">


<div class="card">

<div class="card-header d-block">

    <h4 class="card-title">Cambistas</h4>

    <p class="mb-0 subtitle">Todos os cambistas cadastrados</p>

</div>
@yield('alert')

<div class="card-body">

    <div class="table-responsive">

        <table id="example" class="datatable table align-items-center table-flush">

            <thead>

                <tr class="thead-light">

                    <td scope="col" class="sort">Nome</td>

                    <td scope="col" class="sort">Email</td>

                    <td scope="col" class="sort">Gerente Vinculado</td>

                    <td scope="col" class="sort">Status</td>

                    <td scope="col" class="sort">Ações</td>

                </tr>

            </thead>

            <tbody>

                <?php

                    if(count($sql) > 0){

                        foreach($sql as $dados){

                            $status = '';



                            if($dados->status == 1){

                                $status = '<span class="badge badge-success">Ativo</div>';

                            }elseif($dados->status == 0){

                                $status = '<span class="badge badge-danger">Inativo</span>';

                            }



                            $gerente = DB::table('users')->where('id', $dados->idgerente)->get();

                            if(count($gerente) > 0){

                                $gerente = '<span class="badge badge-success">'.$gerente[0]->name.'<br>'.$gerente[0]->email.'</div>';

                            }else{

                                $gerente = '';

                            }



                            echo '

                            <tr>

                                <td>'.$dados->name.'</td>

                                <td>'.$dados->email.'</td>

                                <td>'.$gerente.'</td>

                                <td>'.$status.'</td>

                               

                                <td>

                                    <div class="dropdown">

                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                        </button>

                                        <div class="dropdown-menu">

                                            <a class="dropdown-item" href="/admin/cambistas/editar/'.$dados->id.'">Editar</a>
                                            <a class="dropdown-item" href="/admin/cambistas/caixa/lancamentos/'.$dados->id.'">Fazer Lançamento</a>
                                        </div>

                                    </div>

                                </td>

                            </tr>

                            ';

                        }

                    }

                ?>

            </tbody>

        </table>

    </div>

</div>

</div>


</div>

<!-- Fim -->
 </div>

@yield('footer')

    
