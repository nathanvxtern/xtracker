<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class HourCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_hour_collection( $rs )
    {
        return array_map( [ $this, 'transform_hour_rec' ], $rs );
    }

    public function transform_hour_rec( $rec )
    {
        return [
            'hoursid'=>$rec->hoursid,
            'custrowid'=>$rec->custrowid,
            'taskrowid'=>$rec->taskrowid,
            'notes'=>$rec->notes,
            'invoiceno'=>$rec->invoiceno,
            'numhours'=>$rec->numhours,
            'dateentered'=>$rec->dateentered,
            'user_id'=>$rec->user_id,
        ];
    }

    /*
     *
     * Data Handlers.
     * 
     */

    public function list( $taskrowid )
    {
        $params = [
            $taskrowid
        ];

        $sql = "SELECT H.hoursid, H.custrowid, H.taskrowid, H.notes, H.invoiceno, H.numhours, H.dateentered, H.user_id
                FROM projhours H
                WHERE H.taskrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_hour_collection( $rs );
    }

    public function get( $hoursid )
    {
        $params = [
            $hoursid
        ];

        $sql = "SELECT H.hoursid, H.custrowid, H.taskrowid, H.notes, H.invoiceno, H.numhours, H.dateentered, H.user_id
                FROM projhours H
                WHERE H.hoursid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_hour_collection( $rs );
    }

}