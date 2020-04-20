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

Route::get('/generar_reportes', function () {
    return view('generar_reportes');
});

Route::post('/ejecutar_reportes', 'EjecutarReporteController@ejecutar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/productos_estructura', function () {
    return view('configuraciones.productos.estructura');
});

Route::get('productos','ProductoController@index');
Route::get('productos_sin_estructura','ProductoController@sinestructura');

Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/login")
      ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
});