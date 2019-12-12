<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\CustomerCore;

class CustomerController extends APIController
{

    public function list()
    {
        $customer_core = new CustomerCore();

        $rec = array();

        $rec[ 'results' ][ 'customers' ] = [];

        $rec[ 'results' ][ 'customers' ] = $customer_core->list();

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return view( 'index', $pagevars );
    }

    public function get( Request $request, $custrowid )
    {
        $customer_core = new CustomerCore();

        $rec = array();

        $rec[ 'results' ][ 'customer' ] = [];

        $rec[ 'results' ][ 'customer' ] = $customer_core->get( $custrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function createnew( Request $request )
    {
        $name = $request->input( 'name' , null );

        $customer_core = new CustomerCore();

        $customer_core->create( $name );

        return $this->return_success( $request );
    }

    public function delete( Request $request, $custrowid )
    {
        $customer_core = new CustomerCore();

        $customer_core->delete( $custrowid );

        return $this->return_success( $request );
    }


    public function update( Request $request, $custrowid )
    {
        $customer_core = new CustomerCore();

        $param_list = $request->all();
        $master_update_list = $customer_core->fields_update_list();
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
            $rec = $customer_core->update( $custrowid, $update_list );
        }

        if ( $rec === -1 || $rec === false || $rec === null ) {
            return $this->return_error( $request );
        }

        return $this->return_success( $request );
    }
}