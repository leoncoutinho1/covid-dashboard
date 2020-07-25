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



Auth::routes();

Route::get('/', ['uses' => 'Controller@principal']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/country/{country}/{pdf}', ['uses' => 'Controller@principal'])->where('country', '[A-Za-z-]+');

Route::get('/country/{country?}', ['uses' => 'Controller@principal'])->where('country', '[A-Za-z-]+');

/* Route::get('/', function () {
    return view('welcome');
}); */


