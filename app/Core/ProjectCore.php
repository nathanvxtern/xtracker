<?php
/**
 * Maintains basic information about each project, and provides clients
 * with the ability to interact with the projects (viewing a list of
 * tasks associated with the project, adding a project, deleting a project,
 * viewing the list of projects, ect.)
 */

namespace App\Core;

use \Illuminate\Database\QueryException;

/*
 * 
 */
class ProjectCore
{

    /**
     * The purpose of this function is to provide a complete list of
     * the ID numbers of all of the projects that exist in the database.
     * @return projectIdList array of the integer values of the project
     * ID numbers.
     */
    public static function getProjectIdList()
    {

        $projectIdList = [];

        

    }

    /**
     * The purpose of this function is to return title of the project
     * associated with the projectId parameter. Returns null if there is
     * no project title associated with the provided parameter.
     * @param projectId the id associated with the project
     * @return title the title of the project associated with the id (or
     * null if there is no project associated with the parameter.)
     */
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