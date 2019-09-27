<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Core\ProjectCore;
use App\Core\TaskCore;
use App\Core\CustomerCore;
use App\Core\StatusCore;

class ProjectCoreController extends APIController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = CustomerCore::getCustomers();
        $minProjectId = ProjectCore::getMinProjectId();
        $maxProjectId = ProjectCore::getMaxProjectId();
        $projects = ProjectCore::getAllProjects( $customers, $minProjectId, $maxProjectId );

        return view( 'welcome', [
            'projects' => $projects,
            'customers' => $customers,
            'project' => null,
        ]);
    }

    /**
     * List the tasks.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tasks( Request $request, $id )
    {
        $tasks = TaskCore::getProjectTasks( $id );
        return $this->return_success( $request, $tasks );
    }

    /**
     * List the tasks.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer( Request $request, $id )
    {
        $customer = CustomerCore::getCustomerName( $id );
        return $this->return_success( $request, $customer );
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
    public static function show( $id )
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
