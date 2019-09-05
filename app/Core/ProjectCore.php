<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{

    public static function getAllProjects()
    {

        $projects = [];

        $projectIds = [];
        for ( $i = 100; $i < 110; $i++ ) {
            array_push( $projectIds, $i );
        }

        foreach( $projectIds as $projectId ) {
            $project = new ProjectCore;
            $project->id = $projectId;
            $project->title = ProjectCore::getProjectTitle( $projectId );
            array_push( $projects, $project );
        }

        return $projects;

        /* Code above this line used for testing because code below this line is SLOW. */

        $projects = [];

        $projectIds = ProjectCore::getAllProjectIds();

        foreach( $projectIds as $projectId ) {
            $project = new ProjectCore;
            $project->id = $projectId;
            $project->title = ProjectCore::getProjectTitle( $projectId );
            array_push( $projects, $project );
        }

        return $projects;
    }

    public static function getProjectIdRange()
    {

        $projectIdRange = [];
        $minProjectId = null;
        $maxProjectId = null;

        $minProjectIdSql = "SELECT MIN(public.projmaster.projrowid)
            FROM public.projmaster
        ";
        $maxProjectIdSql = "SELECT MAX(public.projmaster.projrowid)
            FROM public.projmaster
        ";

        try {

            $minProjectId = \DB::select( $minProjectIdSql );
            $minProjectId = ( $minProjectId[ 0 ] )->min;

            $maxProjectId = \DB::select( $maxProjectIdSql );
            $maxProjectId = ( $maxProjectId[ 0 ] )->max;

        } catch ( QueryException $e ) {
            return null;
        }

        array_push( $projectIdRange, $minProjectId );
        array_push( $projectIdRange, $maxProjectId );

        return $projectIdRange;

    }

    public static function getAllProjectIds()
    {

        $projectIdList = [];
        $projectIdRange = null;
        $minProjectId = null;
        $maxProjectId = null;

        $projectIdRange = ProjectCore::getProjectIdRange();
        $minProjectId = $projectIdRange[ 0 ];
        $maxProjectId = $projectIdRange[ 1 ];
            
        for ( $i = $minProjectId; $i <= $maxProjectId; $i++ ) {
            array_push( $projectIdList, $i );
        }
        return $projectIdList;

    }
    
    public static function getProjectTitle( $projectId )
    {

        $title = null;

        $params = [
            $projectId
        ];

        $sql = "SELECT public.projmaster.title
            FROM public.projmaster 
            WHERE public.projmaster.projrowid = ?
        ";

        try {
            $title = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            return null;
        }

        if ( !sizeof( $title ) ) {
            return "";
        }

        $title = ( $title[ 0 ] )->title;
        return $title;
    }

}