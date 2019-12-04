<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends APIController
{

    public function current( Request $request )
    {
        $rec = array();

        $rec[ 'results' ][ 'current' ] = [];

        $rec[ 'results' ][ 'current' ] = \Auth::user();

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;
        
        return $this->return_success( $request, $pagevars );
    }
    
    public function list()
    {
        $user_core = new UserCore();

        $rec = array();
        
        $rec[ 'results' ][ 'users' ] = [];

        $rec[ 'results' ][ 'users' ] = $user_core->list();

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return view( 'index', $pagevars );
    }

    public function get( Request $request, $user_id )
    {
        $user_core = new UserCore();

        $rec = array();

        $rec[ 'results' ][ 'user' ] = [];

        $rec[ 'results' ][ 'user' ] = $user_core->get( $user_id );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function update( Request $request, $user_id )
    {
        $user_core = new TaskCore();

        $param_list = $request->all();
        $master_update_list = $user_core->fields_update_list();
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
            $rec = $user_core->update( $user_id, $update_list );
        }

        if ( $rec === -1 || $rec === false || $rec === null ) {
            return $this->return_error( $request );
        }

        return $this->return_success( $request );
    }

    public function delete( Request $request, $user_id )
    {
        $user_core = new UserCore();

        $user_core->delete( $user_id );

        return $this->return_success( $request );
    }

    public function createnew( Request $request )
    {
        $user_core = new UserCore();

        $user_core->create();

        return $this->return_success( $request );
    }

}