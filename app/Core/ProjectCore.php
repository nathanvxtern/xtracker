<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

/*
 * 
 */
class ProjectCore
{

    public static function getTitle( $id )
    {

        $params = [
            $id
        ];
        
        $sql = "SELECT title
            FROM projmaster 
            WHERE projrowid = ?
        ";

        try {
            $title = \DB::select( $sql, $params );
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