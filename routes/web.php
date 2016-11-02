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

Route::get('/admin/direccionarPqrsf', 'AdminController@mostrarDireccionarPqrsf');
Route::post('/admin/direccionarPqrsf' , 'OsticketController@crearTicket');//only ajax

Route::get('/admin/registrarPqrsf', 'AdminController@mostrarRegistrarPqrsf');
Route::post('/admin/registrarPqrsf', 'AdminController@registrarPqrsf');

Route::get('/admin/datosRegistroPqrsf', 'AdminController@obtnDatosRegistroPqrsf');

Route::get('/admin/pqrsfs/all', 'PqrsfsController@getAll'); //only ajax
Route::get('/admin/pqrsfs/direccionar/datosDireccionamiento' , 'OsticketController@obtnDatosDireccionamiento'); //only ajax


Route::get('/login', 'UsersController@googleLogin') ;
Route::get('/logout', 'UsersController@logout');