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
            'usedhrs'=>$rec->usedhrs,
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

        $sql = "SELECT T.taskrowid, T.title, T.createdate, T.projrowid, T.projtyperowid, T.projstatusrowid, T.esthours, T.custponumber, T.reqcompdate, T.billingrate, SUM(H.numhours) usedhrs
                FROM taskmaster T
                LEFT JOIN projhours H ON H.taskrowid = T.taskrowid 
                WHERE projrowid = ?
                GROUP BY T.taskrowid";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_task_collection( $rs );
    }

    public function create($billingrate=null,$projstatusrowid=null,$projtyperowid=null,$esthours=null,$reqcompdate=null,$taskname=null,$custponumber=null,$projrowid=null)
    {
        $params = [
            $billingrate,
            $projstatusrowid,
            $projtyperowid,
            $esthours,
            $reqcompdate,
            $taskname,
            $custponumber,
            $projrowid
        ];
        $sql = "INSERT INTO taskmaster(billingrate,projstatusrowid,projtyperowid,esthours,reqcompdate,title,custponumber,projrowid)
                VALUES(?,?,?,?,?,?,?,?)";
        try {
            \DB::insert($sql, $params);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e->getMessage());
            return false;
        }
        $sql = "SELECT IDENT_CURRENT('taskmaster') as id;";
        try {
            $res = \DB::select($sql);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e->getMessage());
            return false;
        }
        if(!empty($res)){
            return $res[0]->id;
        } else {
            return false;
        }
    }

    public function update($id, $update_list)
    {
    }
    
}