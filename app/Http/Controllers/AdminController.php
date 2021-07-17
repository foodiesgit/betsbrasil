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
use App\Historic;


use App\CupomAposta;

use App\CupomApostaItem;

use App\CuponsIguais;

use App\CuponsIguaisItens;

use App\CambistasComissoes;
use App\Odds;
use Illuminate\Support\Facades\Redirect;
use DataTables;

class AdminController extends Controller {

    public function viewLogin(){

        return view('admin.auth.login');

    }

    public function postLogin(Request $request){

        $input = $request->all();



        $credentials = $request->only('email', 'password', 'tipo_usuario');



        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {

            Session::put('idadmin', Auth::user()->id);

            Session::put('nomeadmin', Auth::user()->nome);

            return redirect('admin/dashboard');

        }

        return redirect('admin/login')->with('erro', 'Email e/ou senha incorretos');

    }

    public function viewDashboard(){
            $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')

            ->where('users.id', Auth::user()->id)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')
    
            ->first();

        $lancamento = 0;
        if(Auth::user()->tipo_usuario == 2){
            $historico = Historic::all();
        }else{
            $historico = Auth::user()->historics;
        }
        if( Auth::user()->tipo_usuario == 2){
            $bilhetes = CupomAposta::orderBy('id', 'desc')->get();
            $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', '!=', 1)->where('tipo_usuario', '!=', 2)->where('cupom_aposta.caixa', 0)->sum('creditos.saldo_liberado');
            $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.status' ,'!=',5)->where('cupom_aposta.caixa', 0)->sum('cupom_aposta.valor_apostado');
            $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,1)->where('cupom_aposta.caixa', 0)->sum('cupom_aposta.valor_apostado');
            $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,2)->sum('cupom_aposta.possivel_retorno');
            $lancamento = Creditos::sum('lancamento');
            // $comissao = $entrada - $comissoes;
            $comissao = $entrada - $saida - $comissoes + $lancamento;

        }else if(Auth::user()->tipo_usuario == 1){
            $bilhetes = CupomAposta::where('idusuario', Auth::user()->id)->orderBy('id', 'desc')->get();
            $entrada = 0;
            $saida = 0;
            $comissao = 0;
            $comissoes =  0;
            $entradaPendente =  0;
        }else if(Auth::user()->tipo_usuario == 4){
            $bilhetes = CupomAposta::where('idcambista', Auth::user()->id)->orderBy('id', 'desc')->get();
            $entrada = CupomAposta::where('idcambista',  Auth::user()->id)->where('status' ,'!=',4)->where('status' ,'!=',5)->where('caixa', 0)->sum('valor_apostado');
            $entradaPendente = CupomAposta::where('idcambista',  Auth::user()->id)->where('status',1)->where('caixa', 0)->sum('valor_apostado');
            $saida = CupomAposta::where('idcambista',  Auth::user()->id)->where('status' ,2)->where('caixa', 0)->sum('possivel_retorno');
            $credito = Creditos::where('idusuario',  Auth::user()->id)->first();
            $comissao = $credito->saldo_liberado;
            $lancamento = $credito->lancamento;
            $comissoes = 0;

        }else{
            $entradaSite = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.status' ,'!=',5)->where('cupom_aposta.caixa', 0)->sum('cupom_aposta.valor_apostado');
            $saidaSite = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa', 0)->sum('cupom_aposta.possivel_retorno');
            $bilhetes = CupomAposta::join('users','cupom_aposta.idcambista','users.id')->where('users.idgerente', Auth::user()->id)->where('cupom_aposta.caixa', 0)->orderBy('id', 'desc')->get();
            $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 4)->where('idgerente', Auth::user()->id)->sum('creditos.saldo_liberado');
            $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,1)->where('cupom_aposta.caixa', 0)->sum('cupom_aposta.valor_apostado');
            $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa', 0)->where('cupom_aposta.status' ,'!=',5)->sum('cupom_aposta.valor_apostado');
            $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa', 0)->sum('cupom_aposta.possivel_retorno');
            $comissaoGerente = GerentesCampos::where('idusuario',Auth::user()->idgerente)->first();
            $porcentagem = $comissaoGerente->comissao / 100;
            $comissao = ($entradaSite + $saidaSite) * $porcentagem;

            $comissoes = 0;

        }
        $data = [

            'sql' => $sql,
            'historic' => $historico,
            'bilhetes' => $bilhetes,
            'entrada' => $entrada,
            'saida' => $saida,
            'comissao' => $comissao,
            'comissoes' => $comissoes,
            'lancamento' => $lancamento,
            'entradaPendente' => $entradaPendente,

        ];

        return view('admin.dashboard.index',$data);

    }
    public function viewCambista(Request $request){
        if(Auth::user()->tipo_usuario == 2 || Auth::user()->tipo_usuario == 3){
            if(Auth::user()->tipo_usuario == 2 || Auth::user()->tipo_usuario == 3){
                $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')
    
                ->where('users.id', $request->id)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')
        
                ->first();
        
        
                $historico = User::find($request->id)->historics;
            
        
                $bilhetes = CupomAposta::where('idcambista', $request->id)->orderBy('id', 'desc')->get();
                $entrada = CupomAposta::where('idcambista',  $request->id)->where('status' ,'!=',4)->where('caixa',0)->sum('valor_apostado');
                $entradaPendente = CupomAposta::where('idcambista',  $request->id)->where('status',1)->where('caixa',0)->sum('valor_apostado');
                $saida = CupomAposta::where('idcambista',  $request->id)->where('status' ,2)->where('caixa',0)->sum('possivel_retorno');
                $credito = Creditos::where('idusuario',  $request->id)->first();
                $comissao = $credito->saldo_liberado;
                $lancamento = $credito->lancamento;

                $total = $entrada - $saida + $lancamento;
        
            $data = [
        
                'sql' => $sql,
                'historic' => $historico,
                'bilhetes' => $bilhetes,
                'entrada' => $entrada,
                'saida' => $saida,
                'comissao' => $comissao,
                'lancamento' => $lancamento,
                'entradaPendente' => $entradaPendente,
                'total' => $total,
        
            ];
        
            return view('admin.cambistas.view_bilhetes',$data);
            }
           
            return Redirect()->back()->with('erro', 'Sem permissão');
        }

    }

    public function viewGerente(Request $request){
        if(Auth::user()->tipo_usuario == 2 ){
                $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')
    
                ->where('users.id', $request->id)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')
        
                ->first();

                $historico = User::find($request->id)->historics;

                $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 4)->where('idgerente',  $request->id)->sum('creditos.saldo_liberado');
                $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  $request->id)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.status' ,'!=',5)->where('cupom_aposta.caixa' ,'=',0)->sum('cupom_aposta.valor_apostado');
                $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  $request->id)->where('cupom_aposta.status',1)->where('cupom_aposta.caixa' ,'=',0)->sum('cupom_aposta.valor_apostado');
                $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  $request->id)->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa' ,'=',0)->sum('cupom_aposta.possivel_retorno');
                $credito = Creditos::where('idusuario',  Auth::user()->id)->first();
                $comissao = $credito->saldo_liberado;
                $cambistas = User::where('idgerente', $request->id)->get();
                $total = $entrada - $saida - $comissoes;
            $data = [
        
                'sql' => $sql,
                'historic' => $historico,
                'cambistas' => $cambistas,
                'entrada' => $entrada,
                'saida' => $saida,
                'comissao' => $comissao,
                'total' => $total,
                'entradaPendente' => $entradaPendente,
        
            ];
        
            return view('admin.gerentes.view_cambistas',$data);
            }
        return Redirect()->back()->with('erro', 'Sem permissão');

    }
    public function viewListarUsuarios(Request $request){

        $input = $request->all();



        $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')

            ->where('tipo_usuario', 1)->select("users.*", "creditos.saldo_bloqueado", "creditos.saldo_liberado")

            ->where('users.status', '>', 0)->get();



        $data = [

            'sql' => $sql

        ];



        return view('admin.usuarios.listar', $data);

    }

    public function viewEditarUsuarios($id){

        $sql = User::where('id',$id)->where('tipo_usuario', 1)->first();
        

        if(!$sql){

            return redirect('admin/usuarios/listar')->with('erro', 'Usuário não encontrado');

        }



        $data = [

            'sql' => $sql

        ];



        return view('admin.usuarios.editar', $data);

    }

    public function postEditarUsuarios(Request $request, $id){

        $input = $request->all();



        $rules = [

            'name' => 'required',

            'email' => 'required|email|unique:usuarios,email,'.$id.'',

            'cpf' => 'required|unique:usuarios,cpf,'.$id.'',

            'data_nascimento' => 'required',

        ];



        $messages = [

            'name.required' => 'Digite o nome completo desse usuário',

            'email.required' => 'Digite o email desse usuário',

            'email.email' => 'Digite um email válido',

            'email.unique' => 'O email já esta cadastrado',

            'cpf.required' => 'Digite o CPF desse usuário',

            'cpf.unique' => 'Esse CPF já esta cadastrado',

            'data_nascimento.required' => 'Digite a data de nascimento desse usuário',

        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $usuarios = User::find($id);

        $usuarios->email = $input['email'];

        $usuarios->name = $input['name'];

        $usuarios->data_nascimento = $input['data_nascimento'];

        $usuarios->cpf = $input['cpf'];

        $usuarios->status = $input['status'];



        if($input['password'] != ''){

            $usuarios->password = Hash::make($input['password']);

        }



        $usuarios->save();



        return redirect('admin/usuarios/listar')->with('sucesso', 'Usuário editado com sucesso');

    }

    public function viewListarEsportes(){

        /* Recupera os paises */

        /*$response = Http::get('https://betsapi.com/api-doc/samples/countries.json');



        if($response->successful()){

            $json = json_decode($response->body(), false);



            foreach($json->results as $dados){

                $paises = new Paises;

                $paises->cc = $dados->cc;

                $paises->nome = $dados->name;

                $paises->save();

            }

        }else{

            dd('erro');

        }*/



        $sql = Esportes::all();



        $data = [

            'sql' => $sql

        ];



        return view('admin.api.esportes.listar', $data);

    }

    public function viewEditarEsportes($id){

        $sql = Esportes::find($id);



        $data = [

            'sql' => $sql

        ];



        return view('admin.api.esportes.editar', $data);

    }

    public function postEditarEsportes(Request $request, $id){

        $input = $request->all();



        $rules = [

            'nome_traduzido' => 'required',

            'status' => 'required',

            'destaque_menu' => 'required'

        ];



        $messages = [

            'nome_traduzido.required' => 'Digite o nome traduzido desse esporte',

            'status.required' => 'Selecione se esse esporte esta ativo ou não',

            'destaque_menu.required' => 'Selecione se esse esporte aparece no menu'

        ];



        $validation = Validator::make($input, $rules, $messages);


        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $esportes = Esportes::find($id);

        $esportes->nome_traduzido = $input['nome_traduzido'];

        $esportes->status = $input['status'];

        $esportes->destaque_menu = $input['destaque_menu'];

        $esportes->save();



        return redirect('admin/api/esportes/listar')->with('sucesso', 'Esporte editado com sucesso');

    }



    public function viewListarPaises(){

        $sql = Paises::all();



        $data = [

            'sql' => $sql

        ];



        return view('admin.api.paises.listar', $data);

    }

    public function viewEditarPaises($id){

        $sql = Paises::find($id);



        $data = [

            'sql' => $sql

        ];



        return view('admin.api.paises.editar', $data);

    }

    public function postEditarPaises(Request $request, $id){

        $input = $request->all();



        $rules = [

            'nome_traduzido' => 'required',

            'bandeira' => 'required',

            'status' => 'required',

            'destaque' => 'required'

        ];

        $messages = [

            'nome_traduzido.required' => 'Digite o nome traduzido desse país',

            'bandeira.required' => 'Digite a bandeira a ser utilizada',

            'status.required' => 'Selecione o status desse país',

            'destaque.required' => 'Selecione se esse pais tem destaque na home'

        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $paises = Paises::find($id);

        $paises->nome_traduzido = $input['nome_traduzido'];

        $paises->bandeira = $input['bandeira'];

        $paises->status = $input['status'];

        $paises->destaque = $input['destaque'];

        $paises->save();



        return redirect('admin/api/paises/listar')->with('sucesso', 'Pais editado com sucesso');

    }



    public function viewListarLigas(){

        $sql = Ligas::leftJoin('paises', 'paises.id','=','ligas.idpais')->leftJoin('esportes','esportes.id','=','ligas.idesporte')

            ->select('ligas.*', 'paises.nome_traduzido as nome_pais', 'esportes.nome_traduzido as nome_esporte', 'paises.bandeira')->get();



        $data = [

            'sql' => $sql

        ];



        return view('admin.api.ligas.listar', $data);

    }

    public function viewEditarLigas($id){

        $sql = Ligas::find($id);



        $data = [

            'sql' => $sql

        ];



        return view('admin.api.ligas.editar', $data);

    }

    public function postEditarLigas(Request $request, $id){

        $input = $request->all();



        $rules = [

            'nome_traduzido' => 'required',

            'destaque' => 'required',

            'status' => 'required'

        ];

        $messages = [

            'nome_traduzido.required' => 'Digite o nome traduzido dessa liga',

            'destaque.required' => 'Selecione se essa liga tem destaque',

            'status.required' => 'Selecione o status dessa liga'

        ];

        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $ligas = Ligas::find($id);

        $ligas->nome_traduzido = $input['nome_traduzido'];

        $ligas->destaque = $input['destaque'];

        $ligas->status = $input['status'];

        $ligas->save();



        return redirect('admin/api/ligas/listar')->with('sucesso', 'A liga foi editada com sucesso');

    }



    public function viewListarGerentes(){

        $sql = User::where('tipo_usuario', 3)->get();



        $data = [

            'sql' => $sql

        ];



        return view('admin.gerentes.listar', $data);

    }

    public function viewCadastrarGerentes(){

        return view('admin.gerentes.cadastrar');

    }

    public function postCadastrarGerentes(Request $request){

        $input = $request->all();

        $rules = [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'cpf' => 'unique:users,cpf',

            'data_nascimento' => 'required',

            'password' => 'required|min:6',

            'comissao' => 'required'

        ];



        $messages = [

            'name.required' => 'Digite o nome completo desse usuário',

            'email.required' => 'Digite o email desse usuário',

            'email.email' => 'Digite um email válido',

            'email.unique' => 'O email já esta cadastrado',

            'data_nascimento.required' => 'Digite a data de nascimento desse usuário',

            'password.min' => 'A senha deve ter ao menos 6 caracteres',

            'comissao.required' => 'Selecione a comissão desse gerente'

        ];



        $validation = Validator::make($input, $rules, $messages);


        if($validation->fails()){
            return back()->withInput()->withErrors($validation);

        }



        if(!isset($input['checkbox_op1'])){ $input['checkbox_op1'] = 0; }

        if(!isset($input['checkbox_op2'])){ $input['checkbox_op2'] = 0; }

        if(!isset($input['checkbox_op3'])){ $input['checkbox_op3'] = 0; }

        if(!isset($input['checkbox_op4'])){ $input['checkbox_op4'] = 0; }

        if(!isset($input['checkbox_op5'])){ $input['checkbox_op5'] = 0; }



        try{

            DB::beginTransaction();



            $usuario = new User;

            $usuario->name = $input['name'];

            $usuario->email = $input['email'];

            $usuario->password = Hash::make($input['password']);

            $usuario->data_nascimento = $input['data_nascimento'];

            $usuario->cpf = $input['cpf'];

            $usuario->status = $input['status'];

            $usuario->tipo_usuario = 3;

            $usuario->save();



            $campos = new GerentesCampos;

            $campos->idusuario = $usuario->id;

            $campos->pode_criar_cambistas = $input['checkbox_op1'];

            $campos->pode_alterar_cambistas = $input['checkbox_op2'];

            $campos->pode_editar_apostas_cambistas = $input['checkbox_op3'];

            $campos->pode_editar_limite_cambistas = $input['checkbox_op4'];

            $campos->pode_transferencia_cambistas = $input['checkbox_op5'];
            $campos->comissao = $input['comissao'];

            $campos->save();



            $creditos = new Creditos;

            $creditos->idusuario = $usuario->id;

            $creditos->saldo_bloqueado = 0;

            $creditos->saldo_liberado = 0;

            $creditos->saldo_apostas = 0;

            $creditos->save();



            DB::commit();



            return redirect('admin/gerentes/listar')->with('sucesso', 'Gerente cadastrado com sucesso');

        }catch(Exception $e){
            DB::rollback();



            return redirect('admin/gerentes/cadastrar')->with('erro', $e->getMessage());

        }

    }



    public function viewEditarGerentes($id){

        $sql = User::where('tipo_usuario', 3)->where('id', $id)->get();



        if(count($sql) < 1){

            return redirect('admin/gerentes/listar')->with('erro', 'Gerente não encontrado');

        }



        $campos = GerentesCampos::where('idusuario', $id)->first();
        
        $sql[0]->comissao = $campos->comissao;

        $data = [

            'sql' => $sql,

            'campos' => $campos

        ];



        return view('admin.gerentes.editar', $data);

    }

    public function postEditarGerentes(Request $request, $id){

        $input = $request->all();



        $rules = [

            'name' => 'required',

            'email' => 'required|email|unique:usuarios,email,'.$id.'',

            'cpf' => 'unique:usuarios,cpf,'.$id.'',

            'data_nascimento' => 'required',

            'comissao' => 'required'

        ];



        $messages = [

            'name.required' => 'Digite o nome completo desse usuário',

            'email.required' => 'Digite o email desse usuário',

            'email.email' => 'Digite um email válido',

            'email.unique' => 'O email já esta cadastrado',

            'cpf.unique' => 'Esse CPF já esta cadastrado',

            'data_nascimento.required' => 'Digite a data de nascimento desse usuário',

            'password.min' => 'A senha deve ter ao menos 6 caracteres',

            'comissao.required' => 'Selecione a comissão desse gerente'

        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $sql = User::where('tipo_usuario', 3)->where('id', $id)->get();



        if(count($sql) < 1){

            return redirect('admin/gerentes/listar')->with('erro', 'Gerente não encontrado');

        }



        if(!isset($input['checkbox_op1'])){ $input['checkbox_op1'] = 0; }

        if(!isset($input['checkbox_op2'])){ $input['checkbox_op2'] = 0; }

        if(!isset($input['checkbox_op3'])){ $input['checkbox_op3'] = 0; }

        if(!isset($input['checkbox_op4'])){ $input['checkbox_op4'] = 0; }

        if(!isset($input['checkbox_op5'])){ $input['checkbox_op5'] = 0; }



        try{

            DB::beginTransaction();



            $usuario = User::find($id);

            $usuario->name = $input['name'];

            $usuario->email = $input['email'];



            if($input['password'] != ''){

                $usuario->password = Hash::make($input['password']);

            }



            $usuario->data_nascimento = $input['data_nascimento'];

            $usuario->cpf = $input['cpf'];

            $usuario->status = $input['status'];

            $usuario->save();



            $campos = GerentesCampos::where('idusuario', $usuario->id)->first();
            if($campos){
                $campos->pode_criar_cambistas = $input['checkbox_op1'];

                $campos->pode_alterar_cambistas = $input['checkbox_op2'];
    
                $campos->pode_editar_apostas_cambistas = $input['checkbox_op3'];
    
                $campos->pode_editar_limite_cambistas = $input['checkbox_op4'];
    
                $campos->pode_transferencia_cambistas = $input['checkbox_op5'];
                $campos->comissao = $input['comissao'];
    
    
                $campos->save();
            }else{
                $campos = new GerentesCampos;
                $campos->idusuario = $usuario->id;

                $campos->pode_criar_cambistas = $input['checkbox_op1'];
    
                $campos->pode_alterar_cambistas = $input['checkbox_op2'];
    
                $campos->pode_editar_apostas_cambistas = $input['checkbox_op3'];
    
                $campos->pode_editar_limite_cambistas = $input['checkbox_op4'];
    
                $campos->pode_transferencia_cambistas = $input['checkbox_op5'];
                $campos->comissao = $input['comissao'];
    
                $campos->save();
            }





            DB::commit();



            return redirect('admin/gerentes/listar')->with('sucesso', 'Gerente cadastrado com sucesso');

        }catch(Exception $e){

            DB::rollback();



            return redirect('admin/gerentes/cadastrar')->with('erro', $e->getMessage());

        }

    }



    public function viewListarCambistas(){
        if(Auth::user()->tipo_usuario == 3){
            $sql = User::where('tipo_usuario', 4)->where('idgerente', Auth::user()->id)->get();

        }
        else{    
            $sql = User::where('tipo_usuario', 4)->get();
        }


        $data = [

            'sql' => $sql

        ];



        return view('admin.cambistas.listar', $data);

    }

    public function viewCadastrarCambistas(){
        $sql = User::where('tipo_usuario', 3)->get();

        $arrayUsuarios = [];



        if(count($sql) > 0){

            foreach($sql as $dados){

                $arrayUsuarios[$dados->id] = $dados->name;

            }

        }



        $data = [

            'arrayUsuarios' => $arrayUsuarios

        ];



        return view('admin.cambistas.cadastrar', $data);

    }

    public function postCadastrarCambistas(Request $request){

        $input = $request->all();
        $rules = [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'cpf' => 'required|unique:users,cpf',

            'data_nascimento' => 'required',

            'password' => 'required|min:6',

            'idgerente' => 'required',

        ];



        $messages = [

            'name.required' => 'Digite o nome completo desse usuário',

            'email.required' => 'Digite o email desse usuário',

            'email.email' => 'Digite um email válido',

            'email.unique' => 'O email já esta cadastrado',

            'cpf.required' => 'Digite o CPF desse usuário',

            'cpf.unique' => 'Esse CPF já esta cadastrado',

            'data_nascimento.required' => 'Digite a data de nascimento desse usuário',

            'password.min' => 'A senha deve ter ao menos 6 caracteres',

            'idgerente.required' => 'Selecione um gerente para vincular ao cambista',

        ];



        $validation = Validator::make($input, $rules, $messages);

        

        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        try{

            DB::beginTransaction();



            $usuario = new User;

            $usuario->name = $input['name'];

            $usuario->email = $input['email'];

            $usuario->password = Hash::make($input['password']);

            $usuario->data_nascimento = $input['data_nascimento'];

            $usuario->cpf = $input['cpf'];

            $usuario->status = $input['status'];

            $usuario->tipo_usuario = 4;

            $usuario->idgerente = $input['idgerente'];

            $usuario->save();



            $comissoes = new CambistasComissoes;

            $comissoes->idusuario = $usuario->id;

            $comissoes->comissao1jogo = $input['comissao1jogo'];

            $comissoes->comissao2jogo = $input['comissao2jogo'];

            $comissoes->comissao3jogo = $input['comissao3jogo'];

            $comissoes->comissao4jogo = $input['comissao4jogo'];

            $comissoes->comissao5jogo = $input['comissao5jogo'];

            $comissoes->comissao6jogo = $input['comissao6jogo'];

            $comissoes->comissao7jogo = $input['comissao7jogo'];

            $comissoes->comissao8maisjogo = $input['comissao8maisjogo'];

            $comissoes->save();



            $creditos = new Creditos;

            $creditos->idusuario = $usuario->id;

            $creditos->saldo_bloqueado = 0;

            $creditos->saldo_liberado = 0;

            $creditos->saldo_apostas = 0;

            $creditos->save();



            DB::commit();



            return redirect('admin/cambistas/listar')->with('sucesso', 'Cambista cadastrado com sucesso');

        }catch(Exception $e){

            DB::rollback();



            return redirect('admin/cambistas/cadastrar')->with('erro', $e->getMessage());

        }

    }



    public function viewEditarCambistas($id){

        $sql = User::where('tipo_usuario', 4)->where('id', $id)->get();



        if(count($sql) < 1){

            return redirect('admin/cambistas/listar')->with('erro', 'Cambista não encontrado');

        }



        $sqlGerentes = User::where('tipo_usuario', 3)->get();

        $arrayUsuarios = [];



        if(count($sqlGerentes) > 0){

            foreach($sqlGerentes as $dados){

                $arrayUsuarios[$dados->id] = $dados->name;

            }

        }



        $comissoes = CambistasComissoes::where('idusuario', $id)->first();



        $data = [

            'sql' => $sql,

            'arrayUsuarios' => $arrayUsuarios,

            'comissoes' => $comissoes

        ];



        return view('admin.cambistas.editar', $data);

    }

    public function postEditarCambistas(Request $request, $id){

        $input = $request->all();



        $rules = [

            'name' => 'required',

            'email' => 'required|email|unique:usuarios,email,'.$id.'',

            'cpf' => 'required|unique:usuarios,cpf,'.$id.'',

            'data_nascimento' => 'required',

            'idgerente' => 'required',

        ];



        $messages = [

            'name.required' => 'Digite o nome completo desse usuário',

            'email.required' => 'Digite o email desse usuário',

            'email.email' => 'Digite um email válido',

            'email.unique' => 'O email já esta cadastrado',

            'cpf.required' => 'Digite o CPF desse usuário',

            'cpf.unique' => 'Esse CPF já esta cadastrado',

            'data_nascimento.required' => 'Digite a data de nascimento desse usuário',

            'password.min' => 'A senha deve ter ao menos 6 caracteres',

            'idgerente.required' => 'Selecione um gerente para vincular ao cambista',


        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $sql = User::where('tipo_usuario', 4)->where('id', $id)->get();



        if(count($sql) < 1){

            return redirect('admin/cambistas/listar')->with('erro', 'Gerente não encontrado');

        }



        try{

            DB::beginTransaction();



            $usuario = User::find($id);

            $usuario->name = $input['name'];

            $usuario->email = $input['email'];



            if($input['password'] != ''){

                $usuario->password = Hash::make($input['password']);

            }



            $usuario->data_nascimento = $input['data_nascimento'];

            $usuario->cpf = $input['cpf'];

            $usuario->status = $input['status'];

            $usuario->idgerente = $input['idgerente'];

            $usuario->save();



            $comissoes = CambistasComissoes::where('idusuario', $usuario->id)->get();

            $comissoes[0]->comissao1jogo = $input['comissao1jogo'];

            $comissoes[0]->comissao2jogo = $input['comissao2jogo'];

            $comissoes[0]->comissao3jogo = $input['comissao3jogo'];

            $comissoes[0]->comissao4jogo = $input['comissao4jogo'];

            $comissoes[0]->comissao5jogo = $input['comissao5jogo'];

            $comissoes[0]->comissao6jogo = $input['comissao6jogo'];

            $comissoes[0]->comissao7jogo = $input['comissao7jogo'];

            $comissoes[0]->comissao8maisjogo = $input['comissao8maisjogo'];

            $comissoes[0]->save();



            DB::commit();



            return redirect('admin/cambistas/listar')->with('sucesso', 'Cambista editado com sucesso');

        }catch(Exception $e){

            DB::rollback();



            return redirect('admin/cambistas/cadastrar')->with('erro', $e->getMessage());

        }

    }

    public function viewCaixaGerentes(){

        if(Auth::user()->tipo_usuario == 2){
            $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')
            ->where('tipo_usuario', 4)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')
            ->get();
            $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 3)->sum('creditos.saldo_liberado');
            $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
            $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,1)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
            $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.possivel_retorno');
            $total = $entrada - $saida - $comissoes;

        }else if(Auth::user()->tipo_usuario == 3){
            $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')

            ->where('tipo_usuario', 4)->where('idgerente', Auth::user()->id)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')

            ->get();
             $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario',3)->where('idgerente', Auth::user()->id)->sum('creditos.saldo_liberado');
             $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
             $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,1)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
             $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.possivel_retorno');
             $credito = Creditos::where('idusuario',  Auth::user()->id)->first();
             $comissao = $credito->saldo_liberado;
             $total = $entrada - $saida - $comissao;

             
        }
        else{
            return Redirect()->back();

        }

        $data = [

            'sql' => $sql,
            'comissoes' => $comissoes,
            'entrada' => $entrada,
            'saida' => $saida,
            'comissao' => $comissao,
            'total' => $total,
            'entradaPendente' => $entradaPendente,

        ];



        return view('admin.financeiro.caixa_gerentes', $data);

    }



    public function viewLancamentoCaixaGerente($id){

        $dados_usuario = User::where('id', $id)->where('tipo_usuario', 3)->get();

        $creditos_atual = Creditos::where('idusuario', $id)->get();



        $data = [

            'dados_usuario' => $dados_usuario,

            'creditos_atuais' => $creditos_atual

        ];



        return view('admin.financeiro.lancamento_gerente', $data);

    }



    public function postLancamentoCaixaGerente(Request $request, $id){

        $input = $request->all();



        $rules = [

            'idtipo_lancamento' => 'required',

            'valor' => 'required'

        ];



        $messages = [

            'idtipo_lancamento.required' => 'Selecione o tipo de lançamento',

            'valor.required' => 'Digite o valor desse lançamento'

        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $input['valor'] = str_replace('R$ ', '', $input['valor']);

        $input['valor'] = str_replace('.', '', $input['valor']);

        $input['valor'] = str_replace(',', '.', $input['valor']);



        $usuario = User::where('id', $id)->where('tipo_usuario', 3)->get();



        if(count($usuario) < 1){

            return redirect('admin/gerentes/caixa')->with('erro', 'Usuário não encontrado');

        }



        try{

            DB::beginTransaction();



            $creditos = Creditos::where('idusuario', $usuario[0]->id)->get();



            if($input['idtipo_lancamento'] == 5){

                //liberado

                Creditos::where('idusuario', $usuario[0]->id)->update([

                    'saldo_liberado' => DB::raw("(saldo_liberado + ".$input['valor'].")")

                ]);

            }elseif($input['idtipo_lancamento'] == 6){

                //bloqueado

                Creditos::where('idusuario', $usuario[0]->id)->update([

                    'saldo_bloqueado' => DB::raw("(saldo_bloqueado + ".$input['valor'].")")

                ]);

            }elseif($input['idtipo_lancamento'] == 7){

                //apostas

                Creditos::where('idusuario', $usuario[0]->id)->update([

                    'saldo_apostas' => DB::raw("(saldo_apostas + ".$input['valor'].")")

                ]);

            }



            $lancamentos = new LancamentosCaixa;

            $lancamentos->idtipo_lancamento = $input['idtipo_lancamento'];

            $lancamentos->idusuario = $usuario[0]->id;

            $lancamentos->valor = $input['valor'];

            $lancamentos->save();



            DB::commit();



            return redirect('admin/gerentes/caixa')->with('sucesso', 'Lançamento efetuado com sucesso');

        }catch(\Exception $e){

            DB::rollback();



            return back()->with('erro', $e->getMessage());

        }

    }

    public function viewHistoricoLancamentos(Request $request, $id){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }



        $sql = LancamentosCaixa::leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"))->where('lancamentos_caixa.idusuario', $id)

        ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();



        $usuario = User::find($id);



        $data = [

            'sql' => $sql,

            'usuario' => $usuario,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ]

        ];



        return view('admin.financeiro.historico_gerente', $data);

    }

    public function viewHistoricoLancamentosGerentes(Request $request){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }

        if(Auth::user()->tipo_usuario == 2){

            $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 3)

            ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();
        }else if(Auth::user()->tipo_usuario == 3){
            $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 3)
            ->where('users.id', Auth::user()->id)
            ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();
        }else{
            return Redirect()->back();
        }

        $data = [

            'sql' => $sql,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ]

        ];



        return view('admin.financeiro.historico_gerente_todos', $data);

    }

    public function viewCaixaCambistas(){

        if(Auth::user()->tipo_usuario == 2){
            $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')
            ->where('tipo_usuario', 4)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')
            ->get();
            $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 4)->sum('creditos.saldo_liberado');
            $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
            $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,1)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
            $lancamentos = Creditos::sum('lancamento');
            $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.possivel_retorno');
            $comissao = $comissoes;
            $total =  $entrada - $saida - $comissoes + $lancamentos;

        }else if(Auth::user()->tipo_usuario == 3){
             $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 4)->where('idgerente', Auth::user()->id)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')->get();
             $comissoes = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 4)->where('idgerente', Auth::user()->id)->sum('creditos.saldo_liberado');
             $lancamentos = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')->where('tipo_usuario', 4)->where('idgerente', Auth::user()->id)->sum('creditos.lancamento');
             $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
             $entradaPendente = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,1)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
             $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente',  Auth::user()->id)->where('cupom_aposta.status' ,2)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.possivel_retorno');
             $total = $entrada - $saida - $comissoes + $lancamentos;
    
        }
        else if(Auth::user()->tipo_usuario == 4){
            $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')

            ->where('tipo_usuario', 4)->where('idusuario', Auth::user()->id)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')

            ->get();
            $entrada = CupomAposta::where('idcambista',  Auth::user()->id)->where('status' ,'!=',4)->where('caixa' , 0)->sum('valor_apostado');
            $entradaPendente = CupomAposta::where('idcambista',  Auth::user()->id)->where('status',1)->where('caixa' , 0)->sum('valor_apostado');
            $saida = CupomAposta::where('idcambista',  Auth::user()->id)->where('status' ,2)->where('caixa' , 0)->sum('possivel_retorno');
            $credito = Creditos::where('idusuario',  Auth::user()->id)->first();
            $comissao = $credito->saldo_liberado;
            $lancamentos = $credito->lancamento;
            $total= $entrada - $saida - $comissao + $lancamentos;
        }
        else{
            return Redirect()->back();

        }

        // $entrada = CupomAposta::joinwhere('idcambista', $row->idusuario)->where('status' ,'!=',4)->sum('valor_apostado');
       
        // $saida = CupomAposta::where('idcambista', $row->idusuario)->where('status' ,2)->sum('possivel_retorno');


        $data = [

            'sql' => $sql,
            'comissoes' => $comissoes,
            'entrada' => $entrada,
            'saida' => $saida,
            'comissao' => $comissao,
            'lancamento' => $lancamentos,
            'total' => $total,
            'entradaPendente' => $entradaPendente,

        ];


        return view('admin.financeiro.caixa_cambistas', $data);

    }


    public function ajaxViewCaixaCambista(){
        if(Auth::user()->tipo_usuario == 3 || Auth::user()->tipo_usuario == 2){
            $model =  User::leftJoin('creditos', 'creditos.idusuario','=','users.id');
            if(Auth::user()->tipo_usuario == 3){
                $model->where('users.idgerente', Auth::user()->id);
            }
            
            $model->where('tipo_usuario', 4)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*');
            // $model =  User::where('tipo_usuario', 4)->toArray();
            return Datatables::of( $model)
                    ->addIndexColumn()
                    ->addColumn('entrada', function($row){
                        $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('valor_apostado');
                        return  "<span class='badge badge-success'>
                        R$ ".number_format($entrada,2,',','.')." </span>";
                    })
                    ->addColumn('saida', function($row){
                        $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status',2)->where('cupom_aposta.caixa' , 0)->sum('possivel_retorno');
                        return  "<span class='badge badge-danger'>
                        R$ ".number_format($saida,2,',','.')." </span>";
                    })
                    ->addColumn('lancamento', function($row){
                        $lancamento =  "R$ ".number_format($row->lancamento,2,',','.');
                        return $lancamento;
                    })
                    ->addColumn('comissao', function($row){
                        return  "<span class='badge badge-warning'>
                        R$ ".number_format($row->saldo_liberado,2,',','.')." </span>";
                    })
                    ->addColumn('status', function($row){
                        $status = '';
    
    
                        if($row->status == 1){
    
                            $status = '<span class="badge badge-success">Ativo</div>';
    
                        }elseif($row->status == 0){
    
                            $status = '<span class="badge badge-danger">Inativo</span>';
    
                        }
                        return $status;
                      
                    })
                    ->addColumn('action', function($row){
                        $action = '<div class="dropdown">
    
                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
    
                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
    
                        </button>
    
                        <div class="dropdown-menu">';
                            if(Auth::user()->tipo_usuario == 2 ){
                                $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('valor_apostado');
                                $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status',2)->where('cupom_aposta.caixa' , 0)->sum('possivel_retorno');
                                $comissao = number_format($row->saldo_liberado,2,',','.');
                                $lancamento = number_format($row->lancamento,2,',','.');
                                $total = $entrada - $saida - $row->saldo_liberado + $row->lancamento;
                                $action .= '<a class="dropdown-item caixa" href="#" data-toggle="modal" data-target="#caixa" data-id="'.$row->id.'" data-nome="'.$row->name.'" data-entrada="'.number_format($entrada,2,',','.').'" data-saida="'.number_format($saida,2,',','.').'" data-comissao="'.$comissao.'" data-lancamento="'.$lancamento.'" data-total="'.$total.'">Ver Caixa</a>';
                                $action .= '<a class="dropdown-item" href="/admin/fechar/caixa/cambista/'.$row->idusuario.'">Fechar Caixa</a>';
                                // $action .= '<a class="dropdown-item" href="/admin/cambista/historico/'.$row->idusuario.'">Ver Lançamentos</a>';
                            }
                            $action .= '<a class="dropdown-item" href="/admin/ver/cambista/'.$row->idusuario.'">Ver Bilhetes</a>
                            <a class="dropdown-item" target="_blank" href="/minhas-apostas/visualizar-cupom/'.$row->codigo_unico.'">Ver Cupom</a>

                        </div>
                    </div>';
                    return $action;

                      
                    })
    
                    ->rawColumns(['entrada','saida','comissao', 'status', 'action'])
                    ->make();
        }else{
            return Redirect()->back();
        }
        
    }


    public function cancelarBilhete(Request $request){

        $bilhete = CupomAposta::find($request->id);

        if($bilhete){
            if(Auth::user()->tipo_usuario == 2 ){
                $bilhete->status = 5;
                $bilhete->save();

                $cambista = User::find( $bilhete->idcambista);
                $quantidade = CupomApostaItem::where('idcupom',$bilhete->id)->count();


                if($cambista){
                    $comissoes = CambistasComissoes::where('idusuario', $cambista->id)->first();

                    if($comissoes){
                        if($quantidade == 1){ $porcentagem = $comissoes->comissao1jogo / 100; }
                        if($quantidade == 2){ $porcentagem = $comissoes->comissao2jogo / 100; }
                        if($quantidade == 3){ $porcentagem = $comissoes->comissao3jogo / 100; }
                        if($quantidade == 4){ $porcentagem = $comissoes->comissao4jogo / 100; }
                        if($quantidade == 5){ $porcentagem = $comissoes->comissao5jogo / 100; }
                        if($quantidade == 6){ $porcentagem = $comissoes->comissao6jogo / 100; }
                        if($quantidade == 7){ $porcentagem = $comissoes->comissao7jogo / 100; }
                        if($quantidade >= 8){ $porcentagem = $comissoes->comissao7jogo / 100; }
                        $comissao = $bilhete->valor_apostado * $porcentagem;
                        $credito = Creditos::where('idusuario', $cambista->id)->first();
                        $credito->saldo_liberado = $credito->saldo_liberado - $comissao;
                        $credito->save();
                        
                    }
                }
                return Redirect()->back()->with('sucesso', 'Bilhete Cancelado com sucesso!');

            }else if(Auth::user()->tipo_usuario == 4){

                if($bilhete->created_at->addMinutes(20) < \Carbon\Carbon::now()){
                    return Redirect()->back()->with('erro', 'Tempo expirado para cancelamento de aposta');
                }

                $jogos = CupomApostaItem::join('events','events.id', 'cupom_aposta_item.idevent')->where('idcupom', $bilhete->id)->get();
                foreach ($jogos as $jogo) {
                    if($jogo->data < \Carbon\Carbon::now()){
                        return Redirect()->back()->with('erro', 'Você não pode cancelar apostas com jogos já iniciado');

                    }
                }
                $bilhete->status = 5;
                $bilhete->save();
                $cambista = User::find( $bilhete->idcambista);
                $quantidade = CupomApostaItem::where('idcupom',$bilhete->id)->count();


                if($cambista){
                    $comissoes = CambistasComissoes::where('idusuario', $cambista->id)->first();

                    if($comissoes){
                        if($quantidade == 1){ $porcentagem = $comissoes->comissao1jogo / 100; }
                        if($quantidade == 2){ $porcentagem = $comissoes->comissao2jogo / 100; }
                        if($quantidade == 3){ $porcentagem = $comissoes->comissao3jogo / 100; }
                        if($quantidade == 4){ $porcentagem = $comissoes->comissao4jogo / 100; }
                        if($quantidade == 5){ $porcentagem = $comissoes->comissao5jogo / 100; }
                        if($quantidade == 6){ $porcentagem = $comissoes->comissao6jogo / 100; }
                        if($quantidade == 7){ $porcentagem = $comissoes->comissao7jogo / 100; }
                        if($quantidade >= 8){ $porcentagem = $comissoes->comissao7jogo / 100; }
                        $comissao = $bilhete->valor_apostado * $porcentagem;
                        $credito = Creditos::where('idusuario', $cambista->id)->first();
                        $credito->saldo_liberado = $credito->saldo_liberado - $comissao;
                        $credito->save();
                        
                    }
                }

                return Redirect()->back()->with('sucesso', 'Bilhete Cancelado com sucesso!');

            }else{
                return Redirect()->back()->with('error', 'Você não tem permissão');

            }

        }


    }
    public function ajaxViewCaixaCambistaGerente(){
        if(Auth::user()->tipo_usuario == 3 || Auth::user()->tipo_usuario == 2){
            $model =  User::leftJoin('creditos', 'creditos.idusuario','=','users.id');
            if(Auth::user()->tipo_usuario == 3){
                $model->where('users.idgerente', Auth::user()->id);
            }
            
            $model->where('tipo_usuario', 4)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*');
            // $model =  User::where('tipo_usuario', 4)->toArray();
            return Datatables::of( $model)
                    ->addIndexColumn()
                    ->addColumn('entrada', function($row){
                        $entrada = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('valor_apostado');
                        return  "<span class='badge badge-success'>
                        R$ ".number_format($entrada,2,',','.')." </span>";
                    })
                    ->addColumn('saida', function($row){
                        $saida = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status',2)->where('cupom_aposta.caixa' , 0)->sum('possivel_retorno');
                        return  "<span class='badge badge-danger'>
                        R$ ".number_format($saida,2,',','.')." </span>";
                    })
                    ->addColumn('comissao', function($row){
                        return  "<span class='badge badge-warning'>
                        R$ ".number_format($row->saldo_liberado,2,',','.')." </span>";
                    })
                 
                    ->addColumn('status', function($row){
                        $status = '';
    
    
    
                        if($row->status == 1){
    
                            $status = '<span class="badge badge-success">Ativo</div>';
    
                        }elseif($row->status == 0){
    
                            $status = '<span class="badge badge-danger">Inativo</span>';
    
                        }
                        return $status;
                      
                    })
                    ->addColumn('action', function($row){
                        $action = '<div class="dropdown">
    
                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
    
                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
    
                        </button>
    
                        <div class="dropdown-menu">';
                            $action .= '<a class="dropdown-item" href="/admin/ver/cambista/'.$row->idusuario.'">Ver Bilhetes</a>
                            <a class="dropdown-item" target="_blank" href="/minhas-apostas/visualizar-cupom/'.$row->codigo_unico.'">Ver Cupom</a>

                        </div>
                    </div>';
                    return $action;

                      
                    })
    
                    ->rawColumns(['entrada','saida','comissao', 'status', 'action'])
                    ->make();
        }else{
            return Redirect()->back();
        }
        
    }

    public function ajaxViewCaixaGerente(){
        if(Auth::user()->tipo_usuario == 2){
            $model =  User::leftJoin('creditos', 'creditos.idusuario','=','users.id');
            if(Auth::user()->tipo_usuario == 3){
                $model->where('users.idgerente', Auth::user()->id);
            }
            
            $model->where('tipo_usuario', 3)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*');
            // $model =  User::where('tipo_usuario', 4)->toArray();
            return Datatables::of( $model)
                    ->addIndexColumn()
                    ->addColumn('entrada', function($row){
                        $entrada = CupomAposta::join('users', 'users.id', '=', 'cupom_aposta.idusuario')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.valor_apostado');
                        return  "<span class='badge badge-success'>
                        R$ ".number_format($entrada,2,',','.')." </span>";
                    })
                    ->addColumn('saida', function($row){
                        $saida = CupomAposta::join('users', 'users.id', '=', 'cupom_aposta.idusuario')->where('users.idgerente', $row->idusuario)->where('cupom_aposta.status',2)->where('cupom_aposta.caixa' , 0)->sum('cupom_aposta.possivel_retorno');
                        return  "<span class='badge badge-danger'>
                        R$ ".number_format($saida,2,',','.')." </span>";
                    })
                    ->addColumn('comissao', function($row){
                        $entradaSite = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.status' ,'!=',5)->sum('cupom_aposta.valor_apostado');
                        $saidaSite = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,2)->sum('cupom_aposta.possivel_retorno');
                        $comissaoGerente = GerentesCampos::where('idusuario',$row->idusuario)->first();
                        $porcentagem = $comissaoGerente->comissao / 100;
                        $comissao = ($entradaSite + $saidaSite) * $porcentagem;
                        return  "<span class='badge badge-warning'>
                        R$ ".number_format($comissao,2,',','.')." </span>";
                    })
                 
                    ->addColumn('status', function($row){
                        $status = '';
    
    
    
                        if($row->status == 1){
    
                            $status = '<span class="badge badge-success">Ativo</div>';
    
                        }elseif($row->status == 0){
    
                            $status = '<span class="badge badge-danger">Inativo</span>';
    
                        }
                        return $status;
                      
                    })
                    ->addColumn('action', function($row){
                        $action = '<div class="dropdown">
    
                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
    
                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
    
                        </button>
    
                        <div class="dropdown-menu">';
                            if(Auth::user()->tipo_usuario == 2 ){
                                $action .= '<a class="dropdown-item" href="/admin/fechar/caixa/gerente/'.$row->idusuario.'">Fechar Caixa</a>';
                                // $action .= '<a class="dropdown-item" href="/admin/gerente/historico/'.$row->idusuario.'">Ver Historico de Pagamento</a>';
                            }
                            $action .= '<a class="dropdown-item" href="/admin/ver/gerente/'.$row->idusuario.'">Ver Gerente</a>
                        </div>
                    </div>';
                      return $action;
                    })
    
                    ->rawColumns(['entrada','saida','comissao', 'status', 'action'])
                    ->make();
        }else{
            return Redirect()->back();
        }
        
    }

    public function fecharCaixaGerente(Request $request){
        if(Auth::user()->tipo_usuario == 2){
            try {
                DB::beginTransaction();

                $credito = Creditos::where('idusuario',  $request->id)->first();
                $entradaSite = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,'!=',4)->where('cupom_aposta.status' ,'!=',5)->sum('cupom_aposta.valor_apostado');
                $saidaSite = CupomAposta::join('users', 'cupom_aposta.idusuario','=','users.id')->where('cupom_aposta.status' ,2)->sum('cupom_aposta.possivel_retorno');
                $comissaoGerente = GerentesCampos::where('idusuario',Auth::user()->idgerente)->first();
                $porcentagem = $comissaoGerente->comissao / 100;
                $comissao = ($entradaSite + $saidaSite) * $porcentagem;
                $id = hexdec(uniqid());
                $historic = User::find($request->id)->historics()->create([
                    'type' => 'P',
                    'user_id_transaction' =>  Auth::user()->id,
                    'amount' => $comissao,
                    'total_before' =>$comissao,
                    'total_after' => 0,
                    'date' => date('Ymdhis'),
                    'status' => 1
                ]);
                $credito->saldo_liberado =  0 ;
                $credito->save();
                DB::commit();
    
                return Redirect()->back()->with('sucesso', 'Caixa Fechado com Sucesso');

    
            } catch (\Throwable $th) {
                DB::rollback();

                return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');
               
            }
        }

    }
    public function fecharCaixaCambista(Request $request){
        if(Auth::user()->tipo_usuario == 2){
            try {
                DB::beginTransaction();

                $credito = Creditos::where('idusuario',  $request->id)->first();
                $bilhetesAtivos = CupomAposta::where('caixa',  0)->where('caixa',  1)->where('idcambista', $request->id)->orderBy('id', 'desc')->exists();
                if($bilhetesAtivos){
                    return Redirect()->back()->with('error', 'Não foi possivel fechar o caixa, pois o cambista contém bilhetes em aberto!');

                }
                $bilhetes = CupomAposta::where('caixa',  0)->where('idcambista', $request->id)->orderBy('id', 'desc')->get();
                foreach($bilhetes as $bilhete){
                    $bilhete->caixa = 1;
                    $bilhete->save();
                }
                $id = hexdec(uniqid());
                $historic = User::find($request->id)->historics()->create([
                    'type' => 'P',
                    'user_id_transaction' => Auth::user()->id,
                    'amount' => $credito->saldo_liberado,
                    'total_before' => $credito->saldo_liberado,
                    'total_after' => 0,
                    'date' => date('Ymdhis'),
                    'status' => 1
                ]);
                $historic = User::find($request->id)->historics()->create([
                    'type' => 'L',
                    'user_id_transaction' => Auth::user()->id,
                    'amount' => $credito->lancamento,
                    'total_before' => $credito->lancamento,
                    'total_after' => 0,
                    'date' => date('Ymdhis'),
                    'status' => 1
                ]);
                $credito->saldo_liberado =  0 ;
                $credito->lancamento =  0;
                $credito->save();
                DB::commit();
    
                return Redirect()->back()->with('sucesso', 'Caixa Fechado com Sucesso');

    
            } catch (\Throwable $th) {
                DB::rollback();
                return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');
               
            }
        }

    }

    public function viewLancamentoCaixaCambista($id){

        $dados_usuario = User::where('id', $id)->where('tipo_usuario', 4)->get();

        $creditos_atual = Creditos::where('idusuario', $id)->get();



        $data = [

            'dados_usuario' => $dados_usuario,

            'creditos_atuais' => $creditos_atual

        ];



        return view('admin.financeiro.lancamento_cambista', $data);

    }



    public function postLancamentoCaixaCambista(Request $request, $id){

        $input = $request->all();



        $rules = [

            'idtipo_lancamento' => 'required',

            'valor' => 'required'

        ];



        $messages = [

            'idtipo_lancamento.required' => 'Selecione o tipo de lançamento',

            'valor.required' => 'Digite o valor desse lançamento'

        ];



        $validation = Validator::make($input, $rules, $messages);



        if($validation->fails()){

            return back()->withInput()->withErrors($validation);

        }



        $input['valor'] = str_replace('R$ ', '', $input['valor']);

        $input['valor'] = str_replace('.', '', $input['valor']);

        $input['valor'] = str_replace(',', '.', $input['valor']);



        $usuario = User::where('id', $id)->where('tipo_usuario', 4)->get();



        if(count($usuario) < 1){

            return redirect('admin/cambistas/caixa')->with('erro', 'Usuário não encontrado');

        }



        try{

            DB::beginTransaction();



            $creditos = Creditos::where('idusuario', $usuario[0]->id)->get();

            $creditoAnterior = Creditos::where('idusuario', $usuario[0]->id)->first();


            if($input['idtipo_lancamento'] == 5){

                //liberado
                Creditos::where('idusuario', $usuario[0]->id)->update([

                    'saldo_liberado' => DB::raw("(saldo_liberado + ".$input['valor'].")")

                ]);

                $historic = User::find($id)->historics()->create([
                    'type' => 'D',
                    'user_id_transaction' => auth()->user()->id,
                    'amount' => $input['valor'],
                    'total_before' => $creditoAnterior->saldo_liberado,
                    'total_after' => $creditoAnterior->saldo_liberado + $input['valor'],
                    'date' => date('Ymdhis'),
                    'status' => 1
                ]);

            }elseif($input['idtipo_lancamento'] == 7){

                //bloqueado

                Creditos::where('idusuario', $usuario[0]->id)->update([

                    'saldo_aposta' => DB::raw("(saldo_aposta + ".$input['valor'].")")

                ]);
                $historic = User::find($id)->historics()->create([
                    'type' => 'D',
                    'user_id_transaction' => auth()->user()->id,
                    'amount' => $input['valor'],
                    'total_before' => $creditoAnterior->saldo_aposta,
                    'total_after' => $creditoAnterior->saldo_aposta  + $input['valor'],
                    'date' => date('Ymdhis'),
                    'status' => 1
                ]);

            }elseif($input['idtipo_lancamento'] == 6){

                //apostas

                Creditos::where('idusuario', $usuario[0]->id)->update([

                    'lancamento' => DB::raw("(lancamento + ".$input['valor'].")")

                ]);

                $historic = User::find($id)->historics()->create([
                    'type' => 'L',
                    'user_id_transaction' => auth()->user()->id,
                    'amount' => $input['valor'],
                    'total_before' => $creditoAnterior->lancamento,
                    'total_after' => $creditoAnterior->lancamento  + $input['valor'],
                    'date' => date('Ymdhis'),
                    'status' => 1
                ]);

            }

          

            // $lancamentos = new LancamentosCaixa;

            // $lancamentos->idtipo_lancamento = $input['idtipo_lancamento'];

            // $lancamentos->idusuario = $usuario[0]->id;

            // $lancamentos->valor = $input['valor'];

            // $lancamentos->save();



            DB::commit();



            return redirect('admin/cambistas/caixa')->with('sucesso', 'Lançamento efetuado com sucesso');

        }catch(\Exception $e){

            DB::rollback();



            return back()->with('erro', $e->getMessage());

        }

    }

    public function viewHistoricoLancamentosCambistas(Request $request, $id){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }



            $sql = LancamentosCaixa::leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"))->where('lancamentos_caixa.idusuario', $id)
            ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();
        


        $usuario = User::find($id);



        $data = [

            'sql' => $sql,

            'usuario' => $usuario,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ]

        ];



        return view('admin.financeiro.historico_cambista', $data);

    }
    public function viewHistoricoLancamentosUsuario(Request $request, $id){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }



        $sql = LancamentosCaixa::leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"))->where('lancamentos_caixa.idusuario', $id)

        ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();



        $usuario = User::find($id);



        $data = [

            'sql' => $sql,

            'usuario' => $usuario,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ]

        ];



        return view('admin.financeiro.historico_usuario', $data);

    }
    public function viewHistoricoLancamentosCambistasGeral(Request $request){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }


        if(Auth::user()->tipo_usuario == 2){
            $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 4)

            ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();
        }
        else if(Auth::user()->tipo_usuario == 3){
            $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 4)
            ->where('users.idgerente', Auth::user()->id)
            ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();
        }else if(Auth::user()->tipo_usuario == 4){
            $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 4)
            ->where('users.id', Auth::user()->id)
            ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();

        }else{
            return Redirect()->back();
        }

        $data = [

            'sql' => $sql,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ]

        ];



        return view('admin.financeiro.historico_cambistas_todos', $data);

    }

    public function viewHistoricoLancamentosUsuariosGeral(Request $request){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }



        $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 1)

        ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();







        $data = [

            'sql' => $sql,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ]

        ];



        return view('admin.financeiro.historico_usuarios_todos', $data);

    }

    public function viewMapaAposta(Request $request){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }



        if(!isset($input['filtro_esporte'])){ $input['filtro_esporte'] = 1; }

        if(!isset($input['filtro_liga'])){ $input['filtro_liga'] = ''; }

        if(!isset($input['filtro_pais'])){ $input['filtro_pais'] = ''; }

        $sql = Events::leftJoin('ligas', 'ligas.id','=','events.idliga')

            ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')

            ->leftJoin('paises', 'paises.id','=','ligas.idpais')

            ->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idevent', '=', 'events.id')

            ->whereBetween('data', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59']);

            if($input['filtro_esporte'] != '' || $input['filtro_liga'] != '' ||$input['filtro_liga'] != ''){
               $sql->where(function($query) use ($input){

                    if($input['filtro_esporte'] != ''){
    
                        $query->where('esportes.id', $input['filtro_esporte']);
    
                    }
    
                    if($input['filtro_liga'] != ''){
    
                        $query->where('ligas.id', $input['filtro_liga']);
    
                    }
    
                    if($input['filtro_pais'] != ''){
    
                        $query->where('ligas.idpais', $input['filtro_pais']);
    
                    }
    
                });
            }
    
        $p = $sql->select("events.*", DB::raw("date_format(events.data, '%d/%m/%Y as %H:%i') as data_evento"), "ligas.nome_traduzido as nome_liga","esportes.nome_traduzido as nome_esporte", 
        "paises.nome as nome_pais", "paises.nome_traduzido as nome_pais_traduzido")->get();
  
        // $nova_query = $sql->select("events.*", DB::raw("date_format(events.data, '%d/%m/%Y as %H:%i') as data_evento"), "ligas.nome_traduzido as nome_liga", 
        // , DB::raw("sum(valor_apostado) as soma"))

        // ->get();

        $data = [

            'sql' =>$p,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ],

            'filtro' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat,

                'filtro_esporte' => $input['filtro_esporte'],

                'filtro_liga' => $input['filtro_liga'],

                'filtro_pais' => $input['filtro_pais']

            ]

        ];



        return view('admin.jogos.mapa_aposta', $data);

    }



    public function viewListarJogos(Request $request){

        $input = $request->all();



        try{

            $dataInicio = Carbon::createFromFormat('d/m/Y', $input['dataInicio']);

            $dataInicioUs = $dataInicio->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }catch(\Exception $e){

            $dataInicio = new Carbon();

            $dataInicioUs = $dataInicio->firstOfMonth()->format('Y-m-d');

            $dataInicioFormat = $dataInicio->format('d/m/Y');

        }



        try{

            $dataFinal = Carbon::createFromFormat('d/m/Y', $input['dataFinal']);

            $dataFinalUs = $dataFinal->format('Y-m-d');

            $dataFinalFormat = $dataFinal->format('d/m/Y');

        }catch(\Exception $e){

            $dataFinal = new Carbon();

            $dataFinalUs = $dataInicio->lastOfMonth()->format('Y-m-d');

            $dataFinalFormat = $dataInicio->format('d/m/Y');

        }



        if(!isset($input['filtro_esporte'])){ $input['filtro_esporte'] = 1; }

        if(!isset($input['filtro_liga'])){ $input['filtro_liga'] = ''; }

        if(!isset($input['filtro_pais'])){ $input['filtro_pais'] = ''; }



        $sql = Events::leftJoin('ligas', 'ligas.id','=','events.idliga')

            ->leftJoin('esportes', 'esportes.id','=','ligas.idesporte')

            ->leftJoin('paises', 'paises.id','=','ligas.idpais')

            ->whereBetween('data', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])

            ->where(function($query) use ($input){

                if($input['filtro_esporte'] != ''){

                    $query->where('esportes.id', $input['filtro_esporte']);

                }

                if($input['filtro_liga'] != ''){

                    $query->where('ligas.id', $input['filtro_liga']);

                }

                if($input['filtro_pais'] != ''){

                    $query->where('ligas.idpais', $input['filtro_pais']);

                }

            })->select("events.*", DB::raw("date_format(events.data, '%d/%m/%Y as %H:%i') as data_evento"), "ligas.nome_traduzido as nome_liga", "esportes.nome_traduzido as nome_esporte", "paises.nome as nome_pais", "paises.nome_traduzido as nome_pais_traduzido")

            ->orderBy('events.data', 'desc')->take('100')->get();



        $data = [

            'sql' => $sql,

            'datas' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat

            ],

            'filtro' => [

                'dataInicio' => $dataInicioFormat,

                'dataFinal' => $dataFinalFormat,

                'filtro_esporte' => $input['filtro_esporte'],

                'filtro_liga' => $input['filtro_liga'],

                'filtro_pais' => $input['filtro_pais']

            ]

        ];



        return view('admin.jogos.listar', $data);

    }



    public function ajaxRecuperaLigas(Request $request){

        $input = $request->all();



        if(!isset($input['filtro_pais'])){ $input['filtro_pais'] = ''; }

        if(!isset($input['filtro_esporte'])){ $input['filtro_esporte'] = ''; }



        $sql = Ligas::where(function($query) use ($input){

            if($input['filtro_pais'] != ''){

                $query->where('idpais', $input['filtro_pais']);

            }

            if($input['filtro_esporte'] != ''){

                $query->where('idesporte', $input['filtro_esporte']);

            }

        })->select('*')->orderBy('nome_original', 'asc')->get();



        $arrayResultado = [];



        if(count($sql) > 0){

            foreach($sql as $dados){

                $arrayResultado[$dados->id] = $dados->nome_original;

            }

        }



        return response()->json([

            'status' => 'ok',

            'resultado' => $arrayResultado

        ]);



    }



    public function desabilitarJogo($id){

        $sql = Events::find($id);

        $sql->status = 5;

        $sql->save();

    }



    public function viewFixos(){

        $sql = DB::table('campos_fixos')->where('id', 1)->get();



        $data = [

            'sql' => $sql

        ];



        return view('admin.fixos.index', $data);

    }

    public function postFixos(Request $request){

        $input = $request->all();


        if(floatval($input['nao-exibir-cotacao-menor']) != 0){
            $odds = Odds::where('odds', '<', $input['nao-exibir-cotacao-menor'])->where('odds', '!=', 0.00)->get();
            foreach($odds as $odd){
                $odd->odds = floatval($input['nao-exibir-cotacao-menor']);
                $odd->save();
            }
        }
        if(floatval($input['nao-exibir-cotacao-maior']) != 0){
            $odds = Odds::where('odds', '>',floatval($input['nao-exibir-cotacao-maior']))->get();
            foreach($odds as $odd){
                $odd->odds = floatval($input['nao-exibir-cotacao-maior']);
                $odd->save();
            }
        }
        DB::table('campos_fixos')->where('id', 1)->update([

            
            'regulamento' => $input['regulamento'],
            'nome_banca' => $input['nome_banca'],
            'telefone' => $input['telefone'],
            'valor_minimo_aposta' => floatval($input['valor-minimo-aposta']),
            'valor_maximo_aposta' => floatval($input['valor-maximo-aposta']),
            'valor_maximo_aposta_av' => floatval($input['valor-maximo-aposta-av']),
            'premio_maximo' => floatval($input['premio-maximo']),
            'nao_pagar_comissao_menor' =>floatval( $input['nao-pagar-comissao-menor']),
            'cotacao_minima' => floatval($input['cotacao-minima']),
            'cotacao_maxima' => floatval($input['cotacao-maxima']),
            'nao_exibir_cotacao_menor' => $input['nao-exibir-cotacao-menor'],
            'nao_exibir_cotacao_maior' => floatval($input['nao-exibir-cotacao-maior']),
            'quantidade_minima_jogos' => $input['quantidade-minima-jogos'],
            'quantidade_maxima_times_v' => $input['quantidade-maxima-times-v'],
            'rodape_cupom' => $input['rodape_cupom'],
            'pagamento' => $input['pagamento']

        ]);



        return redirect('admin/fixos')->with('sucesso', 'Campos atualizados com sucesso');

    }



    public function visualizarAposta($id){

        $sql = Events::find($id);



        if($sql == null){

            return back()->with('erro', 'Aposta não encontrada');

        }



        $apostas = Events::leftJoin('cupom_aposta_item', 'cupom_aposta_item.idevent', '=', 'events.id')

            ->select(DB::raw("count(*) as total"), DB::raw("sum(cupom_aposta_item.valor_apostado) as soma"), DB::raw("DATE_FORMAT(events.data, '%d/%m/%Y as %H:%i:%s') AS data_evento"))

            ->where('status_conferido', 0)->where('idevent', $id)->get();

        $aposta = CupomApostaItem::where('idevent', $id)->get();
        $t = 0;
        $q = 0;
        foreach($aposta as $ap){
           $bilhete = CupomAposta::find($ap->idcupom);
           $t += $bilhete->valor_apostado;
           $q++;
        }


        $tipos = Events::leftJoin('cupom_aposta_item', 'cupom_aposta_item.idevent', '=', 'events.id')

            ->leftJoin('odds','odds.id','=','cupom_aposta_item.idodds')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select(DB::raw("count(*) as total"), DB::raw("sum(cupom_aposta_item.valor_apostado) as soma"), 'odds.name','odds_subgrupo.titulo_traduzido','cupom_aposta_item.idodds')

            ->where('events.id', $id)

            ->groupBy('odds.id')->get();

        foreach($tipos as $tipo){
            $tipo->soma = 0;
            $apo = CupomApostaItem::where('idodds', $tipo->idodds)->get();
            foreach ($apo as $aposta ) {
                $bilhete = CupomAposta::find($aposta->idcupom);
                $tipo->soma += $bilhete->valor_apostado;
            }
           
        }

        $data = [

            'sql' => $sql,
            'total_apostado' => $t,
            'totalbilhete' => $q,

            'apostas' => $apostas,

            'tipos' => $tipos

        ];



        return view('admin.jogos.visualizar_apostas', $data);

    }

    public function viewGerenciamentoRisco(){

        // $sql = CupomAposta::where('cupom_aposta.status',1)

        //     ->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')

        //     ->select('cupom_aposta_item.*', 'cupom_aposta.valor_apostado as valor_apostado1', 'cupom_aposta.possivel_retorno as possivel_retorno1')

        //     ->get();




        // $sql = CupomAposta::where('cupom_aposta.status', 1)->get();

        // if(count($sql) > 0){

        //     foreach($sql as $dados){

        //         $sql2 = CupomApostaItem::where('idcupom', $dados->id)->get();



        //         $array = [];

        //         if(count($sql2) > 0){

        //             foreach($sql2 as $dados2){

        //                 $array[] = $dados2->idevent;

        //             }

        //         }



        //         $sql3 = CupomAposta::where('cupom_aposta.status',1)->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')->get();

        //         if(count($sql3) > 0){

        //             $erro = 0;

        //             foreach($sql3 as $dados3){

        //                 if(!in_array($dados3->idevent, $array)){

        //                     $erro = 1;

        //                 }

        //             }



        //             // if($erro == 0){

        //             //     $c = new CuponsIguais;

        //             //     $c->

        //             // }

        //         }

        //     }

        // }



        $sql = CupomAposta::where('cupom_aposta.status',1)->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')
        ->select('cupom_aposta_item.*','cupom_aposta.*', 'cupom_aposta.valor_apostado as valor_apostado', 'cupom_aposta.possivel_retorno as possivel_retorno')
        ->get();



        $data = [

            'sql' => $sql

        ];



        return view('admin.jogos.gerenciamento_risco', $data);

    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function viewValidarBilhete(){

        return view('admin.verifica_bilhete');

    }
    
    public function postValidarBilhete(Request $request){
    
        if(Auth::user()->tipo_usuario != 1){
            try {
                $aposta = CupomAposta::where('codigo_unico', $request->bilhete)->where('status', 4)->first();
                if($aposta) {


                    $jogos = CupomApostaItem::join('events', 'cupom_aposta_item.idevent', 'events.id')->where('idcupom', $aposta->id)->get();

                    foreach ($jogos as $jogo){

                        if($jogo->inplay){
                            $response = \Http::get('https://api.b365api.com/v1/event/view?token=&LNG_ID=22&event_id='.$jogo->bet365_id.'&token='.config('app.API_TOKEN'));
                            if( $response->successful() ){
                                $response = json_decode($response->body());

                                if($response->results[0]->timer){
                                    $time = $response->results[0]->timer->tm * 60 +  $response->results[0]->timer->ts;
                                    if($time > 30){
                                        return Redirect()->back()->with('erro', 'Bilhete não pode ser validado pois os jogos já começaram');
                                    }
                                }
                            }else{
                                return Redirect()->back()->with('erro', 'Bilhete não pode ser validado pois os jogos já começaram');
                            }
                        }else{
                            if($jogo->data < \Carbon\Carbon::now()){
                                return Redirect()->back()->with('erro', 'Bilhete não pode ser validado pois os jogos já começaram');
                           }
                        }
                      
                    }
                    DB::beginTransaction();
                    $aposta->idcambista = Auth::user()->id;
                    $aposta->status = 1;
                    $aposta->save();

                    $jogos = CupomApostaItem::where('idcupom', $aposta->id)->count();

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
                        $comissao = $aposta->valor_apostado * $porcentagem;
                        $credito = Creditos::where('idusuario', Auth::user()->id)->first();
                        $credito->saldo_liberado = $credito->saldo_liberado + $comissao;
                        $credito->save();
                        
                    }
                    
                    DB::commit();
                    return Redirect('/minhas-apostas/visualizar-cupom/'.$request->bilhete)->with('sucesso', 'Bilhete Validado com sucesso');
                    
                }else{
                    return Redirect()->back()->with('erro', 'Bilhete não encontrado ou já validado');
                    
                }
            } catch (\Throwable $th) {
                
                DB::rollback();
             
            }
           
        }else{
            return Redirect()->back()->with('erro', 'Sem Permissão');

        }
        

    }

    public function deposit(Request $request){
        if(floatval($request['recarrega-saldo-hidden']) < 40 ){
            return Redirect()->back()->with('erro', 'O valor minimo para deposito é de 40 Reais');
        }

        $historic = Historic::where('user_id', Auth::user()->id)->where('status', 0)->where('type', 'D')->count();

        if($historic){
            return Redirect()->back()->with('erro', 'Você já tem um solicitação de deposito pendente aguarde a aprovação do admin');

        }

        try {
            DB::beginTransaction();

            $id = hexdec(uniqid())+rand(0,1000000000000000000);

            $credito = Creditos::where('idusuario', Auth::user()->id)->first();
            $historic = Auth::user()->historics()->create([
                'type' => 'D',
                'user_id_transaction' => $id,
                'amount' => $request['recarrega-saldo-hidden'],
                'total_before' => $credito->saldo_apostas,
                'total_after' => $credito->saldo_apostas + $request['recarrega-saldo-hidden'],
                'date' => date('Ymdhis'),
                'status' => 0
            ]);
            
            $credito->saldo_bloqueado =  $credito->saldo_bloqueado + $request['recarrega-saldo-hidden'];
            $credito->save();
            DB::commit();

            return Redirect()->back()->with('sucesso', 'Solicitação efetuada aguarde a aprovação do admin');



        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');

           
        }
    }
    public function saque(Request $request){
        if(floatval($request['saque-saldo-hidden']) < 5 ){
            return Redirect()->back()->with('erro', 'O valor minimo para saque é de 5 Reais');
        }
        $credito = Creditos::where('idusuario', Auth::user()->id)->first();

        if(floatval($request['saque-saldo-hidden']) > $credito->saldo_liberado ){
            return Redirect()->back()->with('erro', 'Você não tem saldo suficiente');
        }

        $historic = Historic::where('user_id', Auth::user()->id)->where('status', 0)->where('type', 'S')->count();

        if($historic){
            return Redirect()->back()->with('erro', 'Você já tem um solicitação de saque pendente aguarde a aprovação do admin');

        }

        try {
            DB::beginTransaction();

            $id = hexdec(uniqid())+rand(0,1000000000000000000);
            $historic = Auth::user()->historics()->create([
                'type' => 'S',
                'user_id_transaction' => $id,
                'amount' => $request['saque-saldo-hidden'],
                'total_before' => $credito->saldo_liberado,
                'total_after' => $credito->saldo_liberado - $request['saque-saldo-hidden'],
                'date' => date('Ymdhis'),
                'status' => 0
            ]);
            $saldo_antigo = $credito->saldo_liberado;
            $novoSaldo = $credito->saldo_liberado - $request['saque-saldo-hidden'];
            $credito->saldo_liberado =  $novoSaldo ;
            $credito->saldo_bloqueado =  $credito->saldo_bloqueado + $request['saque-saldo-hidden'];
            $credito->save();
            DB::commit();

            return Redirect()->back()->with('sucesso', 'Solicitação efetuada aguarde a aprovação do admin');



        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');
           
        }
    }

    public function cancelarSolicitacao(Request $request){

        
        try {
            DB::beginTransaction();
            $historic = Historic::find($request->id);

            if($historic->user_id != Auth::user()->id){
                return Redirect()->back()->with('sucesso', 'Sem permissão para essa ação');

            }
            $credito = Creditos::where('idusuario', Auth::user()->id)->first();

            $historic->status = 3;
            $historic->save();

            if($historic->type == 'D'){
                $credito->saldo_bloqueado = $credito->saldo_bloqueado - $historic->amount;
            }
            if($historic->type == 'S'){
                $credito->saldo_liberado = $credito->saldo_liberado + $historic->amount;
                $credito->saldo_bloqueado =  $credito->saldo_bloqueado - $historic->amount;

            }

            $credito->save();

            DB::commit();

            return Redirect()->back()->with('sucesso', 'Solicitação efetuada cancelada');



        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');

        }
    }
    public function aprovarSolicitacao(Request $request){

        if(Auth::user()->tipo_usuario == 2){
            try {
                DB::beginTransaction();
                $historic = Historic::find($request->id);
    
                if($historic->user_id != Auth::user()->id){
                    return Redirect()->back()->with('sucesso', 'Sem permissão para essa ação');
    
                }
                $credito = Creditos::where('idusuario', Auth::user()->id)->first();
    
                $historic->status = 3;
                $historic->save();
    
                if($historic->type == 'D'){
                    $credito->saldo_aposta =  $credito->saldo_aposta + $historic->amount;
                }
                if($historic->type == 'S'){
                    $credito->saldo_liberado = $credito->saldo_liberado - $historic->amount;
                    $credito->saldo_bloqueado =  $credito->saldo_bloqueado -  $historic->amount;

                }
    
                $credito->save();
    
                DB::commit();
    
                return Redirect()->back()->with('sucesso', 'Solicitação efetuada aguarde a aprovação do admin');
    
    
    
            } catch (\Throwable $th) {
                DB::rollback();
                return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');
    
            }
        }else{
            return Redirect()->back()->with('error', 'Sem Permissão');

        }
    }
    public function rejeitarSolicitacao(Request $request){
        if(Auth::user()->tipo_usuario == 2){
            try {
                DB::beginTransaction();
                $historic = Historic::find($request->id);
    
                if($historic->user_id != Auth::user()->id){
                    return Redirect()->back()->with('sucesso', 'Sem permissão para essa ação');
    
                }
                $credito = Creditos::where('idusuario', Auth::user()->id)->first();
    
                $historic->status = 3;
                $historic->save();
    
                if($historic->type == 'D'){
                    $credito->saldo_bloqueado = $credito->saldo_bloqueado - $historic->amount;
                }
                if($historic->type == 'S'){
                    $credito->saldo_liberado = $credito->saldo_liberado + $historic->amount;
                    $credito->saldo_bloqueado =  $credito->saldo_bloqueado -  $historic->amount;

                }
    
                $credito->save();
    
                DB::commit();
    
                return Redirect()->back()->with('sucesso', 'Solicitação efetuada aguarde a aprovação do admin');
    
    
    
            } catch (\Throwable $th) {
                DB::rollback();
                return Redirect()->back()->with('error', 'Tivemos um problema ao processar sua solicitação');
    
            }
        }else{
            return Redirect()->back()->with('error', 'Sem Permissão');

        }
        

    }
}

