
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/user-default.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php $partes=explode(' ', Auth::user()->name);
                if(count($partes)>1) $name=$partes[0] . ' ' . $partes[1];
                else $name=$partes[0];
          ?>
          <p>{!! $name !!}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Panel de control</li>
        
        <li>
          <a href="/admin">
            <i class="fa fa-dashboard"></i> 
            <span>Inicio</span>
          </a>
        </li>  

        <li class="treeview">
          <a href="#">
            <i class="fa fa-search"></i>
            <span>Consultas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i>PQRSFs vencidas</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>PQRSFs proximas a vencerse</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>PQRSFs por estado</a></li>        
            <li><a href=""><i class="fa fa-circle-o"></i>Todas las PQRSFs</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bolt"></i>
            <span>Acciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/registrarPqrsf"><i class="fa fa-circle-o"></i>Registrar PQRSFs</a></li>
            <li><a href="/admin/radicarPQRSF"><i class="fa fa-circle-o"></i>Radicar PQRSFs</a></li>
            <li><a href="/admin/direccionarPqrsf"><i class="fa fa-circle-o"></i>Direccionar PQRSFs</a></li>                  
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i>Reporte 1</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Reporte 2 </a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Reporte 3</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Reporte 4</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>Reporte 5</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Gestion de Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i>Agregar usuario</a></li>            
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
