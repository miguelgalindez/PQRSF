@extends('admin.master')
@section('title', $tituloPagina)
@section('content')

	
	<div class="col-lg-10 col-lg-offset-1">
		<p>{{$descripcionPagina}}</p>
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
@endsection