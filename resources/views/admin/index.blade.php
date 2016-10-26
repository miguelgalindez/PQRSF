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
    $(document).ready(function(){
        $('#pqrsfs').DataTable({
            ajax:{
                url :  '/admin/pqrsfs/all',
                dataSrc: ''

            },            
            "columns": [
                {"data": "pqrsfCodigo"},
                {   "data": "pqrsfTipo",
                    render: function(data, type, row){
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
                },
                {"data": "pqrsfAsunto"},
                {"data": "pqrsfFechaCreacion"},
                {"data": "pqrsfMedioRecepcion"},
                {   "data": "pqrsfEstado",
                    render: function(data, type, row){
                        switch(data){
                            case "0":
                                return "Pendiente";
                            case "1":
                                return "Atendida";
                        }
                    }
                },
                {   "data": null, 
                    render: function(data, type, row){
                        return row.perNombres + " " + row.perApellidos; 
                }}
            ]
        });
    });
</script>

@endsection