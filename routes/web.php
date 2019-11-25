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

Route::get('/filter/Customer/true/true/taskcreated/{selectedproject}', 'ProjectController@list');
Route::get('/filter/{customer}/{popentofilter}/{pclosedtofilter}', 'ProjectController@list');
Route::get('/status/{projrowid}', 'ProjectController@get');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/* Customers */
/* get /customers/ -> " @list */
Route::get('/', 'CustomerController@list');
/* get /customers/{custrowid} -> CustomerController@get */
/* post /customers  -> CustomerController@create */
Route::post('/customers', 'CustomerController@createnew');
/* put /customers/{custrowid} -> " @update */
/* delete /customers/{custrowid} -> " @delete */

/* Projects */
/* get /customers/{custrowid}/projects -> ProjectController@list */
/* get /customers/{custrowid}/projects/{projrowid} -> ProjectController@get */
Route::get('/customer/{projrowid}', 'ProjectController@get');
/* post /customers/{custrowid}/projects -> ProjectController$create */
Route::post('/projects', 'ProjectController@createnew');

/* Tasks */
/* get /customers/{custrowid}/projects/{projrowid}/tasks -> TaskController@list */
/* get /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid} -> " @get */
Route::get('/tasks/{projrowid}', 'TaskController@list');
/* post /customers/{custrowid}/projects/{projrowid}/tasks -> " @create */
Route::post('/tasks', 'TaskController@createnew');
/* put /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid} -> " @update */
Route::patch('/task/edit/{taskrowid}', 'TaskController@update');
/* delete /customers/{custrowid}/projects/{projrowid}/tasks/taskrowid -> " @delete */
Route::get('/confirm/delete/task/{taskrowid}/{title}', 'TaskController@confirmdelete');
Route::get('/delete/task/{taskrowid}', 'TaskController@delete');

/* Hours */
/* get /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours -> HourController@list */
Route::get('/hours/{taskrowid}', 'HourController@list');
/* get /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid} -> " @get */
/* post /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours -> " @create */
Route::post('/hours', 'HourController@createnew');
/* put /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid} -> " @create */
Route::post('/hours/edit', 'HourController@update');
/* delete /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid} -> " @delete */
Route::get('/confirm/delete/hour/{hoursid}', 'HourController@confirmdelete');
Route::get('/delete/hour/{hoursid}', 'HourController@delete');