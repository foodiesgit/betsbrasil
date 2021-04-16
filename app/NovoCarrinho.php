<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovoCarrinho extends Model
{
    protected $table = 'novo_carrinho';
	protected $guarded = ['id'];
}
