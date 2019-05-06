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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    /***
     * Encuestadores
     */

    // home listado
    Route::get('/encuestador/areas','encuestadorController@listadoAreas')->name("homeEncuestadores");

    // cargar nueva area
    Route::get('/encuestador/areas/add','encuestadorController@nuevaArea')->name("nuevaArea");
    Route::post('/save/area','encuestadorController@saveArea')->name('saveArea');
    Route::post('/encuestado/area/entregar','encuestadorController@entregarArea')->name('entregarArea');
    Route::post('/save/encuesta','encuestadorController@saveEncuesta')->name('saveEncuesta');

    Route::post('/encuestador/encuesta/add','encuestadorController@nuevaEncuesta')->name('nuevaEncuesta');
    Route::get('/encuesta/individuales/{id}','encuestadorController@nuevaIndividual')->name('nuevaIndividual');
    Route::post('/individuals/save','encuestadorController@saveIndividuals')->name('saveIndividuals');
    Route::post('/encuesta/editar','encuestadorController@editEncuesta')->name('editarEncuesta');
    Route::post('/area/detalle','encuestadorController@detalleArea')->name('detalleArea');
    Route::get('/area/detalle/{id}','encuestadorController@detalleAreaGet');
    Route::get('/encuesta/detalle/{id}','encuestadorController@detalleEncuestaGet');
    Route::post('/encuesta/detalle','encuestadorController@detalleEncuesta')->name("detalleEncuesta");

    Route::post('/encuesta/borrar','encuestadorController@delete')->name('eliminarEncuesta');
    Route::post('/encuesta/editar','encuestadorController@edit')->name('modificarEncuesta');
    Route::post('/encuesta/editar/save','encuestadorController@editSave')->name('saveEditEncuesta');
    Route::get('/individual/editar/{id}','encuestadorController@editIndividual')->name('editarIndividual');
    Route::post('/individual/update','encuestadorController@updateIndividual')->name('updateIndividual');

    /**
     * Coordinador
     */
    Route::get('/coordinador/areas','CoordinadorController@listadoAreas')->name("homeCoordinador");
    Route::post('/coordinador/rechazar',"CoordinadorController@rechazar")->name("rechazarArea");
    Route::post('/coordinador/asignar',"CoordinadorController@asignar")->name("asignarSupervisor");
    Route::post('/coordinador/confirmar',"CoordinadorController@confirmar")->name("confirmarArea");
    Route::post('/save/supervisor',"CoordinadorController@saveAsignacion")->name("saveAsignacion");
    Route::get('/coordinador/area/{id}',"CoordinadorController@verArea")->name("coordinadorDetalleArea");
    Route::get('/coordinador/encuesta/{id}',"CoordinadorController@verEncuesta")->name("coordinadorDetalleEncuesta");


    /**
     * Supervisor
     */
    Route::get('/supervisor/areas','SupervisorController@listadoAreas')->name("homeSupervisor");


    /**
     * Administrador
     */
    Route::get('/superadmin/home','superAdminController@home')->name('homeSuperAdmin');
    Route::get('/admin/encuesta/{id}',"superAdminController@verEncuesta")->name("superVerEncuesta");

    /**
     * Super Admin
     */


});

