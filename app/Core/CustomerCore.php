<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class CustomerCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_customer_collection( $rs )
    {
        return array_map( [ $this, 'transform_customer_rec' ], $rs );
    }

    public function transform_customer_rec( $rec )
    {
        return [
            'custrowid'=>$rec->custrowid,
            'name'=>$rec->name,
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

        $sql = "SELECT C.custrowid, C.name
                FROM custmaster C";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_customer_collection( $rs );
    }

    public function get( $custrowid )
    {
        $params = [
            $custrowid
        ];

        $sql = "SELECT C.custrowid, C.name
                FROM custmaster C
                WHERE C.custrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_customer_collection( $rs );
    }

}