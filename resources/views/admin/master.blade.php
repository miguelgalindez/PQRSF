<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	
	<link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.css') !!} ">  
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!} ">  
    <link rel="stylesheet" type="text/css" href="{!! asset('DataTables/datatables.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap-datetimepicker.min.css') !!}">
        
    <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>    
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/moment.js') !!}"></script>
    <script src="{!! asset('DataTables/datatables.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap-datetimepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/es.js') !!}"></script>
</head>
<body>

	@include('admin.partial.navbar')
	@yield('content')

</body>
</html>