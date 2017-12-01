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
Route::resource('questions','QuestionsController');
Route::resource('rfp','RFPsController');

Route::get('/comment/document/{id}',['as'=>'commentdocument','uses'=>'CommentsController@getdocument']);
Route::get('/comment/section/{id}',['as'=>'commentsection','uses'=>'CommentsController@getsection']);

Route::group(['middleware'=>['auth']],function(){

	Route::get('/rate/d/{id}/r/{rating}',['as'=>'ratepolicy','uses'=>'RatingsController@ratedocument']);
	Route::get('/rate/d/{id}/s/{sid}/r/{rating}',['as'=>'ratesection','uses'=>'RatingsController@ratesection']);

	Route::get('/account/settings',['as'=>'accountsettings','uses'=>'AccountController@settings']);
	Route::post('/account/settings',['as'=>'accountsettings','uses'=>'AccountController@updatesettings']);
	Route::get('/account/policies/mine',['as'=>'accountmypolicies','uses'=>'AccountController@mypolicies']);
	Route::get('/account/rfps/mine',['as'=>'accountmyrfps','uses'=>'AccountController@myrfps']);
	Route::get('/account/policies/rated',['as'=>'accountratedpolicies','uses'=>'AccountController@ratedpolicies']);
	Route::get('/account/rfps/rated',['as'=>'accountratedrfps','uses'=>'AccountController@ratedrfps']);

	Route::post('/comment/document/{id}',['as'=>'commentdocument','uses'=>'CommentsController@postdocument']);
	Route::post('/comment/section/{id}',['as'=>'commentsection','uses'=>'CommentsController@postsection']);

	Route::post('/add/question/section',['as'=>'addquestionsection','uses'=>'QuestionsController@addsection']);
	Route::post('/add/policy/section',['as'=>'addpolicysection','uses'=>'PoliciesController@addsection']);
	Route::post('/add/rfp/section',['as'=>'addrfpsection','uses'=>'RFPsController@addsection']);

});