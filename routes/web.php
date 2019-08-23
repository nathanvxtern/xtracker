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

    /* 
     * Empty array to be filled with the titles of the projects.
     * This is being designed primarily to show connection to, and
     * understanding of the interaction with the database.
     */
    $titles = [];

    /*
     * Only one instance of ProjectCore is needed for this implementation
     * since an array of the titles is being made using a static method.
     */
    $p = new App\Core\ProjectCore();

    /*
     * For each of the projects with row ID in the following range:
     */
    for ( $id = 0; $id < 100; $id++ ) {

        /*
         * "Reset" the $title variable to null.
         */
        $title = null;
    
        /*
         * Populate the title variable if a project with the specified
         * row ID exists. If it does not exist, getTitle should return
         * null.
         */
        $title = $p->getTitle( $id );

        if ( !is_null( $title ) ) {
            /* If it existed, add the title to the array of titles. */
            array_push( $titles, $title );
        }
    }

    return view('welcome', [
        'titles' => $titles 
    ]);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
