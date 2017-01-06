<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pqrsf;

class PqrsfsController extends Controller
{
    public function obtnNoDireccionadas(){
        
    	return response()->json(Pqrsf::obtnNoDireccionadas());
    }

    public function obtnNoRadicadas(){
    	return response()->json(Pqrsf::obtnNoRadicadas());
    }

    public function obtnTodas(){
    	return response()->json(Pqrsf::obtnTodas());
    }

    public function obtnDatosRestantes($pqrsfCodigo){    	
    	return response()->json(Pqrsf::obtnDatosRestantes($pqrsfCodigo));
    }

    public function obtnIdOrdenes($pqrsfCodigo){
    	return response()->json(Pqrsf::obtnIdOrdenes($pqrsfCodigo));	
    }    

}
