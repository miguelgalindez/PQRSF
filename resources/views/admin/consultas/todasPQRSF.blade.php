@extends('admin.master')
@section('title', 'Todas las PQRSF')
@section('content')		  
   <style>
	   table {table-layout:fixed;}
	   table td {word-wrap:break-word;}
	</style>
      
	<div class="col-lg-10 col-lg-offset-1">
        <table id="pqrsfsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>                                   
                    <th>Tipo</th>
                    <th>Ordenes</th>
                    <th>Asunto</th>                    
                    <th>Solicitante</th>
                    <th>Vencimiento</th>                       
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>              
    </div>

    <!-- Modal -->
    <div id="modalVerPQRSF" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detalles de la PQRSF</h4>
          </div>
            <div class="modal-body">	            
            	<div class="row">            		
            		<div class="col-lg-6">
            		<table border="0" cellpadding="4" cellspacing="20" width="100%">
            			<tbody>
            				<tr>
            					<th width="40%">Codigo</th>
            					<td width="60%"><p align="justify" id="pqrsfCodigo"></p></td>
            				</tr>
            				
            				<tr>
            					<th width="40%">Estado</th>
            					<td width="60%"><p align="justify" id="pqrsfEstado"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Tipo</th>
            					<td width="60%"><p align="justify" id="pqrsfTipo"></p></td>
            				</tr>

            				<tr>
            					<th width="40%">Asunto</th>
            					<td width="60%"><p align="justify" id="pqrsfAsunto"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Descripcion</th>
            					<td width="60%"><button class="btn-xs btn-primary" id="btnVerDescripcion">Ver descripción</button></td>
            				</tr>
            				<tr>
            					<th width="40%">Ordenes</th>
            					<td width="60%" id="pqrsfOrdenes"></td>
            				</tr>
            				<tr>
            					<th width="40%">Fecha de Vencimiento</th>
            					<td width="60%"><p align="justify" id="pqrsfFechaVencimiento"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Fecha de Creación</th>
            					<td width="60%"><p align="justify" id="pqrsfFechaCreacion"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Medio de Recepción</th>
            					<td width="60%"><p align="justify" id="pqrsfMedioRecepcion"></p></td>
            				</tr>

            				<tr>
            					<th width="40%">Radicado</th>
            					<td width="60%"><p align="justify" id="pqrsfRadicado"></p></td>
            				</tr>
            				
            				<tr>
            					<th width="40%">Fecha de Cierre</th>
            					<td width="60%"><p align="justify" id="pqrsfFechaCierre"></p></td>
            				</tr>            			

            			</tbody>
            		</table>
            	</div>

            	<div class="col-lg-5 col-lg-offset-1">
            		<table border="0" cellpadding="4" cellspacing="20" width="100%">
            			<tbody>
            				
            				<tr>
            					<th width="40%">Tipo</th>
            					<td width="60%"><p align="justify" id="perTipo"></p></td>
            				</tr>

            				<tr>
            					<th width="40%">Tipo Identificación</th>
            					<td width="60%"><p align="justify" id="perTipoId"></p></td>
            				</tr>
            				
            				<tr>
            					<th width="40%">Identificación</th>
            					<td width="60%"><p align="justify" id="perId"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Nombres</th>
            					<td width="60%"><p align="justify" id="perNombres"></p></td>
            				</tr>

            				<tr>
            					<th width="40%">Apellidos</th>
            					<td width="60%"><p align="justify" id="perApellidos"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Email</th>
            					<td width="60%"><p align="justify" id="perEmail"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Dirección</th>
            					<td width="60%"><p align="justify" id="perDireccion"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Teléfono</th>
            					<td width="60%"><p align="justify" id="perTelefono"></p></td>
            				</tr>
            				<tr>
            					<th width="40%">Celular</th>
            					<td width="60%"><p align="justify" id="perCelular"></p></td>
            				</tr>            				
            			</tbody>
            		</table>
            	</div>	
            	</div>
            	               
          </div>          
          	<div class="modal-footer">           
             	<a class="btn btn-default pull-right" data-dismiss="modal">Cerrar</a>                         
        	</div>
        </div>
        

        </div>
    </div>


