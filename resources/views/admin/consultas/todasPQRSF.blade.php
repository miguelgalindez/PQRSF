@extends('admin.master')
@section('title', 'Todas las PQRSF')
@section('content')
	
	<div class="col-lg-10 col-lg-offset-1">
        <table id="pqrsfsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>                                   
                    <th>Tipo</th>
                    <th>Ordenes</th>
                    <th>Asunto</th>                    
                    <th>Solicitante</th>
                    <th>Creada</th>                       
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>              
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
                {"data": "pqrsfFechaCreacion"},
                {
                    "data": null,
                    render: $.fn.dataTable.render.accionesDisponibles()                    
                }                            
            ]
        }); 
    });
    
    $.fn.dataTable.render.accionesDisponibles=function(){
    	return function(data, type, row){    	
    		if(!data.radId){
    			return "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-primary'>Imprimir</button> <button class='btn-xs btn-success'>Radicar</button>"
    		}
    		return "<button class='btn-xs btn-default'>Ver</button> <button class='btn-xs btn-success'>Direccionar</button>";
    	}
    }

    $.fn.dataTable.render.numeroOrdenes=function(){
    	return function(data, type, row){    	
    		switch(data.numeroOrdenes){
    			case "0":
    				return '';
    			case "1":
    				return '<a>'+data.numeroOrdenes+' orden</a>';
    			default:
    				return '<a>'+data.numeroOrdenes+' Ordenes</a>';
    		}    		    		
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

