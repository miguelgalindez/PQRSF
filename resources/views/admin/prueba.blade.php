@extends('admin.master')
@section('title', 'prueba')

@section('content')
	<form class="form-horizontal" id="direccionarForm" action="/admin/pqrsfs/direccionar" method="post">

        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

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
@endsection