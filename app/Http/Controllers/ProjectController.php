<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;

class ProjectController extends APIController
{

    public function list( Request $request, $custrowid )
    {
        $project_core = new ProjectCore();

        $rec = array();

        $rec[ 'results' ][ 'projects' ] = [];

        $rec[ 'results' ][ 'projects' ] = $project_core->list( $custrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;
        
        return $this->return_success( $request, $pagevars );
    }

    public function get( Request $request, $custrowid, $projrowid )
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

    public function update( Request $request, $custrowid, $projrowid )
    {
        $project_core = new ProjectCore();

        $param_list = $request->all();
        dump( $param_list );
        $master_update_list = $project_core->fields_update_list();
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
            $rec = $project_core->update( $projrowid, $update_list );
        }

        if ( $rec === -1 || $rec === false || $rec === null ) {
            return $this->return_error( $request );
        }

        return $this->return_success( $request );
    }

    public function createnew( Request $request, $custrowid )
    {
        $title = $request->input( 'title', null );
        $projstatusrowid = $request->input( 'projstatusrowid', null );

        $project_core = new ProjectCore();
        
        $project_core->create( $custrowid, $title, $projstatusrowid );

        return $this->return_success( $request );
    }
}
