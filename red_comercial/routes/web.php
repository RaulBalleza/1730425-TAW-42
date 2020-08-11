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
Route::get('/test', function () {
  return view('layouts.browser');
});
Route::get('/', function () {
  return view('layouts.browser');
});

Route::get('/micrositio/{any}', function () {
  return view('layouts.browser');
})->where('any', '.*');

Route::get('/browser', function () {
  return view('layouts.browser');
});

Auth::routes();

Route::get('/admin', function () {
  return view('layouts.admin');
});

Route::get('/admin/{any}', function () {
  return view('layouts.admin');
})->where('any', '.*');
