<?php



namespace App\Http\Controllers;



use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Ixudra\Curl\Facades\Curl;

use Illuminate\Support\Str;

use Validator;

use DB;

use Session;

use Image;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Http;

use Carbon\Carbon;



use App\Usuarios;

use App\Creditos;

use App\Esportes;

use App\Paises;

use App\Ligas;

use App\GerentesCampos;

use App\LancamentosCaixa;

use App\Events;

use App\Times;

use App\Estadios;

use App\Odds;

use App\OddsGrupo;

use App\OddsSubGrupo;

use App\CarrinhoApostas;

use App\CupomAposta;

use App\CupomApostaItem;

use App\NovoCarrinho;

use App\NovoCarrinhoItem;



class CarrinhoController extends Controller{

    public function recuperarCarrinho(){
        $config =\DB::table('campos_fixos')->first(); 

        $sql = NovoCarrinho::leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

            ->leftJoin('events', 'events.id','=','novo_carrinho_item.idevent')

            ->leftJoin('odds', 'odds.id','=','novo_carrinho_item.idodd')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select('novo_carrinho_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'valor_total_cotas', 'valor_total_apostado', 'odds.id as idodds', 'novo_carrinho_item.cota_momento')

            ->where('session_id', session()->getId())->get();



        if(count($sql) > 0){

            $i = 0;

            foreach($sql as $dados){



                $sql_time_home = Times::find($dados->idhome);

                $sql_time_away = Times::find($dados->idaway);



                if($sql_time_home != null){ $sql[$i]->time_home = $sql_time_home->nome; }

                if($sql_time_away != null){ $sql[$i]->time_away = $sql_time_away->nome; }





                $i++;

            }

        }else{

            return response()->json([

                'status' => 'ok',

                'response' => []

            ]);

        }



        $sqlTotal = NovoCarrinho::where('session_id', session()->getId())->get();



        $valor_total_cotas = 0;

        $valor_total_apostado = 0;



        if(count($sqlTotal) > 0){

            $valor_total_cotas = $sqlTotal[0]->valor_total_cotas;

            $valor_total_apostado = $sqlTotal[0]->valor_total_apostado;

        }



        $possivel_retorno = $valor_total_apostado * $valor_total_cotas;

        $possivel_retorno = ($possivel_retorno > $config->premio_maximo &&  $config->premio_maximo != 0 ? $config->premio_maximo: $possivel_retorno);

        $valor_total_cotas = ($valor_total_cotas < $config->cotacao_minima &&  $config->cotacao_minima != 0 ? $config->cotacao_minima:  $valor_total_cotas);

        $valor_total_cotas =  ( $valor_total_cotas > $config->cotacao_maxima &&  $config->cotacao_maxima != 0 ? $config->cotacao_maxima:  $valor_total_cotas);



        return response()->json([

            'status' => 'ok',

            'response' => $sql,

            'valor_total_cotas' => $valor_total_cotas,

            'valor_total_apostado' => $valor_total_apostado,

            'possivel_retorno' => $possivel_retorno,

            'possivel_retorno_format' => 'R$ '.number_format($possivel_retorno,2,',','.'),

            'valor_total_apostado_format' => 'R$ '.number_format($valor_total_apostado,2,',','.')

        ]);

    }

}

