<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class HourCore
{
    /*
     *
     * Update Fields
     *
     */

    function fields_update_list()
    {
        return [
            'hoursid',
            'custrowid',
            'taskrowid',
            'notes',
            'invoiceno',
            'numhours',
            'dateentered',
            'user_id',
        ];
    }

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

        return $this->transform_hour_rec( $rs[ 0 ] );
    }

    public function create($taskrowid=null,$numhours=null,$notes=null,$dateentered='0000-00-00',$user_id=null,$invoiceno=null,$custrowid=null)
    {

        $params = [
            $custrowid,
            $taskrowid,
            $notes,
            $invoiceno,
            $numhours,
            $dateentered,
            $user_id
        ];
        $sql = "INSERT INTO projhours(custrowid,taskrowid,notes,invoiceno,numhours,dateentered,user_id)
                VALUES(?,?,?,?,?,?,?)";
        try {
            \DB::insert($sql, $params);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e->getMessage());
            return false;
        }
        $sql = "SELECT IDENT_CURRENT('projhours') as id;";
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

    public function update($hoursid, $update_list)
    {
        $params = array();
        $sql_params = array();

        foreach ($update_list as $key => $value) {
            array_push($params, $value);
            array_push($sql_params, $key . ' = ?');
        }
        array_push($params, $hoursid);

        $sql = "UPDATE projhours";
        $sql .= " SET ";
        $sql .= implode(',', $sql_params);
        $sql .= " WHERE hoursid = ?";

        try {
            $recs = \DB::update($sql, $params);
        } catch (\Illuminate\Database\QueryException $e) {
            dump( $e );
            return false;
        }

        if ($recs == 0) {
            return false;
        }

        return true;
    }

    public function delete( $hoursid=null )
    {
        $params = [
            $hoursid
        ];
        $sql = "DELETE
                FROM projhours H
                WHERE H.hoursid = ?";
        try {
            \DB::delete($sql, $params);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info($e->getMessage());
            return false;
        }
    }

}