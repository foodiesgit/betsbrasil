

@include('admin.include')

@yield('header')


<div class="main-content" id="panel">
@yield('nav')
     
    <div class="card">

        <div class="card-header d-block">

            <h4 class="card-title">Ligas</h4>

            <p class="mb-0 subtitle">Todos as ligas cadastradas</p>

        </div>
        @yield('alert') 
        <div class="card-body">

        <div class="table-responsive">

        <table id="example" class="table table-striped table-bordered table-sm tabela">
                <thead>

                    <tr>

                        <td>Original</td>

                        <td>Traduzido</td>

                        <td>Pais</td>

                        <td>Status</td>

                        <td>Ações</td>

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



                                $destaque_menu2 = '';



                                if($dados->destaque_menu == 1){

                                    $destaque_menu = '<span class="badge badge-success">Destacado</div>';

                                }else{

                                    $destaque_menu = '<span class="badge badge-warning">Sem Destaque</div>';

                                }



                                echo '

                                <tr>

                                    <td>'.$dados->nome_original.'</td>

                                    <td>'.$dados->nome_traduzido.'</td>

                                    <td><img src="/assets/bandeiras/'.$dados->bandeira.'" width="32"> '.$dados->nome_pais.'</td>


                                    <td>'.$status.'</td>

                                    <td>

                                        <div class="dropdown">

                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                            </button>

                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="/admin/api/ligas/editar/'.$dados->id.'">Editar</a>



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
@yield('footer')
<!-- <td>'.$destaque_menu.'</td>
<td><span>'.$dados->nome_esporte.'</span></td>
