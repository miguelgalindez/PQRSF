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

    <!-- Modal -->
    <div id="modalRadicar" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Radicar PQRSF</h4>
          </div>
            <div class="modal-body">    
                <form class="form-horizontal" id="formularioRadicarPQRSF">

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="codigoPQRSF" value="" id="codigoPQRSF">
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="idRadicado">Número del radicado</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="idRadicado" name="idRadicado">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="fechaRadicado">Fecha del radicado</label> 
                        <div class="col-sm-8">
                            <input type='text' class="form-control" id="fechaRadicado" name="fechaRadicado" />
                        </div>
                    </div>                                    
                </form>
          </div>
          <div class="modal-footer">
            <div class="col-lg-offset-4">
                <a class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</a>
                <a id="btnModalDireccionar" class="btn btn-success pull-right">Radicar</a>            
            </div>            
          </div>
        </div>

        </div>
    </div>

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

        $('#fechaRadicado').datetimepicker({
            locale: 'es',
            format: "D [de] MMMM [de] YYYY [     Hora:] hh:mm A",
            daysOfWeekDisabled: [0, 6],                                    
            maxDate: new Date(),
            defaultDate: new Date()
        });


        $('#pqrsfsTable tbody').on('click', '.btn-default', function () {
            var data = table.row( $(this).parents('tr') ).data();
            alert('Ver PQRSF');
        });

        $('#pqrsfsTable tbody').on('click', '.btn-primary', function () {
            var data = table.row( $(this).parents('tr') ).data();
            alert('Imprimir PQRSF');
        });

        $('#pqrsfsTable tbody').on('click', '.btn-success', function () {

            var data = table.row( $(this).parents('tr') ).data();
            $("#codigoPQRSF").val(data.codigoPQRSF);
            $('#modalRadicar').modal('toggle');
        });

        

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