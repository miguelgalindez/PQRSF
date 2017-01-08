@extends('admin.master')
@section('title', 'Direccionar PQRSFs')

@section('content')
    
    <div class="col-lg-10 col-lg-offset-1">
        <table id="pqrsfsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>                                   
                    <th>Tipo</th>
                    <th>Asunto</th>                    
                    <th>Solicitante</th>
                    <th>Creada</th>                       
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>              
    </div>
    
@include('admin.partial.modalDireccionarPQRSF')
@include('admin.partial.modalRespuesta')
    
<script type="text/javascript">

    $(document).ready(function(){
        
        var table=$('#pqrsfsTable').DataTable({
            "language": {
                "emptyTable": "No hay PQRSFs pendientes por direccionar",
                "lengthMenu": "Mostrar _MENU_ PQRSFs por página",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "",                
            },

            ajax:{
                url :  '/admin/pqrsfs/noDireccionadas',
                dataSrc: ''

            },    
                    
            "columns": [
                {"data": "pqrsfCodigo"},    
                {   "data": "pqrsfTipo",
                    render: $.fn.dataTable.render.pqrsfTipo()
                },
                {"data": "pqrsfAsunto"},
                {   "data": null, 
                    render: $.fn.dataTable.render.personaNombreCompleto()
                },                
                {"data": "pqrsfFechaCreacion"},
                {
                    "data": null,
                    "defaultContent": "<button class='btn-xs btn-success'>Direccionar</button>"
                }                            
            ]
        });

        $('#fechaVencimiento').datetimepicker({
            locale: 'es',
            format: "D [de] MMMM [de] YYYY",
            daysOfWeekDisabled: [0, 6],
            minDate: new Date(),
            showTodayButton: true            
        });

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
        
        $('#pqrsfsTable tbody').on('click', 'button', function () {

            var data = table.row( $(this).parents('tr') ).data();

            $("#codigoPQRSF").val(data.pqrsfCodigo);
            $("#idPersona").val(data.perId);
            $("#asunto").val(data.pqrsfAsunto);
            $("#descripcion").val(data.pqrsfDescripcion);

            $('#modalDireccionar').modal('toggle');
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

        function cargarModalRespuesta(response){
            
            var modalRespuesta=$("#modalRespuesta");

            if(response && response.status=='success'){
                $("#modalRespuestaTitulo").text('Direccionamiento exitoso');
                $("#modalRespuestaTexto").html("<strong>La PQRSF ha sido asignada al funcionario" +response.nombreFuncionario+ ". </strong></br>Número de Ticket: "+response.numeroTicket);
                modalRespuesta.removeClass('modal-danger');
                modalRespuesta.addClass('modal-success');                   
                $("#modalDireccionar").modal('hide');
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