<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Osticket;
use App\Persona;
use Auth;

class OsticketController extends Controller
{
    public function obtnDatosDireccionamiento(){
    	$dependencias=Osticket::obtnTodasDependencias();
    	$funcionarios=Osticket::obtnTodosFuncionarios();
    	$prioridades=Osticket::obtnTodasPrioridades();
    	$dependenciasFuncionarios=array(
    		'dependencias' => $dependencias,
    		'funcionarios' => $funcionarios,
    		'prioridades' => $prioridades
    	);
    	return response()->json($dependenciasFuncionarios);    	
    }

    public function crearTicket(Request $request){
        // idPersona descripcion 
        $idPersona=$request->get("idPersona");
        $datosPersona=Persona::obtnDatosContacto($idPersona);
    	
        $response=Osticket::crearTicket(
            $request->get('codigoPQRSF'),
            $datosPersona->perNombres . ' ' . $datosPersona->perApellidos,
            $datosPersona->perEmail,
            $datosPersona->perTelefono,
    		$request->get('dependencia'), 
    		$request->get('funcionario'),
    		$request->get('fechaVencimiento'),
    		$request->get('prioridad'),
    		$request->get('asunto'),
            $request->get('descripcion'),
            $request->ip(),
            Auth::user()->id,
            Auth::user()->name
    	);
        return response()->json($response);
    }

}
