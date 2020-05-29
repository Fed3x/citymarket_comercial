<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function (){

Route::get('/generar_reportes', function () {
    return view('generar_reportes');
});

Route::group(['prefix' => 'configuraciones'], function() {
    Route::get('usuarios', function () {
        return view('configuraciones.referencias.usuarios');
    });
    Route::get('departamentos_trabajos', function () {
        return view('configuraciones.referencias.departamentos_trabajos');
    });
    Route::get('departamentos', function () {
        return view('configuraciones.referencias.departamentos');
    });
    Route::get('trabajos', function () {
        return view('configuraciones.referencias.trabajos');
    });
    Route::get('perfiles', function () {
        return view('configuraciones.referencias.perfiles');
    });
});









Route::post('/ejecutar_reportes', 'EjecutarReporteController@ejecutar');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/productos_estructura', function () {
    return view('configuraciones.productos.estructura');
});

Route::get('productos','ProductoController@index');
Route::get('productos_sin_estructura','ProductoController@sinestructura');

Route::ApiResource('estructura', 'EstructuraController');
Route::Resource('trabajos', 'TrabajoController');
Route::Resource('usuarios', 'UsuarioController');
Route::Resource('perfiles', 'PerfilController');
Route::Resource('departamentos', 'DepartamentoController');
Route::ApiResource('departamentos_trabajos', 'DepartamentoTrabajoController');
Route::Resource('reportes', 'ReporteController')->only(['index']);




Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/login")
      ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
});

});