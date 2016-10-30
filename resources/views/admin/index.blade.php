@extends('admin.master')
@section('title', 'Index')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <table id="pqrsfsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Tipo</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                        <th>Creada</th>
                        <th>Recepcion</th>                        
                        <th>Solicitante</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>              
        </div>
    </div>

    <!-- Modal -->
    <div id="direccionarModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Direccionar solicitud</h4>
          </div>
            <div class="modal-body">    
                <form class="form-horizontal" id="direccionarForm" action="/admin/pqrsfs/direccionar" method="post">

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="subject" value="" id="subject">
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
                    <button id="btnDireccionarDireccionarModal" type="submit" class="btn btn-primary">Direccionar</button>                  
                </form>
          </div>
          <div class="modal-footer">
            <button id="btnCancelarDireccionarModal" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            
          </div>
        </div>

        </div>
    </div>
<script type="text/javascript">

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

    $.fn.dataTable.render.pqrsfEstado=function(){
        return function(data, type, row){
            switch(data){
                case "0":
                    return "Pendiente";
                case "1":
                    return "Atendida";
            }
        }
    };

    $.fn.dataTable.render.personaNombreCompleto=function(){
        return function(data, type, row){
            return row.perNombres + " " + row.perApellidos; 
        }
    };

    var dependencias;
    var funcionarios;

    $(document).ready(function(){
        $('#fechaVencimiento').datetimepicker({
            locale: 'es',
            format: "D [de] MMMM [de] YYYY",
            daysOfWeekDisabled: [0, 6],
            minDate: new Date(),
            showTodayButton: true,            
        });

        var table=$('#pqrsfsTable').DataTable({
            ajax:{
                url :  '/admin/pqrsfs/all',
                dataSrc: ''

            },            
            "columns": [
                {"data": "pqrsfCodigo"},
                {   "data": "pqrsfTipo",
                    render: $.fn.dataTable.render.pqrsfTipo()
                },
                {"data": "pqrsfAsunto"},
                {   "data": "pqrsfEstado",
                    render: $.fn.dataTable.render.pqrsfEstado()
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn-xs btn-primary' id='btnDireccionar'>Direccionar</button>"
                },
                {"data": "pqrsfFechaCreacion"},
                {"data": "pqrsfMedioRecepcion"},                
                {   "data": null, 
                    render: $.fn.dataTable.render.personaNombreCompleto()
                }
            ]
        });
/*
        $.get('/admin/pqrsfs/direccionar', function(data){
            $('#direccionarModalContent').html(data);
        });
        */
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
        
        $('#pqrsfsTable tbody').on('click', 'button',function () {
            $('#direccionarModal').modal('show');
            var data = table.row( $(this).parents('tr') ).data();
            console.log(data.pqrsfAsunto);
            $("#subject").val(data.pqrsfAsunto);
        });
    });  

        

</script>

@endsection