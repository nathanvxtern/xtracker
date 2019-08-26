<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectCoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        /* TEST ( databaseInterface ) start. */
        
        /* Creating empty array to test interface with database. */
        $testArray = [];

        /*
         * Generating random numbers to help display random projects
         * to avoid sifting through entire database of projects with
         * every run of testing. At time of authorship, five
         * (cryptographically insecure) random integers (between 10 and
         * 150 inclusive) were generated.
         */
        $randomNumber0 = rand( 10, 150 );
        $randomNumber1 = rand( 10, 150 );
        $randomNumber2 = rand( 10, 150 );
        $randomNumber3 = rand( 10, 150 );
        $randomNumber4 = rand( 10, 150 );

        /* Putting generated random numbers into array. */
        $randomNumberArray = [
            $randomNumber0,
            $randomNumber1,
            $randomNumber2,
            $randomNumber3,
            $randomNumber4
        ];

        /* Creating an (empty) array of random project names. */
        $randomProjectNames = [];

        /* Populating the array of project names. */
        foreach ( $randomNumberArray as $nunber ) {

            /* 
             * Creating an instance of ProjectCore in order to access
             * static methods.
             */
            $project = new ProjectCore;

            /*
             * Creating a variable "potentialTitle" to test whether or not
             * there is a project (with a title) associated with the
             * id number specified in this iteration of the foreach loop.
             */
            $potentialTitle = $project.getProjectTitle( $number );

            /*
             * Checking that there is a project associated with the
             * project id being used in this iteration of the foreach
             * loop. This is accomplished by setting a variable
             * "projectExists" to true, and then changing "projectExists"
             * to false if "potentialTitle" is null for the project
             * id being used in this iteration of the foreach loop.
             */
            $projectExists = true;
            if ( is_null( $potentialTitle ) ) {
                
                /* There is no project for the specified id. */
                $projectExists = false;

            }

            /* 
             * If there is a project for the specified id, assign it
             * to "title" and add the title to the array of project names.
             */
            if ( $projectExists ) {

                $title = $potentialTitle;

                array_push( $randomProjectNames, $title );

            }

        }

        dd( $randomProjectNames );

        /* TEST ( databaseInterface ) end. */

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
