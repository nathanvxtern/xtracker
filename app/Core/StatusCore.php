<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class StatusCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_status_collection( $rs )
    {
        return array_map( [ $this, 'transform_status_rec' ], $rs );
    }

    public function transform_status_rec( $rec )
    {
        return [
            'projstatusrowid'=>$rec->projstatusrowid,
            'projstatus'=>$rec->projstatus,
            'projstatusdesc'=>$rec->projstatusdesc,
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

        $sql = "SELECT S.projstatusrowid, S.projstatus, S.projstatusdesc
                FROM projstatus S";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_status_collection( $rs );
    }

    public function get( $projstatusrowid )
    {
        $params = [
            $projstatusrowid
        ];

        $sql = "SELECT S.projstatusrowid, S.projstatus, S.projstatusdesc
                FROM projstatus S
                WHERE S.projstatusrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_status_collection( $rs );
    }

}