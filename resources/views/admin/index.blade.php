@extends('admin.master')
@section('title', 'Index')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <table id="pqrsfs" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Tipo</th>
                        <th>Asunto</th>
                        <th>Creada</th>
                        <th>Recepcion</th>
                        <th>Estado</th>
                        <th>Solicitante</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>  
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

    $(document).ready(function(){
        $('#pqrsfs').DataTable({
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
                {"data": "pqrsfFechaCreacion"},
                {"data": "pqrsfMedioRecepcion"},
                {   "data": "pqrsfEstado",
                    render: $.fn.dataTable.render.pqrsfEstado()
                },
                {   "data": null, 
                    render: $.fn.dataTable.render.personaNombreCompleto()
                }
            ]
        });
    });
</script>

@endsection