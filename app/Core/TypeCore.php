<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class TypeCore
{
    /*
     *
     * Update Fields
     *
     */

    function fields_update_list()
    {
        return [
            'projtyperowid',
            'projtype',
            'projdesc',
            'multiplier',
            'rate',
        ];
    }

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_type_collection( $rs )
    {
        return array_map( [ $this, 'transform_type_rec' ], $rs );
    }

    public function transform_type_rec( $rec )
    {
        return [
            'projtyperowid'=>$rec->projtyperowid,
            'projtype'=>$rec->projtype,
            'projdesc'=>$rec->projdesc,
            'multiplier'=>$rec->multiplier,
            'rate'=>$rec->rate,
        ];
    }

    /*
     *
     * Data Handlers.
     * 
     */

    public function list()
    {
        $params = [];

        $sql = "SELECT T.projtyperowid, T.projtype, T.projdesc, T.multiplier, T.rate
                FROM projtypes T";

        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        }

        return $this->transform_type_collection( $rs );
    }

    public function get( $projtyperowid )
    {
        $params = [
            $projtyperowid
        ];

        $sql = "SELECT T.projtyperowid, T.projtype, T.projdesc, T.multiplier, T.rate
                FROM projtypes T
                WHERE T.projtyperowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_type_rec( $rs[ 0 ] );
    }

}