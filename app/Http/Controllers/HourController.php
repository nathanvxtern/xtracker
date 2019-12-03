<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\HourCore;

class HourController extends APIController
{

    public function list( Request $request, $custrowid, $projrowid, $taskrowid )
    {
        $hour_core = new HourCore();

        $rec = array();

        $rec[ 'results' ][ 'hours' ] = [];

        $rec[ 'results' ][ 'hours' ] = $hour_core->list( $taskrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function get( Request $request, $custrowid, $projrowid, $taskrowid, $hoursid )
    {
        $hour_core = new HourCore();

        $rec = array();

        $rec[ 'results' ][ 'hour' ] = [];

        $rec[ 'results' ][ 'hour' ] = $hour_core->get( $hoursid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function delete( Request $request, $custrowid, $projrowid, $taskrowid, $hoursid )
    {
        $hour_core = new HourCore();

        $hour_core->delete( $hoursid );

        return $this->return_success( $request );
    }

    public function createnew( Request $request, $custrowid, $projrowid, $taskrowid )
    {
        $user_id = $request->input( 'user_id', null );
        $numhours = $request->input( 'numhours', null );
        $dateentered = $request->input( 'dateentered', null );
        $notes = $request->input( 'notes', null );
        $invoiceno = $request->input( 'invoiceno', null );

        $hour_core = new HourCore();

        $hour_core->create(
                            $taskrowid,
                            $numhours,
                            $notes,
                            $dateentered,
                            $user_id,
                            $invoiceno,
                            $custrowid
        );

        $this->return_success( $request );
    }

    public function update( Request $request, $custrowid, $projrowid, $taskrowid, $hoursid )
    {
        $hour_core = new HourCore();

        $param_list = $request->all();
        $master_update_list = $hour_core->fields_update_list();
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
            $rec = $hour_core->update( $hoursid, $update_list );
        }

        if ($rec === -1 || $rec===false || $rec===null) {
            dump( "There was an error." );
        }

        return $this->return_success( $request );
    }
}
