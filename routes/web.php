<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaController;
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

Route::get('/dashboard', function (){
  return view('index');
});

Route::get('/login', function () {
  return view('index');
});


Route::get('/', function (){
  return view('index');
});

Route::get('/dashboard/{any}', function(){
  return view('index');
})->where('any', '.*');
