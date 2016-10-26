<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	protected $primaryKey='perId';
    
    public function pqrsfs(){
    	return $this->hasMany('App\Pqrsf', 'perId');
    }
}
