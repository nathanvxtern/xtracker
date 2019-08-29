<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class ProjectCore
{

    public static function getProjectIdList()
    {

        $projectIdList = [];
        $minProjectId = null;
        $maxProjectId = null;

        $minProjectIdSql = "SELECT MIN(public.projmaster.projrowid)
            FROM public.projmaster 
        ";
        $maxProjectIdSql = "SELECT MAX(public.projmaster.projrowid)
            FROM public.projmaster
        ";

        try {

            $minId = \DB::select( $minProjectIdSql );
            $maxId = \DB::select( $maxProjectIdSql );

            

        } catch ( QueryException $e ) {
            return null;
        }

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

        if ( is_null( $title ) ) {
            return null;
        } else if ( !sizeof( $title ) ) {
            return "";
        }

        return ( $title[ 0 ] )->title;

    }

}