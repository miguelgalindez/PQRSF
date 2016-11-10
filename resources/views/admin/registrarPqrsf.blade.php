@extends('admin.master')

@section('title', 'Registrar PQRSF')
@section('content')
	<div class="container">
        <div class="col-lg-12">
        	<div class="box box-danger">
	            <div class="box-header with-border">
	            	<h1 class="box-title pull-right">Paso 1 de 3</h1>
	            </div>
	            <form class="form-horizontal">
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

	              <!-- /.box-body -->
	              <div class="box-footer">	                
	                
	                <a href="#" class="btn btn-danger hidden" id="btnAtras">	                
      					<i class="ion ion-android-arrow-dropleft-circle" aria-hidden="true"></i>
      					Atrás      					
    				</a>    				
	                <a href="#" class="btn btn-success pull-right" id="btnSiguiente">	                
      					Siguiente      					
      					<i class="ion ion-android-arrow-dropright-circle" aria-hidden="true"></i>
    				</a>    				
	              </div>
	              <!-- /.box-footer -->
	              </div>
	            </form>
          
       		</div>
       	</div>
    </div>   	        		  

    
    <script type="text/javascript">
    // Enviar 
    	var numeroPaso=1;
    	function accionSiguiente(){

    		if(numeroPaso<3){
    			$("#paso"+numeroPaso).addClass('hidden');
	        	$("#paso"+(numeroPaso+1)).removeClass('hidden');
	        	numeroPaso=numeroPaso+1;


	        	$("#btnAtras").removeClass('hidden');	        	

	        	if(numeroPaso==3){
					$("#btnSiguiente").html("Registrar <i class=\"ion ion-checkmark-circled\" aria-hidden=\"true\"></i>");
					// Send Ajax	
    			}
    		}
    	}
    	function accionAnterior(){
    		if(numeroPaso>1){
    			$("#paso"+numeroPaso).addClass('hidden');
	        	$("#paso"+(numeroPaso-1)).removeClass('hidden');
	        	numeroPaso=numeroPaso-1;

	        	$("#btnSiguiente").html("Siguiente <i class=\"ion ion-android-arrow-dropright-circle\" aria-hidden=\"true\"></i>");
    			if(numeroPaso==1){
					$("#btnAtras").addClass('hidden');
	    		}	    		
    		}
    	}
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
    	
    </script>
@endsection