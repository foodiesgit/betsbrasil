

@include('admin.include')

@yield('header')
<div class="main-content" id="panel">

@yield('nav')
<div class="header bg-dark pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">

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

    <div class="card" style="height: auto;">

        <div class="card-header d-block">

            <h4 class="card-title">Validar Bilhete Avulso</h4>

        </div>

        <div class="card-body">
        @yield('alert')
            <form action="/admin/validar-bilhete" method="post" >
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Codigo do Bilhete</label>
                    <input type="text" class="form-control" name="bilhete" id="bilhete">
                    <small id="emailHelp" class="form-text text-muted">Informe o codigo de acesso que se encontra em seu bilhete</small>
                    </br>
                    <button type="submit" id="btnVerificar" class="btn btn-primary">Verificar</button>
                </div>
            </form>
            
        </div>

        </div>

    </div>
</div>


</div>
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


