<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Osticket;
use App\Pqrsf;
use Log;

class PqrsfsController extends Controller
{
    public function obtnNoDireccionadas(){
        
    	return response()->json(Pqrsf::obtnNoDireccionadas());
    }

    public function obtnNoRadicadas(){
    	return response()->json(Pqrsf::obtnNoRadicadas());
    }

    public function obtnTodas(){
    	return response()->json(Pqrsf::obtnTodas());
    }

    public function obtnDatosRestantes($pqrsfCodigo){    	
    	return response()->json(Pqrsf::obtnDatosRestantes($pqrsfCodigo));
    }

    public function obtnDetallesOrdenes($pqrsfCodigo){
        
        $idsOrdenes=Pqrsf::obtnIdsOrdenes($pqrsfCodigo);

        $idsTickets="";
        // $idsCorreos=""; TODO
        foreach ($idsOrdenes as $id){
            if($id->ordTipo=="TICKET"){
                $idsTickets=$idsTickets . $id->ordId . ",";
            }
            else{
                // TODO lo de los correos
            }            
        }
        $idsTickets=substr($idsTickets, 0, -1);
        
        $datosTickets=Osticket::obtnDatosTickets($idsTickets);
        $historialTickets=Osticket::obtnHistorialTickets($idsTickets);


    // --- TODO solicitudes tipo CORREO

        $correoA=[
            'idCorreo' => 1,
            'destinatario' => 'foo@bar.co',
            'asunto' => 'foo',
            'mensaje' => 'foo and bar',
        ];

        $correoB=[
            'idCorreo' => 2,
            'destinatario' => 'bar@bar.co',
            'asunto' => 'bar',
            'mensaje' => 'bar and bar',
        ];

        $datosCorreos=array((object)$correoA, (object)$correoB);        

    // ---FIN  TODO solicitudes tipo CORREO

    	$detallesOrdenes=[
            'datosCorreos' => $datosCorreos,
            'datosTickets' => $datosTickets,
            'historialTickets' => $historialTickets,
        ];

        return response()->json($detallesOrdenes);
    }    

}
