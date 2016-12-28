@extends('admin.master')
@section('title', 'Direccionar PQRSFs')

@section('content')
    
    <div class="col-lg-10 col-lg-offset-1">
        <table id="pqrsfsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Radicado</th>
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

    <!-- Modal -->
    <div id="modalDireccionar" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Direccionar solicitud</h4>
          </div>
            <div class="modal-body">    
                <form class="form-horizontal" id="formularioDireccionarPQRSF">

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="codigoPQRSF" value="" id="codigoPQRSF">
                    <input type="hidden" name="idPersona" value="" id="idPersona">
                    <input type="hidden" name="asunto" value="" id="asunto">
                    <input type="hidden" name="descripcion" value="" id="descripcion">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dependencia">Dependencia</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="dependencia" name="dependencia"></select>         
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="funcionario">Funcionario</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="funcionario" name="funcionario"></select>         
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fechaVencimiento">Fecha de vencimiento</label> 
                        <div class="col-sm-10">
                            <input type='text' class="form-control" id="fechaVencimiento" name="fechaVencimiento" />                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="prioridad">Prioridad</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="prioridad" name="prioridad"></select>           
                        </div>
                    </div>                
                </form>
          </div>
          <div class="modal-footer">
            <div class="col-lg-offset-2">
                <a class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</a>
                <a id="btnModalDireccionar" class="btn btn-success pull-right">Direccionar</a>            
            </div>            
          </div>
        </div>

        </div>
    </div>

    <div id="modalRespuesta" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button id="btnCerrarModalRespuesta1" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 id="modalRespuestaTitulo" class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p id="modalRespuestaTexto"></p>
          </div>
          <div class="modal-footer">
            <button id="btnCerrarModalRespuesta2" type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
          </div>
        </div>          
      </div>  
    </div>    
    
    
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
                {"data": "radId"},
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
                console.log("ok");        
            });
            request.fail(function(jqXHR, textStatus){
                cargarModalRespuesta(null);
                console.log("OJO !!");
            });
        });
    });



    function cargarModalRespuesta(response){
            
        var modalRespuesta=$("#modalRespuesta");

        if(response && response.status=='success'){
            $("#modalRespuestaTitulo").text('Direccionamiento exitoso');
            $("#modalRespuestaTexto").html("<strong>La PQRSF ha sido asignada al funcionario" +response.nombreFuncionario+ ". </strong></br>Número de Ticket: "+response.numeroTicket);
            modalRespuesta.removeClass('modal-danger');
            modalRespuesta.addClass('modal-success');                   
            modalRespuesta.modal('toggle');
            table.ajax.reload();                             
        }   
        else{
                $("#modalRespuestaTitulo").text('Error');
                $("#modalRespuestaTexto").text('Ha ocurrido un error mientras se registraba la PQRSF. Si el problema persiste, por favor comuníquese con la División de Tecnologías de la Información y las Comunicaciones de la Universidad del Cauca - Teléfono: 8209900 extensión 55 - Correo electrónico: contacto@unicauca.edu.co');
                modalRespuesta.removeClass('modal-success');
                modalRespuesta.addClass('modal-danger');
                modalRespuesta.modal('toggle');
        }               
    }
    
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