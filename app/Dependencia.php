<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dependencia extends Model
{
    protected $table='ost_department';
    protected $connection = 'osticketdb';

    public static function obtnTodasDependencias(){
    	$db=DB::connection('osticketdb');    	
    	return $db->table('ost_department')                    
                    ->select('dept_id', 'dept_name')
                    ->get();        
    }
}
