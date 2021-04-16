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

class LiteController extends Controller{
    public function viewIndex(){
        return view('lite.index');
    }
    public function verEventoById($idevent){
        $event = Events::where('events.id', $idevent)->leftJoin('ligas', 'ligas.id','=', 'events.idliga')
            ->select('events.*', 'ligas.nome_traduzido', DB::raw("date_format(events.data, '%d %M') as data_format"), DB::raw("date_format(events.data, '%H:%i') as hora_format"))->get();

        $sql_odds_principal = Odds::where('idevent', $idevent)->where('idsubgrupo', 79)->get();

        $odds_grupos = OddsGrupo::orderBy('id', 'desc')->get();

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

        return view('lite.ver_evento', $data);
    }
    public function verEventosPorLiga($id){
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

        return view('lite.view_liga', $data);
    }
    public function viewMeuCupom(){
        $sql = NovoCarrinho::leftJoin('novo_carrinho_item', 'novo_carrinho_item.idcarrinho','=','novo_carrinho.id')
            ->leftJoin('events', 'events.id','=','novo_carrinho_item.idevent')
            ->leftJoin('odds', 'odds.id','=','novo_carrinho_item.idodd')
            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')
            ->select('novo_carrinho_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'valor_total_cotas', 'valor_total_apostado', 'odds.id as idodds', 'cota_momento')->where('session_id', session()->getId())->get();

        $total_carrinho = NovoCarrinho::where('session_id', session()->getId())->get();

        if(count($sql) > 0){
            $i = 0;
            foreach($sql as $dados){

                if($dados->idhome != ''){
                    $sql_time_home = Times::find($dados->idhome);
                    $sql_time_away = Times::find($dados->idaway);

                    $sql[$i]->time_home = $sql_time_home->nome;
                    $sql[$i]->time_away = $sql_time_away->nome;

                    $i++;
                }
            }
        }



        $data = [
            'sql' => $sql,
            'total_carrinho' => $total_carrinho
        ];


        return view('lite.meucupom', $data);
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

        return redirect('/lite/meu-cupom')->with('sucesso', 'Alterado com sucesso');
    }
    public function limparApostas(){
        $sql = NovoCarrinho::where('session_id', session()->getId())->get();
        if(count($sql) > 0){
            NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->delete();
            NovoCarrinho::where('session_id', session()->getId())->delete();
        }

        return redirect('lite/meu-cupom')->with('sucesso', 'Cupom excluido com sucesso');
    }
    public function postFinalizarAposta(Request $request){
        $input = $request->all();

        $sql = NovoCarrinho::where('session_id', session()->getId())->get();

        if(count($sql) < 1){
            return redirect('/lite/meu-cupom')->with('erro', 'Cupom de aposta esta vazio');
        }

        $sqlItem = NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->get();

        if(count($sqlItem) < 1){
            return redirect('/lite/meu-cupom')->with('erro', 'Cupom de aposta esta vazio');
        }

        /*if( !Auth::check() ){
            return redirect('/lite/login')->with('erro', 'Digite o seu email e senha para continuar');
        }*/

        #Verifica se o cliente esta logado
        if( Auth::check() ){
            if( auth()->user()->status != 1 ){
                return redirect('/lite');
            }

            //verifica o total da aposta
            $valor_total_cotas = $sql[0]->valor_total_cotas;
            $valor_total_apostado = $sql[0]->valor_total_apostado;

            $creditos = Creditos::where('idusuario', auth()->user()->id)->select(DB::raw("sum(saldo_apostas + saldo_liberado) as soma"), 'saldo_apostas', 'saldo_liberado')->get();

            if(count($creditos) > 0){
                if( $creditos[0]->soma < $valor_total_apostado ){
                    return redirect('/lite/meu-cupom')->with('erro', 'Créditos insuficientes para realizar a aposta');
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
                        $cupomAposta->valor_apostado = 0;
                        $cupomAposta->possivel_retorno = 0;
                        $cupomAposta->retorno_real = 0;
                        $cupomAposta->codigo_unico = Str::random('10');
                        $cupomAposta->save();

                        $total_apostado = 0;
                        $possivel_retorno = 0;

                        foreach($sqlItem as $dados){

                            $cupomApostaItem = new CupomApostaItem;
                            $cupomApostaItem->idcupom = $cupomAposta->id;
                            $cupomApostaItem->idevent = $dados->idevent;
                            $cupomApostaItem->idodds = $dados->idodd;
                            $cupomApostaItem->valor_momento = $dados->cota_momento;
                            $cupomApostaItem->valor_apostado = $sql[0]->valor_total_apostado;
                            $cupomApostaItem->status_conferido = 0;
                            $cupomApostaItem->status_resultado = 0;
                            $cupomApostaItem->save();

                            $temp = $dados->valor_momento * $dados->valor_apostado;
                            $total_apostado = $total_apostado + $dados->valor_apostado;
                            $possivel_retorno = $possivel_retorno + $temp;
                        }

                        $cupomAposta = CupomAposta::find($cupomAposta->id);
                        $cupomAposta->valor_apostado = $sql[0]->valor_total_apostado;
                        $cupomAposta->possivel_retorno = $sql[0]->valor_total_apostado * $sql[0]->valor_total_cotas;
                        $cupomAposta->total_cotas = $sql[0]->valor_total_cotas;
                        $cupomAposta->save();

                        NovoCarrinho::where('session_id', session()->getId())->delete();
                        NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->delete();

                        DB::commit();

                        return redirect('/lite')->with('sucesso', 'Sua aposta foi efetuada com sucesso');
                    }catch(Exception $e){
                        DB::rollback();
                    }
                }
            }
        }else{
            //faz o cupom de pré aposta
            try{
                DB::beginTransaction();

                //faz a aposta real
                $cupomAposta = new CupomAposta;
                $cupomAposta->status = 4;
                $cupomAposta->valor_apostado = 0;
                $cupomAposta->possivel_retorno = 0;
                $cupomAposta->retorno_real = 0;
                $cupomAposta->codigo_unico = Str::random('10');
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
                $cupomAposta->valor_apostado = $sql[0]->valor_total_apostado;
                $cupomAposta->possivel_retorno = $sql[0]->valor_total_apostado * $sql[0]->valor_total_cotas;
                $cupomAposta->total_cotas = $sql[0]->valor_total_cotas;
                $cupomAposta->save();

                NovoCarrinho::where('session_id', session()->getId())->delete();
                NovoCarrinhoItem::where('idcarrinho', $sql[0]->id)->delete();

                DB::commit();

                return redirect('/lite/minhas-apostas/visualizar-cupom/'.$cupomAposta->codigo_unico.'')->with('sucesso', 'Sua aposta foi pré registrada com o código abaixo');
            }catch(Exception $e){
                DB::rollback();
            }
        }
    }

