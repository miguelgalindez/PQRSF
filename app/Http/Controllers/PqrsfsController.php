<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PqrsfsController extends Controller
{
    public function getAll(){
    	
        $pqrsfs= DB::table('pqrsfs')
                    ->join('personas', 'personas.perId', '=', 'pqrsfs.perId')
                    ->select('pqrsfs.*', 'personas.perNombres', 'personas.perApellidos')
                    ->get();
	
    	return response()->json($pqrsfs);
    }
}