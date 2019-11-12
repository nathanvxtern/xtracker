<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class UserCore
{

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
            'id'=>$rec->id,
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

        $sql = "SELECT U.id, U.name
                FROM users U";

        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        }

        return $this->transform_type_collection( $rs );
    }

    public function get( $id )
    {
        $params = [
            $id
        ];

        $sql = "SELECT U.id, U.name
                FROM users U
                WHERE U.id = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_type_collection( $rs );
    }

}