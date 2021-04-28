
    @include('admin.include')

    @yield('header')


    <div class="main-content" id="panel">


        @yield('nav')

        <div class="content-body btn-page">

<div class="container-fluid">

    <!-- row -->

    <div class="row">

        <div class="col-lg-12">
        @yield('alert')

            <div class="card">

                <div class="card-header d-block">

                    <h4 class="card-title">Lançamento</h4>

                    <p class="mb-0 subtitle">Digite os dados para realizar um lançamento</p>

                </div>

                <div class="card-body">

                    {{ Form::open(['url' => 'admin/cambistas/caixa/lancamentos/'.$dados_usuario[0]->id.'', 'id' => 'form1']) }}

                    <div class="row">



                        <div class="form-group col-lg-6 col-md-12">

                            <label class="mb-1"><strong>Tipo de Lançamento*</strong></label>

                            {{ Form::select('idtipo_lancamento', [

                                '5' => 'Lançamento Saldo Liberado',

                                '6' => 'Lançamento Saldo Bloqueado',

                                '7' => 'Lançamento Saldo Aposta'

                            ],null, ['class' => 'form-control form-control-lg '.( $errors->has('idtipo_lancamento') ? ' is-invalid' : '' )]) }}

                            @error('idtipo_lancamento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

                        </div>

                        <div class="form-group col-lg-6 col-md-12">

                            <label class="mb-1"><strong>Valor para lançamento</strong></label>

                            {{ Form::text('valor', null, ['class' => 'form-control form-control-lg '.( $errors->has('valor') ? ' is-invalid' : '' ), 'placeholder' => 'Digite o valor', 'id' => 'valor']) }}

                            @error('valor')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

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


    <!-- Required vendors -->



	<script src="/assets2/vendor/apexchart/apexchart.js"></script>

    <script src="/assets2/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script src="/assets2/js/plugins-init/datatables.init.js"></script>



    <script src="/assets2/js/jquery.maskMoney.min.js"></script>



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



            $('input[name=valor]').maskMoney({

                prefix: 'R$ ',

                thousands: '.',

                decimal: ','

            });

        });

    </script>



</body>

</html>

