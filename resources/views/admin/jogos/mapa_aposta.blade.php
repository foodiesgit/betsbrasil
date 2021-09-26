

    @include('admin.include')



        @yield('header')
        <div class="main-content" id="panel">



		@yield('nav')
		@yield('alert')

        <div class="card" style="height: auto;">

<div class="card-header d-block">

    <h4 class="card-title">Filtro</h4>

    <p class="mb-0 subtitle">Selecione uma data para filtrar</p>

</div>

<div class="card-body">

{{ Form::model($filtro, ['url' => ['admin/jogos/mapa-aposta', ''], 'id' => 'form1', 'method' => 'GET']) }}

    <div class="row">

        <div class="form-group col-md-6 col-sm-12">

            <label class="mb-1"><strong>Data Inicial</strong></label>

            {{ Form::text('dataInicio', null, ['class' => 'form-control']) }}

        </div>

        <div class="form-group col-md-6 col-sm-12">

            <label class="mb-1"><strong>Data Final</strong></label>

            {{ Form::text('dataFinal', null, ['class' => 'form-control']) }}

        </div>

    </div>



    <div class="row">

        <div class="form-group col-md-4 col-sm-12">

            <label class="mb-1"><strong>Pais</strong></label>

            <?php

                $sqlPaises = DB::table('paises')->orderBy('nome_traduzido', 'asc')->where('status', 1)->get();

                $arrayPaises = [];



                if(count($sqlPaises) > 0){

                    foreach($sqlPaises as $dados){

                        $arrayPaises[$dados->id] = $dados->nome.' - '.$dados->nome_traduzido;

                    }

                }

            ?>

            {{ Form::select('filtro_pais', $arrayPaises, null, ['class' => 'form-control']) }}

        </div>

        <div class="form-group col-md-4 col-sm-12">

            <label class="mb-1"><strong>Esporte</strong></label>

            <?php

                $sqlEsportes = DB::table('esportes')->orderBy('nome_traduzido', 'asc')->where('status', 1)->get();

                $arrayEsportes = [];



                if(count($sqlEsportes) > 0){

                    foreach($sqlEsportes as $dados){

                        $arrayEsportes[$dados->id] = $dados->nome_traduzido;

                    }

                }

            ?>

            {{ Form::select('filtro_esporte', $arrayEsportes, null, ['class' => 'form-control']) }}

        </div>

        <div class="form-group col-md-4 col-sm-12">

            <label class="mb-1"><strong>Ligas</strong></label>

            <?php

                $sqlLigas = DB::table('ligas')->orderBy('nome_original', 'asc')->where('status', 1)->get();

                $arrayLigas = [];



                $arrayLigas[''] = '# Selecione uma liga';



                if(count($sqlLigas) > 0){

                    foreach($sqlLigas as $dados){

                        $arrayLigas[$dados->id] = $dados->nome_traduzido;

                    }

                }

            ?>

            {{ Form::select('filtro_liga', $arrayLigas, null, ['class' => 'form-control']) }}

        </div>

    </div>



    <div class="row">

        <div class="col-sm-12">

            <button type="button" name="btn1" id="btn1" class="btn btn-info">

                <i class="fa fa-filter mr-1"></i> Filtrar

            </button>

        </div>

    </div>

{{ Form::close() }}

</div>

</div>

<div class="card" style="height: auto;">

<div class="card-header d-block">

    <h4 class="card-title">Todos os Eventos</h4>

    <p class="mb-0 subtitle">Visualizar Eventos</p>

</div>

<div class="card-body">

    <div class="table-responsive">

        <!--<table id="example" class="datatable table align-items-center table-flush">-->
        <table class="table table-striped table-bordered table-sm tabela">    

            <thead>

                <tr>
                    <td><center>Data</td>
                    <td><center>Pais</td>
                    <td><center>Esporte</td>
                    <td><center>Liga</td>
                    <td><center>Times</td>
                    <td><center>Status</td>
                    <td><center>Ações</td>
                </tr>

            </thead>

            <tbody>

                <?php



                    if(count($sql) > 0){

                        foreach($sql as $dados){

                            $status = '';



                            $time1 = DB::table('times')->where('id', $dados->idhome)->get();

                            $time2 = DB::table('times')->where('id', $dados->idaway)->get();



                            $time_home = '';

                            $time_away = '';



                            if(count($time1) > 0){

                                $time_home = $time1[0]->nome;

                            }

                            if(count($time2) > 0){

                                $time_away = $time2[0]->nome;

                            }



                            if($dados->status == 1){

                                $status = '<span class="badge badge-info">Aguardando Inicio</span>';

                            }elseif($dados->status == 2){

                                $status = '<span class="badge badge-primary">Ao Vivo</span>';

                            }elseif($dados->status == 3){

                                $status = '<span class="badge badge-info">Interrompido</span>';

                            }elseif($dados->status == 4){

                                $status = '<span class="badge badge-dark">Encerrado</span>';

                            }else{

                                $status = '<span class="badge badge-danger">'.$dados->status.'</span>';

                            }



                            echo '

                            <tr>

                                <td>'.$dados->data_evento.'</td>

                                <td>'.$dados->nome_pais.'</td>

                                <td>'.$dados->nome_esporte.'</td>

                                <td>'.$dados->nome_liga.'</td>

                                <td>

                                    <span class="badge badge-success">'.$time_home.'</span><br>

                                    <span class="badge badge-warning">'.$time_away.'</span>

                                </td>



                                <td>'.$status.'</td>

                                <td>

                                    <div class="dropdown">

                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">

                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>

                                        </button>

                                        <div class="dropdown-menu">';



                                        echo '<a class="dropdown-item" href="/admin/jogos/visualizar-apostas/'.$dados->id.'">Visualizar Apostas</a>';

                                        /*if($dados->status != 5){

                                            echo '<a class="dropdown-item" href="/admin/jogos/desabilitar/'.$dados->id.'">Desabilitar</a>';

                                        }else{

                                            echo '<a class="dropdown-item" href="/admin/jogos/habilitar/'.$dados->id.'">Habilitar</a>';

                                        }*/

                                        echo '

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

        <div>
        @yield('footer')




    <script type="text/javascript">

        $(document).ready(function(e){

            $('input[name=dataInicio]').pickadate({

                format: 'dd/mm/yyyy'

            });

            $('input[name=dataFinal]').pickadate({

                format: 'dd/mm/yyyy'

            });



            $('#btn1').click(function(e){

                $(this).attr('disabled', 'disabled');

                $('#form1').submit();

            });

        });

    </script>



</body>

</html>

