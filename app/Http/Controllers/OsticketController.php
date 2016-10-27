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


}
