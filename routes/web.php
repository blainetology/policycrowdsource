<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('policies','PoliciesController');

	Route::get('/rate/p/{pid}/r/{rating}',['as'=>'ratepolicy','uses'=>'RatingsController@ratepolicy']);
	Route::get('/rate/p/{pid}/s/{sid}/r/{rating}',['as'=>'ratesection','uses'=>'RatingsController@ratesection']);
