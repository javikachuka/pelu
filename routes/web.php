<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('horarios', 'HorarioController@index')->name('horarios.index');
    Route::get('horarios/create', 'HorarioController@create')->name('horarios.create');
    Route::post('horarios', 'HorarioController@save')->name('horarios.save');
    Route::delete('horarios/{id}', 'HorarioController@delete')->name('horarios.delete');

    Route::get('servicios', 'ServicioController@index')->name('servicios.index');
    Route::get('servicios/create', 'ServicioController@create')->name('servicios.create');
    Route::post('servicios', 'ServicioController@save')->name('servicios.save');
    Route::get('servicios/duracion/{id}', 'ServicioController@getDuracion')->name('servicios.getDuracion');
    Route::delete('servicios/delete/{id}', 'ServicioController@delete')->name('servicios.delete');


    Route::get('usuarios', 'UserController@index')->name('users.index');
    Route::get('usuarios/create', 'UserController@create')->name('users.create');
    Route::delete('usuarios/delete/{id}', 'UserController@delete')->name('users.delete');
    Route::post('usuarios', 'UserController@save')->name('users.save');


    Route::get('turnos', 'TurnoController@index')->name('turnos.index');
    Route::get('turnos/create', 'TurnoController@create')->name('turnos.create');
    Route::get('turnos/obtener', 'TurnoController@get')->name('turnos.obtener');
    Route::post('turnos', 'TurnoController@save')->name('turnos.save');
    Route::get('turnos/obt', 'TurnoController@getIntervalos')->name('turnos.obtenerIntervalo');
    Route::get('turnos/fotos', 'TurnoController@fotos')->name('turnos.fotos');
    Route::post('turnos/fotos', 'TurnoController@saveFotos')->name('turnos.saveFotos');
});
