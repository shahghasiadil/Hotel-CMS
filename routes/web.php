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
// Auth Routes
Auth::routes(["register" => false]);
// Redirect Route
Route::redirect('/', '/dashboard');
//Any Match Route
Route::get('/{path}', 'HomeController@index')->where('path', '[A-Za-z]+');

// Hotel Routes
Route::resource('/hotel', 'HotelController');
Route::get('/get_hotel', 'HotelController@index');
Route::get('/search_hotel', 'HotelController@search');

// Rates Routes
Route::resource('rate', 'RateController');
Route::get('get_rate', 'RateController@index');
Route::get('search_rate', 'RateController@search');
Route::get('get_hotels', 'RateController@get_hotels');
