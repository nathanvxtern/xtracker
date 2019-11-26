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

        $isCreated = $customer_core->create( $name );

        if( $isCreated ) {
            return $this->return_success( $request, true );
        } else {
            return $this->return_error( $request, "Customer not created. Please try again later." );
        }
    }

}