<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Osticket;
use App\Pqrsf;
use Log;
use Auth;

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

    public function radicarPQRSF(Request $request){        
        $response=Pqrsf::radicar(
            $request->get('mRadCodigoPQRSF'),
            $request->get('idRadicado'),
            $request->get('fechaRadicado'),
            $request->get('fechaVencimientoPQRSF'),
            Auth::user()->id
        );      

        return response()->json($response);
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
            'corId' => 1,
            'corDestinatario' => 'foo@bar.co',
            'corAsunto' => 'foo',
            'corMensaje' => 'foo and bar',
            'corFecha' => 'fecha Foo',
        ];

        $correoB=[
            'corId' => 2,
            'corDestinatario' => 'bar@bar.co',
            'corAsunto' => 'bar',
            'corMensaje' => 'bar and bar',
            'corFecha' => 'fecha Foo',
        ];

        $datosCorreos=array((object)$correoA, (object)$correoB);        

    // ---FIN  TODO solicitudes tipo CORREO

    	$datosOrdenes=[
            'datosCorreos' => $datosCorreos,
            'datosTickets' => $datosTickets,
            'historialTickets' => $historialTickets,
        ];

        Log::info(date('Y-m-d H:i:s'));

        return response()->json($datosOrdenes);
    }

    public function obtnPqrsfsPorVencimiento($diasParaVencimiento){
        return response()->json(Pqrsf::obtnPqrsfsPorVencimiento($diasParaVencimiento));
    }

}
