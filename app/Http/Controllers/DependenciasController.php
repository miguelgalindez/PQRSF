<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dependencia;
use App\Funcionario;

class DependenciasController extends Controller
{
    
    public function obtnDependenciasFuncionarios(){
    	$dependencias=Dependencia::obtnTodasDependencias();
    	$funcionarios=Funcionario::obtnTodosFuncionarios();
    	$dependenciasFuncionarios=array(
    		'dependencias' => $dependencias,
    		'funcionarios' => $funcionarios
    	);
    	return response()->json($dependenciasFuncionarios);    	
    }
}
