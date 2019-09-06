<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class CustomerCore
{

    public static function getCustomerNames( $projectIds )
    {
        $names = [];

        $customers = CustomerCore::getCustomers();       
        $indexedCustomers = [];
        $maxCustrowid = CustomerCore::getMaxCustrowid(); 
        for ( $i = 0; $i <= $maxCustrowid; $i++ ){
            $emptyCustomer = [];
            $indexedCustomers[ $i ] = $emptyCustomer;
        }
        foreach( $customers as $customer ){
            $indexedCustomers[ $customer->custrowid ] = $customer;
        }

        $custrowids = CustomerCore::getCustrowids( $projectIds );
        foreach( $custrowids as $custrowid ){
            $customer = $indexedCustomers[ $custrowid ];
            $name = $customer->name;
            array_push( $names, $name );
        }
        
        return $names;
    }

    public static function getCustrowidRange()
    {
        $custrowidRange = [];
        $minCustrowid = null;
        $maxCustrowid = null;

        $minCustrowidSql = "SELECT MIN(public.custmaster.custrowid)
            FROM public.custmaster
        ";
        $maxCustrowidSql = "SELECT MAX(public.custmaster.custrowid)
            FROM public.custmaster
        ";

        try {
            $minCustrowid = \DB::select( $minCustrowidSql );
            $maxCustrowid = \DB::select( $maxCustrowidSql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        $minCustrowid = ( $minCustrowid[ 0 ] )->min;
        $maxCustrowid = ( $maxCustrowid[ 0 ] )->max;
        array_push( $custrowidRange, $minCustrowid );
        array_push( $custrowidRange, $maxCustrowid );
        return $custrowidRange;
    }

    public static function getMinCustrowid()
    {
        $custrowidRange = CustomerCore::getCustrowidRange();
        $minCustrowid = $custrowidRange[ 0 ];
        return $minCustrowid;
    }

    public static function getMaxCustrowid()
    {
        $custrowidRange = CustomerCore::getCustrowidRange();
        $maxCustrowid = $custrowidRange[ 1 ];
        return $maxCustrowid;
    }

    public static function getCustomers()
    {
        $customers = [];

        $sql = "SELECT custrowid, name
            FROM public.custmaster
        ";

        try {
            $customers = \DB::select( $sql );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $customers ) ) {
            return [];
        }

        return $customers;
    }

    public static function getCustrowids( $projectIds )
    {
        $custrowids = [];

        $params = $projectIds;
        $in = join( ',', array_fill( 0, count( $params ), '?' ) );
        $custrowidsSql = "SELECT custrowid
            FROM public.projmaster 
            WHERE projrowid 
            IN ( $in )
        ";

        try {
            $custrowids = \DB::select( $custrowidsSql, $params );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $custrowids ) ) {
            return [];
        }

        foreach( $custrowids as $customerIndex => $customer ) {
            $custrowids[ $customerIndex ] = $customer->custrowid;
        }

        return $custrowids;
    }

}