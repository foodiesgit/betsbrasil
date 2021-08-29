

    @include('admin.include')

@yield('header')
<div class="main-content" id="panel">
<style>
     .tabela {
        margin: 50px auto;
        width:70%
     }
 </style>    

    @yield('nav')

<div class="header bg-dark pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container-fluid mt--6">
@yield('alert')

<div class="card">

<div class="card-header d-block">

    <h4 class="card-title">Cambistas</h4>

    <p class="mb-0 subtitle">Resumo dos Cambistas Cadastrados</p>

</div>

<div class="card-body">

    <div class="table-responsive">

        <table id="cambista" class="table table-striped table-bordered table-sm tabela" width="70%">

            <thead>

                <tr>

                    <td><center>ID</td>
                    <td><center>Nome</td>
                    <td><center>Email</td>
                    <td><center>Entrada</td>
                    <td><center>Saida</td>                  
                    <td><center>Lançamentos</td>
                    <td><center>Comissão</td>
                    <td><center>Status</td>
                    <td><center>Ações</td>

                </tr>

            </thead>

        </table>

    </div>

</div>

</div>
</div>
<div class="modal fade" id="caixa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Caixa cambista <spam id="cambistaNome"></spam></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table">
        <tbody>
          <tr>
            <td>Entrada</td>

            <td id="entrada"></td>
          </tr>
          <tr>
          <td>Saida</td>

            <td id="saida"></td>
          </tr>

          <tr>
          <td>Comissão</td>

            <td id="comissao"></td>
          </tr>
          <td>Lançamentos</td>

          <td id="lancamento"></td>
          <td>Total</td>

          <td id="total"></td>
          </tr>

        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="fecharCaixa" href="" >Fechar Caixa</button>
      </div>
    </div>
  </div>
</div>

    @yield('footer')

<script type="text/javascript">

    $(document).ready(function(e){

        var saldo1 = $('input[name=saldo1]').val();

        var saldo2 = $('input[name=saldo2]').val();

        var saldo3 = $('input[name=saldo3]').val();



        $('#saldo1').html( saldo1 );

        $('#saldo2').html( saldo2 );

        $('#saldo3').html( saldo3 );



        var table = $('#cambista').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            ordering: false,
            info: false,

            ajax: "/admin/ajaxviewcambista",
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'entrada',
                    name: 'entrada',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'saida',
                    name: 'saida',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'lancamento',
                    name: 'lancamento',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'comissao',
                    name: 'comissao',
                    orderable: false,
                    searchable: true
                },

                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action'
                },
                
            ]
        });
        $('#caixa').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nome = button.data('nome') // Extract info from data-* attributes
        var id = button.data('id') // Extract info from data-* attributes
        var entrada = button.data('entrada') // Extract info from data-* attributes
        var comissao = button.data('comissao') // Extract info from data-* attributes
        var lancamento = button.data('lancamento') // Extract info from data-* attributes
        var saida = button.data('saida') // Extract info from data-* attributes
        var total = button.data('total') // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Caixa Cambista ' + nome)
        modal.find('#comissao').html('<span>'+comissao+'</span>'); 
        modal.find('#entrada').html('<span>'+entrada+'</span>'); 
        modal.find('#saida').html('<span class="badge badge-danger">'+saida+'</span>'); 
        modal.find('#lancamento').html('<span class="badge badge-danger">'+lancamento+'</span>'); 
        modal.find('#total').html('<span class="badge badge-danger">'+total+'</span>'); 
        modal.find('#fecharCaixa').attr('href','/admin/cambistas/caixa/historico/'+id); 

        // modal.find('.modal-body input').val(recipient)
})
        
        // $('.caixa').click(function(e){

        // var id = $(this).attr('data-id');
        // console.log(id);

        // var comissao = $(this).attr('data-comissao');
        // var entrada = $(this).attr('data-entrada');
        // var saida = $(this).attr('data-saida');
        // var nome = $(this).attr('data-nome');
        // var id = $(this).attr('data-id');
        // $('#cambistaNome').html(nome); 
        // $('#comissao').html(comissao);
        // $('#entrada').html(entrada);
        // $('#saida').html(saida);
        // });
    });

</script>

