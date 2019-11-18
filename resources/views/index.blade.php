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
                Customer
                <select v-model="ctofilter" name="ctofilter" id="ctofilter" class="form-control" v-on:change="cfilter( ctofilter );">
                    <option v-for="customer in currentobject.customers" :key="customer.custrowid">@{{ customer.name }}</option>
                </select>
                <pfilter-component :ctofilter="ctofilter" :popentofilter="popentofilter" :pclosedtofilter="pclosedtofilter"><pfilter-component>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customerModal">
                +
                </button>
            </div>
            <div class="col">
                Project
                <select v-model="ptofilter" name="ptofilter" id="ptofilter" class="form-control" v-on:change="pfilter( ptofilter );">
                    <option v-for="project in customerprojects" :key="project.projrowid" :label="project.title">@{{ project.projrowid }}</option>
                </select>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-customers="currentobject.customers" data-toggle="modal" data-target="#projectModal">
                +
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include( 'partials.tasks' )
            </div>
        </div>

        @include('modals.customer')
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

        var currentobjectPHP = {!! json_encode( $data[ 'results' ] ) !!};

        var taskListToLoad = currentobjectPHP.projected;
        if ( taskListToLoad > 0 ) {
            console.log( taskListToLoad );
        }

    </script>
@endsection
