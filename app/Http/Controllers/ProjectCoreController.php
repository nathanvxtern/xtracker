<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ProjectCore;
use App\Core\TaskCore;
use App\Core\CustomerCore;

class ProjectCoreController extends APIController
{

    public function index()
    {
        $customers = CustomerCore::getCustomers();
        $projects = ProjectCore::getAllProjects( $customers );
        return view( 'welcome', [
            'customers' => $customers,
            'projects' => $projects
        ]);
    }

    public function projects( Request $request, $customers )
    {
        $projects = ProjectCore::getAllProjects( $customers );
        return $this->return_success( $request, $projects );
    }

    public function customer( Request $request, $title )
    {
        $customer = CustomerCore::getCustomerName( $title );
        return $this->return_success( $request, $customer );
    }

    public function gettasks( Request $request, $title )
    {
        $tasks = TaskCore::getProjectTasks( $title );
        return $this->return_success( $request, $tasks );
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
