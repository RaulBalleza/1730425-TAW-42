<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clientes', 'ClientesController@list');
Route::get('clientes/{id}', 'ClientesController@get');
Route::post('clientes', 'ClientesController@create');
Route::put('clientes/{id}', 'ClientesController@update');
Route::delete('clientes/{id}', 'ClientesController@delete');

Route::get('micrositios', 'MicrositiosController@list');
Route::get('micrositios/{id}', 'MicrositiosController@get');
Route::post('micrositios', 'MicrositiosController@create');
Route::put('micrositios/{id}', 'MicrositiosController@update');
Route::delete('micrositios/{id}', 'MicrositiosController@delete');

Route::get('products', 'ProductsController@list');
Route::get('products/{id}', 'ProductsController@get');
Route::get('/{id}/products', 'ProductsController@listMicrositio');
Route::post('products', 'ProductsController@create');
Route::put('products/{id}', 'ProductsController@update');
Route::delete('products/{id}', 'ProductsController@delete');

Route::get('servicios', 'ServiciosController@list');
Route::get('servicios/{id}', 'ServiciosController@get');
Route::get('/{id}/servicios', 'ServiciosController@listMicrositio');
Route::post('servicios', 'ServiciosController@create');
Route::put('servicios/{id}', 'ServiciosController@update');
Route::delete('servicios/{id}', 'ServiciosController@delete');

Route::get('users', 'UsersController@list');
Route::get('users/{id}', 'UsersController@get');
Route::post('users', 'UsersController@create');
Route::put('users/{id}', 'UsersController@update');
Route::delete('users/{id}', 'UsersController@delete');
