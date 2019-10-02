<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class CustomerCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_customer_collection( $rs )
    {
        return array_map( [ $this, 'transform_customer_rec' ], $rs );
    }

    public function transform_customer_rec( $rec )
    {
        return [
            'custrowid'=>$rec->custrowid,
            'name'=>$rec->name,
        ];
    }

    /*
     *
     * Data Handlers.
     * 
     */

    public function list()
    {
        $params = [];

        $sql = "SELECT C.custrowid, C.name
                FROM custmaster C";
       
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_customer_collection( $rs );
    }

    /*
     *
     * Methods built prior to restructuring project to match XTERN style.
     * 
     */

    public static function getCustomerNames( $projectIds, $customers )
    {
        $names = [];
             
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
            /* Test that this doesn't push them in the opposite order. */
            $names[] = $name;
        }
        
        return $names;
    }

    public static function getCustomerName( $projectId )
    {
        $name = null;

        $custrowid = CustomerCore::getCustrowid( $projectId );
        $params = [
            $custrowid
        ];
        $sql = "SELECT name
            FROM public.custmaster
            WHERE custrowid = ?
        ";

        try {
            $name = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            return null;
        }

        if ( !sizeof( $name ) ) {
            return "";
        }

        $name = ( $name[ 0 ] )->name;
        return $name;
    }

    private static function getCustrowidRange()
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
        $custrowidRange[] = $minCustrowid;
        $custrowidRange[] = $maxCustrowid;
        return $custrowidRange;
    }

    private static function getMinCustrowid()
    {
        $custrowidRange = CustomerCore::getCustrowidRange();
        $minCustrowid = $custrowidRange[ 0 ];
        return $minCustrowid;
    }

    private static function getMaxCustrowid()
    {
        $custrowidRange = CustomerCore::getCustrowidRange();
        $maxCustrowid = $custrowidRange[ 1 ];
        return $maxCustrowid;
    }

    public static function getCustomer( $customerName )
    {
        $params = [
            $customerName
        ];

        $customer = [];

        $sql = "SELECT custrowid, name
            FROM public.custmaster
            WHERE name = ?
        ";

        try {
            $customer = \DB::select( $sql, $params );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( !sizeof( $customer ) ) {
            return [];
        }

        return $customer;
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

    private static function getCustrowids( $projectIds )
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

    private static function getCustrowid( $projectId )
    {
        $custrowid = null;

        $params = [
            $projectId
        ];
        $custrowidSql = "SELECT custrowid
            FROM public.projmaster 
            WHERE projrowid = ?
        ";

        try {
            $custrowid = \DB::select( $custrowidSql, $params );
        } catch ( QueryException $e ) {
            dd( $e );
        }

        if ( is_null( $custrowid ) ) {
            return null;
        }

        $custrowid = ( $custrowid[ 0 ] )->custrowid;

        return $custrowid;
    }

}