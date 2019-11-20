<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;
use App\Core\CustomerCore;
use App\Core\StatusCore;
use App\Core\TypeCore;
use App\Core\TaskCore;
use App\Core\UserCore;
use App\Core\HourCore;

class ProjectController extends APIController
{

    public function list( Request $request, $selectedproject=0 )
    {

        $project_core = new ProjectCore();
        $customer_core = new CustomerCore();
        $status_core = new StatusCore();
        $type_core = new TypeCore();
        $task_core = new TaskCore();
        $user_core = new UserCore();
        $hour_core = new HourCore();

        $rec = array();

        $rec[ 'results' ][ 'projects' ] = [];
        $rec[ 'results' ][ 'customers' ] = [];
        $rec[ 'results' ][ 'statuses' ] = [];
        $rec[ 'results' ][ 'types' ] = [];
        $rec[ 'results' ][ 'users' ] = [];
        $rec[ 'results' ][ 'projected' ] = [];
        $rec[ 'results' ][ 'recenttasks' ] = [];

        $rec[ 'results' ][ 'projects' ] = $project_core->list();
        $rec[ 'results' ][ 'customers' ] = $customer_core->list();
        $rec[ 'results' ][ 'statuses' ] = $status_core->list();
        $rec[ 'results' ][ 'types' ] = $type_core->list();
        $rec[ 'results' ][ 'users' ] = $user_core->list();

        $rec[ 'results' ][ 'projected' ] = $selectedproject;

        $rec[ 'results' ][ 'recenttasks' ] = $task_core->recent();

        foreach ( $rec[ 'results' ][ 'recenttasks' ] as &$task ) {
            $task[ 'proj' ] = $project_core->get( $task[ 'projrowid' ] );
        }

        for ($i = 0; $i < 5; $i++) {
            $rec[ 'results' ][ 'recenttasks' ][ $i ][ 'hours' ] = [];
            $rec[ 'results' ][ 'recenttasks' ][ $i ][ 'hours' ] = $hour_core->list( $rec[ 'results' ][ 'recenttasks' ][ $i ][ 'taskrowid' ] );
        }

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
        if ( $selectedproject == 0 ) {
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
        }

        if ( !is_null( $ctofilter ) ) {
            return $this->return_success( $request, $pagevars );
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

    public function createnew(Request $request)
    {

        $title = $request->input('title',null);
        $custrowid = $request->input('custrowid',null);
        $projstatusrowid = $request->input('projstatusrowid',null);

        $project_core = new ProjectCore();
        $project_id = $project_core->create($custrowid,$title,$projstatusrowid);

        return redirect("/");
    }
}
