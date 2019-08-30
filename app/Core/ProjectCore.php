<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{

    public static function getProjectIdRange() {

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

        $projectIdRange = getProjectIdRange();
        $minProjectId = $projectIdRange[ 0 ];
        $maxProjectId = $projectIdRange[ 1 ];

        try {

            for ( $i = $minProjectId; $i <= $maxProjectId; $i++ ) {

                $projectId = null;

                $params = [
                    $i
                ];

                $projectIdSql = "SELECT 1
                    FROM public.projmaster
                    WHERE public.projmaster.projrowid = ?
                ";

                $projectId = \DB::select( $projectIdSql, $params );

                if ( sizeof( $projectId ) ) {
                    array_push( $projectIdList, $projectId );
                }

            }
        } catch ( QueryException $e ) {
            return null;
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

        return ( $title[ 0 ] )->title;

    }

}