<!-- Modal Ver Ordenes-->

    <div id="modalVerOrdenes" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

	        <!-- Modal content-->
	        <div class="modal-content">	          
	            <div class="modal-body">		            
	            	<div class="row">            		
	            		<div class="col-lg-3">
	            			<h4>Ordenes asignadas</h4>
	            			<section class="sidebar">
	            				<ul class="list-group" id="listaOrdenes">
								  
								</ul>	
	            			</section>	            			
	            		</div>
	            		<div class="col-lg-7 col-lg-offset-1">
	            			<div class="row">
	            				<h4>Descripcion de la Orden</h4>
	            					<table border="0" cellpadding="4" cellspacing="20" width="100%">
				            			<tbody>
				            				<tr>
				            					<th width="40%">Responsable</th>
				            					<td width="60%"><p align="justify" id="ordResponsable"></p></td>
				            				</tr>				            				
				            				<tr>
				            					<th width="40%">Dependencia</th>
				            					<td width="60%"><p align="justify" id="ordDependencia"></p></td>
				            				</tr>            				            		
				            				<tr>
				            					<th width="40%">Fecha de vencimiento</th>
				            					<td width="60%"><p align="justify" id="ordFechaVencimiento"></p></td>
				            				</tr>
				            				<tr>
				            					<th width="40%">Ultima respuesta</th>
				            					<td width="60%"><p align="justify" id="ordUltimaRespuesta"></p></td>
				            				</tr>

				            				<tr>
				            					<th width="40%">Servicio solicitado</th>
				            					<td width="60%"><p align="justify" id="ordServicio"></p></td>
				            				</tr>
				            			</tbody>
				            		</table>	
	            			</div>
	            			<div class="row">
	            				<h4>Historial de la Orden</h4>	
	            			</div>
	            		</div>				
	            	</div>
	            	               
	          </div>          
	          	<div class="modal-footer">           
	             	<a class="btn btn-default pull-right" data-dismiss="modal">Cerrar</a>                         
	        	</div>
	        </div>       
        </div>
    </div>

    <!-- Modal Respuesta-->
    <div id="modalRespuesta" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">x</span></button>
		        <h4 id="modalRespuestaTitulo" class="modal-title"></h4>
		      </div>
		      <div class="modal-body">
		        <p id="modalRespuestaTexto"></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
	</div>

	<!-- Modal ver descripcion-->
    <div id="modalVerDescripcion" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">x</span></button>
		        <h4 class="modal-title">Descripción</h4>
		      </div>
		      <div class="modal-body">
		        <p id="pqrsfDescripcion"></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
	</div>

    <script type="text/javascript">

    $(document).ready(function(){
    	
        var table=$('#pqrsfsTable').DataTable({
            "language": {
                "emptyTable": "Aún no se han registrado PQRSFs",
                "lengthMenu": "Mostrar _MENU_ PQRSFs por página",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "",                
            },

            ajax:{
                url :  '/admin/pqrsfs/todas',
                dataSrc: ''

            },    
                    
            "columns": [
                {"data": "codigo"},    
                {   "data": "pqrsfTipo",
                    render: $.fn.dataTable.render.pqrsfTipo()
                },
                {	"data": null,
                	render: $.fn.dataTable.render.numeroOrdenes()
                },
                {"data": "pqrsfAsunto"},
                {   "data": null, 
                    render: $.fn.dataTable.render.personaNombreCompleto()
                },                
                {"data": "pqrsfFechaVencimiento"},
                {
                    "data": null,
                    render: $.fn.dataTable.render.accionesDisponibles()                    
                }                            
            ]
        });

        $('#pqrsfsTable tbody').on('click', '.btn-default', function () {
            var pqrsf = table.row( $(this).parents('tr') ).data();
            
            $.get( "/admin/pqrsfs/consultas/todasPQRSF/datosRestantes/"+pqrsf.codigo)
				.done(function(response) {					
					response=response[0];					
					$("#perNombres").text(pqrsf.perNombres);
		            $("#perApellidos").text(pqrsf.perApellidos);
		            $("#perTipo").text(response.perTipo);
		            $("#perId").text(response.perId);
		            $("#perTipoId").text(response.perTipoId);
		            $("#perEmail").text(response.perEmail);
		            $("#perDireccion").text(response.perDireccion);
		            $("#perTelefono").text(response.perTelefono);
		            $("#perCelular").text(response.perCelular);

					$("#pqrsfCodigo").text(pqrsf.codigo);
		            $("#pqrsfTipo").text(renderPqrsfTipo(pqrsf.pqrsfTipo));
		            $("#pqrsfAsunto").text(pqrsf.pqrsfAsunto);
		            $("#pqrsfFechaVencimiento").text(pqrsf.pqrsfFechaVencimiento);
		            $("#pqrsfRadicado").text(pqrsf.radId);
		            $("#pqrsfDescripcion").text(response.pqrsfDescripcion);
		            $("#pqrsfFechaCreacion").text(response.pqrsfFechaCreacion);
		            $("#pqrsfMedioRecepcion").text(response.pqrsfMedioRecepcion);
		            $("#pqrsfEstado").text(renderPqrsfEstado(response.pqrsfEstado));		            
		            $("#pqrsfFechaCierre").text(response.pqrsfFechaCierre);		                       	      
		            
		            if(pqrsf.numeroOrdenes=="0"){
		            	$("#pqrsfOrdenes").html('<p align="justify">No registra</p></td>');
		            }
		            else{
		            	$("#pqrsfOrdenes").html('<button class="btn-xs btn-success" id="btnVerOrdenes">Ver ordenes</button>');

		            	$("#btnVerOrdenes").on('click', function(){
		            		
		            		// Obteniendo los detalles de las ordenes

		            		$.get("/admin/ordenes/"+pqrsf.codigo+"/detalles")
		            			.done(function(response){
		            				console.log(response);
		            			})
		            			.fail(function(){
							    	cargarModalRespuesta(null);
							 	});

							$("#modalVerOrdenes").modal('toggle');

		            		// Obteniendo el historial de las ordenes

		            		/*
		            		// Obteniendo los ids de las ordenes asociadas a la pqrsf con codigo determinado
		            		$.get( "/admin/ordenes/pqrsf/"+data.codigo)
								.done(function(response){															
									response.forEach(function(orden, index, array){	
										console.log(response);
										// Obteniendo datos de cada orden
										if(orden.ordTipo=="TICKET"){
											$.get( "/admin/ticket/"+orden.ordId)
												.done(function(ticket){
													ticket=ticket[0];
													ordenes.push=new Object({
														ordTipo : "TICKET",
														ordNumeroTicket : ticket.numeroTicket,
														ordDependencia : ticket.dependencia,
														ordResponsable : ticket.responsable,
														ordServicio : ticket.servicio,
														ordUltimaRespuesta : ticket.fechaUltimaRespuesta,
														ordFechaVencimiento : ticket.fechaVencimiento
													});
												})
												.fail(function(){
											    	cargarModalRespuesta(null);
											 	});
										}
										else{
											// TODO Orden por Correo
										}
										
									});
									console.log(ordenes[0]);
									//var listaOrdenes=$("#listaOrdenes");									
									$.each( ordenes, function( key, value ) {
									  	alert( key.ordTipo + ": " + value.ordTipo );
									  	
									});
									/*
									ordenes.forEach(function(orden, index, array){
										console.log(orden);
										if(orden.ordTipo=="TICKET"){
											listaOrdenes.append("<li class=\"list-group-item\"><span class=\"badge\">14</span>"+orden.ordNumeroTicket+"</li>");
										}
										else{
											// TODO orden de tipo correo
										}	
									});

									$("#modalVerOrdenes").modal('toggle');

								})
								.fail(function(){
							    	cargarModalRespuesta(null);
							 	});
							 */					        
				        });		            	
		            }
		            

		            $("#modalVerPQRSF").modal('toggle');		
				})
				.fail(function() {
			    	cargarModalRespuesta(null);
			 	});							           
        });
        
        $("#btnVerDescripcion").on('click', function(){
        	$("#modalVerDescripcion").modal('toggle');
        });              
    });	
    
    $.fn.dataTable.render.accionesDisponibles=function(){
    	return function(data, type, row){    	
    		if(!data.radId){
    			return "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-primary'>Imprimir</button> <button class='btn-xs btn-success'>Radicar</button>"
    		}
    		return "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-success'>Direccionar</button>";
    	}
    }   

    $.fn.dataTable.render.numeroOrdenes=function(){
    	return function(data, type, row){    	
    		switch(data.numeroOrdenes){
    			case "0":
    				return '';
    			case "1":
    				return '<a>'+data.numeroOrdenes+' orden</a>';
    			default:
    				return '<a>'+data.numeroOrdenes+' Ordenes</a>';
    		}    		    		
    	}
    }

    function renderPqrsfEstado(estado){
    	switch(estado){
    		case "0":
    			return "Pendiente";
    		case "1":
    			return "En proceso";
    		case "2":
    			return "Atendida";
    	}
    }

    function renderPqrsfTipo(tipo){
    	switch(tipo){
            case "P":
                return "Petición";
            case "Q":
                return "Queja";
            case "R":
                return "Reclamo";
            case "S":
                return "Sugerencia";
            case "F":
                return "Felicitación";
       	}
    }

    $.fn.dataTable.render.pqrsfTipo= function(){
        return function(data, type, row){
            return renderPqrsfTipo(data)
        }
    };

    $.fn.dataTable.render.personaNombreCompleto=function(){
        return function(data, type, row){
            return row.perNombres + " " + row.perApellidos; 
        }
    };

    function cargarModalRespuesta(response){
    		
    		var modalRespuesta=$("#modalRespuesta");

    		if(response && response.status=='success'){
    			$("#modalRespuestaTitulo").text('Registro satisfactorio');
				$("#modalRespuestaTexto").html("<strong>La PQRSF ha sido registrada exitosamente.</strong></br>Codigo: "+response.codigoPQRSF);
				modalRespuesta.removeClass('modal-danger');
				modalRespuesta.addClass('modal-success');					
				reiniciarFormulario();
				modalRespuesta.modal('toggle');							
	    	}	
	    	else{
	    			$("#modalRespuestaTitulo").text('Error');
					$("#modalRespuestaTexto").text('Ha ocurrido un error mientras se completaba la operación. Si el problema persiste, por favor comuníquese con la División de Tecnologías de la Información y las Comunicaciones de la Universidad del Cauca - Teléfono: 8209900 extensión 55 - Correo electrónico: contacto@unicauca.edu.co');
					modalRespuesta.removeClass('modal-success');
					modalRespuesta.addClass('modal-danger');
					modalRespuesta.modal('toggle');
	    	}	    		
    	}
</script>
@endsection

