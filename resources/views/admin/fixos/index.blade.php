

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
            <input type="text" class="form-control" id="nome_banca" name="nome_banca" value="{{$sql[0]->nome_banca}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone"value="{{$sql[0]->telefone}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="valor-minimo-aposta">Valor minimo por aposta (R$)</label>
            <input type="text" class="form-control" id="valor-minimo-aposta" name="valor-minimo-aposta"value="{{$sql[0]->valor_minimo_aposta}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="valor-maximo-aposta">Valor m??ximo por aposta (R$)</label>
            <input type="text" class="form-control" id="valor-maximo-aposta" name="valor-maximo-aposta"value="{{$sql[0]->valor_maximo_aposta}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <!-- <label for="valor-maximo-aposta">Valor m??ximo por aposta (Ao Vivo) (R$)</label> -->
            <input type="hidden" class="form-control" id="valor-maximo-aposta-av" name="valor-maximo-aposta-av" value="{{$sql[0]->premio_maximo}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="premio-maximo">Pr??mio M??ximo (R$)</label>
            <input type="text" class="form-control" id="premio-maximo" name="premio-maximo"value="{{$sql[0]->nao_pagar_comissao_menor}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="cotacao-maxima">Cota????o minima no bilhete</label>
            <input type="number" class="form-control" id="cotacao-minima" name="cotacao-minima"value="{{$sql[0]->cotacao_minima}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="nao-pagar-comissao-menor">N??o pagar comiss??o em apostas com cota menor que</label>
            <input type="number" class="form-control" id="nao-pagar-comissao-menor" name="nao-pagar-comissao-menor"value="{{$sql[0]->nao_exibir_cotacao_menor}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="cotacao-maxima">Cota????o m??xima no bilhete</label>
            <input type="number" class="form-control" id="cotacao-maxima" name="cotacao-maxima" value="{{$sql[0]->cotacao_maxima}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="nao-exibir-cotacao-menor">N??o exibir cota????es menores que</label>
            <input type="number" class="form-control" id="nao-exibir-cotacao-menor" name="nao-exibir-cotacao-menor"value="{{$sql[0]->nao_exibir_cotacao_menor}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="nao-exibir-cotacao-menor">N??o exibir cota????es maiores que</label>
            <input type="number" class="form-control" id="nao-exibir-cotacao-maior" name="nao-exibir-cotacao-maior"value="{{$sql[0]->nao_exibir_cotacao_maior}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <label for="quantidade-minima-jogos">Quantidade minima de jogos por bilhete</label>
            <input type="number" class="form-control" id="quantidade-minima-jogos" name="quantidade-minima-jogos"value="{{$sql[0]->quantidade_minima_jogos}}" aria-describedby="emailHelp">
        </div>
        <div class="form-group col-sm-12">
            <!-- <label for="quantidade-maxima-times-v">Quantidade m??xima de times visitantes do mesmo campeonato por bilhete</label> -->
            <input type="hidden" class="form-control" id="quantidade-maxima-times-v" name="quantidade-maxima-times-v"value="{{$sql[0]->quantidade_maxima_times_v}}" aria-describedby="emailHelp">
        </div>

        <div class="form-group col-sm-12">

            <label class="mb-1"><strong>Regulamento*</strong></label>

            {{ Form::textarea('regulamento', null, ['class' => 'summernote form-control form-control-lg '.( $errors->has('regulamento') ? ' is-invalid' : '' ), 'placeholder' => 'Digite aqui o texto do regulamento']) }}

            @error('regulamento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>
        <div class="form-group col-sm-12">

            <label for="texto-rodape">Pagamento Deposito</label>


            {{ Form::textarea('pagamento', null, ['class' => 'summernote form-control form-control-lg '.( $errors->has('pagamento') ? ' is-invalid' : '' ), 'placeholder' => 'Digite aqui suas forma de pagamento']) }}

            @error('pagamento')<div class="invalid-feedback animated fadeInUp">{{ $message }}</div>@enderror

        </div>

        <div class="form-group col-sm-12">

            <label for="texto-rodape">Rodap?? bilhete</label>


            {{ Form::textarea('rodape_cupom', null, ['class' => 'summernote form-control form-control-lg '.( $errors->has('rodape_cupom') ? ' is-invalid' : '' ), 'placeholder' => 'Digite aqui o rodap??']) }}

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
            $(".summernote").summernote({

                height: 190,

                minHeight: null,

                maxHeight: null,

                focus: !1

            });

            // $('input[name=valor-minimo-aposta]').maskMoney({

            // prefix: 'R$ ',

            // thousands: '.',

            // decimal: ','

            // });

            // $('input[name=valor-maximo-aposta]').maskMoney({

            // prefix: 'R$ ',

            // thousands: '.',

            // decimal: ','

            // });
            
            // $('input[name=premio-maximo]').maskMoney({

            // prefix: 'R$ ',

            // thousands: '.',

            // decimal: ','

            // });
            
            // $('input[name=valor-maximo-aposta-av]').maskMoney({

            // prefix: 'R$ ',

            // thousands: '.',

            // decimal: ','

            // });
            // $('input[name=premio-maximo]').maskMoney({

            // prefix: 'R$ ',

            // thousands: '.',

            // decimal: ','

            // });
            

        });

    </script>



</body>

</html>

