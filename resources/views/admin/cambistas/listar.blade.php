

    @include('admin.include')

@yield('header')
<div class="main-content" id="panel">
<style>
     .tabela {
        margin: 50px auto;
        width:70%
     }
    </style>  
@yield('nav')
<div class="header bg-dark pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
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

        <table id="example" class="table table-striped table-bordered table-sm tabela">

            <thead>

                <tr class="thead-light">

                <td scope="col" class="sort"><center>Nome</td>

                <td scope="col" class="sort"><center>Email</td>

                <td scope="col" class="sort"><center>Gerente Vinculado</td>

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

                                $status = '<center><span class="badge badge-success">Ativo</div>';

                            }elseif($dados->status == 0){

                                $status = '<center><span class="badge badge-danger">Inativo</span>';

                            }



                            $gerente = DB::table('users')->where('id', $dados->idgerente)->get();

                            if(count($gerente) > 0){

                                $gerente = '<center><span class="badge">'.$gerente[0]->name.'</div>';

                            }else{

                                $gerente = '';

                            }



                            echo '

                            <tr>

                            <td><center>'.$dados->name.'</td>

                            <td><center>'.$dados->email.'</td>

                            <td><center>'.$gerente.'</td>

                            <td><center>'.$status.'</td>

                               

                                <td>

                                    <div class="dropdown">

                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown"><center>

                                            <center><svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

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

    
