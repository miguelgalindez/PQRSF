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



}
