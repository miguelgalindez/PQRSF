@extends('admin.master')
@section('title', 'Administrador PQRSF')

@section('content')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/free-jqgrid/4.13.4/css/ui.jqgrid.min.css">
	<script src="https://cdn.jsdelivr.net/free-jqgrid/4.13.4/js/i18n/grid.locale-de.min.js"></script>
	<script src="https://cdn.jsdelivr.net/free-jqgrid/4.13.4/js/jquery.jqgrid.min.js"></script>

	<div class="container">
		<div class="content">
			<div class="title">Bienvenido Admin</div>			
			
			<table id="s2list"></table>
			<div id="s2pager"></div>
			<div id="filter" style="margin-left:30%;display:none">Search Invoices</div>
			<script src="search2.js" type="text/javascript"> </script>
			
		</div>		
	</div>
@endsection