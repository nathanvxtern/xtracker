<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{

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