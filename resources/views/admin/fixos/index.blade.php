

@include('admin.include')
<link href="/assets2/vendor/summernote/summernote.css" rel="stylesheet">

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

    <h4 class="card-title">Campos Fixos</h4>

    <p class="mb-0 subtitle">Editar campos</p>

</div>

<div class="card-body">

    {{ Form::model($sql[0], ['url' => ['admin/fixos', ''], 'id' => 'form1']) }}

    <div class="row">
        <div class="form-group col-sm-12">
            <label for="nome_banca">Nome da banca</label>
            <input type="text" class="form-control" id="nome_banca" name="nome_banca" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="valor-minimo-aposta">Valor minimo por aposta (R$)</label>
            <input type="num" class="form-control" id="valor-minimo-aposta" name="valor-minimo-aposta" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="valor-maximo-aposta">Valor máximo por aposta (R$)</label>
            <input type="num" class="form-control" id="valor-maximo-aposta" name="valor-maximo-aposta" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="valor-maximo-aposta">Valor máximo por aposta (Ao Vivo) (R$)</label>
            <input type="num" class="form-control" id="valor-minimo-aposta-av" name="valor-maximo-aposta-av" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="premio-maximo">Prêmio Máximo (R$)</label>
            <input type="num" class="form-control" id="premio-maximo" name="premio-maximo" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="cotacao-maxima">Cotação minima no bilhete</label>
            <input type="num" class="form-control" id="cotacao-minima" name="cotacao-minima" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="nao-pagar-comissao-menor">Não pagar comissão em apostas com cota menor que</label>
            <input type="num" class="form-control" id="nao-pagar-comissao-menor" name="nao-pagar-comissao-menor" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="cotacao-maxima">Cotação máxima no bilhete</label>
            <input type="num" class="form-control" id="cotacao-maxima" name="cotacao-maxima" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="nao-exibir-cotacao-menor">Não exibir cotações menores que</label>
            <input type="num" class="form-control" id="nao-exibir-cotacao-menor" name="nao-exibir-cotacao-menor" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="quantidade-minima-jogos">Quantidade minima de jogos por bilhete</label>
            <input type="num" class="form-control" id="quantidade-minima-jogos" name="quantidade-minima-jogos" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="quantidade-maxima-times-v">Quantidade máxima de times visitantes do mesmo campeonato por bilhete</label>
            <input type="num" class="form-control" id="quantidade-maxima-times-v" name="quantidade-maxima-times-v" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="texto-rodape">Texto rodapé bilhete</label>
            <textarea class="form-control" id="texto-rodape" rows="3"></textarea>
        </div>
        <div class="form-group col-sm-12">

            <label class="mb-1"><strong>Regulamento*</strong></label>

            {{ Form::textarea('regulamento', null, ['class' => 'summernote form-control form-control-lg '.( $errors->has('regulamento') ? ' is-invalid' : '' ), 'placeholder' => 'Digite aqui o texto do regulamento']) }}

            @error('regulamento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>



        <div class="form-group col-sm-12">

            <label class="mb-1"><strong>Rodapé*</strong></label>

            {{ Form::textarea('rodape_cupom', null, ['class' => 'form-control form-control-lg '.( $errors->has('rodape_cupom') ? ' is-invalid' : '' ), 'placeholder' => 'Digite aqui o rodapé']) }}

            @error('rodape_cupom')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>



    </div>





</div>

<div class="card-footer">

    <button class="btn btn-outline-primary" type="button" id="btn1">

        <i class="fa fa-save"></i> Salvar

    </button>

</div>

</div>


</div>

<!-- Fim -->
 </div>

@yield('footer')

    


	<script src="/assets2/vendor/apexchart/apexchart.js"></script>



    <script src="/assets2/vendor/summernote/js/summernote.min.js"></script>

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

            $('input[name=valor-minimo-aposta]').maskMoney({

            prefix: 'R$ ',

            thousands: '.',

            decimal: ','

            });


            $(".summernote").summernote({

                height: 190,

                minHeight: null,

                maxHeight: null,

                focus: !1

            }), $(".inline-editor").summernote({

                airMode: !0

            });

        });

    </script>



</body>

</html>

