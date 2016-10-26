<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	
	<link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.css') !!} ">  
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!} ">  
    <link rel="stylesheet" type="text/css" href="{!! asset('DataTables/datatables.css') !!}">
    <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('DataTables/datatables.js') !!}"></script>
</head>
<body>

	@include('partials.navbar')
	@yield('content')

</body>
</html>