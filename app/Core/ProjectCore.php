<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{
    /*
     *
     * Update Fields
     *
     */

    function fields_update_list()
    {
        return [
            'title',
            'projrowid',
            'custrowid',
        ];
    }

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_project_collection( $rs )
    {
        return array_map( [ $this, 'transform_project_rec' ], $rs );
    }

    public function transform_project_rec( $rec )
    {
        return [
            'projrowid'=>$rec->projrowid,
            'title'=>$rec->title,
            'createdate'=>$rec->createdate,
            'custrowid'=>$rec->custrowid,
            'projtyperowid'=>$rec->projtyperowid,
            'projstatusrowid'=>$rec->projstatusrowid,
            'esthours'=>$rec->esthours,
            'custponumber'=>$rec->custponumber,
            'reqcompdate'=>$rec->reqcompdate
        ];
    }

    /*
     *
     * Data Handlers.
     * 
     */

    public function list( $custrowid )
    {
        $params = [
            $custrowid
        ];

        $sql = "SELECT P.projrowid, P.title, P.createdate, P.custrowid, P.projtyperowid, P.projstatusrowid, P.esthours, P.custponumber, P.reqcompdate
                FROM projmaster P
                WHERE P.custrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            return null;
        }

        $projects = $this->transform_project_collection( $rs );

        return $projects;
    }

    public function get( $projrowid )
    {
        $params = [ 
            $projrowid
        ];

        $sql = "SELECT
                    P.projrowid,
                    P.title,
                    P.createdate,
                    P.custrowid,
                    P.projtyperowid,
                    P.projstatusrowid,
                    P.esthours,
                    P.custponumber,
                    P.reqcompdate
                FROM projmaster P
                WHERE projrowid = ?";

        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            return null;
        }

        if (count($rs) == 0) {
            return null;
        }
        
        $project = $this->transform_project_rec( $rs[ 0 ] );

        return $project;
    }

    public function create( $custrowid=null, $title=null, $projstatusrowid=null )
    {

        $params = [
            $custrowid,
            $title,
            $projstatusrowid,
        ];
        $sql = "INSERT INTO projmaster(custrowid,title,projstatusrowid)
                VALUES(?,?,?)";
        try {
            \DB::insert($sql, $params);
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info($e->getMessage());
            return false;
        }
        $sql = "SELECT IDENT_CURRENT('projmaster') as id;";
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

    public function update( $projrowid, $update_list )
    {
        $params = array();
        $sql_params = array();

        foreach ( $update_list as $key => $value ) {
            array_push( $params, $value );
            array_push( $sql_params, $key . ' = ?' );
        }
        array_push( $params, $projrowid );

        $sql = "UPDATE projmaster";
        $sql .= " SET ";
        $sql .= implode( ',', $sql_params );
        $sql .= " WHERE projrowid = ?";

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
}