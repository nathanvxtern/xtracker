@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @include( 'partials.quickadd' )
            </div>
        </div>
        <div class="row">
            <div class="col">
                <select v-model="ctofilter" name="ctofilter" id="ctofilter" class="form-control" v-on:change="cfilter( ctofilter );">
                    <option selected>Customer</option>
                    <option v-for="customer in currentObject.customers" :key="customer.custrowid">@{{ customer.name }}</option>
                </select>
                <pfilter-component :ctofilter="ctofilter" :popentofilter="popentofilter" :pclosedtofilter="pclosedtofilter"><pfilter-component>
            </div>
            <div class="col">
                <select v-model="ptofilter" name="ptofilter" id="ptofilter" class="form-control" v-on:change="pfilter( ptofilter )">
                    <option selected>Project</option>
                    <option v-for="project in customerprojects" :key="project.projrowid">@{{ project.title }}</option>
                </select>
            </div>
        </div>
        <div class="row">
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
            <div class="col">
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
        }

    </script>
@endsection
