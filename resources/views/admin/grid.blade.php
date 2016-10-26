<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.css') !!} ">  
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!} ">  
    <link rel="stylesheet" type="text/css" href="{!! asset('DataTables/datatables.css') !!}">
    <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('DataTables/datatables.js') !!}"></script>
    <title></title>
</head>
<body>
    <table id="firstTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr>
        </tbody>

    </table>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#firstTable').DataTable();
    });
</script>
</html>