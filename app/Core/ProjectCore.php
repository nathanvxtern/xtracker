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

    /*
     *
     * Methods built prior to restructuring project to match XTERN style.
     * 
     */
    
    public static function getAllProjects( $customers, $minProjectId, $maxProjectId )
    {
        $projects = [];

        $projectIds = ProjectCore::getAllProjectIds( $minProjectId, $maxProjectId );
        $projectTitles = ProjectCore::getProjectTitles( $projectIds );
        $projectCustomers = CustomerCore::getCustomerNames( $projectIds, $customers );
        $projectStatuses = StatusCore::getProjectStatuses( $projectIds );

        for ( $i = $minProjectId; $i <= $maxProjectId; $i++ ) {

            $index = $i - $minProjectId;

            $project = new ProjectCore;
            $project->id = $projectIds[ $index ];
            $project->title = $projectTitles[ $index ];
            $project->customer = $projectCustomers[ $index ];
            $project->status = $projectStatuses[ $index ];
            $projects[] = $project;
        }

        return $projects;
    }

    public static function getFilteredProjects( $customers )
    {

    }
    
    public static function getMinProjectId()
    {
        $minProjectId = null;
        $minProjectIdSql = "SELECT MIN(public.projmaster.projrowid)
            FROM public.projmaster
        ";
        try {
            $minProjectId = \DB::select( $minProjectIdSql );
        } catch ( QueryException $e ) {
            dd( $e );
        }
        $minProjectId = ( $minProjectId[ 0 ] )->min;
        return $minProjectId;
    }

    public static function getMaxProjectId()
    {
        $maxProjectId = null;
        $maxProjectIdSql = "SELECT MAX(public.projmaster.projrowid)
            FROM public.projmaster
        ";
        try {
            $maxProjectId = \DB::select( $maxProjectIdSql );
        } catch ( QueryException $e ) {
            dd( $e );
        }
        $maxProjectId = ( $maxProjectId[ 0 ] )->max;
        return $maxProjectId;
    }

    private static function getAllProjectIds( $minProjectId, $maxProjectId )
    {
        $projectIdList = [];
            
        for ( $i = $minProjectId; $i <= $maxProjectId; $i++ ) {
            $projectIdList[] = $i;
        }

        return $projectIdList;
    }
    
    public static function getProjectTitle( $projectId )
    {
        $title = [];

        $params = [
            $projectId
        ];
        $sql = "SELECT title
            FROM public.projmaster 
            WHERE projrowid = ?
        ";

        try {
            $title = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            $title = [];
        }

        if ( !sizeof( $title ) ) {
            return "";
        }

        $title = ( $title[ 0 ] )->title;
        return $title;
    }

    private static function getProjectTitles( $projectIds )
    {
        $titles = [];

        $params = $projectIds;
        $in = join( ',', array_fill( 0, count( $params ), '?' ) );
        $sql = "SELECT title
            FROM public.projmaster 
            WHERE projrowid 
            IN ( $in )
        ";

        try {
            $titles = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $titles ) ) {
            return [];
        }

        foreach( $titles as $titleIndex => $title ) {
            $titles[ $titleIndex ] = $title->title;
        }

        return $titles;
    }

}