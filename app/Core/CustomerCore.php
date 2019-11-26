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

        $sql = "SELECT C.custrowid, C.custid, C.name, C.billtoid
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

        $sql = "SELECT C.custrowid, C.custid, C.name, C.billtoid
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

    public function create($name=null)
    {
        if ( is_null( $name ) ) {
            return false;
        }

        $params = [
            $name,
        ];
        $sql = "INSERT INTO custmaster(name)
                VALUES(?)";
        try {
            \DB::insert($sql, $params);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e->getMessage());
            return false;
        }
        $sql = "SELECT IDENT_CURRENT('custmaster') as id;";
        try {
            $res = \DB::select($sql);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e->getMessage());
            return false;
        }
        if(!empty($res)){
            return $res[0]->id;
        } else{
            return false;
        }
    }
}