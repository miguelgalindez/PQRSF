<?php

namespace App\Http\Controllers;

use App\Pqrsf;
use Illuminate\Http\Request;

class PqrsfsController extends Controller
{
    public function getAll(){
    	
		$pqrsfs=Pqrsf::with('persona')->get();
    	/*$pqrsfs=Pqrsf::with(array('persona'=>function($query){
        		$query->select('perNombres','perApellidos');
    		}
    	))->get();
		*/
    	return response()->json($pqrsfs);
    }
}

/*
'pqrsfCodigo', 'pqrsfTipo', 'pqrsfAsunto', 'pqrsfDescripcion', 'pqrsfFechaCreacion', 'pqrsfMedioRecepcion', 'pqrsfEstado', '
*/