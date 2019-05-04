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
    // carga nueva encuesta en area
    // params:
    Route::post('/encuestador/encuesta/add','encuestadorController@nuevaEncuesta')->name('nuevaEncuesta');
    Route::get('/encuesta/individuales/{id}','encuestadorController@nuevaIndividual')->name('nuevaIndividual');
    Route::post('/individuals/save','encuestadorController@saveIndividuals')->name('saveIndividuals');
    Route::post('/encuesta/editar','encuestadorController@editEncuesta')->name('editarEncuesta');
    Route::post('/area/detalle','encuestadorController@detalleArea')->name('detalleArea');
    Route::post('/encuesta/detalle','encuestadorController@detalleEncuesta')->name("detalleEncuesta");

    /**
     * Coordinador
     */
    Route::get('/coordinador/areas','CoordinadorController@listadoAreas')->name("homeCoordinador");
    Route::post('/coordinador/rechazar',"CoordinadorController@rechazar")->name("rechazarArea");
    Route::post('/coordinador/asignar',"CoordinadorController@asignar")->name("asignarSupervisor");
    Route::post('/coordinador/confirmar',"CoordinadorController@confirmar")->name("confirmarArea");
    Route::post('/save/supervisor',"CoordinadorController@saveAsignacion")->name("saveAsignacion");



    /**
     * Supervisor
     */
    Route::get('/supervisor/areas','SupervisorController@listadoAreas')->name("homeSupervisor");

    /**
     * Administrador
     */
    Route::get('/superadmin/home','superAdminController@home')->name('homeSuperAdmin');

    /**
     * Super Admin
     */


});

