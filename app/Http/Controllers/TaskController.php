<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\HourCore;
use App\Core\ProjectCore;

class TaskController extends APIController
{

    public function list( Request $request, $projrowid )
    {
        $task_core = new TaskCore();
        $hour_core = new HourCore();
        $project_core = new ProjectCore();

        $rec = array();

        $rec[ 'results' ][ 'tasks' ] = [];

        $rec[ 'results' ][ 'tasks' ] = $task_core->list( $projrowid );

        foreach ( $rec[ 'results' ][ 'tasks' ] as $taskKey => $task ) {
            $rec[ 'results' ][ 'tasks' ][ $taskKey ][ 'hours' ] = [];
            $rec[ 'results' ][ 'tasks' ][ $taskKey ][ 'hours' ] = $hour_core->list( $task[ 'taskrowid' ] );
            $rec[ 'results' ][ 'tasks' ][ $taskKey ][ 'custrowid' ] = $project_core->get( $projrowid )[ 'custrowid' ];
        }

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function update(Request $request,$taskrowid)
    {

        $task_core = new TaskCore();

        $param_list = $request->all();

        $master_update_list = $task_core->fields_update_list();

        $update_list = array();

        $rec = false;

        foreach ($master_update_list as $value) {
            if( $request->input($value) == "%NULL%" ) {
                $update_list[ $value ] = null;
            } else if (isset($param_list[$value]) == true) {
                $param_value = $request->input($value);
                $update_list[$value] = $param_value;
            }
        }

        if(!empty($update_list)) {
            $rec = $task_core->update($taskrowid,$update_list);
        }

        if ($rec === -1 || $rec===false || $rec===null) {
            dump( "There was an error." );
        }

        return redirect( "/" );

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

        return redirect("/");
    }
}
