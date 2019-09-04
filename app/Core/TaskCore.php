<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class TaskCore
{

    public static function getAllTasks( $projectId )
    {
        $tasks = [];

        $taskIds = TaskCore::getAllTaskIds( $projectId );

        foreach( $taskIds as $taskId ) {
            $task = new TaskCore;
            $task->id = $taskId;
            $task->title = TaskCore::getTaskTitle( $taskId );
            array_push( $tasks, $task );
        }

        return $tasks;
    }

    public static function getAllTaskIds( $projectId )
    {

        $taskIdArray = [];

        $params = [
            $projectId
        ];

        $tasksSql = "SELECT public.taskmaster.taskrowid
            FROM public.taskmaster
            WHERE public.taskmaster.projrowid = ?
        ";

        try {

            $tasks = \DB::select( $tasksSql, $params );
            
            foreach ( $tasks as $task ) {

                array_push( $taskIdArray, $task->taskrowid );
                
            }

        } catch ( QueryException $e ) {
            return null;
        }

        return $taskIdArray;

    }

}