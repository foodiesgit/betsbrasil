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

use App\CupomAposta;
use App\CupomApostaItem;
use App\Times;
use App\Creditos;


use App\Usuarios;



class MinhaContaController extends Controller{

    public function viewLogin(){

        /*$usuario = new Usuarios;

        $usuario->email = 'wdnadre15@gmail.com';

        $usuario->password = Hash::make('123456');

        $usuario->nome = 'Andre Luis';

        $usuario->data_nascimento = '05/08/1990';

        $usuario->cpf = '123.456.789-00';

        $usuario->status = 1;

        $usuario->save();*/



        return view('minhaconta.auth.login');

    }

    public function postLogin(Request $request){

        $input = $request->all();



        $credentials = $request->only('email', 'password');



        if (Auth::attempt($credentials)) {

            Session::put('idusuario', Auth::user()->id);

            Session::put('nomeusuario', Auth::user()->nome);



            if( Session::has('redirect') ){

                $redirect = Session::get('redirect');

                Session::forget('redirect');



                return redirect($redirect);

            }else{
                
                return redirect('/admin/cambistas/caixa');

            }





        }



        return redirect('login')->with('erro', 'Email e/ou senha incorretos');

    }



    public function viewCadastro(){

        return view('minhaconta.auth.cadastro');

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

        ->where('cupom_aposta_item.idcupom', $cupomAposta[0]->id)->select('cupom_aposta_item.id', 'odds.name', 'odds_subgrupo.titulo_traduzido as subgrupo', 'events.idhome', 'events.idaway', 'odds.id as idodds', 'valor_momento', 'esportes.nome_traduzido as nome_esporte', 'ligas.nome_traduzido as nome_liga', 'cupom_aposta_item.valor_momento', 'cupom_aposta_item.status_resultado', 'events.data')->get();



        if(count($cupomApostaItem) > 0){

            $i = 0;

            foreach($cupomApostaItem as $dados){

                if($dados->idhome != ''){

                    $sql_time_home = Times::find($dados->idhome);

                    $sql_time_away = Times::find($dados->idaway);



                    $cupomApostaItem[$i]->time_home = $sql_time_home->nome;
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



        return view('client.visualizar_cupom_aposta', $data);

    }
    public function postCadastro(Request $request){

        $input = $request->all();



        $rules = [

            'nome' => 'required',

            'telefone' => 'required',

            'data_nascimento' => 'required',

            'email' => 'required|unique:usuarios,email',

            'password' => 'required|min:6'

        ];



        $messages = [

            'nome.required' => 'Digite o seu nome completo',

            'cpf.required' => 'Digite o seu cpf',

            'cpf.unique' => 'O CPF digitado já esta cadastrado',

            'cpf.size' => 'Digite o seu CPF corretamente',

            'data_nascimento.required' => 'Digite a sua data de nascimento',

            'email.required' => 'Digite o seu email corretamente',

            'email.unique' => 'O email digitado já esta cadastrado',

            'password.required' => 'Digite uma senha de acesso',

            'password.min' => 'Digite uma senha com no mínimo 6 caracteres',

            'telefone.required' => 'Digite o seu telefone'

        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $usuarios = new User;

        $usuarios->name = $input['nome'];

        $usuarios->password = Hash::make($input['password']);

        $usuarios->cpf = $input['cpf'];

        $usuarios->telefone = $input['telefone'];

        $usuarios->data_nascimento = $input['data_nascimento'];

        $usuarios->email = $input['email'];

        $usuarios->status = 1;
        $usuarios->tipo_usuario = 1;

        $usuarios->save();

        $creditos = new Creditos;

        $creditos->idusuario = $usuarios->id;

        $creditos->saldo_bloqueado = 0;

        $creditos->saldo_liberado = 0;

        $creditos->saldo_apostas = 0;

        $creditos->save();


        return redirect('admin/dashboard')->with('sucesso', 'Seja bem vindo.');

    }



    public function viewDashboard(){

        return view('minhaconta.dashboard');

    }

}

