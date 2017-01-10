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
@include('admin.partial.modalVerPQRSF')
@include('admin.partial.modalRespuesta')
@include('admin.partial.modalVerDescripcion')

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
                    "defaultContent": "<button class='btn-xs btn-default btnVer'>Ver</button> <button class='btn-xs btn-primary'>Imprimir</button> <button class='btn-xs btn-success'>Radicar</button>"
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
        
        $('#pqrsfsTable tbody').on('click', '.btnVer', function () {
            var pqrsf = table.row( $(this).parents('tr') ).data();
            
            $.get( "/admin/pqrsfs/consultas/todasPQRSF/datosRestantes/"+pqrsf.pqrsfCodigo)
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

                    $("#mVerPqrsfCodigo").text(pqrsf.pqrsfCodigo);
                    $("#mVerPqrsfTipo").text(renderPqrsfTipo(pqrsf.pqrsfTipo));
                    $("#mVerPqrsfAsunto").text(pqrsf.pqrsfAsunto);
                    $("#mVerPqrsfFechaVencimiento").text(pqrsf.pqrsfFechaVencimiento);
                    $("#mVerPqrsfRadicado").text(pqrsf.radId);
                    $("#mVerPqrsfDescripcion").text(response.pqrsfDescripcion);
                    $("#mVerPqrsfFechaCreacion").text(response.pqrsfFechaCreacion);
                    $("#mVerPqrsfMedioRecepcion").text(response.pqrsfMedioRecepcion);
                    $("#mVerPqrsfEstado").text(renderPqrsfEstado(response.pqrsfEstado));                    
                    $("#mVerPqrsfFechaCierre").text(response.pqrsfFechaCierre);                                             
                    
                    $("#mVerPqrsfOrdenes").html('<p align="justify">No registra</p></td>');
                    
                    
                    $("#modalVerPQRSF").modal('toggle');        
                })
                .fail(function() {
                    cargarModalRespuesta(null);
                });
            
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

        $("#mVerBtnVerDescripcion").on('click', function(){
            $("#modalVerDescripcion").modal('toggle');
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