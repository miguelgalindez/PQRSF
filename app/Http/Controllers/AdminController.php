<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Pqrsf;
use Log;

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

	public function mostrarVencimientoPQRSF($diasParaVencimiento){
		return view('admin.consultas.vencimientoPQRSF', [
			'diasParaVencimiento' => $diasParaVencimiento
		]);
	}
	
    public function mostrarDireccionarPqrsf(){
        return view('admin.acciones.direccionarPqrsf');
    }

    public function mostrarRadicarPQRSF(){
    	return view('admin.acciones.radicarPQRSF');
    }

    public function index(){
    	$numeroPqrsfsVencidas=Pqrsf::obtnNumeroVencidas()[0]->numeroVencidas;
    	$numeroPqrsfsProximasVencidas=Pqrsf::obtnNumeroProximasVencidas()[0]->numeroProximasVencidas;
    	$numeroPqrsfsNoRadicadas=Pqrsf::obtnNumeroNoRadicadas()[0]->numeroNoRadicadas;
    	$numeroPqrsfsNoDireccionadas=Pqrsf::obtnNumeroNoDireccionadas()[0]->numeroNoDireccionadas;
    	$numeroPqrsfsAtendidas=Pqrsf::obtnNumeroAtendidas()[0]->numeroAtendidas;
    	$numeroPqrsfsAtendiendo=Pqrsf::obtnNumeroAtendiendo()[0]->numeroAtendiendo;
    	$numeroPqrsfsPendientes=Pqrsf::obtnNumeroPendientes()[0]->numeroPendientes;

    	return view('admin.index', [
    		'numeroPqrsfsVencidas' => $numeroPqrsfsVencidas,
    		'numeroPqrsfsProximasVencidas' => $numeroPqrsfsProximasVencidas,
    		'numeroPqrsfsNoRadicadas' => $numeroPqrsfsNoRadicadas,
    		'numeroPqrsfsNoDireccionadas' => $numeroPqrsfsNoDireccionadas,
    		'numeroPqrsfsAtendidas' => $numeroPqrsfsAtendidas,
    		'numeroPqrsfsAtendiendo' => $numeroPqrsfsAtendiendo,
    		'numeroPqrsfsPendientes' => $numeroPqrsfsPendientes
    	]);
    }

    public function mostrarTodasPqrsfs(){
    	return view('admin.consultas.todasPQRSF');
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
		return view('admin.acciones.registrarPqrsf');
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
}
