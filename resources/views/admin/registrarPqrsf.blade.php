@extends('admin.master')

@section('title', 'Registrar PQRSF')
@section('content')
        <div class="col-lg-10 col-lg-offset-1">
        	<div class="box box-danger">
	            <div class="box-header with-border">
	            	<h2 class="pull-right" id="tituloNumeroPaso">Paso 1 de 3</h2>
	            </div>
	            <form class="form-horizontal" id="formularioRegistroPqrsf">
	              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
	              <div class="box-body">

	              	<div id="paso1">		                
		                
		                <div class="form-group">
		                  <label for="tipoSolicitante" class="col-sm-2 control-label">Tipo solicitante</label>
		                  <div class="col-sm-10">
		                    <select class="form-control" id="tipoSolicitante" name="tipoSolicitante"></select>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="tipoIdentificacion" class="col-sm-2 control-label">Tipo de Identificación</label>
		                  <div class="col-sm-10">
		                    <select class="form-control" id="tipoIdentificacion" name="tipoIdentificacion"></select>
		                  </div>
		                </div>

						<div class="form-group">
		                  <label for="identificacion" class="col-sm-2 control-label">Identificación</label>
		                  <div class="col-sm-10">
		                    <input class="form-control" type="text" id="identificacion" name="identificacion">
		                  </div>
		                </div>		               
		                
		                <div class="form-group">
		                  <label for="nombres" class="col-sm-2 control-label">Nombres</label>
		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="nombres" name="nombres">
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="apellidos" name="apellidos">
		                  </div>
		                </div>
		            </div>	        

		            <div id="paso2" class="hidden">

		            	<div class="form-group">
		                  <label for="email" class="col-sm-2 control-label">Email</label>
		                  <div class="col-sm-10">
		                    <input type="email" class="form-control" id="email" name="email">
		                  </div>
		                </div>

		            	<div class="form-group">
		                  <label for="telefono" class="col-sm-2 control-label">Telefono</label>
		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="telefono" name="telefono">
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="celular" class="col-sm-2 control-label">Celular</label>
		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="celular" name="celular">
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="direccion" class="col-sm-2 control-label">Dirección</label>
		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="direccion" name="direccion">
		                  </div>
		                </div>		                
		            </div>

		            <div id="paso3" class="hidden">
		            	<div class="form-group">
		                  <label for="tipoSolicitud" class="col-sm-2 control-label">Tipo de Solicitud</label>
		                  <div class="col-sm-10">
		                    <select class="form-control" id="tipoSolicitud" name="tipoSolicitud"></select>
		                  </div>
		                </div>

						<div class="form-group">
		                  <label for="medioRecepcion" class="col-sm-2 control-label">Medio de Recepción</label>
		                  <div class="col-sm-10">
		                    <select class="form-control" id="medioRecepcion" name="medioRecepcion"></select>
		                  </div>
		                </div>	

		                <div class="form-group">
		                  <label for="asunto" class="col-sm-2 control-label">Asunto</label>
		                  <div class="col-sm-10">
		                    		<input class="form-control" id="asunto" name="asunto">
		                  </div>
		                </div>

		               	<div class="form-group">
		                  <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
		                  <div class="col-sm-10">
		                    		<textarea class="form-control" rows="4" id="descripcion" name="descripcion"></textarea>
		                  </div>
		                </div>		                	                		        			        				        				
		            </div>

		            <div id="modalRespuesta" class="modal fade" role="dialog">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">×</span></button>
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

	              <!-- /.box-body -->
	              <div class="box-footer">	                
	                <div class="col-lg-offset-2">
	                	<a href="#" class="btn btn-danger hidden" id="btnAtras">	                
	      					<i class="fa fa-sign-out fa-2x fa-rotate-180 pull-left" aria-hidden="true"></i>
	      					Atrás      					
	    				</a>    				
		                <a href="#" class="btn btn-success pull-right" id="btnSiguiente">	                
	      					Siguiente      					
	      					<i class="fa fa-sign-out fa-2x pull-right" aria-hidden="true"></i>
	    				</a>    				
	                </div>	                
	              </div>
	              <!-- /.box-footer -->
	              </div>
	            </form>
          
       		</div>
       	</div>	        		  
    
    <script type="text/javascript">
    // Enviar 
    	var numeroPaso=1;    

    	$(document).ready(function(){
    		
    		$.get('/admin/datosRegistroPqrsf', function(data){
	          	           	            
	            $('#tipoSolicitante').append("<option value=''>Elegir...</option>");
	            $.each(data.tiposPersona, function(index, tipoPersona){
	                $('#tipoSolicitante').append("<option value='"+ tipoPersona+ "'>" +tipoPersona+"</option>");
	            });

	            $('#tipoIdentificacion').append("<option value=''>Elegir...</option>"); 
	            $.each(data.tiposIdentificacion, function(index, tipoIdentificacion){
	               $('#tipoIdentificacion').append("<option value='"+ tipoIdentificacion + "'>" +tipoIdentificacion+"</option>"); 
	            });

				$('#tipoSolicitud').append("<option value=''>Elegir...</option>"); 
	            $.each(data.tiposSolicitud, function(index, tipoSolicitud){
	               $('#tipoSolicitud').append("<option value='"+ tipoSolicitud.substring(0, 1) + "'>" +tipoSolicitud+"</option>"); 
	            });

	            $('#medioRecepcion').append("<option value=''>Elegir...</option>"); 
	            $.each(data.mediosRecepcion, function(index, medioRecepcion){
	               $('#medioRecepcion').append("<option value='"+ medioRecepcion + "'>" +medioRecepcion+"</option>"); 
	            });
	        });	

	        
	        $("#btnSiguiente").on('click', function(e){
	        	e.preventDefault();
	        	accionSiguiente();        	
	        });
	        $("#btnAtras").on('click', function(e){
	        	e.preventDefault();
	        	accionAnterior();        	
	        });
    	});

    	function accionSiguiente(){

    		if(numeroPaso<3){
    			$("#paso"+numeroPaso).addClass('hidden');
	        	$("#paso"+(numeroPaso+1)).removeClass('hidden');
	        	numeroPaso=numeroPaso+1;
	        	$("#tituloNumeroPaso").text("Paso "+numeroPaso+" de 3");
	        	$("#btnAtras").removeClass('hidden');	        	

	        	if(numeroPaso==3) $("#btnSiguiente").html("Registrar <i class=\"fa fa-floppy-o fa-2x pull-right\" aria-hidden=\"true\"></i>");
    		}
    		else{
    			var datosFormulario = $("#formularioRegistroPqrsf").serialize();
					var request=$.ajax({
						type: "POST",
						url: "/admin/registrarPqrsf",
						data: datosFormulario,
						dataType: "json"
					});
				
				request.done(function(response){					
					cargarModalRespuesta(response);												
				});
				request.fail(function (jqXHR, textStatus){									
					cargarModalRespuesta(null);
				});
    		}
    	}    	

    	function reiniciarFormulario(){
    		var token=$("#_token").val();
			$("#formularioRegistroPqrsf").trigger("reset");
			$("#_token").val(token);
			numeroPaso=1;
			$("#btnSiguiente").html("Siguiente <i class=\"fa fa-sign-out fa-2x pull-right\" aria-hidden=\"true\"></i>");
			$("#btnAtras").addClass('hidden');
			$("#paso1").removeClass('hidden');
			$("#paso3").addClass('hidden');
			$("#tituloNumeroPaso").text("Paso 1 de 3");

    	}

    	function accionAnterior(){
    		if(numeroPaso>1){
    			$("#paso"+numeroPaso).addClass('hidden');
	        	$("#paso"+(numeroPaso-1)).removeClass('hidden');
	        	numeroPaso=numeroPaso-1;
	        	$("#tituloNumeroPaso").text("Paso "+numeroPaso+" de 3");

	        	$("#btnSiguiente").html("Siguiente <i class=\"fa fa-sign-out fa-2x pull-right\" aria-hidden=\"true\"></i>");
    			if(numeroPaso==1){
					$("#btnAtras").addClass('hidden');
	    		}	    		
    		}
    	}

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
					$("#modalRespuestaTexto").text('Ha ocurrido un error mientras se registraba la PQRSF. Si el problema persiste, por favor comuníquese con la División de Tecnologías de la Información y las Comunicaciones de la Universidad del Cauca - Teléfono: 8209900 extensión 55 - Correo electrónico: contacto@unicauca.edu.co');
					modalRespuesta.removeClass('modal-success');
					modalRespuesta.addClass('modal-danger');
					modalRespuesta.modal('toggle');
	    	}	    		
    	}        	
    </script>
@endsection

