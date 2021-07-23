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

class PrincipalController extends Controller{
    public function viewIndex(){
        return view('principal.index');
    }
}
