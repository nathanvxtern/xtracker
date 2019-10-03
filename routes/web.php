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

Route::get('/tasks/{projrowid}', 'TaskController@list');
Route::get('/customer/{projrowid}', 'ProjectController@get');
Route::get('/status/{projrowid}', 'ProjectController@get');

Route::resource( 'projects', 'ProjectController' );

Route::get( '/filter/{customer}/{popentofilter}/{pclosedtofilter}', 'ProjectController@list' );

