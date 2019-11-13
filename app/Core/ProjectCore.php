<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{

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
            'custrowid'=>$rec->custrowid,
            'projrowid'=>$rec->projrowid,
            'title'=>$rec->title,
            'status'=>$rec->projstatusrowid,
            'createdate'=>$rec->createdate,
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

        $sql = "SELECT P.custrowid, P.projrowid, P.title, P.projstatusrowid, P.createdate
                FROM projmaster P";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        $projects = $this->transform_project_collection( $rs );

        $customer_core = new CustomerCore();
        $customers = $customer_core->list();
        foreach( $projects as &$project ) {
            foreach( $customers as $customer ) {
                if ( $customer[ 'custrowid' ] == $project[ 'custrowid' ] ) {
                    $project[ 'customer' ] = $customer;
                }
            }
        }

        return $projects;
    }

    public function get( $projrowid )
    {
        $params = [ 
            $projrowid
        ];

        $sql = "SELECT P.custrowid, P.projrowid, P.title, P.projstatusrowid, P.createdate
                FROM projmaster P 
                WHERE projrowid = ?";

        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            return null;
        }

        if ( count( $rs ) == 0 ) {
            return null;
        }

        $project = $this->transform_project_rec( $rs[ 0 ] );

        $customer_core = new CustomerCore();
        $customers = $customer_core->list();
        foreach( $customers as $customer ) {
            if ( $customer[ 'custrowid' ] == $project[ 'custrowid' ] ) {
                $project[ 'customer' ] = $customer;
            }
        }

        $status_core = new StatusCore();
        $status = $status_core->get( $project[ 'status' ] );
        $project[ 'status' ] = $status[ 0 ][ 'projstatus' ];

        return $project;
    }

    public function getid( $title )
    {
        $params = [ 
            $title
        ];

        $sql = "SELECT P.projrowid
                FROM projmaster P 
                WHERE title = ?";

        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            return null;
        }
        
        $id = $rs[ 0 ];

        return $id;
    }

    public function create($custrowid=null,$title=null,$projstatusrowid=null)
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
        } catch (\Illuminate\Database\QueryException $e) {
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
}