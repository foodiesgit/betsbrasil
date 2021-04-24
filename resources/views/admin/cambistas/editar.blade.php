

    @include('admin.include')

@yield('header')

<div class="main-content" id="panel">


    @yield('nav')

    <div class="content-body btn-page">

<div class="container-fluid">

    <div class="row page-titles mx-0">


    </div>

    <!-- row -->

    <div class="row">

        <div class="col-lg-12">


            <div class="card">

                <div class="card-header d-block">

                    <h4 class="card-title">Cambista</h4>

                    <p class="mb-0 subtitle">Dados do novo cambista</p>

                </div>

                <div class="card-body">

                    {{ Form::model($sql[0], ['url' => ['admin/cambistas/editar', $sql[0]->id], 'id' => 'form1']) }}

                    <div class="row">



                        <div class="form-group col-sm-12">

                            <label class="mb-1"><strong>Nome Completo*</strong></label>

                            {{ Form::text('nome', null, ['class' => 'form-control form-control-lg '.( $errors->has('nome') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o nome completo desse cambista']) }}

                            @error('nome')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>



                        <div class="form-group col-sm-6">

                            <label class="mb-1"><strong>CPF*</strong></label>

                            {{ Form::text('cpf', null, ['class' => 'form-control form-control-lg '.( $errors->has('cpf') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o CPF desse usuário', 'id' => 'cpf']) }}

                            @error('cpf')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-sm-6">

                            <label class="mb-1"><strong>Data de Nascimento*</strong></label>

                            {{ Form::text('data_nascimento', null, ['class' => 'form-control form-control-lg '.( $errors->has('data_nascimento') ? ' is-invalid' : '' ), 'placeholder' => 'Ex.: 01/01/1980', 'id' => 'data_nascimento']) }}

                            @error('data_nascimento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>



                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Status*</strong></label>

                            {{ Form::select('status', [

                                '1' => 'Ativo', '0' => 'Inativo'

                            ], null, ['class' => 'form-control form-control-lg '.( $errors->has('status') ? ' is-invalid' : '' )]) }}

                            @error('status')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Gerente Vinculado*</strong></label>

                            {{ Form::select('idgerente', $arrayUsuarios, null, ['class' => 'form-control form-control-lg '.( $errors->has('idgerente') ? ' is-invalid' : '' )]) }}

                            @error('idgerente')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>







                        <div class="form-group col-sm-6">

                            <label class="mb-1"><strong>Email*</strong></label>

                            {{ Form::text('email', null, ['class' => 'form-control form-control-lg '.( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o email desse usuário', 'id' => 'email']) }}

                            @error('email')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-sm-6">

                            <label class="mb-1"><strong>Senha*</strong></label>

                            {{ Form::password('password', ['class' => 'form-control form-control-lg '.( $errors->has('password') ? ' is-invalid' : '' ), 'id' => 'password']) }}

                            @error('password')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                    </div>



                    <h4 class="card-title mt-5">Comissões</h4>



                    <div class="row">

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 1 jogo*</strong></label>

                            {{ Form::select('comissao1jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao1jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao1jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao1jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 2 jogos*</strong></label>

                            {{ Form::select('comissao2jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao2jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao2jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao2jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 3 jogos*</strong></label>

                            {{ Form::select('comissao3jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao3jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao3jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao3jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 4 jogos*</strong></label>

                            {{ Form::select('comissao4jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao4jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao4jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao4jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 5 jogos*</strong></label>

                            {{ Form::select('comissao5jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao5jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao5jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao5jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 6 jogos*</strong></label>

                            {{ Form::select('comissao6jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao6jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao6jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao6jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 7 jogos*</strong></label>

                            {{ Form::select('comissao7jogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao7jogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao7jogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao7jogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Para apostas com 8 ou mais jogos*</strong></label>

                            {{ Form::select('comissao8maisjogo', [

                                '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                '30' => '30%'

                            ], $comissoes[0]->comissao8maisjogo, ['class' => 'form-control form-control-lg '.( $errors->has('comissao8maisjogo') ? ' is-invalid' : '' )]) }}

                            @error('comissao8maisjogo')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                    </div>





                    {{ Form::close() }}

                </div>

                <div class="card-footer">

                    <button class="btn btn-outline-primary" type="button" id="btn1">

                        <i class="fa fa-save"></i> Salvar

                    </button>

                </div>

            </div>

        </div>



    </div>

</div>

</div>







    @yield('footer')

</div>



<!-- Required vendors -->







    <!-- Required vendors -->

	<script src="/assets2/vendor/apexchart/apexchart.js"></script>

    <script src="/assets2/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script src="/assets2/js/plugins-init/datatables.init.js"></script>



    <script src="https://unpkg.com/imask"></script>



    <script type="text/javascript">

        var element = document.getElementById('cpf');

        var maskOptions = {

            mask: '000.000.000-00'

        };

        var mask = IMask(element, maskOptions);



        var element = document.getElementById('data_nascimento');

        var maskOptions = {

            mask: '00/00/0000'

        };

        var mask2 = IMask(element, maskOptions);

    </script>



    <script type="text/javascript">

        $(document).ready(function(e){

            $('#btn1').click(function(e){

                $('#btn1').attr('disabled', 'disabled');

                $('#form1').submit();

            });

        });

    </script>



</body>

</html>

