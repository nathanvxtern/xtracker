<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class TaskCore
{

    public static function getAllTasks( $projectId )
    {
        $tasks = [];

        $taskIds = TaskCore::getAllTaskIds( $projectId );
        $taskTitles = TaskCore::getAllTaskTitles( $taskIds );

        $taskIndex = 0;
        foreach( $taskIds as $taskId ) {
            $task = new TaskCore;
            $task->id = $taskId;
            $task->title = $taskTitles[ $taskIndex ];
            array_push( $tasks, $task );
            
            $taskIndex++;
            
        }

        return $tasks;
    }

    public static function getAllTaskIds( $projectId )
    {
        $taskIdArray = [];

        $params = [
            $projectId
        ];
        $tasksSql = "SELECT taskrowid
            FROM public.taskmaster
            WHERE projrowid = ?
        ";

        try {

            $tasks = \DB::select( $tasksSql, $params );
            
            foreach ( $tasks as $task ) {
                $task = $task->taskrowid;
                array_push( $taskIdArray, $task );
            }
            
        } catch ( QueryException $e ) {
            return null;
        }

        return $taskIdArray;
    }

    public static function getTaskTitle( $taskId )
    {
        $title = null;

        $params = [
            $taskId
        ];

        $sql = "SELECT title
            FROM public.taskmaster
            WHERE taskrowid = ?
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

    public static function getAllTaskTitles( $taskIds )
    {
        $titles = [];

        $params = $taskIds;
        $in = join( ',', array_fill( 0, count( $params ), '?' ) );
        $sql = "SELECT title
            FROM public.taskmaster 
            WHERE taskrowid 
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