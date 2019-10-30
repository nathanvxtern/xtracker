<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\TaskCore;

class TaskController extends APIController
{

    public function list( Request $request, $projrowid )
    {
        $task_core = new TaskCore();

        $rec = array();

        $rec[ 'results' ][ 'tasks' ] = [];

        $rec[ 'results' ][ 'tasks' ] = $task_core->list( $projrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function update(Request $request,$taskrowid){
    }

    public function delete()
    {
        return view("confirmations/deletions/task");
    }

    public function createnew(Request $request)
    {

        $taskname = $request->input('taskname',null);
        $projrowid = $request->input('projrowid',null);
        $billingrate = $request->input('billingrate',null);
        $projstatusrowid = $request->input('projstatusrowid',null);
        $projtyperowid = $request->input('projtyperowid',null);
        $custponumber = $request->input('custponumber', null);
        $estimated = $request->input('estimated', null);
        $reqcompdate = $request->input('reqcompdate', null);

        $task_core = new TaskCore();
        $task_id = $task_core->create($billingrate,$projstatusrowid,$projtyperowid,$estimated,$reqcompdate,$taskname,$custponumber,$projrowid);

        return redirect("/filter/Customer" . "/" . "true" . "/" . "true" . "/" . "taskcreated" . "/" . strval( $projrowid ) );
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
