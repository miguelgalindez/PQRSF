<!-- Modal Ver Ordenes-->

    <div id="modalVerOrdenes" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">

	        <!-- Modal content-->
	        <div class="modal-content">	
		        <div class="modal-header">
	            	<button type="button" class="close" data-dismiss="modal">X</button>            
	          	</div>          
	            <div class="modal-body">		            
	            	<div class="row">            		
	            		<div class="col-lg-3">
	            			<h4>Ordenes asignadas</h4>
	            			<div class="list-group" id="listaOrdenes">
	            					<!-- TODO
	            						Que la lista pueda ser scrollable, colocar iconos de correo y de ticket y que ademas se marque el que esta activo
								  	 <a href="#" class="list-group-item active">Activo</a>  -->
							</div>	            				            	
	            		</div>
	            		<div class="col-lg-7 col-lg-offset-1">
	            			<div class="row">
	            				<h4>Descripcion de la Orden</h4>
	            					<table id="tblTicket" border="0" cellpadding="4" cellspacing="20" width="100%">
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

				            		<table id="tblCorreo" border="0" cellpadding="4" cellspacing="20" width="100%">
				            			<tbody>
				            				<tr>
				            					<th width="40%">Destinatario</th>
				            					<td width="60%"><p align="justify" id="ordDestinatario"></p></td>
				            				</tr>				            				
				            				<tr>
				            					<th width="40%">Asunto</th>
				            					<td width="60%"><p align="justify" id="ordAsunto"></p></td>
				            				</tr>            				            		
				            				<tr>
				            					<th width="40%">Mensaje</th>
				            					<td width="60%"><p align="justify" id="ordMensaje"></p></td>
				            				</tr>
				            				<tr>
				            					<th width="40%">Fecha</th>
				            					<td width="60%"><p align="justify" id="ordFecha"></p></td>
				            				</tr>

				            			</tbody>
				            		</table>	
	            			</div>	            			            			
	            		</div>
	            		<div class="col-lg-12" id="divHistorial"></div>		            		
	            	</div>
	            	               
	          </div>          
	          	<div class="modal-footer">           
	             	<a class="btn btn-default pull-right" data-dismiss="modal">Cerrar</a>                         
	        	</div>
	        </div>       
        </div>
    </div>