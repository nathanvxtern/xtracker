<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{

    public static function getAllProjects()
    {
        $projects = [];

        $projectIds = ProjectCore::getAllProjectIds();
        $projectTitles = ProjectCore::getAllProjectTitles( $projectIds );

        $minProjectId = ProjectCore::getMinProjectId();
        $maxProjectId = ProjectCore::getMaxProjectId();
        for ( $i = $minProjectId; $i <= $maxProjectId; $i++ ) {

            $index = $i - $minProjectId;

            $project = new ProjectCore;
            $project->id = $projectIds[ $index ];
            $project->title = $projectTitles[ $index ];
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
            $maxProjectId = \DB::select( $maxProjectIdSql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        $minProjectId = ( $minProjectId[ 0 ] )->min;
        $maxProjectId = ( $maxProjectId[ 0 ] )->max;
        array_push( $projectIdRange, $minProjectId );
        array_push( $projectIdRange, $maxProjectId );
        return $projectIdRange;
    }

    public static function getMinProjectId()
    {
        $projectIdRange = ProjectCore::getProjectIdRange();
        $minProjectId = $projectIdRange[ 0 ];
        return $minProjectId;
    }

    public static function getMaxProjectId()
    {
        $projectIdRange = ProjectCore::getProjectIdRange();
        $maxProjectId = $projectIdRange[ 1 ];
        return $maxProjectId;
    }

    public static function getAllProjectIds()
    {
        $projectIdList = [];
        $projectIdRange = null;
        $minProjectId = null;
        $maxProjectId = null;

        $minProjectId = ProjectCore::getMinProjectId();
        $maxProjectId = ProjectCore::getMaxProjectId();
            
        for ( $i = $minProjectId; $i <= $maxProjectId; $i++ ) {
            array_push( $projectIdList, $i );
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

    public static function getAllProjectTitles( $projectIds )
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