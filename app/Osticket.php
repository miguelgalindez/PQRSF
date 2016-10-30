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

    
    private static function obtnSigNumeroTicket(){
        $db=DB::connection('osticketdb');
                
            $resp= $db->table('ost_sequence')
                        ->select('next', 'increment')
                        ->lockForUpdate()
                        ->get();

            $sigNumeroTicket=$resp[0]->next;
            $increment=$resp[0]->increment;

            $db->table('ost_sequence')
                ->where('id', 1)
                ->update(['next' => $sigNumeroTicket+$increment]);

        return $sigNumeroTicket;            
    }

    private static function obtnnumeroMes($mes){
        switch ($mes) {
            
            case 'enero':
                return '01';
            
            case 'febrero':
                return '02';

            case 'marzo':
                return '03';

            case 'abril':
                return '04';

            case 'mayo':
                return '05';

            case 'junio':
                return '06';

            case 'julio':
                return '07';

            case 'agosto':
                return '08';

            case 'septiembre':
                return '09';

            case 'octubre':
                return '10';

            case 'noviembre':
                return '11';

            case 'diciembre':
                return '12';
            
        }
    }

    public static function crearTicket($idDependencia, $idFuncionario, $fechaVencimiento, $idPrioridad, $subject){
        $db=DB::connection('osticketdb');

        $sigNumeroTicket=Self::obtnSigNumeroTicket();
        $partes=explode(' ', $fechaVencimiento);
        $vencimiento=$partes[4] . "-" . Self::obtnnumeroMes($partes[2]) . "-" . (string)$partes[0] . " 23:59:59";
        
        try{
            $db->beginTransaction();
            $idTicket=$db->table('ost_ticket')
                            ->insertGetId([
                                'number' => $sigNumeroTicket,
                                'status_id' => 1,
                                'dept_id' => $idDependencia,
                                // Sin Topic ??
                                // Sin sla ??
                                // Sin team ?
                                // Sin email Id
                                // sin flags
                                // sin ip address

                                'staff_id' => $idFuncionario,
                                'source'=> 'Web',
                                'isoverdue' => 0,
                                'duedate' => $vencimiento,
                                'created' => date('Y-m-d H:i:s'),
                                'updated' => date('Y-m-d H:i:s'),
            ]);

            $db->table('ost_ticket__cdata')
                 ->insert([
                    'ticket_id' => $idTicket,
                    'subject' => $subject,
                    'priority' => $idPrioridad
            ]);

            // OJO FALTA AGREGARLO A LA TABLA SERVICIOS
            $db->commit();

            return $sigNumeroTicket;
        }
        catch(Exception $ex){
            $db->rollback();
            throw new Exception($ex->getMessage(), 1);
            
        }
        

    }

}