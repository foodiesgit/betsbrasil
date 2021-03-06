

    @include('admin.include')




        @yield('header')

        <div class="main-content" id="panel">

		@yield('nav')
		@yield('alert')

        <div class="content-body btn-page">

            <div class="container-fluid">

                <!-- row -->

                <div class="row">

                    <div class="col-lg-12">


                        <div class="card">

                            <div class="card-header d-block">

                                <h4 class="card-title">Gerente</h4>

                                <p class="mb-0 subtitle">Dados do novo gerente</p>

                            </div>

                            <div class="card-body">

                                {{ Form::model($sql[0], ['url' => ['admin/gerentes/editar', $sql[0]->id], 'id' => 'form1']) }}

                                <div class="row">



                                    <div class="form-group col-sm-12">

                                        <label class="mb-1"><strong>Nome Completo*</strong></label>

                                        {{ Form::text('name', null, ['class' => 'form-control form-control-lg '.( $errors->has('nome') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o nome completo desse gerente']) }}

                                        @error('name')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

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



                                    <div class="form-group col-md-12 col-sm-12">

                                        <label class="mb-1"><strong>Status*</strong></label>

                                        {{ Form::select('status', [

                                            '1' => 'Ativo', '0' => 'Inativo'

                                        ], null, ['class' => 'form-control form-control-lg '.( $errors->has('status') ? ' is-invalid' : '' )]) }}

                                        @error('status')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                    </div>



                                    <div class="form-group col-md-12 col-sm-12">

                                        <label class="mb-1"><strong>Comissão*</strong></label>

                                        {{ Form::select('comissao', [

                                            '0' => '0%', '1' => '1%','2' => '2%', '3' => '3%','4' => '4%', '5' => '5%',

                                            '6' => '6%', '7' => '7%','8' => '8%', '9' => '9%','10' => '10%', '11' => '11%',

                                            '12' => '12%', '13' => '13%','14' => '14%', '15' => '15%','16' => '16%', '17' => '17%',

                                            '18' => '18%', '19' => '19%','20' => '20%', '21' => '21%','22' => '22%', '23' => '23%',

                                            '24' => '24%', '25' => '25%','26' => '26%', '27' => '27%','28' => '28%', '29' => '29%',

                                            '30' => '30%'

                                        ], null, ['class' => 'form-control form-control-lg '.( $errors->has('comissao') ? ' is-invalid' : '' )]) }}

                                        @error('comissao')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                    </div>



                                    <div class="form-group col-sm-6">

                                        <label class="mb-1"><strong>Email*</strong></label>

                                        {{ Form::text('email', null, ['class' => 'form-control form-control-lg '.( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o email desse usuário', 'id' => 'email']) }}

                                        @error('email')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                    </div>

                                    <div class="form-group col-sm-6">

                                        <label class="mb-1"><strong>Senha</strong></label>

                                        {{ Form::password('password', ['class' => 'form-control form-control-lg '.( $errors->has('password') ? ' is-invalid' : '' ), 'id' => 'password']) }}

                                        @error('password')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                                    </div>

                                </div>



                                <h4 class="card-title mt-5">Selecione as Permissões para esse Gerente</h4>



                                <div class="row">

                                    <div class="col-12">

                                        <div class="custom-control custom-checkbox mb-3 checkbox-info">

                                            <input type="checkbox" class="custom-control-input" id="checkbox_op1" name="checkbox_op1" value="1">

                                            <label class="custom-control-label" for="checkbox_op1">Pode Criar Cambistas</label>

                                        </div>

                                    </div>

                                    <div class="col-12">

                                        <div class="custom-control custom-checkbox mb-3 checkbox-info">

                                            <input type="checkbox" class="custom-control-input" id="checkbox_op2" name="checkbox_op2" value="1">

                                            <label class="custom-control-label" for="checkbox_op2">Pode Alterar Cambistas</label>

                                        </div>

                                    </div>

                                    <div class="col-12">

                                        <div class="custom-control custom-checkbox mb-3 checkbox-info">

                                            <input type="checkbox" class="custom-control-input" id="checkbox_op3" name="checkbox_op3" value="1">

                                            <label class="custom-control-label" for="checkbox_op3">Pode Editar as Apostas dos Cambistas</label>

                                        </div>

                                    </div>

                                    <div class="col-12">

                                        <div class="custom-control custom-checkbox mb-3 checkbox-info">

                                            <input type="checkbox" class="custom-control-input" id="checkbox_op4" name="checkbox_op4" value="1">

                                            <label class="custom-control-label" for="checkbox_op4">Pode Editar os Limites dos Cambistas</label>

                                        </div>

                                    </div>

                                    <div class="col-12">

                                        <div class="custom-control custom-checkbox mb-3 checkbox-info">

                                            <input type="checkbox" class="custom-control-input" id="checkbox_op5" name="checkbox_op5" value="1">

                                            <label class="custom-control-label" for="checkbox_op5">Pode Transferir Saldo dos Cambistas</label>

                                        </div>

                                    </div>

                                </div>

        

                                {{ Form::hidden('pode_criar_cambistas', isset($campos->pode_criar_cambistas) ? $campos->pode_criar_cambistas : '' , []) }}

                                {{ Form::hidden('pode_alterar_cambistas',  isset($campos->pode_alterar_cambistas) ? $campos->pode_alterar_cambistas : '', []) }}

                                {{ Form::hidden('pode_editar_apostas_cambistas', isset($campos->pode_editar_apostas_cambistas) ? $campos->pode_editar_apostas_cambistas : '', []) }}

                                {{ Form::hidden('pode_editar_limite_cambistas', isset($campos->pode_editar_limite_cambistas) ? $campos->pode_editar_limite_cambistas : '', []) }}

                                {{ Form::hidden('pode_transferencia_cambistas',isset($campos->pode_transferencia_cambistas) ? $campos->pode_transferencia_cambistas : '', []) }}



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
    </div>

        @yield('footer')

        <!--**********************************

            Content body start

        ***********************************-->

   

    <!-- Required vendors -->






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



            var pode_criar_cambistas = $('input[name=pode_criar_cambistas]').val();

            var pode_alterar_cambistas = $('input[name=pode_alterar_cambistas]').val();

            var pode_editar_apostas_cambistas = $('input[name=pode_editar_apostas_cambistas]').val();

            var pode_editar_limite_cambistas = $('input[name=pode_editar_limite_cambistas]').val();

            var pode_transferencia_cambistas = $('input[name=pode_transferencia_cambistas]').val();



            if( pode_criar_cambistas == 1 ){

                $('#checkbox_op1').attr('checked', 'checked');

            }



            if( pode_alterar_cambistas == 1 ){

                $('#checkbox_op2').attr('checked', 'checked');

            }



            if( pode_editar_apostas_cambistas == 1 ){

                $('#checkbox_op3').attr('checked', 'checked');

            }



            if( pode_editar_limite_cambistas == 1 ){

                $('#checkbox_op4').attr('checked', 'checked');

            }



            if( pode_transferencia_cambistas == 1 ){

                $('#checkbox_op5').attr('checked', 'checked');

            }

        });

    </script>



</body>

</html>

