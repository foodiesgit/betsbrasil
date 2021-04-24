

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

            @yield('alert')
            

            <div class="card">

                <div class="card-header d-block">

                    <h4 class="card-title">Usuários</h4>

                    <p class="mb-0 subtitle">Editar dados</p>

                </div>

                <div class="card-body">

                    {{ Form::model($sql, ['url' => ['admin/usuarios/editar', $sql->id], 'id' => 'form1']) }}

                    <div class="row">



                        <div class="form-group col-sm-12">

                            <label class="mb-1"><strong>Nome Completo*</strong></label>

                            {{ Form::text('name', null, ['class' => 'form-control form-control-lg '.( $errors->has('nome') ? ' is-invalid' : '' ), 'placeholder' => 'Nome completo do usuário']) }}

                            @error('name')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>



                        <div class="form-group col-md-4 col-sm-12">

                            <label class="mb-1"><strong>CPF*</strong></label>

                            {{ Form::text('cpf', null, ['class' => 'form-control form-control-lg '.( $errors->has('cpf') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o CPF desse usuário', 'id' => 'cpf']) }}

                            @error('cpf')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>



                        <div class="form-group col-md-4 col-sm-12">

                            <label class="mb-1"><strong>Data de Nascimento*</strong></label>

                            {{ Form::text('data_nascimento', null, ['class' => 'form-control form-control-lg '.( $errors->has('data_nascimento') ? ' is-invalid' : '' ), 'placeholder' => 'Ex.: 01/01/1980', 'id' => 'data_nascimento']) }}

                            @error('data_nascimento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>



                        <div class="form-group col-md-4 col-sm">

                            <label class="mb-1"><strong>Status*</strong></label>

                            {{ Form::select('status', [

                                '1' => 'Ativo', '2' => 'Suspenso'

                            ], null, ['class' => 'form-control form-control-lg '.( $errors->has('status') ? ' is-invalid' : '' )]) }}

                            @error('status')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>



                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Email *</strong></label>

                            {{ Form::text('email', null, ['class' => 'form-control form-control-lg '.( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o email do usuário']) }}

                            @error('email')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-md-6 col-sm-12">

                            <label class="mb-1"><strong>Senha *</strong></label>

                            {{ Form::password('password', ['class' => 'form-control form-control-lg '.( $errors->has('password') ? ' is-invalid' : '' ), 'placeholder' => 'Se quiser alterar a senha do cliente, digite a nova senha aqui']) }}

                            @error('password')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

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





