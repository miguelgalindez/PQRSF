@extends('admin.master')

@section('title', 'Registrar PQRSF')
@section('content')
	<div class="container">
        <div class="col-lg-10">
        	<div class="row">
        		<form class="form-horizontal" action="/admin/registrarPqrsf" method="post">
        			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        			
		        	<div id="paso1">
		        		<div class="col-lg-6">
			        		<div class="input-group">
								<span class="input-group-addon">Tipo de solicitante</span>
								<select class="form-control" id="tipoSolicitante" name="tipoSolicitante"></select>
							</div>	
			        	</div>
			        	
			        	<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">Tipo de identificacion</span>
								<select class="form-control" id="tipoIdentificacion" name="tipoIdentificacion"></select>
							</div>
						</div>

						<div class="col-lg-6">
			        		<div class="input-group">
								<span class="input-group-addon">Identificación</span>
								<input class="form-control" type="text" id="identificacion" name="identificacion">
							</div>	
			        	</div>
			        	
			        	<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">Email</span>
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">Nombres</span>
								<input type="text" class="form-control" id="nombres" name="nombres">
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">Apellidos</span>
								<input type="text" class="form-control" id="apellidos" name="apellidos">
							</div>
						</div>					

						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">Telefono</span>
								<input type="text" class="form-control" id="telefono" name="telefono">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">Celular</span>
								<input type="text" class="form-control" id="celular" name="celular">
							</div>
						</div>

						<div class="col-lg-12">
							<div class="input-group">
								<span class="input-group-addon">Dirección</span>
								<input type="text" class="form-control" id="direccion" name="direccion">
							</div>
						</div>
					
						<div class="col-lg-12 text-right">
							<button type="clear" class="btn btn-primary">Cancelar</button>
							<a href="#" id="btnSiguiente" class="btn btn-primary">Siguiente</a>
						</div>
		        	</div>
		        	
		        	<div id="paso2" class="hidden">
		        		<div class="col-lg-6">
			        		<div class="input-group">
								<span class="input-group-addon">Tipo de solicitud</span>
								<select class="form-control" id="tipoSolicitud" name="tipoSolicitud"></select>
							</div>	
			        	</div>

			        	<div class="col-lg-6">
			        		<div class="input-group">
								<span class="input-group-addon">Medio de recepción</span>
								<select class="form-control" id="medioRecepcion" name="medioRecepcion"></select>
							</div>	
			        	</div>
			        	
			        	<div class="col-lg-12">
							<div class="input-group">
								<span class="input-group-addon">Asunto</span>
								<input class="form-control" id="asunto" name="asunto">
							</div>
						</div>

						<div class="col-lg-12">
			        		<div class="input-group">
								<span class="input-group-addon">Descripción</span>
								<textarea class="form-control" rows="4" id="descripcion" name="descripcion"></textarea>
							</div>	
			        	</div>

			        	<div class="col-lg-12 text-right">
							<a href="#" id="btnAtras" class="btn btn-default">Atrás</a>
							<button type="submit" class="btn btn-primary">Registrar PQRSF</button>
						</div>
		        	</div>
					
				</form>
			</div>        							
        </div>
    </div>

    <script type="text/javascript">
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

	        	$("#paso1").addClass('hidden');
	        	$("#paso2").removeClass('hidden');
	        });

	        $("#btnAtras").on('click', function(e){
	        	e.preventDefault();

	        	$("#paso1").removeClass('hidden');
	        	$("#paso2").addClass('hidden');	        	
	        });
    	});
    	
    </script>
@endsection