<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;



class Events extends Model

{

    protected $table = 'events';

	protected $guarded = ['id'];

    public function odds(){
        return $this->hasMany(Odds::class, 'idevent');
    }
}

