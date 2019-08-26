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
     * The purpose of this function is to return the associated project's
     * title.
     * @param projectId the id associated with the project
     * @return title the title of the project associated with the id
     */
    public static function getProjectTitle( $projectId )
    {

        /* Setting title to null. */
        $title = null;

        /*
         * At the time of authorship, an array titled "params" was used
         * to hold the single parameter "projectId."
         */
        $params = [
            $projectId
        ];

        $sql = "SELECT public.projmaster.esthours
            FROM public.projmaster 
            WHERE public.projmaster.projrowid = ?
        ";

        try {
            $title = DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            return null;
        }

        if ( is_null( $title ) ) {
            return null;
        }

        return $title;

    }

    // /* 
    //  * Default value for list of Tasks is set to an empty collection (in addition
    //  * to constructor setting the list of Tasks to an empty collection.) During
    //  * initial class development, an empty array was chosen as the default collection.
    //  */
    // private $taskList = [
        
    // ];

    // /* 
    //  * Default name for the project is set to "defaultName." 
    //  */
    // private $projectName = "defaultName";

    // /**
    //  * Basic constructor for Project.
    //  * @param projectName the name of the project
    //  */
    // public function __construct( $projectName )
    // {

    //     /* 
    //      * At time of construction, the list of Tasks for the project is an empty
    //      * collection. During initial class development, an empty array was used.
    //      */
    //     $this->taskList = [
            
    //     ];

    //     $this->projectName = $projectName;

    // }

    // /**
    //  * Basic getter for the name of the project.
    //  * @return projectName the name of the project
    //  */
    // public function getProjectName()
    // {

    //     return $this->projectName;

    // }

}