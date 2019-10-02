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

Route::get('/', 'ProjectController@list');
Route::get('/index', 'ProjectController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource( 'projectCores', 'ProjectController' );

Route::get('/tasks/{projrowid}', 'TaskController@list');
Route::get('/customer/{id}', 'ProjectCoreController@customer');
Route::get('/status/{id}', 'ProjectCoreController@status');

Route::get( '/filter/{customer}', 'ProjectCoreController@filter' );
Route::get( '/cfilter/{ctofilter}', 'ProjectCoreController@cfilter' );

