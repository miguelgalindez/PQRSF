<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pqrsf extends Model
{
    protected $primaryKey='pqrsfCodigo';


	public static function obtnTiposSolicitud(){
    	return array(
    		'Petición',
    		'Queja',
    		'Reclamo',
    		'Sugerencia',
    		'Felicitación'
    	);
    }

    public static function obtnMediosRecepcion(){
    	return array(
    		'Web',
    		'Correo electrónico',
    		'Teléfono',
    		'Comunicación verbal'
    	);
    }

    public static function obtnTodas(){
        $sql="SELECT pqrsfCodigo AS codigo, pqrsfTipo, radId, (SELECT COUNT(ticketId) FROM tickets WHERE pqrsfCodigo=codigo) AS numeroOrdenes, pqrsfAsunto, perNombres, perApellidos, pqrsfFechaCreacion FROM pqrsfs NATURAL JOIN personas";

        return DB::select($sql);
    }

    public static function obtnNoDireccionadas(){
        
        $sql= "SELECT pqrsf.pqrsfCodigo, pqrsf.radId, pqrsf.pqrsfTipo, pqrsf.pqrsfAsunto, pqrsf.pqrsfDescripcion, pqrsf.pqrsfFechaCreacion, pqrsf.pqrsfMedioRecepcion, persona.perId, persona.perNombres, persona.perApellidos FROM pqrsfs pqrsf JOIN personas persona ON pqrsf.radId IS NOT NULL AND pqrsf.pqrsfDireccionada=0 AND pqrsf.perId=persona.perId AND pqrsf.perTipoId=persona.perTipoId";

        return DB::select( $sql );
    }

    public static function obtnNoRadicadas(){
        $sql= "SELECT pqrsf.pqrsfCodigo, pqrsf.pqrsfTipo, pqrsf.pqrsfAsunto, pqrsf.pqrsfDescripcion, pqrsf.pqrsfFechaCreacion, pqrsf.pqrsfMedioRecepcion, persona.perId, persona.perNombres, persona.perApellidos FROM pqrsfs pqrsf join personas persona on pqrsf.perId =persona.perId AND pqrsf.perTipoId=persona.perTipoId AND pqrsf.radId IS NULL";

        return DB::select( $sql );
    }

    public static function crear($tipoSolicitante, $tipoIdentificacion, $identificacion, $email, $nombres, $apellidos, $telefono, $celular, $direccion, $codigo, $tipoSolicitud, $medioRecepcion, $asunto, $descripcion){
    	
        try{
            $db=DB::connection('PQRSFdb');
            $db->beginTransaction();

            Persona::crearActualizar($db, $identificacion, $tipoIdentificacion, $tipoSolicitante, $nombres, $apellidos, $email, $direccion, $telefono, $celular);

            $db->table('pqrsfs')
                ->insert([
                    'pqrsfCodigo' => $codigo,
                    'perId' => $identificacion,
                    'perTipoId' => $tipoIdentificacion,
                    'pqrsfTipo' => $tipoSolicitud,
                    'pqrsfAsunto' => $asunto,
                    'pqrsfDescripcion' => $descripcion,
                    'pqrsfFechaCreacion' => date('Y-m-d H:i:s'),
                    'pqrsfMedioRecepcion' => $medioRecepcion,
                    'pqrsfEstado' => 0                  
            ]);

            $db->commit();

            return array(
                'status' => 'success',
                'codigoPQRSF' => $codigo,
                'tipoSolicitud' => $tipoSolicitud
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

    public static function radicar($codigoPQRSF, $idRadicado, $fechaRadicado, $usuarioPQRSF){

        $partes=explode(' ', $fechaRadicado);        
        $fecha=$partes[4] . "-" . Self::obtnnumeroMes($partes[2]) . "-" . (string)$partes[0];
        
        $partes=explode('Hora: ', $fechaRadicado);
        $hora24 = date("H:i", strtotime($partes[1]));

        $fecha = $fecha . " " . $hora24;

        $db=DB::connection('PQRSFdb');

        try{
            $db->beginTransaction();

            $db->table('radicados')
                ->insert([
                    'radId' => $idRadicado,
                    'radFecha' => $fecha,
                    'radUsuario' => $usuarioPQRSF
            ]);

            $db->table('pqrsfs')
                ->where('pqrsfCodigo', $codigoPQRSF)
                ->update(['radId' => $idRadicado]);

            $db->commit(); 
            return array(
                'status' => 'success'
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

}
