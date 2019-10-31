<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\TaskCore;
use App\Core\HourCore;

class TaskController extends APIController
{

    public function list( Request $request, $projrowid )
    {
        $task_core = new TaskCore();
        $hour_core = new HourCore();

        $rec = array();

        $rec[ 'results' ][ 'tasks' ] = [];

        $rec[ 'results' ][ 'tasks' ] = $task_core->list( $projrowid );

        foreach ( $rec[ 'results' ][ 'tasks' ] as $taskKey => $task ) {
            $rec[ 'results' ][ 'tasks' ][ $taskKey ][ 'hours' ] = [];
            $rec[ 'results' ][ 'tasks' ][ $taskKey ][ 'hours' ] = $hour_core->list( $task[ 'taskrowid' ] );
        }

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function update(Request $request,$taskrowid)
    {
        \Log::info( $request->all() );
    }

    public function confirmdelete( $taskrowid, $title )
    {
        return view( "confirmations/deletions/task", [ 'taskrowid' => $taskrowid, 'title' => $title ] );
    }

    public function delete( $taskrowid )
    {
        $task_core = new TaskCore();
        $task_core->delete($taskrowid);
        return redirect("/");
    }

    public function createnew( Request $request )
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
}
