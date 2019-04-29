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

    /**
     * Coordinador
     */



    /**
     * Supervisor
     */

    /**
     * Administrador
     */

    /**
     * Super Admin
     */


});
