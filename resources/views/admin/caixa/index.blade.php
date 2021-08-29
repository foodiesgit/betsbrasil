
    @include('admin.include')
    @yield('nav')
    @yield('header')

    <?php $config =\DB::table('campos_fixos')->first(); ?>
    <div class="main-content" id="panel">
<style>
.apostas_container {
    margin: 20px;
    width: calc(30% - 30px);
    background-color: #f1f3f9;
    padding: 5px;
    display: inline-block;
    margin-bottom: 60px;
    box-sizing: border-box;
    position: relative;
}

.linkNoClicable {
    font-family: 'Source Sans Pro', sans-serif;
    color: rgb(68, 68, 68);
    text-align: center;
    text-decoration: none;
    height: 70px;
    width: 100%;
    border-bottom: 1px solid rgb(230,230,230);
    font-size: 17px;
    font-weight: 600;
    display: block;
    padding: 20px;
    box-sizing: border-box;
}
.jogos_container {
    margin: 15px;
    width: calc(65% - 30px);
    background-color: #f1f3f9;
    padding: 5px;
    display: inline-block;
    margin-bottom: 60px;
    box-sizing: border-box;
    position: relative;
    float: right;
}
lado {
    width: 100px;
    height: 100px;
    display: inline-block;
}

</style>

        <div class="header bg-dark pb-6">
        </div>

    <div class="container-fluid mt--6">
        <div class="card">

        <div class="card-header d-block">
            <h4 class="card-title">Caixa - Admin</h4>
        </div>
        <div class="lado">
        <!--  <div class="card-body"> Class da divisoria -->
        <div id="conteudo_divCaixa" class="apostas_container">
        <h2 id="conteudo_H2Lancamentos">Caixa - Administrador</h2>
        <a id="conteudo_lblEntradas" class="linkNoClicable">Entradas<br/>R$ {{number_format($entrada,2,',','.')}} </a>
        <a id="conteudo_lblEntradasAbertas" class="linkNoClicable">Entradas em aberto<br/>R$ {{number_format($entradaPendente,2,',','.')}} </a>
        <a id="conteudo_lblSaidas" class="linkNoClicable">Saídas<br/>R$ {{number_format($saida,2,',','.')}}</a>
        <a id="conteudo_lblLancamentos" class="linkNoClicable">Lançamentos<br/>R$ {{number_format($lancamento,2,',','.')}}</a>
        <a id="conteudo_lblComicoes" class="linkNoClicable">Comissões<br/>R$ {{number_format($comissoes,2,',','.')}}</a>
        <a id="conteudo_lblTotal" class="linkNoClicable">Total<br/>R$ {{number_format($comissao,2,',','.')}}</a>
        </br>
        <a class="linkNoClicable" style="background-color:#3c8dbc; color:white" href="#">Resumo para fechamento</a>
        </div>
        <div id="conteudo_divLancamentos" class="jogos_container">
        <h2 id="conteudo_H2Lancamentos">Lançamentos de caixa</h2>
        <div>
            </div>
        <div>
        </div>

        </div>
    </div>
</div>


@yield('footer')