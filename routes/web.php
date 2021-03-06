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

// Route::view('/#', 'index');
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/employees/current', 'UserController@current');
Route::get('/employees', 'UserController@list');
Route::get('/employees/{user_id}', 'UserController@get');
Route::post('/employees', 'UserController@createnew');
Route::put('/employees/{user_id}', 'UserController@update');
Route::delete('/employees/{user_id}', 'UserController@delete');

Route::get('/types', 'TypeController@list');

Route::get('/customers', 'CustomerController@list');
Route::get('/customers/{custrowid}', 'CustomerController@get');
Route::post('/customers', 'CustomerController@createnew');
Route::put('/customers/{custrowid}', 'CustomerController@update');
Route::delete('/customers/{custrowid}', 'CustomerController@delete');

Route::get('/customers/{custrowid}/projects', 'ProjectController@list');
Route::get('/customers/{custrowid}/projects/{projrowid}', 'ProjectController@get');
Route::post('/customers/{custrowid}/projects', 'ProjectController@createnew');
Route::put('/customers/{custrowid}/projects/{projrowid}', 'ProjectController@update' );
Route::delete('/customers/{custrowid}/projects/{projrowid}', 'ProjectController@delete');

Route::get('customers/{custrowid}/projects/{projrowid}/tasks', 'TaskController@list');
Route::get('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}', 'TaskController@get');
Route::post('customers/{custrowid}/projects/{projrowid}/tasks', 'TaskController@createnew');
Route::put('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}', 'TaskController@update');
Route::delete('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}', 'TaskController@delete');

Route::get('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours', 'HourController@list');
Route::get('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid}', 'HourController@get');
Route::post('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours', 'HourController@createnew');
Route::put('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid}', 'HourController@update');
Route::delete('/customers/{custrowid}/projects/{projrowid}/tasks/{taskrowid}/hours/{hoursid}', 'HourController@delete');