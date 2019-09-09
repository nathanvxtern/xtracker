<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Core\ProjectCore;
use App\Core\TaskCore;
use App\Core\CustomerCore;
use App\Core\StatusCore;

class ProjectCoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectCore::getAllProjects();

        Session::flash( 'projects', $projects );

        return view( 'welcome', [
            'projects' => $projects,
            'projectCustomer' => "No Project Selected",
            'projectStatus' => "No Project Selected",
            'tasks' => []
        ]);
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
    public function show( Request $request, $id )
    {
        $projects = $request->session()->get( 'projects' );
        Session::flash( 'projects', $projects );
        
        $tasks = TaskCore::getProjectTasks( $id );
        $projectCustomer = CustomerCore::getCustomerName( $id );
        $projectStatus = StatusCore::getStatus( $id );

        return view( 'welcome', [
            'projects' => $projects,
            'projectCustomer' => $projectCustomer,
            'projectStatus' => $projectStatus,
            'tasks' => $tasks
        ]);
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
