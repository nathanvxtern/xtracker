@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                @include( 'partials.pfilter' )
                <pfilter-component :ctofilter="ctofilter" :popentofilter="popentofilter" :pclosedtofilter="pclosedtofilter"><pfilter-component>
            </div>
            <div class="col">
                <tasks-header-component :customers="currentObject.customers"
                                        :statuses="currentObject.statuses"
                                        v-bind:projrowid="projrowid"
                                        v-bind:customer="customer"
                                        v-bind:status="status">
                <tasks-header-component>
            </div>
        </div>
        <div class="row">
            <div class="col-4 overflow-auto mb-3 " style="height:500;">
                @include( 'tables.projects' )
            </div>
            <div class="col overflow-auto mb-3" style="height:500;">
                <tasks-component v-bind:tasks="tasks" :taskrowidadd="taskrowidadd" :projstatusrowid="projstatusrowid" :projtyperowid="projtyperowid"></tasks-component>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" data-customers="currentObject.customers" data-toggle="modal" data-target="#projectModal">
                Add Project
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">
                Add Task
                </button>
            </div>
        </div>

        @include('modals.project')
        <newproject-component :newprojectcustomer="newprojectcustomer"
                                :newprojectstatus="newprojectstatus"
                                :newprojectcustrowid="newprojectcustrowid"
                                :newprojstatusrowid="newprojstatusrowid">
        </newproject-component>
        @include('modals.tasks.add')
        <newtask-component :newtaskstatus="newtaskstatus"
                            :newtaskstatusrowid="newtaskstatusrowid"></newtask-component>
        @include('modals.tasks.edit')
        @include('modals.hours.add')
        @include('modals.hours.edit')

    </div>
@endsection

@section('pagescripts')
    <script>

        var currentObjectPHP = {!! json_encode( $data[ 'results' ] ) !!};

        var taskListToLoad = currentObjectPHP.projected;
        if ( taskListToLoad > 0 ) {
            console.log( taskListToLoad );
            // populatetaskcomponent( taskListToLoad );
        }

    </script>
@endsection
