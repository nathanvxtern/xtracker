<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;

class ProjectCoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* Begin test. */
        $project = new ProjectCore();
        $projectIdRange = $project->getProjectIdRange();
        dd( $projectIdRange );
        /* End test. */

        $Number0 = rand( 10, 150 );
        $Number1 = rand( 10, 150 );
        $Number2 = rand( 10, 150 );
        $Number3 = rand( 10, 150 );
        $Number4 = rand( 10, 150 );

        // $NumberArray = [
        //     $Number0,
        //     $Number1,
        //     $Number2,
        //     $Number3,
        //     $Number4
        // ];

        $testNumberArray = [
            1000,
            100000,
            1,
            10,
            100,
            10000
        ];
        $NumberArray = $testNumberArray;

        $project = new ProjectCore();

        $projectIdArray = [];
        $projectIdArray = $project->getAllProjectIds();

        dd( $projectIdArray );

        $ProjectTitles = [];
        foreach ( $NumberArray as $number ) {

            $potentialTitle = $project->getProjectTitle( $number );

            $projectExists = true;
            if ( is_null( $potentialTitle ) ) {
                $projectExists = false;
            } 

            if ( $projectExists ) {
                $title = $potentialTitle;
                array_push( $ProjectTitles, $title );
            }
        }

        if ( sizeof( $ProjectTitles ) ) {

            return view( 'welcome', [
                'titles' => $ProjectTitles
            ]);

        } else {

            dd( "No database connection" );

        }

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
