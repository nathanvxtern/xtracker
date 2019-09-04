<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;
use App\Core\TaskCore;

class ProjectCoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* Begin: small array of project ids for testing purposes. */
        $projectIdArray = [];
        // $projectIdRange = ProjectCore::getProjectIdRange();
        // $smallId = $projectIdRange[ 0 ];
        // $largeId = $projectIdRange[ 1 ];
        // for ( $i = 0; $i < 20; $i++ ){
        //     array_push( $projectIdArray, rand( $smallId, $largeId ) );
        // }
        for ( $i = 100; $i < 120; $i++ ){
            array_push( $projectIdArray, $i );
        }
        /* End: small array of project ids for testing purposes. */

        /*
         * Complete list of project ids,
         * but something is VERY SLOW. 
         */
        // $projectIdArray = [];
        // $projectIdArray = ProjectCore::getAllProjectIds();

        $projects = ProjectCore::getAllProjectsTEST();

        // $projectTitles = [];
        // foreach ( $projectIdArray as $projectId ) {

        //     $potentialTitle = ProjectCore::getProjectTitle( $projectId );

        //     $projectExists = true;
        //     if ( is_null( $potentialTitle ) ) {
        //         $projectExists = false;
        //     } 

        //     if ( $projectExists ) {
        //         $title = $potentialTitle;
        //         array_push( $projectTitles, $title );
        //     }
        // }

        return view( 'welcome', [
            'projects' => $projects,
            'tasks' => []
        ]);

        // if ( sizeof( $ ) ) {

        //     return view( 'welcome', [
        //         'titles' => $projectTitles
        //     ]);

        // } else {

        //     dd( "No database connection" );

        // }

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
