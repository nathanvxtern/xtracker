<?php

/*
 * 
 */
class ProjectCore
{

    /* 
     * Default value for list of Tasks is set to an empty collection (in addition
     * to constructor setting the list of Tasks to an empty collection.) During
     * initial class development, an empty array was chosen as the default collection.
     */
    private $taskList = [
        
    ];

    /* 
     * Default name for the Project is set to "defaultName." 
     */
    private $projectName = "defaultName";

    function __construct( $projectName )
    {

        /* 
         * At time of construction, the list of Tasks for the project is an empty
         * collection. During initial class development, an empty array was used.
         */
        $this->taskList = [
            
        ];

        $this->projectName = $projectName;

    }

}