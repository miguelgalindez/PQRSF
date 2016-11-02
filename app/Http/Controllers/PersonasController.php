<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
class PersonasController extends Controller
{

    public function obtnDatosRegistro(){
    	$resp=array(
    		'tiposPersona' => Persona::obtnTiposPersona(),
    		'tiposIdentificacion' => Persona::obtnTiposIdentificacion()
    	);

    	return response()->json($resp);
    }
}
