<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends APIController
{

    public function type( Request $request, $projtyperowid )
    {
        $type_core = new TypeCore();

        $rec = array();

        $rec[ 'results' ][ 'type' ] = [];

        $rec[ 'results' ][ 'type' ] = $type_core->get( $projtyperowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

}