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

/* Route to originally load the page. */
Route::get('/', 'ProjectCoreController@index');

/* Route to accomodate redirects within app. */
Route::get('/projectCores', 'ProjectCoreController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource( 'projectCores', 'ProjectCoreController' );

Route::get('/{id}', 'ProjectCoreController@tasks');
