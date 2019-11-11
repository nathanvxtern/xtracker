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

    public function confirmdelete( $hoursid )
    {
        return view( "confirmations/deletions/hour", [ 'hoursid' => $hoursid ] );
    }

    public function delete( $hoursid )
    {
        $hour_core = new HourCore();
        $hour_core->delete($hoursid);
        return redirect("/");
    }

    public function createnew(Request $request)
    {

        $taskrowid = $request->input('taskrowid',null);
        $numhours = $request->input('numhours',null);
        $user_id = $request->input('user_id',null);
        $dateentered = $request->input('dateentered',null);
        $notes = $request->input('notes',null);
        $invoiceno = $request->input('invoiceno',null);

        $hour_core = new HourCore();
        $hour_id = $hour_core->create($taskrowid,$numhours,$notes,$dateentered,$user_id,$invoiceno);

        return redirect("/");
    }

    public function update( Request $request, $hoursid=null, $numhours=null, $user_id=null, $dateentered=null, $notes=null, $invoiceno=null )
    {
        $hour_core = new HourCore();

        $param_list = [ 'hoursid' => $hoursid,
                        'numhours' => $numhours,
                        'user_id' => $user_id,
                        'dateentered' => $dateentered,
                        'notes' => $notes,
                        'invoiceno' => $invoiceno
                    ];

        $master_update_list = $hour_core->fields_update_list();

        $update_list = array();

        $rec = false;

        foreach ($master_update_list as $value) {
            if (isset($param_list[$value]) == true) {
                $param_value = $param_list[$value];
                $update_list[$value] = $param_value;
            }
        }

        if(!empty($update_list)) {
            $rec = $hour_core->update($hoursid,$update_list);
        }

        if ($rec === -1 || $rec===false || $rec===null) {
            dump( "There was an error." );
        }

        return redirect( "/" );

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
