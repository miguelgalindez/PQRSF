<nav class="navbar navbar-default">	
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			
			<!-- Boton para cuando se colapse el navbar-->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
		  	</button>

		  	<!-- Eslogan -->
		  	<a class="navbar-brand" href="#">PQRS</a>
		</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar-collapse">
		  	<ul class="nav navbar-nav">        
		        
		        <li class="dropdown">
		         	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Consultas<span class="caret"></span></a>
		          	<ul class="dropdown-menu" role="menu">
			            <li><a href="#">Ver todas las PQRSFs</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Ver PQRSFs por estado</a></li>
			            <li><a href="#">Ver PQRSFs por tipo</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Ver PQRSFs vencidas</a></li>        
			            <li><a href="#">Ver respuestas</a></li>
		          	</ul>
		        </li>
		        
		        <li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Acciones<span class="caret"></span></a>
		         	<ul class="dropdown-menu" role="menu">
			            <li><a href="#">Registrar PQRSF</a></li>		            
			            <li><a href="#">Clasificar PQRSF</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Imprimir PQRSF</a></li>
			            <li><a href="#">Radicar PQRSF</a></li>        
			            <li class="divider"></li>		            
			            <li><a href="#">Direccionar PQRSF</a></li>
		          	</ul>
		        </li>

		        <li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes<span class="caret"></span></a>
		         	<ul class="dropdown-menu" role="menu">
			            <li><a href="#">Algun reporte</a></li>		            		            
			            <li class="divider"></li>
			            <li><a href="#">Mas reportes</a></li>		            
		          	</ul>
		        </li>

		        <li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gestión de usuarios<span class="caret"></span></a>
		         	<ul class="dropdown-menu" role="menu">
			            <li><a href="#">Agregar Usuario</a></li>		            		            
			            <li><a href="#">Eliminar Usuario</a></li>		            
		          	</ul>
		        </li>
		  	</ul>

		    <ul class="nav navbar-nav navbar-right">
		    	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Account
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-content">                            	
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="{!! asset('img/user-default.png') !!}"
                                            alt="Alternate Text" class="img-responsive" />
                                        <p class="text-center small">
                                            <a href="#">Change Photo</a></p>
                                    </div>
                                    <div class="col-lg-8">
                                        <span>
                                        	{!! Auth::user()->name !!}
                                        </span>
                                        <p class="text-muted small">
                                            {!! Auth::user()->id !!}
                                        </p>
                                        <div class="divider">
                                        </div>
                                        <a href="#" class="btn btn-primary btn-sm active">View Profile</a>
                                    </div>
                                </div>                              
                            </div>
                            <div class="navbar-footer">
                                <div class="navbar-footer-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="#" class="btn btn-default btn-sm">Change Passowrd</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="http://www.jquery2dotnet.com" class="btn btn-default btn-sm pull-right">Sign Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>	    	
		    </ul>   
		</div><!-- /.navbar-collapse -->	
</nav>