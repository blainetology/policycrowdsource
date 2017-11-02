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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('policies/sections/{pid}/{sid}',['as'=>'getpolicysections','uses'=>'PoliciesController@getsubsections']);
Route::resource('policies','PoliciesController');
Route::resource('rfp','RFPsController');

Route::get('/comment/policy/{pid}',['as'=>'commentpolicy','uses'=>'CommentsController@getpolicy']);
Route::get('/comment/section/{sid}',['as'=>'commentsection','uses'=>'CommentsController@getsection']);
Route::get('/comment/rfp/{rid}',['as'=>'commentrfp','uses'=>'CommentsController@getrfp']);

Route::group(['middleware'=>['auth']],function(){

	Route::get('/rate/r/{rid}/r/{rating}',['as'=>'raterfp','uses'=>'RatingsController@raterfp']);
	Route::get('/rate/p/{pid}/r/{rating}',['as'=>'ratepolicy','uses'=>'RatingsController@ratepolicy']);
	Route::get('/rate/p/{pid}/s/{sid}/r/{rating}',['as'=>'ratesection','uses'=>'RatingsController@ratesection']);

	Route::get('/account/settings',['as'=>'accountsettings','uses'=>'AccountController@settings']);
	Route::post('/account/settings',['as'=>'accountsettings','uses'=>'AccountController@updatesettings']);
	Route::get('/account/mypolicies',['as'=>'accountmypolicies','uses'=>'AccountController@mypolicies']);
	Route::get('/account/myrfps',['as'=>'accountmyrfps','uses'=>'AccountController@myrfps']);
	Route::get('/account/ratedpolicies',['as'=>'accountratedpolicies','uses'=>'AccountController@ratedpolicies']);
	Route::get('/account/ratedrfps',['as'=>'accountratedrfps','uses'=>'AccountController@ratedrfps']);

	Route::post('/comment/policy/{pid}',['as'=>'commentpolicy','uses'=>'CommentsController@postpolicy']);
	Route::post('/comment/section/{sid}',['as'=>'commentsection','uses'=>'CommentsController@postsection']);
	Route::post('/comment/rfp/{rid}',['as'=>'commentrfp','uses'=>'CommentsController@postrfp']);

});