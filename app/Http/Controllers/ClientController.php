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
use App\CambistasComissoes;

use Illuminate\Support\Facades\Cache;

class ClientController extends Controller{

    public function viewLayout(){

        return view('client.index_novo');

    }

    public function viewIndex(){
        $date = \Carbon\Carbon::now();
        $nextD = $date->addDay(1)->toDateTime();
        $campeonatosDestaque = Ligas::where('status', 1)->where('destaque', 1)->get();

        $paisesDestaque = Paises::where('status', 1)->where('destaque', 1)->get();

        $esportes = Esportes::where('status', 1)->get();



        /*$jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('idesporte', 1)

            ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga')->groupBy('idliga')->take('20')->get();

*/


        $sql1 = Events::where('data', '>=', date('Y-m-d H:i:s'))->where('data','<=', $nextD)->orderBy('data', 'asc')

        ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

        ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

        ->where('idesporte', 1)//->where('ligas.status', 1)

        ->select('events.idliga', 'paises.nome_traduzido', 'paises.id as idpais', 'paises.bandeira')->groupBy('idpais')->get();



        $array_pais = [];



        if(count($sql1) > 0){

        foreach($sql1 as $dados1){

            $jogos_aba_futebol = Events::where('data', '>=', date('Y-m-d H:i:s'))->where('data','<=', $nextD)->orderBy('data', 'asc')

                ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                ->leftJoin('paises', 'paises.id', '=', 'ligas.idpais')

                ->where('idesporte', 1)->where('ligas.status', 1)->where('ligas.idpais', $dados1->idpais)

                ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->get();





            $array_ligas = [];



            if(count($jogos_aba_futebol) > 0){

                foreach($jogos_aba_futebol as $dados){



                    $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->where('data','<=', $nextD)  ->orderBy('data', 'asc')

                        ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                        ->where('idesporte', 1)->where('idliga', $dados->idliga)

                        ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();



                    $array_jogos = [];


                    if(count($jogos) > 0){

                        foreach($jogos as $dados2){



                            $sql_time_home = Times::find($dados2->idhome);

                            $sql_time_away = Times::find($dados2->idaway);

                            $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();





                            if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                                $array_jogos[] = [

                                    'id' => $dados2->id,

                                    'data' => $dados2->data,

                                    'hora' => $dados2->hora,

                                    'home' => $sql_time_home->nome,

                                    'away' => $sql_time_away->nome,

                                    'total_odds' => $dados2->total_odds,

                                    'oddhome_id' => $sql_odds_principal[0]->id,

                                    'oddhome_value' => $sql_odds_principal[0]->odds,

                                    'oddhome_name' => $sql_odds_principal[0]->name,

                                    'odddraw_id' => $sql_odds_principal[1]->id,

                                    'odddraw_value' => $sql_odds_principal[1]->odds,

                                    'odddraw_name' => $sql_odds_principal[1]->name,

                                    'oddaway_id' => $sql_odds_principal[2]->id,

                                    'oddaway_value' => $sql_odds_principal[2]->odds,

                                    'oddaway_name' => $sql_odds_principal[2]->name,

                                ];



                            }

                        }

                    }



                    $array_ligas[] = [

                        'id' => $dados->idliga,

                        'liga' => $dados->nome_traduzido,

                        'jogos' => $array_jogos

                    ];

                }

            }

            //fim



            $array_pais[] = [

                'id' => $dados1->idpais,

                'pais' => $dados1->nome_traduzido,

                'bandeira' => $dados1->bandeira,

                'ligas' => $array_ligas

            ];

        }

        }



        $array_jogos_aba_futebol = $array_pais;



        $array_jogos_carousel = [];



