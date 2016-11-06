<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Osticket;

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
    	$resp=Osticket::crearTicket(
    		$request->get('dependencia'), 
    		$request->get('funcionario'),
    		$request->get('fechaVencimiento'),
    		$request->get('prioridad'),
    		$request->get('asunto')
    	);

        ($nombrePersona,$emailPersona, $telefonoPersona, $idDependencia, $idFuncionario, $fechaVencimiento, $idPrioridad, $asunto, $descripcion, $ipFuncionarioPQRSF, $usernameFuncionarioPQRSF, $emailFuncionarioPQRSF, $nombreFuncionarioPQRSF){

    	return $resp;
    }

}
