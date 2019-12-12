<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class CustomerCore
{
    /*
     *
     * Update Fields
     *
     */

    function fields_update_list()
    {
        return [
            'custrowid',
            'custid',
            'name',
            'billtoid',
        ];
    }

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
            'custid'=>$rec->custid,
            'name'=>$rec->name,
            'billtoid'=>$rec->billtoid
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

        $sql = "SELECT
                    C.custrowid,
                    C.custid,
                    C.name,
                    C.billtoid
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

        $sql = "SELECT 
                    C.custrowid,
                    C.custid,
                    C.name,
                    C.billtoid
                FROM custmaster C
                WHERE C.custrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_customer_rec( $rs[ 0 ] );
    }

    public function update( $custrowid, $update_list )
    {
        $params = array();
        $sql_params = array();

        foreach ( $update_list as $key => $value ) {
            array_push( $params, $value );
            array_push( $sql_params, $key . ' = ?' );
        }
        array_push( $params, $custrowid );

        $sql = "UPDATE custmaster";
        $sql .= " SET ";
        $sql .= implode( ',', $sql_params );
        $sql .= " WHERE custrowid = ?";

        $recs = [];

        try {
            $recs = \DB::update( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            dump( $e );
        }

        if ( $recs == 0 ) {
            return false;
        }

        return true;
    }

    public function create( $name = null )
    {
        if ( is_null( $name ) ) {
            return false;
        }

        $params = [
            $name,
        ];

        $sql = "INSERT INTO custmaster( name )
                VALUES( ? )";
        try {
            \DB::insert( $sql, $params );
        } catch (\Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }

        return true;
    }

    public function delete( $custrowid = null )
    {
        $params = [
            $custrowid
        ];
        $sql = "DELETE 
                FROM projhours H
                WHERE H.custrowid = ?";
        try {
            \DB::delete( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }
        $sql = "DELETE FROM taskmaster T
                USING (
                        SELECT P.*
                        FROM projmaster P
                          INNER JOIN custmaster C
                            ON P.custrowid = C.custrowid
                      ) J
                WHERE T.projrowid = J.projrowid
                  AND J.custrowid = ?";
        try {
            \DB::delete( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }
        $sql = "DELETE
                FROM projmaster P
                WHERE P.custrowid = ?";
        try {
            \DB::delete( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }
        $sql = "DELETE
                FROM custmaster C
                WHERE C.custrowid = ?";
        try {
            \DB::delete( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }
    }
}