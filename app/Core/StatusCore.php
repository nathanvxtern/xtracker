<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class StatusCore
{

    public static function getProjstatusrowid( $projectId )
    {
        $projstatusrowid = null;

        $params = [
            $projectId
        ];
        $sql = "SELECT projstatusrowid
            FROM public.projmaster 
            WHERE projrowid = ?
        ";

        try {
            $projstatusrowid = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( is_null( $projstatusrowid ) ) {
            return null;
        }

        $projstatusrowid = ( $projstatusrowid[ 0 ] )->projstatusrowid;

        return $projstatusrowid;
    }

    public static function getStatus( $projectId )
    {
        $status = null;

        $projstatusrowid = StatusCore::getProjstatusrowid( $projectId );
        $params = [
            $projstatusrowid
        ];
        $sql = "SELECT projstatus
            FROM public.projstatus
            WHERE projstatusrowid = ?
        ";

        try {
            $status = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            return null;
        }

        if ( !sizeof( $status ) ) {
            return "";
        }

        $status = ( $status[ 0 ] )->projstatus;
        return $status;
    }

    public static function getProjectStatuses( $projectIds )
    {
        $projectStatuses = [];

        $statuses = StatusCore::getStatuses();       
        $indexedStatuses = [];
        $maxProjstatusrowid = StatusCore::getMaxProjstatusrowid(); 
        for ( $i = 0; $i <= $maxProjstatusrowid; $i++ ){
            $emptyStatus = [];
            $indexedStatuses[ $i ] = $emptyStatus;
        }
        foreach( $statuses as $status ){
            $indexedStatuses[ $status->projstatusrowid ] = $status;
        }

        $projstatusrowids = StatusCore::getProjstatusrowids( $projectIds );
        foreach( $projstatusrowids as $projstatusrowid ){
            $status = $indexedStatuses[ $projstatusrowid ];
            $projstatus = $status->projstatus;
            /* Test that this doesn't push them in the opposite order. */
            array_push( $projectStatuses, $projstatus );
        }
        
        return $projectStatuses;
    }

    public static function getStatuses()
    {
        $statuses = [];

        $sql = "SELECT projstatusrowid, projstatus
            FROM public.projstatus
        ";

        try {
            $statuses = \DB::select( $sql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $statuses ) ) {
            return [];
        }

        return $statuses;
    }

    public static function getProjstatusrowidRange()
    {
        $projstatusrowidRange = [];
        $minProjstatusrowid = null;
        $maxProjstatusrowid = null;

        $minProjstatusrowidSql = "SELECT MIN(public.projstatus.projstatusrowid)
            FROM public.projstatus
        ";
        $maxProjstatusrowidSql = "SELECT MAX(public.projstatus.projstatusrowid)
            FROM public.projstatus
        ";

        try {
            $minProjstatusrowid = \DB::select( $minProjstatusrowidSql );
            $maxProjstatusrowid = \DB::select( $maxProjstatusrowidSql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        $minProjstatusrowid = ( $minProjstatusrowid[ 0 ] )->min;
        $maxProjstatusrowid = ( $maxProjstatusrowid[ 0 ] )->max;
        array_push( $projstatusrowidRange, $minProjstatusrowid );
        array_push( $projstatusrowidRange, $maxProjstatusrowid );
        return $projstatusrowidRange;
    }

    public static function getMinProjstatusrowid()
    {
        $projstatusrowidRange = StatusCore::getProjstatusrowidRange();
        $minProjstatusrowid = $projstatusrowidRange[ 0 ];
        return $minProjstatusrowid;
    }

    public static function getMaxProjstatusrowid()
    {
        $projstatusrowidRange = StatusCore::getProjstatusrowidRange();
        $maxProjstatusrowid = $projstatusrowidRange[ 1 ];
        return $maxProjstatusrowid;
    }

    public static function getProjstatusrowids( $projectIds )
    {
        $projstatusrowids = [];

        $params = $projectIds;
        $in = join( ',', array_fill( 0, count( $params ), '?' ) );
        $projstatusrowidsSql = "SELECT projstatusrowid
            FROM public.projmaster 
            WHERE projrowid 
            IN ( $in )
        ";

        try {
            $projstatusrowids = \DB::select( $projstatusrowidsSql, $params );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $projstatusrowids ) ) {
            return [];
        }

        foreach( $projstatusrowids as $statusIndex => $status ) {
            $projstatusrowids[ $statusIndex ] = $status->projstatusrowid;
        }

        return $projstatusrowids;
    }
}