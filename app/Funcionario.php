<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Funcionario extends Model
{
    protected $table='ost_staff';
    protected $connection='osticketdb';

    public static function obtnTodosFuncionarios(){
    	$db=DB::connection('osticketdb');    	
    	return $db->table('ost_staff')
    			->select('dept_id', 'staff_id', 'firstname', 'lastname')
    			->get();
    }
}
