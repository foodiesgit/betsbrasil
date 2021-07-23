<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LancamentosCaixa extends Model
{
    protected $table = 'lancamentos_caixa';
	protected $guarded = ['id'];
}
