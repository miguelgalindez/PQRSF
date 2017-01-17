<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/', 'AdminController@index');

Route::get('/admin/registrarPqrsf', 'AdminController@mostrarRegistrarPqrsf');
Route::post('/admin/registrarPqrsf', 'AdminController@registrarPqrsf');

Route::get('/admin/direccionarPqrsf', 'AdminController@mostrarDireccionarPqrsf');
Route::post('/admin/direccionarPqrsf' , 'OsticketController@crearTicket');//only ajax

Route::get('/admin/radicarPQRSF', 'AdminController@mostrarRadicarPQRSF');
Route::post('/admin/pqrsf/radicarPQRSF', 'PqrsfsController@radicarPQRSF');

Route::get('/admin/datosRegistroPqrsf', 'AdminController@obtnDatosRegistroPqrsf');

Route::get('/admin/pqrsfs/noDireccionadas', 'PqrsfsController@obtnNoDireccionadas'); //only ajax
Route::get('/admin/pqrsfs/direccionar/datosDireccionamiento' , 'OsticketController@obtnDatosDireccionamiento'); //only ajax

Route::get('/admin/pqrsfs/noRadicadas', 'PqrsfsController@obtnNoRadicadas');


Route::get('/login', 'UsersController@googleLogin') ;
Route::get('/logout', 'UsersController@logout');


//------------------------------------------------------------------------------------------------------
//								CONSULTAS

// Admin/Consultas/TodasPqrsfs
Route::get('/admin/consultas/todasPQRSF', 'AdminController@mostrarTodasPqrsfs');
Route::get('/admin/pqrsfs/todas', 'PqrsfsController@obtnTodas');
Route::get('/admin/pqrsfs/consultas/todasPQRSF/datosRestantes/{pqrsfCodigo}', 'PqrsfsController@obtnDatosRestantes');
// Obtener los detalles de las ordenes
Route::get('/admin/ordenes/{pqrsfCodigo}/detalles', 'PqrsfsController@obtnDetallesOrdenes');


// Admin/Consultas/vencimientoPQRSF
Route::get('/admin/consultas/vencimientoPQRSF/{diasParaVencimiento}', 'AdminController@mostrarVencimientoPQRSF');
Route::get('/admin/pqrsfs/vencimiento/{diasParaVencimiento}', 'PqrsfsController@obtnPqrsfsPorVencimiento');


//------------------------------------------------------------------------------------------------------
//								REPORTES

// PQRSFs por Estado
Route::get('/admin/reportes/pqrsfsPorEstado', 'AdminController@mostrarPqrsfsPorEstado');
Route::get('/admin/osticket/dependencias', 'OsticketController@obtnTodasDependencias');