<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\CustomerCore;

class CustomerController extends APIController
{

    public function customer( Request $request, $custrowid )
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

    public function createnew(Request $request)
    {
        $name = $request->input('customer',null);

        $customer_core = new CustomerCore();
        $custrowid = $customer_core->create($name);

        return redirect("/");
    }

}