        $jogos_carousel = Events::whereDate('data', '>=', $date)->orderBy('data', 'asc')

                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')->where('destaque_carousel', 1)->where('ligas.status', 1)

                    ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'ligas.nome_traduzido')->take('20')->get();



        if(count($jogos_carousel) > 0){

            foreach($jogos_carousel as $dados2){



                $sql_time_home = Times::find($dados2->idhome);

                $sql_time_away = Times::find($dados2->idaway);

                $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();



                if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                    $array_jogos_carousel[] = [

                        'id' => $dados2->id,

                        'liga' => $dados2->nome_traduzido,

                        'data' => $dados2->data,

                        'hora' => $dados2->hora,

                        'home' => $sql_time_home->nome,

                        'away' => $sql_time_away->nome,

                        'oddhome_id' => $sql_odds_principal[0]->id,

                        'oddhome_value' => $sql_odds_principal[0]->odds,

                        'oddhome_name' => $sql_odds_principal[0]->name,

                        'odddraw_id' => $sql_odds_principal[1]->id,

                        'odddraw_value' => $sql_odds_principal[1]->odds,

                        'odddraw_name' => $sql_odds_principal[1]->name,

                        'oddaway_id' => $sql_odds_principal[2]->id,

                        'oddaway_value' => $sql_odds_principal[2]->odds,

                        'oddaway_name' => $sql_odds_principal[2]->name,

                    ];

                }

            }

        }



        $sqlNovoCarrinho = NovoCarrinho::leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')

            ->leftJoin('events', 'events.id','=','novo_carrinho_item.idevent')

            ->leftJoin('odds', 'odds.id','=','novo_carrinho_item.idodd')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select('novo_carrinho_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'valor_total_cotas', 'valor_total_apostado', 'odds.id as idodds', 'cota_momento')->where('session_id', session()->getId())->get();



        $total_carrinho = NovoCarrinho::where('session_id', session()->getId())->get();



        if(count($sqlNovoCarrinho) > 0){

            $i = 0;

            foreach($sqlNovoCarrinho as $dados){



                if($dados->idhome != ''){

                    $sql_time_home = Times::find($dados->idhome);

                    $sql_time_away = Times::find($dados->idaway);



                    $sqlNovoCarrinho[$i]->time_home = $sql_time_home->nome;

                    $sqlNovoCarrinho[$i]->time_away = $sql_time_away->nome;



                    $i++;

                }

            }

        }


        $data = [

            'campeonatosDestaque' => $campeonatosDestaque,

            'paisesDestaque' => $paisesDestaque,

            'esportes' => $esportes,

            // 'jogos_aba_futebol' => $jogos_aba_futebol,

            'array_jogos_aba_futebol' => $array_jogos_aba_futebol,

            'array_jogos_carousel' => $array_jogos_carousel,

            'sqlNovoCarrinho' => $sqlNovoCarrinho,

            'total_carrinho' => $total_carrinho

        ];  
       
        return view('client.index', $data);

    }



    public function viewAtualizarAposta(Request $request){

        $input = $request->all();



        $rules = [

            'newstake' => 'required'

        ];

        $messages = [

            'newstake.required' => 'Digite o valor para apostar'

        ];

        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->with('erro', 'Digite um valor para apostar');

        }



        $input['newstake'] = str_replace('R$ ', '', $input['newstake']);

        $input['newstake'] = str_replace('.', '', $input['newstake']);

        $input['newstake'] = str_replace(',', '.', $input['newstake']);



        if($input['newstake'] < 10){

            return back()->with('erro', 'O valor mínimo para aposta é de R$ 10,00');

        }



        NovoCarrinho::where('session_id', session()->getId())->update([

            'valor_total_apostado' => $input['newstake']

        ]);



        return back()->with('sucesso', 'Alterado com sucesso');

    }

    public function postFinalizarAposta(Request $request){

        $input = $request->all();
        $config =\DB::table('campos_fixos')->first();

        $sql = NovoCarrinho::where('session_id', session()->getId())->get();

        // dd($input);
        if(count($sql) < 1){

            return redirect('/')->with('erro', 'Cupom de aposta esta vazio');

        }
        if(!isset($input['newstake_hidden']) ||  $input['newstake_hidden'] == 0 || is_null($input['newstake_hidden'])){
            if( !isset($input['newstake_hidden_mobile']) || $input['newstake_hidden_mobile'] == 0 || is_null($input['newstake_hidden_mobile'])){
                return redirect('/')->with('erro', 'Você não pode fazer uma aposta com valor vazio');
            }

        }


        $sqlItem = NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->get();



        if(count($sqlItem) < 1){

            return redirect('/')->with('erro', 'Cupom de aposta esta vazio');

        }

        if(count($sqlItem) < $config->quantidade_minima_jogos && $config->quantidade_minima_jogos != 0 ){

            return redirect('/')->with('erro', 'A quantidade minima de jogos por bilhete é:'.$config->quantidade_minima_jogos);

        }

       
   
        /*if( !Auth::check() ){

            return redirect('/lite/login')->with('erro', 'Digite o seu email e senha para continuar');

        }*/



        #Verifica se o cliente esta logado

        if( Auth::check() ){

            if( auth()->user()->status != 1 ){

                return redirect('/');

            }



            //verifica o total da aposta

            $valor_total_cotas = $sql[0]->valor_total_cotas;
            if(isset($input['newstake_hidden']) || $input['newstake_hidden'] != 0 ){
                $valor_total_apostado = $input['newstake_hidden'];
            }else{
                $valor_total_apostado =$input['newstake_hidden_mobile'];

            }

            if($config->valor_minimo_aposta >  $valor_total_apostado && $config->valor_minimo_aposta != 0){
                return redirect('/')->with('erro', 'O Valor minimo para aposta é: R$ '.number_format($config->valor_minimo_aposta,2,',','.'));
            
            }
            if($config->valor_maximo_aposta <  $valor_total_apostado && $config->valor_maximo_aposta != 0){
                return redirect('/')->with('erro', 'O Valor maximo para aposta é: R$ '.number_format($config->valor_maximo_aposta,2,',','.'));
            
            }
            $creditos = Creditos::where('idusuario', auth()->user()->id)->select(DB::raw("sum(saldo_apostas + saldo_liberado) as soma"), 'saldo_apostas', 'saldo_liberado')->get();



            if(count($creditos) > 0){

                if(Auth::user()->tipo_usuario == 1 && $creditos[0]->soma < $valor_total_apostado ){

                    return redirect('/')->with('erro', 'Créditos insuficientes para realizar a aposta');

                }else{



                    //return redirect('/lite/meu-cupom')->with('erro', 'Créditos insuficientes para realizar a aposta');



                    $saldo_apostas = $creditos[0]->saldo_apostas;

                    $saldo_liberado = $creditos[0]->saldo_liberado;

                    $diferenca = 0;



                    $total = $sql[0]->valor_total_apostado;



                    if( $saldo_apostas < $total ){

                        $diferenca = $total - $saldo_apostas;

                    }



                    try{

                        DB::beginTransaction();



                        if($diferenca > 0){

                            Creditos::where('idusuario', auth()->user()->id)->update([

                                'saldo_apostas' => '0',

                                'saldo_liberado' => DB::raw("(saldo_liberado - ".$diferenca.")")

                            ]);

                        }


                        //faz a aposta real

                        $cupomAposta = new CupomAposta;

                        $cupomAposta->idusuario = auth()->user()->id;

                        $cupomAposta->status = 1;

                        $cupomAposta->valor_apostado = $valor_total_apostado;

                        $cupomAposta->possivel_retorno = 0;

                        $cupomAposta->retorno_real = 0;

                        $cupomAposta->codigo_unico = substr(uniqid(), 0, 6);

                        $cupomAposta->save();



                        $total_apostado = 0;

                        $possivel_retorno = 0;



                        foreach($sqlItem as $dados){



                            $cupomApostaItem = new CupomApostaItem;

                            $cupomApostaItem->idcupom = $cupomAposta->id;

                            $cupomApostaItem->idevent = $dados->idevent;

                            $cupomApostaItem->idodds = $dados->idodd;

                            $cupomApostaItem->valor_momento = $dados->cota_momento;

                            $cupomApostaItem->valor_apostado = 0;

                            $cupomApostaItem->status_conferido = 0;

                            $cupomApostaItem->status_resultado = 0;

                            $cupomApostaItem->save();



                            $temp = $dados->valor_momento * $dados->valor_apostado;

                            $total_apostado = $total_apostado + $dados->valor_apostado;

                            $possivel_retorno = $possivel_retorno + $temp;

                        }



                        $cupomAposta = CupomAposta::find($cupomAposta->id);

                        $cupomAposta->valor_apostado = $valor_total_apostado;
                        if($sql[0]->valor_total_cotas < $config->cotacao_minima && $config->cotacao_minima != 0 ){

                            $cupomAposta->possivel_retorno = $valor_total_apostado * $config->cotacao_minima;

                            $cupomAposta->total_cotas = $config->cotacao_minima;
                
                
                        }else if($sql[0]->valor_total_cotas > $config->cotacao_maxima && $config->cotacao_maxima != 0 ){
                
                            $cupomAposta->possivel_retorno = $valor_total_apostado * $config->cotacao_maxima;

                            $cupomAposta->total_cotas = $config->cotacao_maxima;
                
                
                        }else{
                            
                            $cupomAposta->possivel_retorno = $valor_total_apostado * $sql[0]->valor_total_cotas;

                            $cupomAposta->total_cotas = $sql[0]->valor_total_cotas;

                        }

                        if($config->premio_maximo < ($valor_total_apostado * $sql[0]->valor_total_cotas) && $config->premio_maximo != 0 || $config->premio_maximo < ($valor_total_apostado * $config->cotacao_maxima) && $config->premio_maximo != 0 ){
                            $cupomAposta->possivel_retorno = $config->premio_maximo;
                        }

                        $cupomAposta->save();

                        if(Auth::user()->tipo_usuario == 4){
                            if($cupomAposta) {
                                $cupomAposta->idcambista = Auth::user()->id;
                                $cupomAposta->status = 1;
                                $cupomAposta->save();
            
                                $jogos = CupomApostaItem::where('idcupom', $cupomAposta->id)->count();
    
                                if(Auth::user()->idgerente){
                                    $comissaoGerente = GerentesCampos::where('idusuario',Auth::user()->idgerente)->first();
                                    $porcentagem = $comissaoGerente->comissao / 100;
                                    $comissao = $cupomAposta->valor_apostado * $comissaoGerente->porcentagem;
                                    $credito = Creditos::where('idusuario', Auth::user()->idgerente)->first();
                                    $credito->saldo_liberado =  $credito->saldo_liberado + $comissao;
                                    $credito->save();
                                }
                                $comissoes = CambistasComissoes::where('idusuario', Auth::user()->id)->first();
            
                                if($comissoes){
                                    if($jogos == 1){ $porcentagem = $comissoes->comissao1jogo / 100; }
                                    if($jogos == 2){ $porcentagem = $comissoes->comissao2jogo / 100; }
                                    if($jogos == 3){ $porcentagem = $comissoes->comissao3jogo / 100; }
                                    if($jogos == 4){ $porcentagem = $comissoes->comissao4jogo / 100; }
                                    if($jogos == 5){ $porcentagem = $comissoes->comissao5jogo / 100; }
                                    if($jogos == 6){ $porcentagem = $comissoes->comissao6jogo / 100; }
                                    if($jogos == 7){ $porcentagem = $comissoes->comissao7jogo / 100; }
                                    if($jogos >= 8){ $porcentagem = $comissoes->comissao7jogo / 100; }
                                    $comissao = $cupomAposta->valor_apostado * $porcentagem;
                                    $credito = Creditos::where('idusuario', Auth::user()->id)->first();
                                    $credito->saldo_liberado = $credito->saldo_liberado + $comissao;
                                    $credito->save();
                                    
                                }
                                
            
                            }
                        }
                      


                        NovoCarrinho::where('session_id', session()->getId())->delete();

                        NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->delete();



                        DB::commit();



                        return redirect('/minhas-apostas/visualizar-cupom/'.$cupomAposta->codigo_unico.'')->with('sucesso', 'Sua aposta foi efetuada com sucesso');

                    }catch(Exception $e){

                        DB::rollback();

                    }

                }

            }

        }else{

            //faz o cupom de pré aposta

            try{

                DB::beginTransaction();

                if(isset($input['newstake_hidden']) || $input['newstake_hidden'] != 0 ){
                    $valor_total_apostado = $input['newstake_hidden'];
                }else{
                    $valor_total_apostado =$input['newstake_hidden_mobile'];
    
                }
                if($config->valor_minimo_aposta >  $valor_total_apostado && $config->valor_minimo_aposta != 0){
                    return redirect('/')->with('erro', 'O Valor minimo para aposta é: R$ '.number_format($config->valor_minimo_aposta,2,',','.'));
                
                }
                if($config->valor_maximo_aposta <  $valor_total_apostado && $config->valor_maximo_aposta != 0){
                    return redirect('/')->with('erro', 'O Valor maximo para aposta é: R$ '.number_format($config->valor_maximo_aposta,2,',','.'));
                
                }

                //faz a aposta real

                $cupomAposta = new CupomAposta;

                $cupomAposta->status = 4;

                $cupomAposta->valor_apostado = 0;

                $cupomAposta->possivel_retorno = 0;

                $cupomAposta->retorno_real = 0;

                $cupomAposta->codigo_unico = substr(uniqid(), 0, 6);

                $cupomAposta->save();



                $total_apostado = 0;

                $possivel_retorno = 0;



                foreach($sqlItem as $dados){



                    $cupomApostaItem = new CupomApostaItem;

                    $cupomApostaItem->idcupom = $cupomAposta->id;

                    $cupomApostaItem->idevent = $dados->idevent;

                    $cupomApostaItem->idodds = $dados->idodd;

                    $cupomApostaItem->valor_momento = $dados->cota_momento;

                    $cupomApostaItem->status_conferido = 0;

                    $cupomApostaItem->status_resultado = 0;

                    $cupomApostaItem->save();



                    $temp = $dados->valor_momento * $dados->valor_apostado;

                    $total_apostado = $total_apostado + $dados->valor_apostado;

                    $possivel_retorno = $possivel_retorno + $temp;

                }



                $cupomAposta = CupomAposta::find($cupomAposta->id);

                $cupomAposta->valor_apostado = $valor_total_apostado;
                if($sql[0]->valor_total_cotas < $config->cotacao_minima && $config->cotacao_minima != 0 ){

                    $cupomAposta->possivel_retorno = $valor_total_apostado * $config->cotacao_minima;

                    $cupomAposta->total_cotas = $config->cotacao_minima;
        
        
                }else if($sql[0]->valor_total_cotas > $config->cotacao_maxima && $config->cotacao_maxima != 0 ){
        
                    $cupomAposta->possivel_retorno = $valor_total_apostado * $config->cotacao_maxima;

                    $cupomAposta->total_cotas = $config->cotacao_maxima;
        
        
                }else{
                    
                    $cupomAposta->possivel_retorno = $valor_total_apostado * $sql[0]->valor_total_cotas;

                    $cupomAposta->total_cotas = $sql[0]->valor_total_cotas;

                }

                if($config->premio_maximo < ($valor_total_apostado * $sql[0]->valor_total_cotas) && $config->premio_maximo != 0 || $config->premio_maximo < ($valor_total_apostado * $config->cotacao_maxima) && $config->premio_maximo != 0 ){
                    $cupomAposta->possivel_retorno = $config->premio_maximo;
                }


                $cupomAposta->save();



                NovoCarrinho::where('session_id', session()->getId())->delete();

                NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->delete();



                DB::commit();



                return redirect('/minhas-apostas/visualizar-cupom/'.$cupomAposta->codigo_unico.'')->with('sucesso', 'Sua aposta foi pré registrada com o código abaixo');

            }catch(Exception $e){

                DB::rollback();

            }

        }

    }



    public function removeSelection(Request $request, $id){

        $input = $request->all();

        $sql = NovoCarrinhoItem::leftJoin('novo_carrinho', 'novo_carrinho.id','=','novo_carrinho_item.idcarrinho')->where('session_id', session()->getId())->where('novo_carrinho_item.id', $id)->delete();


        $itensCarrinho = NovoCarrinhoItem::leftJoin('novo_carrinho', 'novo_carrinho.id','=','novo_carrinho_item.idcarrinho')

            ->select("novo_carrinho_item.*")->where('session_id', session()->getId())->get();



        $multiplicacao = 1;

        $soma = 0;


        if(count($itensCarrinho) > 0){

            foreach($itensCarrinho as $dados){

                $multiplicacao = $multiplicacao * $dados->cota_momento;

                $soma = $soma + $dados->cota_momento;

            }

        }



        NovoCarrinho::where('session_id', session()->getId())->update([

            'valor_total_cotas' => $multiplicacao

        ]);



        if($soma == 0){

            NovoCarrinho::where('session_id', session()->getId())->delete();

        }



        return Response()->json('Removido com sucesso');

    }



    public function viewJogosPorLiga($id){

        $jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('ligas.id', $id)

            ->where('idesporte', 1)->where('ligas.status', 1)

            ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->take('20')->get();



        $array_ligas = [];



        if(count($jogos_aba_futebol) > 0){

            foreach($jogos_aba_futebol as $dados){



                $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                    ->where('idesporte', 1)->where('idliga', $dados->idliga)

                    ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();



                $array_jogos = [];



                if(count($jogos) > 0){

                    foreach($jogos as $dados2){



                        $sql_time_home = Times::find($dados2->idhome);

                        $sql_time_away = Times::find($dados2->idaway);

                        $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();



                        if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                            $array_jogos[] = [

                                'id' => $dados2->id,

                                'data' => $dados2->data,

                                'hora' => $dados2->hora,

                                'home' => $sql_time_home->nome,

                                'away' => $sql_time_away->nome,

                                'total_odds' => $dados2->total_odds,

                                'oddhome_id' => $sql_odds_principal[0]->id,

                                'oddhome_value' => $sql_odds_principal[0]->odds,

                                'oddhome_name' => $sql_odds_principal[0]->name,

                                'odddraw_id' => $sql_odds_principal[1]->id,

                                'odddraw_value' => $sql_odds_principal[1]->odds,

                                'odddraw_name' => $sql_odds_principal[1]->name,

                                'oddaway_id' => $sql_odds_principal[2]->id,

                                'oddaway_value' => $sql_odds_principal[2]->odds,

                                'oddaway_name' => $sql_odds_principal[2]->name,

                            ];

                        }

                    }

                }



                $array_ligas[] = [

                    'id' => $dados->idliga,

                    'liga' => $dados->nome_traduzido,

                    'jogos' => $array_jogos

                ];

            }

        }



        $array_jogos_aba_futebol = $array_ligas;



        $liga = Ligas::find($id);



        $data = [

            'array_ligas' => $array_ligas,

            'array_jogos_aba_futebol' => $array_jogos_aba_futebol,

            'liga' => $liga

        ];



        return view('client.view_liga', $data);

    }



    public function viewJogosPorEsporte($id){

        $jogos_aba_futebol = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

            ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->where('ligas.idesporte', $id)

            ->where('ligas.status', 1)

            ->select('events.idliga', 'ligas.nome_traduzido')->groupBy('idliga')->take('20')->get();



        $array_ligas = [];



        if(count($jogos_aba_futebol) > 0){

            foreach($jogos_aba_futebol as $dados){



                $jogos = Events::where('data', '>', date('Y-m-d H:i:s'))->orderBy('data', 'asc')

                    ->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

                    ->where('idesporte', 1)->where('idliga', $dados->idliga)

                    ->select(DB::raw("date_format(events.data, '%d/%m') as data"), DB::raw("date_format(events.data, '%H:%i') as hora"), 'events.id', 'events.idhome', 'events.idaway', 'events.idliga', 'total_odds')->take('20')->get();



                $array_jogos = [];



                if(count($jogos) > 0){

                    foreach($jogos as $dados2){



                        $sql_time_home = Times::find($dados2->idhome);

                        $sql_time_away = Times::find($dados2->idaway);

                        $sql_odds_principal = Odds::where('idevent', $dados2->id)->where('idsubgrupo', 79)->get();



                        if( $sql_time_home != null && $sql_time_away != '' && count($sql_odds_principal) > 0 ){

                            $array_jogos[] = [

                                'id' => $dados2->id,

                                'data' => $dados2->data,

                                'hora' => $dados2->hora,

                                'home' => $sql_time_home->nome,

                                'away' => $sql_time_away->nome,

                                'total_odds' => $dados2->total_odds,

                                'oddhome_id' => $sql_odds_principal[0]->id,

                                'oddhome_value' => $sql_odds_principal[0]->odds,

                                'oddhome_name' => $sql_odds_principal[0]->name,

                                'odddraw_id' => $sql_odds_principal[1]->id,

                                'odddraw_value' => $sql_odds_principal[1]->odds,

                                'odddraw_name' => $sql_odds_principal[1]->name,

                                'oddaway_id' => $sql_odds_principal[2]->id,

                                'oddaway_value' => $sql_odds_principal[2]->odds,

                                'oddaway_name' => $sql_odds_principal[2]->name,

                            ];

                        }

                    }

                }



                $array_ligas[] = [

                    'id' => $dados->idliga,

                    'liga' => $dados->nome_traduzido,

                    'jogos' => $array_jogos

                ];

            }

        }



        $array_jogos_aba_futebol = $array_ligas;



        $esporte = Esportes::find($id);



        $data = [

            'array_ligas' => $array_ligas,

            'array_jogos_aba_futebol' => $array_jogos_aba_futebol,

            'esporte' => $esporte

        ];



        return view('client.view_esporte', $data);

    }



    public function teste(){

        return view('client.teste');

    }



    public function viewEvent_bkp($idevent){

        $event = Events::where('events.id', $idevent)->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->select('events.*', 'ligas.nome_traduzido', DB::raw("date_format(events.data, '%d/%m') as data_format"), DB::raw("date_format(events.data, '%H:%i') as hora_format"))->get();



        $sql_odds_principal = Odds::where('idevent', $idevent)->where('idsubgrupo', 79)->get();



        $odds_grupos = OddsGrupo::where('id', 5)->orderBy('id', 'desc')->get();



        $data = [

            'event' => $event,

            'sql_odds_principal' => $sql_odds_principal,

            'odds_grupo' => $odds_grupos

        ];



        return view('client.view_event', $data);

    }



    public function viewEvent($idevent){

        $event = Events::where('events.id', $idevent)->leftJoin('ligas', 'ligas.id','=', 'events.idliga')

            ->select('events.*', 'ligas.nome_traduzido', DB::raw("date_format(events.data, '%d %M') as data_format"), DB::raw("date_format(events.data, '%H:%i') as hora_format"))->get();



        $sql_odds_principal = Odds::where('idevent', $idevent)->where('idsubgrupo', 79)->get();



        $odds_grupos = OddsGrupo::where('id', 5)->orderBy('id', 'desc')->get();



        foreach($event as $dados){

            $eng = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $pot = ['Jan', 'Fev', 'Mar', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];



            $data = str_replace($eng, $pot, $dados->data_format);

            $event[0]->data_format = $data;

        }



        $data = [

            'event' => $event,

            'sql_odds_principal' => $sql_odds_principal,

            'odds_grupo' => $odds_grupos

        ];



        return view('client.view_event', $data);

    }



    # Operações do carrinho de apostas

    public function ajaxAdicionarApostaCarrinho(Request $request){

        $input = $request->all();



        $id = $input['id'];



        $sql = CarrinhoApostas::where('session_id', session()->getId())->where('idodds', $id)->get();



        if(count($sql) > 0){

            CarrinhoApostas::where('session_id', session()->getId())->where('idodds', $id)

            ->delete();



            return response()->json([

                'status' => 'erro2',

                'idodds' => $id,

                'mensagem' => 'Odd já selecionada no cupom atual'

            ]);

        }



        $odds = Odds::find($id);

        $sql_Carrinho = CarrinhoApostas::where('session_id', session()->getId())->where('idevent', $odds->idevent)->get();



        if(count($sql_Carrinho) > 0){

            CarrinhoApostas::where('id', $sql_Carrinho[0]->id)->destroy();
            return response()->json([

                'status' => 'erro',

                'mensagem' => 'Jogo removido do carrinho'

            ]);


        }





        # Como ainda não tem os dados, fazer a consulta dessa ODD

        $sqlodd = Odds::leftJoin('events', 'events.id','=','odds.idevent')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->where('odds.id', $id)->select('odds.id', 'odds.idevent', 'odds.name', 'odds.odds','odds_subgrupo.titulo_traduzido as subgrupo')->get();



        if(count($sqlodd) < 1){

            return response()->json([

                'status' => 'erro',

                'mensagem' => 'Odd não encontrada'

            ]);

        }



        $carrinho = new CarrinhoApostas;

        $carrinho->session_id = session()->getId();

        $carrinho->idevent = $sqlodd[0]->idevent;

        $carrinho->idodds = $sqlodd[0]->id;

        $carrinho->valor_momento = $sqlodd[0]->odds;

        $carrinho->valor_apostado = 10;

        $carrinho->save();



        return response()->json([

            'status' => 'ok',

        ]);

    }



    public function ajaxRecuperaApostasCarrinho(){

        $sql = CarrinhoApostas::leftJoin('events', 'events.id','=','carrinho_apostas.idevent')

            ->leftJoin('odds', 'odds.id','=','carrinho_apostas.idodds')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select('carrinho_apostas.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'valor_momento', 'valor_apostado', 'odds.id as idodds')->where('session_id', session()->getId())->get();



        if(count($sql) > 0){

            $i = 0;

            foreach($sql as $dados){

                $sql_time_home = Times::find($dados->idhome);

                $sql_time_away = Times::find($dados->idaway);



                $sql[$i]->time_home = $sql_time_home->nome;

                $sql[$i]->time_away = $sql_time_away->nome;



                $i++;

            }

        }else{

            return response()->json([

                'status' => 'ok',

                'response' => []

            ]);

        }



        return response()->json([

            'status' => 'ok',

            'response' => $sql

        ]);

    }



    public function atualizaAposta(Request $request){

        $input = $request->all();



        CarrinhoApostas::where('session_id', session()->getId())->where('id', $input['id'])

            ->update([

                'valor_apostado' => $input['valor']

            ]);



        return response()->json([

            'status' => 'ok'

        ]);

    }



    public function excluirAposta(Request $request){

        $input = $request->all();



        $sql = CarrinhoApostas::find($input['id']);



        CarrinhoApostas::where('session_id', session()->getId())->where('id', $input['id'])

        ->delete();



        return response()->json([

            'status' => 'ok',

            'idodds' => $sql->idodds

        ]);

    }



    public function colocarAposta(Request $request){

        $input = $request->all();



        $sql = CarrinhoApostas::where('session_id', session()->getId())->get();



        if(count($sql) < 1){

            return back()->with('erro', 'Cupom de aposta esta vazio');

        }



        #Verifica se o cliente esta logado

        if( Auth::check() ){

            if( auth()->user()->status != 1 ){

                return redirect('/');

            }



            //verifica o total da aposta

            $total = 0;

            foreach($sql as $dados){

                $soma = $dados->valor_momento * $dados->valor_apostado;



                $total = $total + $soma;

            }



            $creditos = Creditos::where('idusuario', auth()->user()->id)->select(DB::raw("sum(saldo_apostas + saldo_liberado) as soma"), 'saldo_apostas', 'saldo_liberado')->get();



            if(count($creditos) > 0){

                if( $creditos[0]->soma < $total ){

                    return redirect('/')->with('erro', 'Créditos insuficientes para realizar a aposta');

                }



                $saldo_apostas = $creditos[0]->saldo_apostas;

                $saldo_liberado = $creditos[0]->saldo_liberado;

                $diferenca = 0;



                if( $saldo_apostas < $total ){

                    $diferenca = $total - $saldo_apostas;

                }



                try{

                    DB::beginTransaction();



                    if($diferenca > 0){

                        Creditos::where('idusuario', auth()->user()->id)->update([

                            'saldo_apostas' => '0',

                            'saldo_liberado' => DB::raw("(saldo_liberado - ".$diferenca.")")

                        ]);

                    }



                    //faz a aposta real

                    $cupomAposta = new CupomAposta;

                    $cupomAposta->idusuario = auth()->user()->id;

                    $cupomAposta->status = 1;

                    $cupomAposta->valor_apostado = 0;

                    $cupomAposta->possivel_retorno = 0;

                    $cupomAposta->retorno_real = 0;

                    $cupomAposta->save();



                    $total_apostado = 0;

                    $possivel_retorno = 0;



                    foreach($sql as $dados){

                        $cupomApostaItem = new CupomApostaItem;

                        $cupomApostaItem->idcupom = $cupomAposta->id;

                        $cupomApostaItem->idevent = $dados->idevent;

                        $cupomApostaItem->idodds = $dados->idodds;

                        $cupomApostaItem->valor_momento = $dados->valor_momento;

                        $cupomApostaItem->valor_apostado = $dados->valor_apostado;

                        $cupomApostaItem->status_conferido = 0;

                        $cupomApostaItem->status_resultado = 0;

                        $cupomApostaItem->save();



                        $temp = $dados->valor_momento * $dados->valor_apostado;

                        $total_apostado = $total_apostado + $dados->valor_apostado;

                        $possivel_retorno = $possivel_retorno + $temp;

                    }



                    $cupomAposta = CupomAposta::find($cupomAposta->id);

                    $cupomAposta->valor_apostado = $total_apostado;

                    $cupomAposta->possivel_retorno = $possivel_retorno;

                    $cupomAposta->save();



                    CarrinhoApostas::where('session_id', session()->getId())->delete();



                    DB::commit();



                    return redirect('/')->with('sucesso', 'Sua aposta foi efetuada com sucesso');

                }catch(Exception $e){

                    DB::rollback();

                }

            }

        }else{

            $total = 0;

            foreach($sql as $dados){

                $soma = $dados->valor_momento * $dados->valor_apostado;



                $total = $total + $soma;

            }



            try{

                DB::beginTransaction();



                //faz a aposta real

                $cupomAposta = new CupomAposta;

                $cupomAposta->status = 4;

                $cupomAposta->valor_apostado = 0;

                $cupomAposta->possivel_retorno = 0;

                $cupomAposta->retorno_real = 0;

                $cupomAposta->codigo_unico = Str::random('7');

                $cupomAposta->save();



                $total_apostado = 0;

                $possivel_retorno = 0;



                foreach($sql as $dados){

                    $cupomApostaItem = new CupomApostaItem;

                    $cupomApostaItem->idcupom = $cupomAposta->id;

                    $cupomApostaItem->idevent = $dados->idevent;

                    $cupomApostaItem->idodds = $dados->idodds;

                    $cupomApostaItem->valor_momento = $dados->valor_momento;

                    $cupomApostaItem->valor_apostado = $dados->valor_apostado;

                    $cupomApostaItem->status_conferido = 0;

                    $cupomApostaItem->status_resultado = 0;

                    $cupomApostaItem->save();



                    $temp = $dados->valor_momento * $dados->valor_apostado;

                    $total_apostado = $total_apostado + $dados->valor_apostado;

                    $possivel_retorno = $possivel_retorno + $temp;

                }



                $cupomAposta = CupomAposta::find($cupomAposta->id);

                $cupomAposta->valor_apostado = $total_apostado;

                $cupomAposta->possivel_retorno = $possivel_retorno;

                $cupomAposta->save();



                CarrinhoApostas::where('session_id', session()->getId())->delete();



                DB::commit();



                return redirect('/ver-cupom/'.$cupomAposta->codigo_unico.'')->with('sucesso', 'Sua aposta foi efetuada com sucesso');

            }catch(Exception $e){

                DB::rollback();

            }



        }

    }



    public function verCupom($random){

        $cupomAposta = CupomAposta::leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')

            ->leftJoin('events', 'events.id','=','cupom_aposta_item.idevent')

            ->leftJoin('odds', 'odds.id','=','cupom_aposta_item.idodds')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->leftJoin('status_cupom_aposta', 'status_cupom_aposta.id','=', 'cupom_aposta.status')

            ->leftJoin('ligas', 'ligas.id','=','events.idliga')

            ->select('cupom_aposta.id', 'cupom_aposta.valor_apostado', 'cupom_aposta.possivel_retorno', 'cupom_aposta.retorno_real','cupom_aposta.status', 'cupom_aposta.codigo_unico', 'events.id as idevent', 'events.idhome', 'events.idaway', 'cupom_aposta_item.valor_apostado as valor_apostado_item', 'cupom_aposta_item.valor_momento as valor_momento_item', DB::raw("date_format(cupom_aposta.created_at, '%d/%m/%Y as %H:%i') as data_aposta"), 'status_cupom_aposta.status_cupom', 'cupom_aposta_item.id as idcai', 'ligas.nome_traduzido as nome_liga', 'odds.name as name_odds', 'odds_subgrupo.titulo_traduzido as name_odds_subgrupo', 'cupom_aposta_item.status_conferido', 'cupom_aposta_item.status_resultado', 'cupom_aposta.idusuario', 'cupom_aposta.idcambista')

            ->where('codigo_unico', $random)

            ->get();



        if(count($cupomAposta) < 1){

            return redirect('/')->with('erro', 'Cupom de aposta não encontrado');

        }



        $data = [

            'cupomAposta' => $cupomAposta

        ];



        return view('client.view_cupom', $data);

    }

    public function viewRegulamentacao(){

        $dados = DB::table('campos_fixos')->where('id', 1)->first();
        return view('client.regulamentacao', compact('dados'));
    }


    public function verificaBilhete(){
        return view('client.verifica_bilhete');
    }
    public function resultBilhete(Request $request){

        $aposta = CupomAposta::where('codigo_unico', $request->bilhete)->where('status', '!=', 4)->first();
        if($aposta){
            $jogos = CupomApostaItem::join('events', 'cupom_aposta_item.idevent', '=', 'events.id')->join('odds', 'cupom_aposta_item.idodds', '=', 'odds.id')->join('odds_subgrupo', 'odds_subgrupo.id', '=', 'odds.idsubgrupo')->join('times as home', 'home.id', '=', 'events.idhome')->join('times as away', 'away.id', '=', 'events.idaway')->join('estadios', 'estadios.id', '=', 'events.idestadio')->join('ligas', 'ligas.id', '=', 'events.idliga')
            ->where('idcupom',  $aposta->id)
            ->select('events.*','events.bet365_id as betid','cupom_aposta_item.status_resultado as ticketStatus', 'odds.*', 'home.nome as homeNome', 'home.image_id as homeImage','away.image_id as awayImage','away.nome as awayNome', 'estadios.city', 'estadios.name as estadio', 'estadios.country', 'ligas.nome_traduzido', 'odds_subgrupo.titulo_traduzido')
            ->get();
            // dd($jogos);
            return view('client.view_bilhete', compact('aposta', 'jogos'));
        }else{
            return Redirect()->back()->with('erro', 'Aposta não encontrada');
        }

    }


    public function ajaxResultBilhete(Request $request){
        $now = \Carbon\Carbon::now(); 
        if (Cache::has($request->bilhete)) {
            $result = Cache::get($request->bilhete);
            $result = json_decode($result);
        }else{
            $aposta = CupomAposta::where('codigo_unico', $request->bilhete)->where('status', '!=', 4)->first();
            
            $jogos = CupomApostaItem::join('events', 'cupom_aposta_item.idevent', '=', 'events.id')->join('odds', 'cupom_aposta_item.idodds', '=', 'odds.id')->where('idcupom',  $aposta->id)
            ->orWhere(function($query) {
                $query->where('status_resultado', 0);
                $query->where('status_resultado', 1);
                $query->where('status_resultado', 2);
            })->get();
            $result = [];
            foreach($jogos as $jogo){
    
                if($jogo->data < $now){
                    $response = \Http::get('https://api.b365api.com/v1/bet365/result?token='.config('app.API_TOKEN').'&event_id='.$jogo->bet365_id);
                    if( $response->successful() ){
                        $response = json_decode($response->body());
                        array_push($result, $response->results);
                    }
                } 
            }
            Cache::put($request->bilhete, json_encode($result), 180);
        }
       

        return Response()->json($result);
    }

}

