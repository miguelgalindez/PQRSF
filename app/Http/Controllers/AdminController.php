<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Pqrsf;
use Auth;

class AdminController extends Controller
{
	public function __construct(){		
		$this->middleware('auth');
		$this->middleware('admin');		

/*
		$this->middleware('log')->only('index');
        $this->middleware('subscribed')->except('store');

*/

	}

	
    public function mostrarDireccionarPqrsf(){
        return view('admin.direccionarPqrsf');
    }

    public function mostrarRadicarPQRSF(){
    	return view('admin.radicarPQRSF');
    }

    public function index(){
    	return view('admin.index');
    }

    public function obtnDatosRegistroPqrsf(){
    	$resp=array(
    		'tiposPersona' => Persona::obtnTiposPersona(),
    		'tiposIdentificacion' => Persona::obtnTiposIdentificacion(),
    		'tiposSolicitud' => Pqrsf::obtnTiposSolicitud(),
    		'mediosRecepcion' => Pqrsf::obtnMediosRecepcion()
    	);

    	return response()->json($resp);
    }

    public function mostrarRegistrarPqrsf(){
		return view('admin.registrarPqrsf');
	}

	private function generateRandomString($length = 10) {
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

	    return $randomString;
	}

	public function registrarPqrsf(Request $request){
		
		
		$codigoPQRSF=$this->generateRandomString(5);
		$tipoSolicitud=$request->get('tipoSolicitud');
		
		$response=Pqrsf::crear(			
			$request->get('tipoSolicitante'),
			$request->get('tipoIdentificacion'),
			$request->get('identificacion'),
			$request->get('email'),
			$request->get('nombres'),
			$request->get('apellidos'),
			$request->get('telefono'),
			$request->get('celular'),
			$request->get('direccion'),
			$codigoPQRSF,
			$tipoSolicitud,
			$request->get('medioRecepcion'),
			$request->get('asunto'),
			$request->get('descripcion')
		);

		return response()->json($response);
		
	}

	public function radicarPQRSF(Request $request){

		$response=Pqrsf::radicar(
			$request->get('codigoPQRSF'),
			$request->get('idRadicado'),
			$request->get('fechaRadicado'),
			Auth::user()->id
		);		

		return response()->json($response);
	}
}
