<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Esportes extends Model
{
    protected $table = 'esportes';
	protected $guarded = ['id'];
}
