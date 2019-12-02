<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;

class ProjectController extends APIController
{

    public function list( Request $request, $custrowid )
    {
        $project_core = new ProjectCore();

        $rec = array();

        $rec[ 'results' ][ 'projects' ] = [];

        $rec[ 'results' ][ 'projects' ] = $project_core->list( $custrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;
        
        return $this->return_success( $request, $pagevars );
    }

    public function get( Request $request, $custrowid, $projrowid )
    {
        $project_core = new ProjectCore();

        $rec = array();

        $rec[ 'results' ][ 'project' ] = [];

        $rec[ 'results' ][ 'project' ] = $project_core->get( $projrowid );

        $pagevars = array();
        $pagevars[ 'data' ] = array();
        $pagevars[ 'data' ] = $rec;

        return $this->return_success( $request, $pagevars );
    }

    public function createnew(Request $request)
    {
        $title = $request->input('title',null);
        $custrowid = $request->input('custrowid',null);
        $projstatusrowid = $request->input('projstatusrowid',null);

        $project_core = new ProjectCore();
        
        $project_core->create($custrowid,$title,$projstatusrowid);

        return $this->return_success( $request );
    }
}
