<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Paises extends Model
{
    protected $table = 'paises';
	protected $guarded = ['id'];
}
