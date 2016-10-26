<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pqrsf extends Model
{
    protected $primaryKey='pqrsfCodigo';
	public function persona(){
		return $this->belongsTo('App\Persona');
		//->select(array('perNombres', 'perApellidos'));
	}

}
