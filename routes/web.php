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

Route::get('/admin', 'PqrsfsController@index');
Route::get('/admin/pqrsfs/all', 'PqrsfsController@getAll'); //only ajax

Route::get('/admin/pqrsfs/direccionar', 'PqrsfsController@getDireccionar'); // only ajax
Route::get('/admin/pqrsfs/direccionar/datosDireccionamiento' , 'OsticketController@obtnDatosDireccionamiento'); //only ajax