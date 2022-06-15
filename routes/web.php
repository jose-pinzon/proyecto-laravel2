<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/','InicioController')->name('Inicio');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


//  Rutas protegidas
Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('/vacantes','VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create','VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes','VacanteController@store')->name('vacantes.store');
    Route::delete('/vacantes/{vacante}','VacanteController@destroy')->name('vacantes.destroy');
    Route::get('/vacantes/{vacante}/edit', 'VacanteController@edit')->name('vacantes.edit');
    Route::put('/vacantes/{vacante}', 'VacanteController@update')->name('vacantes.update');

    // ?Ruta que se usaron en dropzone
    Route::post('/vacantes/imagen','VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen','VacanteController@borrarImagen')->name('vacantes.borrarImagen');

    //!cambiar estado de la vacante
    Route::post('/vacantes/{vacante}','VacanteController@cambiarEstado')->name('vacantes.cambiarEstado');

});


// !Categorias
Route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');

// !Buscador
Route::post('/busqueda/buscar','VacanteController@buscar')->name('vacantes.buscar');
Route::get('/busqueda/buscar','VacanteController@resultados')->name('vacantes.resultados');


//!Muestra los trabajos publicos
Route::get('/vacantes/{vacante}','VacanteController@show')->name('vacantes.show');

//!enviar datos para una vacante
Route::get('/candidatos/{id}','CandidatoController@index')->name('candidatos.index');
Route::post('/candidatos/store','CandidatoController@store')->name('candidato.store');


//!Notificaciones
Route::get('/notificaciones','NotificacionesController')->name('notificaciones');


