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

Auth::routes();

Route::get('/home',"App\Http\Controllers\EventController@index");

Route::post('event/store',"App\Http\Controllers\EventController@store");
Route::post('event/delete/',"App\Http\Controllers\EventController@delete");

