<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovoCarrinhoItem extends Model
{
    protected $table = 'novo_carrinho_item';
	protected $guarded = ['id'];
}
