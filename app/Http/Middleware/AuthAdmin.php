<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::check()){
            return redirect('admin/login');
        }

        if(auth()->user()->tipo_usuario != 2){
            return redirect('admin/login');
        }

        return $next($request);
    }
}
