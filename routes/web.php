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

    Route::get('/coordinador/desasignar/{id}',"CoordinadorController@desasignar")->name('desasginar');


    /**
     * Supervisor
     */
    Route::get('/supervisor/areas','SupervisorController@listadoAreas')->name("homeSupervisor");
    Route::get('/supervisor/area/{id}','SupervisorController@verArea')->name("supervisarArea");
    Route::get('/supervisor/area/finalizar/{id}','SupervisorController@finalizarArea')->name("finalizarArea");



    Route::get('supervisor/individual/editar/{id}','supervisorController@editIndividual')->name('supervisoreditarIndividual');
    Route::post('supervisor/individual/update','supervisorController@updateIndividual')->name('supervisorupdateIndividual');
    //TODO
    Route::get('supervisor/individual/{id}','supervisorController@showIndividual')->name("supervisorcargarcomponentes");
    Route::post('supervisor/individual/savenew','supervisorController@saveIndividual')->name("supervisorSaveIndividual");
    //

    Route::post('/supervisor/encuesta/','supervisorController@ver')->name('supervisorVerDetalle');
    Route::get('/supervisor/encuesta/{id}','supervisorController@verGet');
    Route::post('/supervisor/encuesta/edit/','supervisorController@edit')->name('supervisorModificarEncuesta');
    Route::post('/supervisor/encuesta/update/','supervisorController@update')->name('supervisorUpdateEncuesta');




    /**
     * Administrador
     */
    Route::get('/superadmin/home','superAdminController@home')->name('homeSuperAdmin');
    Route::get('/admin/encuesta/{id}',"superAdminController@verEncuesta")->name("superVerEncuesta");


    Route::get('/superadmin/encuesta/edit/{id}','superAdminController@edit')->name("AdminEditEncuesta");
    Route::post('/superadmin/encuesta/update/','superAdminController@update')->name("AdminUpdateEncuesta");
    Route::get('/superadmin/encuesta/listo/{id}','superAdminController@listo')->name("listo");
    Route::get('/superadmin/encuesta/listoHome/{id}','superAdminController@listoHome')->name("listoHome");

    Route::get('/superadmin/individual/editar/{id}','superAdminController@editIndividual')->name('AdminEditarIndividual');
    Route::post('/superadmin/individual/update','superAdminController@updateIndividual')->name('AdminupdateIndividual');
    /**
     * Super Admin
     */


});

// AJAX

route::get('ajax/encuesta/listo/{id}','EncuestaController@listo');
route::get('ajax/encuesta/listo/','EncuestaController@listo')->name('ajaxListo');;

