

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

    <h4 class="card-title">País</h4>

    <p class="mb-0 subtitle">Editar dados</p>

</div>

<div class="card-body">

    {{ Form::model($sql, ['url' => ['admin/api/paises/editar', $sql->id], 'id' => 'form1']) }}

    <div class="row">



        <div class="form-group col-sm-12">

            <label class="mb-1"><strong>Nome Original*</strong></label>

            {{ Form::text('nome', null, ['class' => 'form-control form-control-lg '.( $errors->has('nome_original') ? ' is-invalid' : '' ), 'placeholder' => '', 'readonly' => 'readonly']) }}

            @error('nome_original')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>

        <div class="form-group col-sm-6">

            <label class="mb-1"><strong>Nome Traduzido*</strong></label>

            {{ Form::text('nome_traduzido', null, ['class' => 'form-control form-control-lg '.( $errors->has('nome_traduzido') ? ' is-invalid' : '' ), 'placeholder' => 'Tradução do nome original']) }}

            @error('nome_traduzido')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>

        <div class="form-group col-sm-6">

            <label class="mb-1"><strong>Bandeira*</strong></label>

            {{ Form::text('bandeira', null, ['class' => 'form-control form-control-lg '.( $errors->has('bandeira') ? ' is-invalid' : '' ), 'placeholder' => 'Ex.: brazil.png']) }}

            @error('bandeira')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>



        <div class="form-group col-md-6 col-sm">

            <label class="mb-1"><strong>Status*</strong></label>

            {{ Form::select('status', [

                '1' => 'Ativo', '0' => 'Inativo'

            ], null, ['class' => 'form-control form-control-lg '.( $errors->has('status') ? ' is-invalid' : '' )]) }}

            @error('status')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>

        <div class="form-group col-md-6 col-sm">

            <label class="mb-1"><strong>Destaque Menu*</strong></label>

            {{ Form::select('destaque', [

                '1' => 'Destaque', '0' => 'Sem destaque'

            ], null, ['class' => 'form-control form-control-lg '.( $errors->has('destaque') ? ' is-invalid' : '' )]) }}

            @error('destaque')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

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

