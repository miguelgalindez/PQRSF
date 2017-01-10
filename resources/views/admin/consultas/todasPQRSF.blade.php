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

@include('admin.partial.modalVerPQRSF')
@include('admin.partial.modalVerOrdenes')
@include('admin.partial.modalDireccionarPQRSF')
@include('admin.partial.modalRadicarPQRSF')
@include('admin.partial.modalRespuesta')
@include('admin.partial.modalVerDescripcion')


    <script type="text/javascript">

    $(document).ready(function(){
    	var modalActual;
    	var datosOrdenes;    	
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
        
        $('#pqrsfsTable tbody').on('click', '.linkVerOrdenes', function () {        	
        	var pqrsf = table.row( $(this).parents('tr') ).data();
        	abrirModalVerOrdenes(pqrsf.codigo);
        });

        $('#pqrsfsTable tbody').on('click', '.btn-default', function () {
            var pqrsf = table.row( $(this).parents('tr') ).data();
            
            $.get( "/admin/pqrsfs/consultas/todasPQRSF/datosRestantes/"+pqrsf.codigo)
				.done(function(response) {					
					response=response[0];					
					$("#mVerPerNombres").text(pqrsf.perNombres);
		            $("#mVerPerApellidos").text(pqrsf.perApellidos);
		            $("#mVerPerTipo").text(response.perTipo);
		            $("#mVerPerId").text(response.perId);
		            $("#mVerPerTipoId").text(response.perTipoId);
		            $("#mVerPerEmail").text(response.perEmail);
		            $("#mVerPerDireccion").text(response.perDireccion);
		            $("#mVerPerTelefono").text(response.perTelefono);
		            $("#mVerPerCelular").text(response.perCelular);

					$("#mVerPqrsfCodigo").text(pqrsf.codigo);
		            $("#mVerPqrsfTipo").text(renderPqrsfTipo(pqrsf.pqrsfTipo));
		            $("#mVerPqrsfAsunto").text(pqrsf.pqrsfAsunto);
		            $("#mVerPqrsfFechaVencimiento").text(pqrsf.pqrsfFechaVencimiento);
		            $("#mVerPqrsfRadicado").text(pqrsf.radId);
		            $("#mVerPqrsfDescripcion").text(response.pqrsfDescripcion);
		            $("#mVerPqrsfFechaCreacion").text(response.pqrsfFechaCreacion);
		            $("#mVerPqrsfMedioRecepcion").text(response.pqrsfMedioRecepcion);
		            $("#mVerPqrsfEstado").text(renderPqrsfEstado(response.pqrsfEstado));		            
		            $("#mVerPqrsfFechaCierre").text(response.pqrsfFechaCierre);		                       	      
		            
		            if(pqrsf.numeroOrdenes=="0"){
		            	$("#mVerPqrsfOrdenes").html('<p align="justify">No registra</p></td>');
		            }
		            else{
		            	$("#mVerPqrsfOrdenes").html('<button class="btn-xs btn-success" id="btnVerOrdenes">Ver ordenes</button>');

		            	$("#mVerBtnVerOrdenes").on('click', function(){
		            		abrirModalVerOrdenes(pqrsf.codigo);		            		
		            	});
		            }		           
		            $("#modalVerPQRSF").modal('toggle');		
				})
				.fail(function() {
			    	cargarModalRespuesta(null);
			 	});							           
        });               

        function abrirModalVerOrdenes(codigoPQRSF){
        			         	
			// Obteniendo los datos de las ordenes
			$.get("/admin/ordenes/"+codigoPQRSF+"/detalles")
				.done(function(response){
					datosOrdenes=response;		            				
					inicializarModalVerOrdenes();
					$("#modalVerOrdenes").modal('toggle');
				})
				.fail(function(){
			    	cargarModalRespuesta(null);
			 	});        	
        }

        function inicializarModalVerOrdenes(){
	    	
	    	// Cargando el sidebar
	    	var listaOrdenes=$("#listaOrdenes");
	    	listaOrdenes.empty();
	    	
	    	var arr=datosOrdenes.datosTickets;
	    	var numeroTickets=arr.length;
	    	for (var i = 0; i < numeroTickets; i++){
	    		listaOrdenes.append("<a id=\""+arr[i].idTicket+"\" href=\"#\" class=\"list-group-item orden\">Ticket # "+arr[i].numeroTicket+"</a>");
	    	}	    		    		

	    	arr=datosOrdenes.datosCorreos;
	    	for (var i = 0, len = arr.length; i < len; i++){
	    		listaOrdenes.append("<a id=\""+arr[i].corId+"\" href=\"#\" class=\"list-group-item orden\">"+arr[i].corDestinatario+"</a>");
	    	}	

	    	// Cargando los datos de la orden
	    	if(numeroTickets>0){
	    		cargarDatosOrden('TICKET', datosOrdenes.datosTickets[0].idTicket);	
	    	}
	    	else{
	    		cargarDatosOrden('CORREO', datosOrdenes.datosCorreos[0].corId);		
	    	}    	
	    }

		function cargarDatosOrden(ordTipo, ordId){
			var orden, arr;
			var divHistorial=$("#divHistorial");
			if(ordTipo=='TICKET'){
				
				arr=datosOrdenes.datosTickets;
				for (var i = 0, len = arr.length; i < len; i++){
					if(arr[i].idTicket == ordId){
						orden=arr[i];
						break;
					}
				}																
				$("#ordResponsable").text(orden.responsable);
				$("#ordDependencia").text(orden.dependencia);
				$("#ordServicio").text(orden.servicio);
				$("#ordUltimaRespuesta").text(orden.fechaUltimaRespuesta);
				$("#ordFechaVencimiento").text(orden.fechaVencimiento);

				$('#tblCorreo').hide();
				$('#tblTicket').show();
				$('#tituloHistorial').show();				

				// Cargando Historial del Ticket

				var historial=datosOrdenes.historialTickets;
				var estilo;
				divHistorial.empty();
				divHistorial.append("<h4>Historial de la Orden</h4>");
				for(var i=0, len=historial.length; i<len; i++){
					if(historial[i].tipo=="R"){
						estilo="panel panel-success";
					}
					else{
						estilo="panel panel-primary";
					}
					divHistorial.append("<div class=\""+estilo+"\"><div class=\"panel-heading\"><span class=\"pull-left\">Fecha: "+historial[i].fecha+"</span><span class=\"pull-right\">Autor: "+historial[i].autor+"</span><div class=\"clearfix\"></div>Novedad: "+historial[i].titulo+"</div><div class=\"panel-body\">"+historial[i].mensaje+"</div></div>");
				}
			}
			else{
				
				arr=datosOrdenes.datosCorreos;
				for (var i = 0, len = arr.length; i < len; i++){
					if(arr[i].corId == ordId){
						orden=arr[i];
						break;
					}
				}
				$("#ordFecha").text(orden.corFecha);
				$("#ordDestinatario").text(orden.corDestinatario);
				$("#ordAsunto").text(orden.corAsunto);
				$("#ordMensaje").text(orden.corMensaje);
				
				$('#tblTicket').hide();
				divHistorial.empty();
				$('#tblCorreo').show();
			}
		}

		
		$("#listaOrdenes").on("click", ".orden", function(event){			
			if($(this).text().includes('Ticket')){
				cargarDatosOrden("TICKET", $(this).attr('id'));				
			}
			else{
				cargarDatosOrden("CORREO", $(this).attr('id'));	
			}			
		});

		$("#mVerBtnVerDescripcion").on('click', function(){
        	$("#modalVerDescripcion").modal('toggle');
        });

		// --------------------------------------------------------------
		// Funcionalidad de direccionar

        var dependencias=[];
        var funcionarios=[];

        $.get('/admin/pqrsfs/direccionar/datosDireccionamiento', function(data){
            dependencias=data.dependencias;
            funcionarios=data.funcionarios;
            
            $('#dependencia').append("<option value=''>Elegir...</option>");
            $.each(data.dependencias, function(index, dependencia){
                $('#dependencia').append("<option value='"+ dependencia.dept_id + "'>" +dependencia.dept_name+"</option>");
            });

            $('#prioridad').append("<option value=''>Elegir...</option>"); 
            $.each(data.prioridades, function(index, prioridad){
               $('#prioridad').append("<option value='"+ prioridad.priority_id + "'>" +prioridad.priority_desc+"</option>"); 
            });
        });

        $('#dependencia').change(function(){
            $('#funcionario').empty();
            $('#funcionario').append("<option value=''>Elegir...</option>");
            var dependenciaSeleccionada=$(this).val();
            $.each(funcionarios, function(index, funcionario){
                if(funcionario.dept_id == dependenciaSeleccionada){
                    $('#funcionario').append("<option value='"+ funcionario.staff_id + "'>" +funcionario.firstname+ " "+ funcionario.lastname + "</option>");
                }
            });
        });
        
        $('#pqrsfsTable tbody').on('click', '.btnDireccionar', function () {

            var data = table.row( $(this).parents('tr') ).data();            
            var now=moment().format('YYYY-MM-DD');
            
            $('#fechaVencimiento').datetimepicker({
	            locale: 'es',
	            format: "D [de] MMMM [de] YYYY",
	            daysOfWeekDisabled: [0, 6],
                // para que no salga el error de que minDate es mayor que maxDate
	            minDate: now,
	            maxDate: data.pqrsfFechaVencimiento,
	            defaultDate: now,
	            showTodayButton: true
	        });

            $("#codigoPQRSF").val(data.codigo);
            $("#idPersona").val(data.perId);
            $("#asunto").val(data.pqrsfAsunto);
            $("#descripcion").val(data.pqrsfDescripcion);
            
            modalActual=$('#modalDireccionar');
            modalActual.modal('toggle');
        });
        
        $("#btnModalDireccionar").on('click', function(){
            var datosFormulario = $("#formularioDireccionarPQRSF").serialize();
            var request=$.ajax({
                type: "POST",
                url: "/admin/direccionarPqrsf",
                data: datosFormulario,
                dataType: "json"
            });

            request.done(function(response){
                cargarModalRespuesta(response);                    
            });
            request.fail(function(jqXHR, textStatus){
                cargarModalRespuesta(null);                
            });
        });

        // -----------------------------------------------------------------------------
        // Funcionalidad de radicar

        var maxfechaRadicado=new Date();
        var minFechaVencimiento=new Date();
        
        try{
            cargarDateTimePicker(maxfechaRadicado, minFechaVencimiento);            
        }
        catch(err){                                            
            maxfechaRadicado.setDate(maxfechaRadicado.getDate() - ((maxfechaRadicado.getDay()+2) % 7));              
            minFechaVencimiento.setDate(minFechaVencimiento.getDate() + ((8-minFechaVencimiento.getDay()) % 7));
            cargarDateTimePicker(maxfechaRadicado, minFechaVencimiento);        
        }             

        $('#pqrsfsTable tbody').on('click', '.btnRadicar', function () {

            var data = table.row( $(this).parents('tr') ).data();
            $("#mRadCodigoPQRSF").val(data.codigo);
            modalActual=$('#modalRadicar');
            modalActual.modal('toggle');
        });        

        $('#btnModalRadicar').on('click', function(){

            var datosFormulario=$('#formularioRadicarPQRSF').serialize();
            var request=$.ajax({
                type: 'POST',
                url: '/admin/pqrsf/radicarPQRSF',
                data: datosFormulario,
                dataType: 'json' 
            });
               
            request.done(function(response){                    
                cargarModalRespuesta(response);                                             
            });
            
            request.fail(function (jqXHR, textStatus){                                  
                cargarModalRespuesta(null);
            });
        });

	    function cargarDateTimePicker(maxfechaRadicado, minFechaVencimiento){           
	        $('#fechaRadicado').datetimepicker({
	            locale: 'es',            
	            //format: "D [de] MMMM [de] YYYY [     Hora:] hh:mm A",
	            format: "D [de] MMMM [de] YYYY",
	            daysOfWeekDisabled: [0, 6],                                    
	            maxDate: maxfechaRadicado,
	            defaultDate: maxfechaRadicado
	        });
	        
	        $('#fechaVencimientoPQRSF').datetimepicker({
	            locale: 'es',
	            format: "D [de] MMMM [de] YYYY",
	            daysOfWeekDisabled: [0, 6],                                    
	            minDate: minFechaVencimiento,
	            defaultDate: minFechaVencimiento
	        });
	    }    

	    // -----------------------------------------------------------------------------

        function cargarModalRespuesta(response){
            
            var modalRespuesta=$("#modalRespuesta");

            if(response && response.status=='success'){
                $("#modalRespuestaTitulo").text('Direccionamiento exitoso');
                $("#modalRespuestaTexto").html("<strong>La PQRSF ha sido asignada al funcionario" +response.nombreFuncionario+ ". </strong></br>Número de Ticket: "+response.numeroTicket);
                modalRespuesta.removeClass('modal-danger');
                modalRespuesta.addClass('modal-success');                   
                modalActual.modal('hide');
                modalRespuesta.modal('toggle');            
                table.ajax.reload();                           
            }   
            else{
                    $("#modalRespuestaTitulo").text('Error');
                    $("#modalRespuestaTexto").text('Ha ocurrido un error mientras se direccionaba la PQRSF. Si el problema persiste, por favor comuníquese con la División de Tecnologías de la Información y las Comunicaciones de la Universidad del Cauca - Teléfono: 8209900 extensión 55 - Correo electrónico: contacto@unicauca.edu.co');
                    modalRespuesta.removeClass('modal-success');
                    modalRespuesta.addClass('modal-danger');
                    modalRespuesta.modal('toggle');
            }               
        }       

    });		

    $.fn.dataTable.render.accionesDisponibles=function(){
    	return function(data, type, row){    	
    		if(!data.radId){
    			return "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-primary'>Imprimir</button> <button class='btn-xs btn-success btnRadicar'>Radicar</button>"
    		}
    		return "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-success btnDireccionar'>Direccionar</button>";
    	}
    }   

    $.fn.dataTable.render.numeroOrdenes=function(){
    	return function(data, type, row){    	
    		switch(data.numeroOrdenes){
    			case "0":
    				return '';
    			case "1":
    				return '<a class="linkVerOrdenes">'+data.numeroOrdenes+' orden</a>';
    			default:
    				return '<a class="linkVerOrdenes">'+data.numeroOrdenes+' ordenes</a>';
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
</script>
@endsection

