<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class TaskCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_task_collection( $rs )
    {
        return array_map( [ $this, 'transform_task_rec' ], $rs );
    }

    public function transform_task_rec( $rec )
    {
        return [
            'taskrowid'=>$rec->taskrowid,
            'title'=>$rec->title,
            'createdate'=>$rec->createdate,
            'projrowid'=>$rec->projrowid,
            'projtyperowid'=>$rec->projtyperowid,
            'projstatusrowid'=>$rec->projstatusrowid,
            'esthours'=>$rec->esthours,
            'custponumber'=>$rec->custponumber,
            'reqcompdate'=>$rec->reqcompdate,
            'billingrate'=>$rec->billingrate,
        ];
    }

    /*
     *
     * Data Handlers.
     * 
     */

    public function list( $projrowid )
    {
        $params = [
            $projrowid,
        ];

        $sql = "SELECT T.taskrowid, T.title, T.createdate, T.projrowid, T.projtyperowid, T.projstatusrowid, T.esthours, T.custponumber, T.reqcompdate, T.billingrate
                FROM taskmaster T
                WHERE projrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_task_collection( $rs );
    }
    
}