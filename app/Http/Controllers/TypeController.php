<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\TypeCore;

class TypeController extends APIController
{

    public function list( Request $request )
    {
        $type_core = new TypeCore();

        $rec = array();

        $rec[ 'results' ][ 'types' ] = [];

        $rec[ 'results' ][ 'types' ] = $type_core->list( );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $pagevars );
    }

}