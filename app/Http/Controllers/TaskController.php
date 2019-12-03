<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\TaskCore;

class TaskController extends APIController
{

    public function list( Request $request, $custrowid, $projrowid )
    {
        $task_core = new TaskCore();

        $rec = array();

        $rec[ 'results' ][ 'tasks' ] = [];

        $rec[ 'results' ][ 'tasks' ] = $task_core->list( $projrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function get( Request $request, $custrowid, $projrowid, $taskrowid )
    {
        $task_core = new TaskCore();

        $rec = array();

        $rec[ 'results' ][ 'task' ] = [];

        $rec[ 'results' ][ 'task' ] = $task_core->get( $taskrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function update( Request $request, $custrowid, $projrowid, $taskrowid )
    {
        $task_core = new TaskCore();

        $param_list = $request->all();
        $master_update_list = $task_core->fields_update_list();
        $update_list = array();
        $rec = false;
        foreach ( $master_update_list as $value ) {
            if( $request->input( $value ) == NULL_VALUE ) {
                $update_list[ $value ] = null;
            } else if ( isset( $param_list[ $value ] ) == true ) {
                $param_value = $request->input( $value );
                $update_list[ $value ] = $param_value;
            }
        }

        if( !empty( $update_list ) ) {
            $rec = $task_core->update( $taskrowid, $update_list );
        }

        if ( $rec === -1 || $rec === false || $rec === null ) {
            return $this->return_error( $request );
        }

        return $this->return_success( $request );
    }

    public function confirmdelete( $taskrowid, $title )
    {
        return view( "confirmations/deletions/task", [ 'taskrowid' => $taskrowid, 'title' => $title ] );
    }

    public function delete( Request $request, $custrowid, $projrowid, $taskrowid )
    {
        $task_core = new TaskCore();

        $task_core->delete( $taskrowid );

        return $this->return_success( $request );
    }

    public function createnew( Request $request, $custrowid, $projrowid )
    {
        $taskname = $request->input( 'taskname' , null );
        $billingrate = $request->input( 'billingrate' , null );
        $projstatusrowid = $request->input( 'projstatusrowid' , null );
        $projtyperowid = $request->input( 'projtyperowid' , null );
        $custponumber = $request->input( 'custponumber' , null );
        $estimated = $request->input( 'estimated' , null );
        $reqcompdate = $request->input( 'reqcompdate' , null );

        $task_core = new TaskCore();

        $task_core->create(
                            $billingrate,
                            $projstatusrowid,
                            $projtyperowid,
                            $estimated,
                            $reqcompdate,
                            $taskname,
                            $custponumber,
                            $projrowid 
        );

        return $this->return_success( $request );
    }
}
