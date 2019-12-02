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

}