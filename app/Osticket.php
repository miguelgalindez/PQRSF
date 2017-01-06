<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Osticket extends Model
{
	
    public static function crearTicket($codigoPQRSF, $nombrePersona,$emailPersona, $telefonoPersona, $idDependencia, $idFuncionario, $fechaVencimiento, $idPrioridad, $asunto, $descripcion, $ipFuncionarioPQRSF, $emailFuncionarioPQRSF, $nombreFuncionarioPQRSF){
        $db=DB::connection('osticketdb');

        $datosUsuario=null;

        try{
            $db->beginTransaction();

            $datosUsuario=Self::obtnDatosUsuario($emailPersona);
            if($datosUsuario==null){
                $datosUsuario=Self::crearUsuario($db, $nombrePersona, $emailPersona, $telefonoPersona);
            }
 
            $partes=explode(' ', $fechaVencimiento);
            $vencimiento=$partes[4] . "-" . Self::obtnnumeroMes($partes[2]) . "-" . (string)$partes[0] . " 23:59:59";
            $now=date('Y-m-d H:i:s');

            $numeroTicket=Self::obtnSigNumeroTicket();
            $longNumeroTicket=6;
            $idTema=6; // OJO.. colocar el id del tema que se va a establecer para la creacion de Tickets desde PQRSF

            $idTicket=$db->table('ost_ticket')
                            ->insertGetId([
                                'number' => str_pad($numeroTicket, $longNumeroTicket, "0", STR_PAD_LEFT),
                                'user_id' => $datosUsuario["idUsuario"],
                                'user_email_id' => $datosUsuario["idEmail"],
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
                                'updated' => $now // Como estaria recien creado el ticket se deja esto como NULO
            ]);

            $db->table('ost_ticket__cdata')
                 ->insert([
                    'ticket_id' => $idTicket,
                    'subject' => $asunto,
                    'priority' => $idPrioridad
            ]);

            $usernameFuncionarioPQRSF=Self::obtnUserName($emailFuncionarioPQRSF);

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
                    'user_id' => $datosUsuario["idUsuario"],
                    'thread_type' => 'M',
                    'poster' => $nombrePersona,
                    'source' => 'Web',  // OJO verificar si se puede dejar como los de PQRSF
                    'title' => 'Descripción de la solicitud',
                    'body' => $descripcion,
                    'format' => 'html',
                    'ip_address' => '::1',
                    'created' => $now,
                    'updated' => date('Y-m-d H:i:s', 0)
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
                    'ip_address' => $ipFuncionarioPQRSF,
                    'created' => $now,
                    'updated' => date('Y-m-d H:i:s', 0)
            ]);

            $nombreFuncionario=Self::obtnNombreFuncionario($idFuncionario);

            $db->table('ost_ticket_thread')
                ->insert([
                    'pid' => 0,
                    'ticket_id' => $idTicket,
                    'staff_id' => Self::obtnStaffId($emailFuncionarioPQRSF),
                    'user_id' => 0,
                    'thread_type' => 'N',
                    'poster' => $nombreFuncionarioPQRSF,
                    'source' => '',
                    'title' => 'Ticket asignado a ' . $nombreFuncionario,
                    'body' => 'El agente ' . $nombreFuncionarioPQRSF . ' (PQRSF) acaba de asignar el Ticket a: ' .  $nombreFuncionario,
                    'format' => 'html',
                    'ip_address' => $ipFuncionarioPQRSF,
                    'created' => $now,
                    'updated' => date('Y-m-d H:i:s', 0)
            ]);
            
            /*
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
            */

            DB::table('ordenes')
                ->insert([
                    'ordId' => $idTicket,
                    'ordTipo' => 'TICKET',
                    'pqrsfCodigo' => $codigoPQRSF
            ]);

            DB::table('pqrsfs')
                ->where('pqrsfCodigo', $codigoPQRSF)
                ->update(['pqrsfDireccionada' => 1]);

            $db->commit();

            return array(
                'status' => 'success',
                'numeroTicket' =>$numeroTicket,
                'nombreFuncionario'=> $nombreFuncionario            
            );
        }
        catch(Exception $ex){
            $db->rollback();
            report($ex);

            return array(
                'status' => 'fail'
            );   
        }

    }

    public static function obtnDatosTickets($idsTickets){
        $db=DB::connection('osticketdb');

        $sql="SELECT ticket.ticket_id AS idTicket, ticket.number AS numeroTicket, CONCAT(staff.firstname, ' ', staff.lastname) AS responsable, dept_name AS dependencia, lastresponse AS fechaUltimaRespuesta, duedate AS fechaVencimiento, thread.body AS servicio FROM ost_ticket ticket JOIN ost_staff staff ON ticket.staff_id=staff.staff_id JOIN ost_department department ON staff.dept_id=department.dept_id JOIN ost_ticket_thread thread ON (ticket.ticket_id=thread.ticket_id AND thread.thread_type='M') WHERE ticket.ticket_id IN (" . $idsTickets .") ORDER BY ticket.ticket_id;";
        
        return $db->select($sql);
    }

    public static function obtnHistorialTickets($idsTickets){
        $db=DB::connection('osticketdb');
        $sql="SELECT ticket_id AS idTicket, thread_type AS tipo, title AS titulo, body AS mensaje, created AS fecha, poster AS autor FROM `ost_ticket_thread` WHERE ticket_id IN (" . $idsTickets . ") AND thread_type!='M' ORDER BY ticket_id";

        return $db->select($sql);        
    }

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
    // Ojo que tambien busque en la tabla Staff
    public static function obtnDatosUsuario($email){
        $db=DB::connection('osticketdb');
        
        $user=$db->table('ost_user_email')
                    ->where('address', $email)
                    ->select('id', 'user_id')
                    ->first();

        if($user!=null){
            return array('idUsuario' => $user->user_id, 'idEmail' => $user->id);    
        }

        return null;        
    }

    public static function crearUsuario($db, $nombres, $email, $telefono){

        $now=date('Y-m-d H:i:s');
        
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
        $prioridad=$db->table('ost_ticket_priority')
                    ->where('priority_id', $idPrioridad)
                    ->select('priority_desc')
                    ->first();
        return $prioridad->priority_desc;
    }

    public static function obtnStaffId($emailFuncionario){
        $db=DB::connection('osticketdb');
        $staff=$db->table('ost_staff')
                    ->where('email', $emailFuncionario)
                    ->select('staff_id')
                    ->first();
        return $staff->staff_id;
    }

    public static function obtnUserName($emailFuncionario){
        $db=DB::connection('osticketdb');
        $staff=$db->table('ost_staff')
                    ->where('email', $emailFuncionario)
                    ->select('username')
                    ->first();

        return $staff->username;
    }

    public static function obtnNombreFuncionario($idFuncionario){
        $db=DB::connection('osticketdb');

        $staff=$db->table('ost_staff')
                    ->where('staff_id', $idFuncionario)
                    ->select('firstname', 'lastname')
                    ->first();

        return $staff->firstname . ' ' . $staff->lastname;
    }
}