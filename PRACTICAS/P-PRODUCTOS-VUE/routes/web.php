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
//Para consultar las rutas existentes se usa 'php artisan route:list'

//Esto registra todas las funciones de ProductoController como rutas que se pueden acceder, 
//solo si usamos la opcion --resource al crear el controlador
Route::resource('productos', 'ProductoController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
