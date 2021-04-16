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
                return redirect('minha-conta/dashboard');
            }


        }

        return redirect('login')->with('erro', 'Email e/ou senha incorretos');
    }

    public function viewCadastro(){
        return view('minhaconta.auth.cadastro');
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

        $usuarios = new Usuarios;
        $usuarios->nome = $input['nome'];
        $usuarios->password = Hash::make($input['password']);
        $usuarios->cpf = $input['cpf'];
        $usuarios->telefone = $input['telefone'];
        $usuarios->data_nascimento = $input['data_nascimento'];
        $usuarios->email = $input['email'];
        $usuarios->status = 1;
        $usuarios->save();

        return redirect('minha-conta/dashboard')->with('sucesso', 'Seja bem vindo.');
    }

    public function viewDashboard(){
        return view('minhaconta.dashboard');
    }
}
