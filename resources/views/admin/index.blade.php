@extends('admin.master')
@section('title', 'Exito')

@section('content')
      <!-- Small boxes (Stat box) -->
        <div class="col-lg-4 col-lg-offset-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" onclick="location.href='/admin/consultas/vencimientoPQRSF/0';">
            <div class="inner">
              <h3>{{$numeroPqrsfsVencidas}}</h3>

              <p>PQRSFs vencidas</p>
            </div>
            <div class="icon">
              <i class="ion ion-nuclear"></i>
            </div>
            <a href="/admin/consultas/vencimientoPQRSF/0" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange" onclick="location.href='/admin/consultas/vencimientoPQRSF/8';">
            <div class="inner">
              <h3>{{$numeroPqrsfsProximasVencidas}}</h3>

              <p>PQRSFs pŕoximas a vencerse</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="/admin/consultas/vencimientoPQRSF/8" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-lg-offset-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black" onclick="location.href='/admin/radicarPQRSF';">
            <div class="inner">
              <h3>{{$numeroPqrsfsNoRadicadas}}</h3>

              <p>PQRSFs sin radicar</p>
            </div>
            <div class="icon">
              <i class="ion ion-archive white-icon"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black" onclick="location.href='/admin/direccionarPqrsf';">
            <div class="inner">
              <h3>{{$numeroPqrsfsNoDireccionadas}}</h3>

              <p>PQRSFs sin direccionar</p>
            </div>
            <div class="icon">
              <i class="ion ion-shuffle white-icon"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$numeroPqrsfsAtendidas}}</h3>

              <p>PQRSFs atendidas</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-checkmark-circle"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{$numeroPqrsfsAtendiendo}}</h3>

              <p>PQRSFs que se estan atendiendo</p>
            </div>
            <div class="icon">
              <i class="ion ion-settings"></i>
            </div>
            <a href="#" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$numeroPqrsfsPendientes}}</h3>

              <p>PQRSFs pendientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-cancel"></i>
            </div>
            <a href="#" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>            
              
@endsection