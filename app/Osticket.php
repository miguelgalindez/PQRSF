<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Osticket extends Model
{
	

    public static function obtnTodosFuncionarios(){
    	$db=DB::connection('osticketdb');	
    	return $db->table('ost_staff')
    			->select('dept_id', 'staff_id', 'firstname', 'lastname')
    			->get();
    }

    public static function obtnTodasDependencias(){
    	$db=DB::connection('osticketdb');
    	return $db->table('ost_department')                    
                    ->select('dept_id', 'dept_name')
                    ->get();        
    }

    public static function obtnTodasPrioridades(){
    	$db=DB::connection('osticketdb');
    	return $db->table('ost_ticket_priority')
    				->select('priority_id', 'priority_desc')
    				->get();
    }
}
