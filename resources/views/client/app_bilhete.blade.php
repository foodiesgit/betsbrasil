<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Título Opcional</title>
 
        <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    </head>
    <body>
         
 
<style type="text/css">

.recibo{

  font-family: verdana;  

}



p{

  color: black;

  font-size: 10px;

}



th {

  font-size: 12px;

  color:black;

}



/* Small devices (tablets, 768px and up) */

@media (min-width: @screen-sm-min) { 

  .desktop{ display: none !important; }

}



/* Medium devices (desktops, 992px and up) */

@media (min-width: @screen-md-min) { 

  .mobile{ display: none !important; }

}





/* Large devices (large desktops, 1200px and up) */

@media (min-width: @screen-lg-min) { 

  .mobile{ display: none !important; }



}



h5{

  display:block;

  color:#000000;

  border-top:1px dotted #626261;

  border-bottom:1px dotted #6B6B6B;

  letter-spacing: 4px;

}

h6{

  color:#626261;

}

hr{

  border-bottom:1px dotted #6B6B6B;

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



</style>

<?php // $code =  base64_encode($ticket[0]->ativacao_code) ; ?>




      <section class="section section-sm bg-gray-100">

        <div class="container">

          <div class="row isotope-wrap row-30">

            <!-- Isotope Filters-->

            <div class="col-lg-12">

              <div class="isotope-filters isotope-filters-horizontal">

                <button class="btn btn-success btn-block voyager-print" onclick="printDiv('bilhete')"><div class="isotope-filters-info">

                  <p style="color:white;">Imprimir Bilhete</p>

                </div></button>

              </div>



            <div id="bilhete" style="background-color: #f5f5db; padding: 5px;" align="left">



             <h6 class="text-center destaque"> Nome do $sql_time_home</h6>

             <h5 class="text-center titulo">Detalhe da Aposta</h5>

             <p><span class="titulo">Hora:</span><b> {{date('d/m/Y H:i:s')}}</b></p>

             <p><span class="titulo">Nome Cliente:</span> Nome do Cliente</p>

             <p><span class="titulo">Vendedor:</span> Nome do Cambista</p>

             <h5 class="text-center titulo">Jogos</h5>



             <table align="center">

              <thead>

                <tr class="linha">

                  <th style="width:90%;">Aposta</th>

                  <th>Cotação</th>

                </tr>

              </thead>

              <tbody>
                @foreach($cupomApostaItem as $bilhete)

                <tr>

                  <td><br>

                    <p class="destaque">Nome da partida </p>

                    <p><small>Data :</small></p>

                    <p>Palpite: <span class="destaque">Palpite</span></p>

                  </td>

                  <!-- cotação -->

                  <td class="text-center"><p>3.00</p></td>

                </tr>



                @endforeach



                <tr>

                  <td class="text-right"><p>Total Apostado R$</p> </td>

                  <td class="text-center"><p>10.000</p></td>

                </tr>

                <tr>

                  <td class="text-right"><p>Possiveis Ganhos R$</p></td>

                  <td class="text-center"><p>50.0000</p></td>

                </tr>



              </tbody>

            </table>



            <div class="text-center campo_codigo">

             <p>Codigo de Ativação<br><span class="codigo_ativ">0000000000</span></p>

           </div>

           <div class="text-center">

             <p>Para validar sua aposta envie o código de ativação para o seu revendedor! <br> O revendedor efetuará a ativação após o pagamento</p>

           </div>

            </div>

         </div>

       </div>



     </div>

   </div>

 </div>

</div>






</body></html>

