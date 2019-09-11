<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Session;
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

        // $data = [ $customers, $projects ];
        // Session::flash( 'data', $data );

        return view( 'welcome', [
            'projects' => $projects,
            'customers' => $customers,
            'project' => null,
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
    public function show( /* Request $request, */ $id )
    {
        return response(null, Response::HTTP_OK);
        // $data = $request->session()->get( 'data' );    
        // Session::flash( 'data', $data );

        // $project = $data[ 1 ][ $id ];

        // return view( 'welcome', [
        //     'customers' => $data[ 0 ],
        //     'projects' => $data[ 1 ],
        //     'project' => $project,
        //     'tasks' => $project->tasks
        // ]);
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
