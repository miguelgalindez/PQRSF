<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function crearActualizar($identificacion, $tipoIdentificacion, $tipoSolicitante, $nombres, $apellidos, $email, $direccion, $telefono, $celular){
    	
    	$personaExiste = DB::table('personas')->select('perid')->where(['perTipoId' => $tipoIdentificacion, 'perId' => $identificacion])->count();
    	
    	if($personaExiste==0){
    		DB::table('personas')
    			->insert([
    				'perId' => $identificacion,
    				'perTipoId' => $tipoIdentificacion,
    				'perTipo' => $tipoSolicitante,
    				'perNombres' => $nombres,
    				'perApellidos' => $apellidos,
    				'perEmail' => $email,
    				'perDireccion' => $direccion,
    				'perTelefono' => $telefono,
    				'perCelular' => $celular,
    				'created_at' => date('Y-m-d H:i:s'),    				
    		]);
    	}
    	else{
    		DB::table('personas')
    			->where(['perTipoId' => $tipoIdentificacion, 'perId' => $identificacion])
    			->update([
    				'perTipo' => $tipoSolicitante,
    				'perNombres' => $nombres,
    				'perApellidos' => $apellidos,
    				'perEmail' => $email,
    				'perDireccion' => $direccion,
    				'perTelefono' => $telefono,
    				'perCelular' => $celular,
    				'updated_at' => date('Y-m-d H:i:s'),
    		]);
    	}    	
    }
}
