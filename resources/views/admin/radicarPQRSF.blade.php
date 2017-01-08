@extends('admin.master')
@section('title', 'Radicar PQRSFs')
@section('content')
	<div class="col-lg-10 col-lg-offset-1">
        <table id="pqrsfsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Tipo</th>
                    <th>Asunto</th>          
                    <th>Acciones</th>
                    <th>Creada</th>                                        
                    <th>Solicitante</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>              
    </div>

@include('admin.partial.modalRadicarPQRSF')
@include('admin.partial.modalRespuesta')

    <script type="text/javascript">

    $(document).ready(function(){        
        var table=$('#pqrsfsTable').DataTable({
            
        	"language": {
            	"emptyTable": "No hay PQRSFs pendientes por radicar",
            	"lengthMenu": "Mostrar _MENU_ PQRSFs por página",
            	"info": "Página _PAGE_ de _PAGES_",
            	"infoEmpty": "",            	
            },

            ajax:{
                url :  '/admin/pqrsfs/noRadicadas',
                dataSrc: ''
            },            
            "columns": [
                {"data": "pqrsfCodigo"},
                {   "data": "pqrsfTipo",
                    render: $.fn.dataTable.render.pqrsfTipo()
                },
                {"data": "pqrsfAsunto"},                
                {
                    "data": null,
                    "defaultContent": "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-primary'>Imprimir</button> <button class='btn-xs btn-success'>Radicar</button>"
                },
                {"data": "pqrsfFechaCreacion"},                
                {   "data": null, 
                    render: $.fn.dataTable.render.personaNombreCompleto()
                }
            ]            
        });
        
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
        
        $('#pqrsfsTable tbody').on('click', '.btn-default', function () {
            var data = table.row( $(this).parents('tr') ).data();
            alert('Ver PQRSF' + data.pqrsfCodigo);
        });

        $('#pqrsfsTable tbody').on('click', '.btn-primary', function () {
            var data = table.row( $(this).parents('tr') ).data();
            alert('Imprimir PQRSF' + data.pqrsfCodigo);
        });

        $('#pqrsfsTable tbody').on('click', '.btn-success', function () {

            var data = table.row( $(this).parents('tr') ).data();
            $("#mRadCodigoPQRSF").val(data.pqrsfCodigo);
            $('#modalRadicar').modal('toggle');
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

    function cargarModalRespuesta(response){
           
            var modalRespuesta=$("#modalRespuesta");

            if(response && response.status=='success'){
                $("#modalRespuestaTitulo").text('Radicado satisfactorio');
                $("#modalRespuestaTexto").html("<strong>La PQRSF ha sido radicada exitosamente.");
                modalRespuesta.removeClass('modal-danger');
                modalRespuesta.addClass('modal-success');                   
                $("#modalRadicar").modal('hide');
                modalRespuesta.modal('toggle');
                table.ajax.reload();                         
            }   
            else{
                    $("#modalRespuestaTitulo").text('Error');
                    $("#modalRespuestaTexto").text('Ha ocurrido un error mientras se radicaba la PQRSF. Si el problema persiste, por favor comuníquese con la División de Tecnologías de la Información y las Comunicaciones de la Universidad del Cauca - Teléfono: 8209900 extensión 55 - Correo electrónico: contacto@unicauca.edu.co');
                    modalRespuesta.removeClass('modal-success');
                    modalRespuesta.addClass('modal-danger');
                    modalRespuesta.modal('toggle');
            }               
        }

    });

    
    $.fn.dataTable.render.pqrsfTipo= function(){
        return function(data, type, row){
            switch(data){
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
    };

    $.fn.dataTable.render.personaNombreCompleto=function(){
        return function(data, type, row){
            return row.perNombres + " " + row.perApellidos; 
        }
    };

</script>
@endsection