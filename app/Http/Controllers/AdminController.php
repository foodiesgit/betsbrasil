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


use App\CupomAposta;

use App\CupomApostaItem;

use App\CuponsIguais;

use App\CuponsIguaisItens;

use App\CambistasComissoes;


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

            return redirect('admin/gerentes/caixa');

        }

        return redirect('admin/login')->with('erro', 'Email e/ou senha incorretos');

    }

    public function viewDashboard(){

        return view('admin.dashboard');

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

            'email' => 'required|email|unique:usuarios,email',

            'cpf' => 'unique:usuarios,cpf',

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



            $campos = GerentesCampos::where('idusuario', $usuario->id)->get();

            $campos[0]->pode_criar_cambistas = $input['checkbox_op1'];

            $campos[0]->pode_alterar_cambistas = $input['checkbox_op2'];

            $campos[0]->pode_editar_apostas_cambistas = $input['checkbox_op3'];

            $campos[0]->pode_editar_limite_cambistas = $input['checkbox_op4'];

            $campos[0]->pode_transferencia_cambistas = $input['checkbox_op5'];

            $campos[0]->save();



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

            'email' => 'required|email|unique:usuarios,email',

            'cpf' => 'required|unique:usuarios,cpf',

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



        if(count($sql) > 0){

            foreach($sql as $dados){

                $arrayUsuarios[$dados->id] = $dados->name;

            }

        }



        $comissoes = CambistasComissoes::where('idusuario', $id)->get();



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



            $comissoes = CambistasComissoes::where('idusuario', $usuario->id);

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

        $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')

            ->where('tipo_usuario', 3)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')

            ->get();



        $data = [

            'sql' => $sql

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



        $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 3)

        ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();







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

        $sql = User::leftJoin('creditos', 'creditos.idusuario','=','users.id')

            ->where('tipo_usuario', 4)->select('users.name', 'users.email', 'users.status', 'users.id as idusuario', 'creditos.*')

            ->get();



        $data = [

            'sql' => $sql

        ];



        return view('admin.financeiro.caixa_cambistas', $data);

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



        $sql = LancamentosCaixa::leftJoin('users', 'users.id','=','lancamentos_caixa.idusuario')->leftJoin('tipo_lancamento_caixa', 'tipo_lancamento_caixa.id','=','lancamentos_caixa.idtipo_lancamento')->select('lancamentos_caixa.*', 'tipo_lancamento_caixa.tipo_lancamento', DB::raw("date_format(lancamentos_caixa.created_at, '%d/%m/%Y as %H:%i:%s') as data_lancamento"), 'users.name', 'users.email')->where('users.tipo_usuario', 4)

        ->whereBetween('lancamentos_caixa.created_at', [$dataInicioUs.' 00:00:00', $dataFinalUs.' 23:59:59'])->get();







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

            })->select("events.*", DB::raw("date_format(events.data, '%d/%m/%Y as %H:%i') as data_evento"), "ligas.nome_traduzido as nome_liga", "esportes.nome_traduzido as nome_esporte", "paises.nome as nome_pais", "paises.nome_traduzido as nome_pais_traduzido", DB::raw("sum(valor_apostado) as soma"))

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



        DB::table('campos_fixos')->where('id', 1)->update([

            'regulamento' => $input['regulamento'],

            'rodape_cupom' => $input['rodape_cupom']

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



        $tipos = Events::leftJoin('cupom_aposta_item', 'cupom_aposta_item.idevent', '=', 'events.id')

            ->leftJoin('odds','odds.id','=','cupom_aposta_item.idodds')

            ->leftJoin('odds_subgrupo', 'odds_subgrupo.id','=','odds.idsubgrupo')

            ->select(DB::raw("count(*) as total"), DB::raw("sum(cupom_aposta_item.valor_apostado) as soma"), 'odds.name','odds_subgrupo.titulo_traduzido')

            ->where('events.id', $id)

            ->groupBy('odds.id')->get();



        $data = [

            'sql' => $sql,

            'apostas' => $apostas,

            'tipos' => $tipos

        ];



        return view('admin.jogos.visualizar_apostas', $data);

    }

    public function viewGerenciamentoRisco(){

        $sql = CupomAposta::where('cupom_aposta.status',1)

            ->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')

            ->select('cupom_aposta_item.*', 'cupom_aposta.valor_apostado as valor_apostado1', 'cupom_aposta.possivel_retorno as possivel_retorno1')

            ->get();



        if(count($sql) > 0){

            foreach($sql as $dados){

               

            }

        }



        $sql = CupomAposta::where('cupom_aposta.status', 1)->get();

        if(count($sql) > 0){

            foreach($sql as $dados){

                $sql2 = CupomApostaItem::where('idcupom', $dados->id)->get();



                $array = [];

                if(count($sql2) > 0){

                    foreach($sql2 as $dados2){

                        $array[] = $dados2->idevent;

                    }

                }



                $sql3 = CupomAposta::where('cupom_aposta.status',1)->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')->get();

                if(count($sql3) > 0){

                    $erro = 0;

                    foreach($sql3 as $dados3){

                        if(!in_array($dados3->idevent, $array)){

                            $erro = 1;

                        }

                    }



                    // if($erro == 0){

                    //     $c = new CuponsIguais;

                    //     $c->

                    // }

                }

            }

        }



        $sql = CupomAposta::where('cupom_aposta.status',1)->leftJoin('cupom_aposta_item', 'cupom_aposta_item.idcupom','=','cupom_aposta.id')->get();



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
}

