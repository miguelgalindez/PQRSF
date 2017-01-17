@extends('admin.master')
@section('title', 'R1: PQRSFs por estado')
@section('content')
	
	<!-- Select2 -->
  	<link rel="stylesheet" href="{!! asset('plugins/select2/select2.min.css') !!}">

	<div class="col-lg-10 col-lg-offset-1">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-1">
			  <!-- Date range -->
              <div class="form-group">
                <label>Intervalo de tiempo:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    Desde
                  </div>
                  <input type="text" class="form-control pull-right" id="fechaInicio">
                  <div class="input-group-addon">
                    Hasta
                  </div>
                  <input type="text" class="form-control pull-right" id="fechaFin">
                </div>           
              </div>          
              	<div class="form-group">
	            	<label>Formato: </label>
	            	<div class="input-group">
	            		<div class="input-group-addon">
	            			<i class="fa fa-area-chart "></i>
	            		</div>	            	
	            		<select class="form-control">
		                  <option selected="selected">Mensual</option>
		                  <option>Anual</option>		                  
		                </select>
	            	</div>
	            </div>

	            <div class="form-group">
					<label>Dependencias</label>
					<div class="input-group">
	            		<div class="input-group-addon">
	            			<i class="fa fa-users"></i>
	            		</div>
						<select class="form-control select2" id="dependencias" multiple="multiple" data-placeholder="Seleccione dependencia(s)">
							
						</select>
					</div>
				</div>	          
            </div>
			<!-- DONUT CHART -->
			<div class="col-lg-5">
		      <div class="box box-danger">
		        <div class="box-header with-border">
		          <h3 class="box-title">PQRSFs en cada estado</h3>
		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse">
		            	<i class="fa fa-minus"></i>
		            </button>
		            <button type="button" class="btn btn-box-tool" data-widget="remove">
		            	<i class="fa fa-times"></i>
		            </button>
		          </div>
		        </div>

		        <div class="box-body">
		          <canvas id="pieChart" style="height:250px"></canvas>
		        </div>	        
		      </div>
		    </div>
		</div>
	</div>

	<!-- Select2 -->
	<script src="{!! asset('plugins/select2/select2.full.min.js') !!}"></script>

	<script type="text/javascript">

		$(".select2").select2();
		$.get('/admin/osticket/dependencias', function(data){                                  
            $.each(data, function(index, dependencia){
                $('#dependencias').append("<option value='"+ dependencia.dept_id + "'>" +dependencia.dept_name+"</option>");
            });            
        });

        $('#dependencias').on("select2:select", function(e) { 
		   console.log("Nombre dependencia Seleccionada: "+e.params.data.text+"\tId Dependencia: "+e.params.data.id);
		});
		$('#dependencias').on("select2:unselect", function(e) {
		   console.log("Nombre dependencia Deseleccionada: "+e.params.data.text+"\tId Dependencia: "+e.params.data.id);
		});

		var now=new Date();
		var minDate=new Date("01/01/" +now.getFullYear());		

		$('#fechaInicio').datetimepicker({	
			locale: 'es',						
			format: "D [de] MMMM [de] YYYY",
			useCurrent: false,
			defaultDate: minDate,
			maxDate: now
		});
        $('#fechaFin').datetimepicker({
        	locale: 'es',
        	format: "D [de] MMMM [de] YYYY",
            useCurrent: false, //Important! See issue #1075
            maxDate: now,
            minDate: minDate,
            defaultDate: now
        });

        $("#fechaInicio").on("dp.change", function (e) {
            $('#fechaFin').data("DateTimePicker").minDate(e.date);
            // Actualizar datos y graficos
            console.log("Fecha inicio actualziada");
        });
        $("#fechaFin").on("dp.change", function (e) {
            $('#fechaInicio').data("DateTimePicker").maxDate(e.date);
            // Actualizar datos y graficos
            console.log("Fecha fin actualziada");
        });



		//- PIE CHART -
	    //-------------
	    // Get context with jQuery - using jQuery's .get() method.
	    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
	    var pieChart = new Chart(pieChartCanvas);
	    var PieData = [
	      {
	        value: 54,
	        color: "green",
	        highlight: "green",
	        label: "Atendidas"
	      },
	      {
	        value: 23,
	        color: "yellow",
	        highlight: "yellow",
	        label: "Atendiendo"
	      },
	      {
	        value: 12,
	        color: "red",
	        highlight: "red",
	        label: "Pendientes"
	      }	    
	    ];

	    var pieOptions = {
	      //Boolean - Whether we should show a stroke on each segment
	      segmentShowStroke: true,
	      //String - The colour of each segment stroke
	      segmentStrokeColor: "#fff",
	      //Number - The width of each segment stroke
	      segmentStrokeWidth: 2,
	      //Number - The percentage of the chart that we cut out of the middle
	      percentageInnerCutout: 50, // This is 0 for Pie charts
	      //Number - Amount of animation steps
	      animationSteps: 100,
	      //String - Animation easing effect
	      animationEasing: "easeOutBounce",
	      //Boolean - Whether we animate the rotation of the Doughnut
	      animateRotate: true,
	      //Boolean - Whether we animate scaling the Doughnut from the centre
	      animateScale: false,
	      //Boolean - whether to make the chart responsive to window resizing
	      responsive: true,
	      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
	      maintainAspectRatio: true,
	      //String - A legend template
	      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	    };
	    //Create pie or douhnut chart
	    // You can switch between pie and douhnut using the method below.
	    pieChart.Doughnut(PieData, pieOptions);


	</script>
@endsection