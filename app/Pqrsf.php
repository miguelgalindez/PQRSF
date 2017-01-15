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

    public static function obtnPqrsfsPorVencimiento($diasParaVencimiento){
        $sql="";
        if($diasParaVencimiento==0){
            $sql="SELECT pqrsfCodigo AS codigo, pqrsfTipo, radId, (SELECT COUNT(ordId) FROM ordenes WHERE pqrsfCodigo=codigo) AS numeroOrdenes, pqrsfAsunto, pqrsfDescripcion, perId, perNombres, perApellidos, datediff(DATE(NOW()), DATE(pqrsfFechaVencimiento)) AS diasVencimiento FROM pqrsfs NATURAL JOIN personas WHERE pqrsfEstado!='2' AND DATE(NOW())>DATE(pqrsfFechaVencimiento)";
        }
        else{
            $sql="SELECT pqrsfCodigo AS codigo, pqrsfTipo, radId, (SELECT COUNT(ordId) FROM ordenes WHERE pqrsfCodigo=codigo) AS numeroOrdenes, pqrsfAsunto, pqrsfDescripcion, perId, perNombres, perApellidos, datediff(DATE(pqrsfFechaVencimiento), DATE(NOW())) AS diasVencimiento FROM pqrsfs NATURAL JOIN personas WHERE pqrsfEstado!='2' AND DATE(pqrsfFechaVencimiento)>=DATE(NOW()) AND datediff(DATE(pqrsfFechaVencimiento), DATE(NOW()))<=" . $diasParaVencimiento;
        }
        return DB::select($sql);
    }

    public static function obtnNumeroVencidas(){
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroVencidas FROM pqrsfs WHERE pqrsfEstado!='2' AND DATE(NOW())>DATE(pqrsfFechaVencimiento)";
        return DB::select($sql);
    }

    public static function obtnNumeroProximasVencidas(){
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroProximasVencidas FROM pqrsfs WHERE pqrsfEstado!='2' AND datediff(DATE(pqrsfFechaVencimiento), DATE(NOW())>0 AND datediff(DATE(pqrsfFechaVencimiento), DATE(NOW())<=8";

        return DB::select($sql);
    }

    public static function obtnNumeroNoRadicadas(){
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroNoRadicadas FROM pqrsfs WHERE radId IS NULL OR radId = ''";
        return DB::select($sql);
    }

    public static function obtnNumeroNoDireccionadas(){
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroNoDireccionadas FROM pqrsfs WHERE radId IS NOT NULL AND radId!='' AND pqrsfDireccionada='0'";
        return DB::select($sql);
    }

    public static function obtnNumeroAtendidas(){
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroAtendidas FROM pqrsfs WHERE pqrsfEstado='2'";
        return DB::select($sql);
    }

    public static function obtnNumeroAtendiendo(){
        //$sql="SELECT COUNT(pqrsfCodigo) AS numeroAtendiendo FROM pqrsfs WHERE pqrsfEstado='1'        
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroAtendiendo FROM pqrsfs WHERE pqrsfEstado='1' AND DATE(NOW())<=DATE(pqrsfFechaVencimiento)";
        return DB::select($sql);   
    }

    public static function obtnNumeroPendientes(){
        //$sql="SELECT COUNT(pqrsfCodigo) AS numeroPendientes FROM pqrsfs WHERE pqrsfEstado='0';
        $sql="SELECT COUNT(pqrsfCodigo) AS numeroPendientes FROM pqrsfs WHERE pqrsfEstado='0' AND DATE(NOW())<=DATE(pqrsfFechaVencimiento)";
        
        return DB::select($sql);   
    }

    public static function obtnTodas(){
        $sql="SELECT pqrsfCodigo AS codigo, pqrsfTipo, radId, (SELECT COUNT(ordId) FROM ordenes WHERE pqrsfCodigo=codigo) AS numeroOrdenes, pqrsfAsunto, pqrsfDescripcion, perId, perNombres, perApellidos, pqrsfFechaVencimiento FROM pqrsfs NATURAL JOIN personas";

        return DB::select($sql);
    }

    public static function obtnDatosRestantes($pqrsfCodigo){
        $sql="SELECT pqrsfDescripcion, pqrsfFechaCreacion, pqrsfMedioRecepcion, pqrsfEstado, pqrsfFechaCierre, perTipo, perTipoId, perId, perEmail, perDireccion, perTelefono, perCelular FROM pqrsfs NATURAL JOIN personas WHERE pqrsfCodigo='" . $pqrsfCodigo . "'";

        return DB::select($sql);   
    }

    public static function obtnIdsOrdenes($pqrsfCodigo){
        $sql="SELECT ordId, ordTipo FROM ordenes WHERE pqrsfCodigo='" . $pqrsfCodigo . "'";
        return DB::select($sql);        
    }    

    public static function obtnNoDireccionadas(){
        
        $sql= "SELECT pqrsf.pqrsfCodigo, pqrsf.radId, pqrsf.pqrsfTipo, pqrsf.pqrsfAsunto, pqrsf.pqrsfDescripcion, pqrsf.pqrsfFechaCreacion, pqrsf.pqrsfFechaVencimiento, pqrsf.pqrsfMedioRecepcion, persona.perId, persona.perNombres, persona.perApellidos FROM pqrsfs pqrsf JOIN personas persona ON pqrsf.radId IS NOT NULL AND pqrsf.radId!='' AND pqrsf.pqrsfDireccionada='0' AND pqrsf.perId=persona.perId AND pqrsf.perTipoId=persona.perTipoId";

        return DB::select( $sql );
    }

    public static function obtnNoRadicadas(){
        $sql= "SELECT pqrsf.pqrsfCodigo, pqrsf.pqrsfTipo, pqrsf.pqrsfAsunto, pqrsf.pqrsfDescripcion, pqrsf.pqrsfFechaCreacion, pqrsf.pqrsfMedioRecepcion, persona.perId, persona.perNombres, persona.perApellidos FROM pqrsfs pqrsf join personas persona on pqrsf.perId =persona.perId AND pqrsf.perTipoId=persona.perTipoId AND (pqrsf.radId IS NULL OR  pqrsf.radId = '')";

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
                    'pqrsfEstado' => '0'                 
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

    public static function radicar($codigoPQRSF, $idRadicado, $fechaRadicado, $fechaVencimientoPQRSF, $usuarioPQRSF){

        if($idRadicado==""){
            return array(
                'status' => 'fail'
            );
        }
        
        $partes=explode(' ', $fechaRadicado);        
        $fechaRadicado=$partes[4] . "-" . Self::obtnnumeroMes($partes[2]) . "-" . (string)$partes[0] . " 23:59:59";
    /*      Para incluir la hora
        $partes=explode('Hora: ', $fechaRadicado);
        $hora24 = date("H:i", strtotime($partes[1]));
        $fechaRadicado = $fechaRadicado . " " . $hora24;
    */

        $partes=explode(' ', $fechaVencimientoPQRSF);
        $fechaVencimientoPQRSF=$partes[4] . "-" . Self::obtnnumeroMes($partes[2]) . "-" . (string)$partes[0] . " 23:59:59";        


        $db=DB::connection('PQRSFdb');

        try{
            $db->beginTransaction();

            $db->table('radicados')
                ->insert([
                    'radId' => $idRadicado,
                    'radFecha' => $fechaRadicado,
                    'radUsuario' => $usuarioPQRSF
            ]);

            $db->table('pqrsfs')
                ->where('pqrsfCodigo', $codigoPQRSF)
                ->update([
                    'radId' => $idRadicado,
                    'pqrsfFechaVencimiento' => $fechaVencimientoPQRSF
                ]);

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
