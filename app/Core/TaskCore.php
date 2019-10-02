<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class TaskCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_task_collection( $rs )
    {
        return array_map( [ $this, 'transform_task_rec' ], $rs );
    }

    public function transform_task_rec( $rec )
    {
        return [
            'taskrowid'=>$rec->taskrowid,
            'title'=>$rec->title,
            'createdate'=>$rec->createdate,
            'projrowid'=>$rec->projrowid,
            'projtyperowid'=>$rec->projtyperowid,
            'projstatusrowid'=>$rec->projstatusrowid,
            'esthours'=>$rec->esthours,
            'custponumber'=>$rec->custponumber,
            'reqcompdate'=>$rec->reqcompdate,
            'billingrate'=>$rec->billingrate,
        ];
    }

    /*
     *
     * Data Handlers.
     * 
     */

    public function list( $projrowid )
    {
        $params = [
            $projrowid,
        ];

        $sql = "SELECT T.taskrowid, T.title, T.createdate, T.projrowid, T.projtyperowid, T.projstatusrowid, T.esthours, T.custponumber, T.reqcompdate, T.billingrate
                FROM taskmaster T
                WHERE projrowid = ?";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_task_collection( $rs );
    }

    /*
     *
     * Methods built prior to restructuring project to match XTERN style.
     * 
     */

    public static function getProjectTasks( $projectId )
    {
        $tasks = [];

        $taskIds = TaskCore::getAllTaskIds( $projectId );
        $taskTitles = TaskCore::getTaskTitles( $taskIds );

        $taskIndex = 0;
        foreach( $taskIds as $taskId ) {
            $task = new TaskCore;
            $task->id = $taskId;
            $task->title = $taskTitles[ $taskIndex ];
            $tasks[] = $task;
            
            $taskIndex++;
        }

        return $tasks;
    }

    public static function getTasksByProjectId( $projectIds )
    {
        $tasksByProjectId = [];

        $maxProjectId = ProjectCore::getMaxProjectId(); 
        for ( $i = 0; $i <= $maxProjectId; $i++ ){
            $emptyProject = [];
            $tasksByProjectId[] = $emptyProject;
        }

        $tasks = TaskCore::getAllTasks();

        foreach ( $tasks as  $task ) {
            $tasksByProjectId[ $task->projrowid ][] = $task;
        }

        return $tasksByProjectId;
    }

    private static function getAllTasks() 
    {
        $tasks = [];

        $sql = "SELECT projrowid, title
            FROM public.taskmaster
        ";

        try {
            $tasks = \DB::select( $sql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $tasks ) ) {
            return [];
        }

        return $tasks;
    }

    private static function getTaskrowidRange()
    {
        $taskrowidRange = [];
        $minTaskrowid = null;
        $maxTaskrowid = null;

        $minTaskrowidSql = "SELECT MIN(public.taskmaster.taskrowid)
            FROM public.taskmaster
        ";
        $maxTaskrowidSql = "SELECT MAX(public.taskmaster.taskrowid)
            FROM public.taskmaster
        ";

        try {
            $minTaskrowid = \DB::select( $minTaskrowidSql );
            $maxTaskrowid = \DB::select( $maxTaskrowidSql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        $minTaskrowid = ( $minTaskrowid[ 0 ] )->min;
        $maxTaskrowid = ( $maxTaskrowid[ 0 ] )->max;
        $taskrowidRange[] = $minTaskrowid;
        $taskrowidRange[] = $maxTaskrowid;
        return $taskrowidRange;
    }

    private static function getMinTaskrowid()
    {
        $taskrowidRange = TaskCore::getTaskrowidRange();
        $minTaskrowid = $taskrowidRange[ 0 ];
        return $minTaskrowid;
    }

    private static function getMaxTaskrowid()
    {
        $taskrowidRange = TaskCore::getTaskrowidRange();
        $maxTaskrowid = $taskrowidRange[ 1 ];
        return $maxTaskrowid;
    }

    private static function getAllTaskIds( $projectId )
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
                $taskIdArray[] = $task;
            }
            
        } catch ( QueryException $e ) {
            return null;
        }

        return $taskIdArray;
    }

    /*
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
    */

    private static function getTaskTitles( $taskIds )
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