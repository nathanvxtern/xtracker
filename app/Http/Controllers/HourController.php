<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\HourCore;

class HourController extends APIController
{

    public function list( Request $request, $taskrowid )
    {
        $hour_core = new HourCore();

        $rec = array();

        $rec[ 'results' ][ 'hours' ] = [];

        $rec[ 'results' ][ 'hours' ] = $hour_core->list( $taskrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function createnew(Request $request)
    {

        $taskrowid = $request->input('taskrowid',null);
        $numhours = $request->input('numhours',null);

        $hour_core = new HourCore();
        $hour_id = $hour_core->create($taskrowid,$numhours);

        $varsToDump = [];
        array_push( $varsToDump, "something" );
        array_push( $varsToDump, "something else" );
        array_push( $varsToDump, $hour_id );
        dump( $varsToDump );

        return redirect("/");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
