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

    public function createnew( Request $request )
    {
        $user_core = new UserCore();

        $user_core->create();

        return $this->return_success( $request );
    }

}