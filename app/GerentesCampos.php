<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GerentesCampos extends Model
{
    protected $table = 'gerentes_campos';
	protected $guarded = ['id'];
}
