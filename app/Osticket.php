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

    public function usuarioExiste($email){
        $db=DB::connection('osticketdb');
        
        $cont=$db->table('ost_user_email')
                    ->where('address', $email)
                    ->select('address')
                    ->count();

        return $cont>0;
    }

    public function crearUsuario($nombres, $email, $telefono){

        $now=date('Y-m-d H:i:s');
        $db=DB::connection('osticketdb');

        $idUsuario=$db->table('ost_user')
                            ->insertGetId([
                                'org_id' => 0,
                                'default_email_id' => 0,
                                'status' => 0,
                                'name' => $nombres,
                                'created' => $now,
                                'updated' => $now
        ]);

        $idEmail=$db->table('ost_user_email')
                            ->insertGetId([
                                'user_id' => $idUsuario,
                                'address' => $email
        ]);

        $db->table('ost_user')
                ->where('id', $idUsuario)
                ->update(['default_email_id' => $idEmail]);

            // define los datos del usuario (form_id=1) 
            //    objectId hace referencia al id del usuario
       $idEntrada=$db->table('ost_form_entry')
                        ->insertGetId([
                            'form_id' => 1,
                            'object_id' => $idUsuario,
                            'object_type' => 'U',
                            'sort' => 1,
                            'created' => $now,
                            'updated' => $now
        ]);

        // se le asigna el numero de TELEFONO a la entrada recien creada

        $db->table('ost_form_entry_values')
                        ->insert([
                            'entry_id' => $idEntrada,
                            'field_id' => 3,
                            'value' => $telefono,
        ]);

        // se le asigna las NOTAS INTERNAS a la entrada recien creada. OJO por ahora es NULL
        $db->table('ost_form_entry_values')
                        ->insert([
                            'entry_id' => $idEntrada,
                            'field_id' => 4,
                            // 'value' => $notasInternas, // Por ahora sera NULO 
                                                        
        ]);

        // Osticket por defecto tambien hace la siguiente inserción
        $db->table('ost__search')
                        ->insert([
                            'object_type' => 'U',
                            'object_id' => $idUsuario,
                            'title' => $nombres,
                            'content' => ''
        ]);

        return array('idUsuario' =>$idUsuario, 'idEmail' => $idEmail);
    }

    public static function obtnDescripcionPrioridad($idPrioridad){
        
        $db=DB::connection('osticketdb');
        return $db->table('ost_ticket_priority')
                    -where('priority_id', $idPrioridad)
                    ->select('priority_desc')
                    ->first();
    }

    public static function obtnStaffId($emailFuncionario){
        $db=DB::connection('osticketdb');
        return $db->table('ost_staff')
                    -where('email', $emailFuncionario)
                    ->select('staff_id')
                    ->first();
    }

    public static function obtnNombreFuncionario($idFuncionario){
        $db=DB::connection('osticketdb');

        $nombres=$db->table('ost_staff')
                    ->where('staff_id', $idFuncionario)
                    ->select('firstname', 'lastname')
                    ->first();

        return $nombres->firstname . ' ' . $nombres->lastname;
    }


    public static function crearTicket($nombrePersona,$emailPersona, $telefonoPersona, $idDependencia, $idFuncionario, $fechaVencimiento, $idPrioridad, $asunto, $descripcion, $ip, $usernameFuncionarioPQRSF, $emailFuncionarioPQRSF, $nombreFuncionarioPQRSF){
        $db=DB::connection('osticketdb');

        $datosUsuario=null;

        try{
            $db->beginTransaction();

            if($this->usuarioExiste()){
                //  TODO
                //  $datosUsuario= xxxxx   obtener el id del usuario
            }
            else{
                $datosUsuario=$this->crearUsuario($nombrePersona, $emailPersona, $telefonoPersona);
            }

            
            $numeroTicket=Self::obtnSigNumeroTicket();
            $partes=explode(' ', $fechaVencimiento);
            $vencimiento=$partes[4] . "-" . Self::obtnnumeroMes($partes[2]) . "-" . (string)$partes[0] . " 23:59:59";
            $now=date('Y-m-d H:i:s');

            $longNumeroTicket=6;
            $idTema=7; // OJO.. colocar el id del tema que se va a establecer para la creacion de Tickets desde PQRSF

            $idTicket=$db->table('ost_ticket')
                            ->insertGetId([
                                'number' => str_pad($numeroTicket, $longNumeroTicket, "0", STR_PAD_LEFT),
                                'user_id' => $datosUsuario->idUsuario,
                                'user_email_id' => $datosUsuario->idEmail,
                                'status_id' => 1,
                                'dept_id' => $idDependencia,
                                'sla_id' =>0,  // Sin sla ??

                                'topic_id' => $idTema,
                                'staff_id' => $idFuncionario,
                                
                                'team_id' => 0, //Al parecer se deja asi cuando el ticket es asignado a una persona en concreto
                                'email_id' => 0, // Asi lo deja osticket
                                'flags' =>0,     // Asi lo deja osticket
                                                                        
                                'ip_address' => '::1',                                
                                'source'=> 'Web', // toca verificar para que en lo posible sean los mismos definidos por PQRSF
                                'isoverdue' => 0,
                                'isanswered' => 0,
                                'duedate' => $vencimiento,

                                // 'reopened' => NULL, // osticket lo deja como nulo
                                // 'closed' => NULL, // osticket lo deja como nulo
                                // 'lastmessage' => NULL, // Como estaria recien creado el ticket se deja esto como NULO
                                // 'lastresponse' => NULL, 

                                'created' => $now,
                                // 'updated' => NULL // Como estaria recien creado el ticket se deja esto como NULO
            ]);

            $db->table('ost_ticket__cdata')
                 ->insert([
                    'ticket_id' => $idTicket,
                    'subject' => $asunto,
                    'priority' => $idPrioridad
            ]);


            $db->table('ost_ticket_event')
                 ->insert([
                    'ticket_id' => $idTicket,
                    'staff_id' => $idFuncionario,
                    'team_id' => 0, // Asi lo esta dejando osticket
                    'dept_id' => $idDependencia,
                    'topic_id' => $idTema,
                    'state' => 'created',
                    'staff' => $usernameFuncionarioPQRSF,
                    'annulled' => 0,
                    'timestamp' =>$now
            ]);

            $db->table('ost_ticket_event')
             ->insert([
                'ticket_id' => $idTicket,
                'staff_id' => $idFuncionario,
                'team_id' => 0, // Asi lo esta dejando osticket
                'dept_id' => $idDependencia,
                'topic_id' => $idTema,
                'state' => 'assigned',
                'staff' => $usernameFuncionarioPQRSF,
                'annulled' => 0,
                'timestamp' =>$now
            ]);

       
            // Entrada que define los datos del ticket (form_id=2 ) objectId hace referencia al id del ticket TICKET
            $idEntrada=$db->table('ost_form_entry')
                        ->insertGetId([
                            'form_id' => 2,
                            'object_id' => $idTicket,
                            'object_type' => 'T',
                            'sort' => 1,
                            'created' => $now,
                            'updated' => $now
            ]);


            $db->table('ost_form_entry_values')
                ->insert([
                    'entry_id' => $idEntrada,
                    'field_id' => 20,
                    'value' => $asunto,
                    // 'value_id' => NULL
            ]);

            $db->table('ost_form_entry_values')
                ->insert([
                    'entry_id' => $idEntrada,
                    'field_id' => 22,
                    'value' => Self::obtnDescripcionPrioridad($idPrioridad),
                    'value_id' => $idPrioridad

            ]);
            
            $db->table('ost_ticket_thread')
                ->insert([
                    'pid' => 0,
                    'ticket_id' => $idTicket,
                    'staff_id' => 0,
                    'user_id' => $datosUsuario->idUsuario,
                    'thread_type' => 'M',
                    'poster' => $nombrePersona,
                    'source' => 'Web',  // OJO verificar si se puede dejar como los de PQRSF
                    'title' => 'Descripción de la solicitud',
                    'body' => $descripcion,
                    'format' => 'html',
                    'ip_address' => '::1',
                    'created' => $now,
                    'updated' => '0000-00-00 00:00:00'
            ]);

            $db->table('ost_ticket_thread')
                ->insert([
                    'pid' => 0,
                    'ticket_id' => $idTicket,
                    'staff_id' => 0,
                    'user_id' => 0,
                    'thread_type' => 'N',
                    'poster' => 'SYSTEM',
                    'source' => '',
                    'title' => 'Ticket creado',
                    'body' => 'Ticket creado por el agente ' . $nombreFuncionarioPQRSF . ' (PQRSF)',
                    'format' => 'html',
                    'ip_address' => $ip,
                    'created' => $now,
                    'updated' => '0000-00-00 00:00:00'
            ]);

            $db->table('ost_ticket_thread')
                ->insert([
                    'pid' => 0,
                    'ticket_id' => $idTicket,
                    'staff_id' => Self::obtnStaffId($emailFuncionarioPQRSF),
                    'user_id' => 0,
                    'thread_type' => 'N',
                    'poster' => $nombreFuncionarioPQRSF,
                    'source' => '',
                    'title' => 'Ticket asignado',
                    'body' => 'El agente ' . $nombreFuncionarioPQRSF . ' (PQRSF) acaba de asignar el Ticket a: ' .  Self::obtnNombreFuncionario($idFuncionario),
                    'format' => 'html',
                    'ip_address' => $ip,
                    'created' => $now,
                    'updated' => '0000-00-00 00:00:00'
            ]);

            $db->table('ost__search')
                ->insert([
                    'object_type' => 'H',
                    'object_id' => $idTicket,
                    'title' => '',
                    'content' => $descripcion,

            ]);
            
            $db->table('ost__search')
                ->insert([
                    'object_type' => 'T',
                    'object_id' => $idTicket,
                    'title' => str_pad($numeroTicket, $longNumeroTicket, "0", STR_PAD_LEFT) . ' ' . $asunto,
                    'content' => $asunto,
            ]);

            // OJO FALTA AGREGARLO A LA TABLA SERVICIOS
            $db->commit();

            return $numeroTicket;
        }
        catch(Exception $ex){
            $db->rollback();
            throw new Exception($ex->getMessage(), 1);
            
        }
        

    }

}