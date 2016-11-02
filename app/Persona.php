<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	protected $primaryKey='perId';

	public static function obtnTiposPersona(){
		return array(
			'Estudiante',
			'Docente',
			'Funcionario',
			'Contratista',
			'Pensionado',
			'Egresado',
			'Autoridades Nacionales',
			'Persona Externa',
			'Otro'
		);
	}

	public static function obtnTiposIdentificacion(){
		return array(
			'Cédula',
			'Tarjeta de Identidad',
			'Cédula de Extranjería',
			'Nit',
			'Pasaporte'
		);
	}
    
    public function pqrsfs(){
    	return $this->hasMany('App\Pqrsf');
    }
}
