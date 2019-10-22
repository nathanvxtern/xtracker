<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;
use App\Core\CustomerCore;
use App\Core\StatusCore;
use App\Core\TypeCore;

class ProjectController extends APIController
{

    public function list( Request $request )
    {

        $project_core = new ProjectCore();
        $customer_core = new CustomerCore();
        $status_core = new StatusCore();
        $type_core = new TypeCore();

        $rec = array();

        $rec[ 'results' ][ 'projects' ] = [];
        $rec[ 'results' ][ 'customers' ] = [];
        $rec[ 'results' ][ 'statuses' ] = [];
        $rec[ 'results' ][ 'types' ] = [];

        $rec[ 'results' ][ 'projects' ] = $project_core->list();
        $rec[ 'results' ][ 'customers' ] = $customer_core->list();
        $rec[ 'results' ][ 'statuses' ] = $status_core->list();
        $rec[ 'results' ][ 'types' ] = $type_core->list();

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        $ctofilter = null;
        $popentofilter = null;
        $pclosedtofilter = null;
        $popenid = null;
        $pclosedid = null;
        foreach ( $pagevars[ 'data' ][ 'results' ][ 'statuses' ] as $status ) {
            if ( $status[ 'projstatus' ] == "Closed" ) {
                $pclosedid = $status[ 'projstatusrowid' ];
            }
            if ( $status[ 'projstatus' ] == "Open" ) {
                $popenid = $status[ 'projstatusrowid' ];
            }
        }
        if ( !is_null( $request->segment( 2 ) ) ) {
            $ctofilter = $request->segment( 2 );
        }
        if ( !is_null( $request->segment( 3 ) ) ) {
            $popentofilter = $request->segment( 3 );
        }
        if ( !is_null( $request->segment( 4 ) ) ) {
            $pclosedtofilter = $request->segment( 4 );
        }
        foreach ( $pagevars[ 'data' ][ 'results' ][ 'projects' ] as $projectKey => &$project ) {
            if ( !is_null( $ctofilter ) && $ctofilter != "Customer" ) {
                if ( $project[ 'customer' ][ 'name' ] != $ctofilter ) {
                    unset( $pagevars[ 'data' ][ 'results' ][ 'projects' ][ $projectKey ] );
                    continue;
                }
            }
            if ( ( $popentofilter == "true" ) && ( $pclosedtofilter == "false" ) ) {
                if ( $project[ 'status' ] != $popenid ) {
                    unset( $pagevars[ 'data' ][ 'results' ][ 'projects' ][ $projectKey ] );
                    continue;
                }
            }
            if ( ( $pclosedtofilter == "true" ) && ( $popentofilter == "false" ) ) {
                if ( $project[ 'status' ] != $pclosedid ) {
                    unset( $pagevars[ 'data' ][ 'results' ][ 'projects' ][ $projectKey ] );
                    continue;
                }
            }
        }

        return view( 'index', $pagevars );
    }

    public function get( Request $request, $projrowid )
    {
        $project_core = new ProjectCore();

        $rec = array();

        $rec[ 'results' ][ 'project' ] = [];

        $rec[ 'results' ][ 'project' ] = $project_core->get( $projrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function createnew(Request $request){

        $title = $request->input('title',null);
        $custrowid = $request->input('custrowid',null);
        $projstatusrowid = $request->input('projstatusrowid',null);

        $project_core = new ProjectCore();
        $project_id = $project_core->create($custrowid,$title,$projstatusrowid);

        return redirect("/");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
