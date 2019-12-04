<?php

namespace App\Core;

use \Illuminate\Database\QueryException;

class UserCore
{

    /*
    *
    * Data Transform Functions
    *
    */

    public function transform_type_collection( $rs )
    {
        return array_map( [ $this, 'transform_type_rec' ], $rs );
    }

    public function transform_type_rec( $rec )
    {
        return [
            'id'=>$rec->id,
            'name'=>$rec->name,
            'email'=>$rec->email,
            'email_verified_at'=>$rec->email_verified_at,
            'password'=>$rec->password,
            'remember_token'=>$rec->remember_token,
            'created_at'=>$rec->created_at,
            'updated_at'=>$rec->updated_at,
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

        $sql = "SELECT
                    U.id,
                    U.name,
                    U.email,
                    U.email_verified_at,
                    U.password,
                    U.remember_token,
                    U.created_at,
                    U.updated_at,
                FROM users U";

        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        }

        return $this->transform_type_collection( $rs );
    }

    public function get( $id )
    {
        $params = [
            $id
        ];

        $sql = "SELECT
                    U.id,
                    U.name,
                    U.email,
                    U.email_verified_at,
                    U.password,
                    U.remember_token,
                    U.created_at,
                    U.updated_at
                FROM users U
                WHERE U.id = ?";
                
        try {
            $rs = \DB::select( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::error( $e->getMessage() );
            return [];
        } 

        return $this->transform_type_rec( $rs[ 0 ] );
    }
    
    public function create( $name = null, $email = null )
    {
        if ( is_null( $name ) || is_null( $email ) ) {
            return false;
        }

        $params = [
            $name,
            $email,
        ];

        $sql = "INSERT INTO projhours(name,email)
                VALUES( ? )";
        try {
            \DB::insert( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }

        return true;
    }

    public function update( $user_id, $update_list )
    {
        $params = array();
        $sql_params = array();

        foreach ( $update_list as $key => $value ) {
            array_push( $params, $value );
            array_push( $sql_params, $key . ' = ?' );
        }
        array_push( $params, $user_id );

        $sql = "UPDATE users";
        $sql .= " SET ";
        $sql .= implode( ',', $sql_params );
        $sql .= " WHERE user_id = ?";

        $recs = [];

        try {
            $recs = \DB::update( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            dump( $e );
        }

        if ( $recs == 0 ) {
            return false;
        }

        return true;
    }

    public function delete( $user_id = null )
    {
        $params = [
            $user_id
        ];
        $sql = "DELETE
                FROM users U
                WHERE U.user_id = ?";
        try {
            \DB::delete( $sql, $params );
        } catch ( \Illuminate\Database\QueryException $e ) {
            \Log::info( $e->getMessage() );
            return false;
        }
    }

}