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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/status/{projrowid}', 'ProjectController@get');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/* Customers */
Route::get('/customers', 'CustomerController@list');
Route::get('/customers/{custrowid}', 'CustomerController@get');
/* post /customers  -> CustomerController@create */
Route::post('/customers', 'CustomerController@createnew');
/* put /customers/{custrowid} -> " @update */
/* delete /customers/{custrowid} -> " @delete */

/* Projects */
Route::get('/customers/{custrowid}/projects', 'ProjectController@list');
Route::get('/customers/{custrowid}/projects/{projrowid}', 'ProjectController@get');
/* post /customers/{custrowid}/projects -> ProjectController$create */
Route::post('/projects', 'ProjectController@createnew');

/* Tasks */
/* get /customers/{custrowid}/projects/{projrowid}/tasks -> TaskController@list */
Route::get('customers/{custrowid}/projects/{projrowid}/tasks', 'TaskController@list');
/* get /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid} -> " @get */
/* post /customers/{custrowid}/projects/{projrowid}/tasks -> " @create */
Route::post('customers/{custrowid}/projects/{projrowid}/tasks', 'TaskController@createnew');
/* put /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid} -> " @update */
Route::put('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}', 'TaskController@update');
/* delete /customers/{custrowid}/projects/{projrowid}/tasks/taskrowid -> " @delete */
Route::get('/confirm/delete/task/{taskrowid}/{title}', 'TaskController@confirmdelete');
Route::get('/delete/task/{taskrowid}', 'TaskController@delete');

/* Hours */
Route::get('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours', 'HourController@list');
/* get /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid} -> " @get */
/* post /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours -> " @create */
Route::post('/hours', 'HourController@createnew');
/* put /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid} -> " @create */
Route::post('/hours/edit', 'HourController@update');
/* delete /customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid} -> " @delete */
Route::get('/confirm/delete/hour/{hoursid}', 'HourController@confirmdelete');
Route::get('/delete/hour/{hoursid}', 'HourController@delete');