    public function viewCadastro(){
        return view('lite.cadastro');
    }
    public function postCadastro(Request $request){
        $input = $request->all();
    }

    public function viewLogin(){
        return view('lite.login');
    }
    public function postLogin(Request $request){
        $input = $request->all();

        $sessionid = session()->getId();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Session::put('idusuario', Auth::user()->id);
            Session::put('nomeusuario', Auth::user()->nome);

            NovoCarrinho::where('session_id', $sessionid)->update([
                'session_id' => session()->getId()
            ]);

            if( Session::has('redirect') ){
                $redirect = Session::get('redirect');
                Session::forget('redirect');

                return redirect($redirect);
            }else{
                return redirect('/lite');
            }


        }

        return redirect('lite/login')->with('erro', 'Email e/ou senha incorretos');
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

        return redirect('/lite/meu-cupom');
    }

    public function viewMinhasApostas(){
        $sql = CupomAposta::where('idusuario', auth()->user()->id)
            ->leftJoin('status_cupom_aposta', 'status_cupom_aposta.id','=','cupom_aposta.status')
            ->select('cupom_aposta.*', 'status_cupom_aposta.status_cupom', DB::raw("date_format(cupom_aposta.created_at, '%d/%m/%Y') as data_aposta"))->orderBy('created_at', 'desc')->get();

        $data = [
            'sql' => $sql
        ];

        return view('lite.minhas_apostas', $data);
    }
    public function viewVisualizarApostaById($codigo_unico){
        $cupomAposta = CupomAposta::where('codigo_unico', $codigo_unico)
            ->leftJoin('usuarios', 'usuarios.id', '=', 'cupom_aposta.idusuario')
            ->select('cupom_aposta.*', 'usuarios.id as idusuario', 'usuarios.nome', DB::raw("date_format(cupom_aposta.created_at, '%d/%m/%Y as %H:%i:%s') as data_aposta"))->get();

        if(count($cupomAposta) < 1){
            return redirect('/lite/minhas-apostas')->with('erro', 'Cupom não encontrado');
        }

        $cupomApostaItem = CupomApostaItem::leftJoin('events', 'events.id','=','cupom_aposta_item.idevent')
        ->leftJoin('odds', 'odds.id','=','cupom_aposta_item.idodds')
        ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')
        ->leftJoin('ligas', 'ligas.id','=','events.idliga')
        ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')
        ->where('cupom_aposta_item.idcupom', $cupomAposta[0]->id)->select('cupom_aposta_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'odds.id as idodds', 'valor_momento', 'esportes.nome_traduzido as nome_esporte', 'ligas.nome_traduzido as nome_liga', 'cupom_aposta_item.valor_momento', 'cupom_aposta_item.status_resultado')->get();

        if(count($cupomApostaItem) > 0){
            $i = 0;
            foreach($cupomApostaItem as $dados){

                if($dados->idhome != ''){
                    $sql_time_home = Times::find($dados->idhome);
                    $sql_time_away = Times::find($dados->idaway);

                    $cupomApostaItem[$i]->time_home = $sql_time_home->nome;
                    $cupomApostaItem[$i]->time_away = $sql_time_away->nome;

                    $i++;
                }
            }
        }

        $data = [
            'cupomAposta' => $cupomAposta,
            'cupomApostaItem' => $cupomApostaItem
        ];

        return view('lite.visualizar_cupom_aposta', $data);
    }
}
