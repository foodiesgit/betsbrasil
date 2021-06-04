<!DOCTYPE html>
<?php $config =\DB::table('campos_fixos')->first(); ?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$config->nome_banca}} - {{$cupomAposta->codigo_unico}}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    </head>
    <body>
         
 
<style type="text/css">

@page { 
size: 88mm 500mm; 
}

p{

  color: black;

  font-size: 10px;

}



th {

  font-size: 12px;

  color:black;

}


h5{

  display:block;

  color:#000000;

  border-top:1px dotted #626261;

  border-bottom:1px dotted #6B6B6B;

  /* letter-spacing: 4px; */

}

h6{

  color:#626261;

}

hr{

  border-bottom:1px dotted #6B6B6B;

}
p {
  margin: 1px;
}
.linha{

  border-bottom:1px dotted #6B6B6B;

}

.titulo{

  text-transform: uppercase;

}

.destaque{

  font-weight: bold;

}

.codigo_ativ{

  font-weight: bold;

  font-size:40px;

}

.campo_codigo{

  border:1px dotted #6B6B6B;

}

.hr{
  border-bottom:1px dotted #6B6B6B;
}

</style>

<?php // $code =  base64_encode($ticket[0]->ativacao_code) ; ?>




<div id="bilhete" style="background-color: #f5f5db; padding: 5px;" align="center">


<img src="http://novobets.tk/logo_principal.png" align="center" width="106" height="41"/>

<!-- <h6 class="text-center destaque">{{$config->nome_banca}}</h6> -->
<div align="left">
<h5 class="text-center titulo">Detalhe da Aposta</h5>

<p><span class="titulo">Hora:</span><b> {{$cupomAposta->data_aposta}}</b></p>

<p><span class="titulo">Nome Cliente:</span>{{$cupomAposta->name}}</p>

<p><span class="titulo">Cambista:</span>{{$cupomAposta->cambistaName}}</p>

<h5 class="text-center titulo">Jogos</h5>


</div>



<table style="table-layout: fixed; min-width:100%">

<thead>

<tr>
    <th>Suas apostas</th>
</tr>

</thead>

<tbody>
@foreach($cupomApostaItem as $bilhete)

<tr>

    <td class="hr">
    <p>{{\Carbon\Carbon::parse($bilhete->data)->format('d/m/Y H:i:s')}}</p>
    <p class="destaque">{{$bilhete->nome_esporte}} - {{$bilhete->nome_liga}}</p>
    <p class="destaque">{{$bilhete->time_home}} x  {{$bilhete->time_away}}</p>
    <p><span class="destaque">{{$bilhete->subgrupo}} - {{$bilhete->name}}</span></p>
    <p><span class="destaque">Cotação:{{$bilhete->valor_momento}}</span></p>



</tr>



@endforeach



<tr>

    <td><p class="destaque">Total Apostado: R$ {{number_format($cupomAposta->valor_apostado,2,'.',',')}}</p> </td>

</tr>

<tr>

    <td><p class="destaque">Possiveis Ganhos: R$ {{number_format($cupomAposta->possivel_retorno,2,'.',',')}}</p></td>

</tr>



</tbody>

</table>



<div class="text-center campo_codigo">

<p>Codigo de Ativação<br><span class="codigo_ativ">{{$cupomAposta->codigo_unico}}</span></p>

</div>

<div class="text-center">

<p>Para validar sua aposta envie o código de ativação para o seu revendedor! <br> O revendedor efetuará a ativação após o pagamento</p>

</div>

</div>






</body></html>

