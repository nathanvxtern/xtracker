<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class StatusCore
{
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
        $projstatusrowidRange = CustomerCore::getProjstatusrowidRange();
        $minProjstatusrowid = $projstatusrowidRange[ 0 ];
        return $minProjstatusrowid;
    }

    public static function getMaxProjstatusrowid()
    {
        $projstatusrowidRange = CustomerCore::getProjstatusrowidRange();
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