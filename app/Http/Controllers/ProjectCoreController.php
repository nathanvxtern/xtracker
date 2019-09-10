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
        $customers = CustomerCore::getCustomers();
        $projects = ProjectCore::getAllProjects( $customers );
        $data = [ $customers, $projects ];
        dd( $data );
        Session::flash( 'data', $data );

        return view( 'welcome', [
            'projects' => $projects,
            'customers' => $customers,
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
        $data = $request->session()->get( 'data' );
        $customers = 
        Session::flash( 'data', $data );
        
        $project = $projects[ $id ];
        $tasks = $project->tasks;
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
