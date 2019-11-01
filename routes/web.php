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
Route::get('/filter/Customer/true/true/taskcreated/{selectedproject}', 'ProjectController@list');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tasks/{projrowid}', 'TaskController@list');
Route::get('/hours/{taskrowid}', 'HourController@list');
Route::get('/customer/{projrowid}', 'ProjectController@get');
Route::get('/status/{projrowid}', 'ProjectController@get');
Route::post('/projects', 'ProjectController@createnew');
Route::post('/tasks', 'TaskController@createnew');
Route::post('/hours', 'HourController@createnew');

Route::patch('/task/edit/{taskrowid}', 'TaskController@update');

Route::get('/filter/{customer}/{popentofilter}/{pclosedtofilter}', 'ProjectController@list');

Route::get('/confirm/delete/task/{taskrowid}/{title}', 'TaskController@confirmdelete');
Route::get('/delete/task/{taskrowid}', 'TaskController@delete');

Route::get('/confirm/delete/hour/{hoursid}', 'HourController@confirmdelete');
Route::get('/delete/hour/{hoursid}', 'HourController@delete');