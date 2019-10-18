
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
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
            <div class="col overflow-auto mb-3 " style="height:500;">
                <div class="row">
                    <div class="col">Customer</div>
                    <div class="col">cid</div>
                    <div class="col">Project</div>
                </div>

                @foreach ( $data[ 'results' ][ 'projects' ] as $project )
                    <div class="row">
                        <div class="col">{{ $project[ 'customer' ][ 'name' ] }}</div>
                        <div class="col">{{ $project[ 'customer' ][ 'custrowid' ] }}</div>
                        <div class="col">
                            <button type="button" class="btn btn-link font-weight-bold" @click="gettasks( '{{ $project[ 'projrowid' ] }}' );
                                                                                                getprojectcustomer( '{{ $project[ 'projrowid' ] }}' );
                                                                                                getprojectstatus( '{{ $project[ 'projrowid' ] }}' );
                                                                                                setprojrowid( '{{ $project[ 'projrowid' ] }}' );
                                                                                                populatetaskmodal( '{{ $project[ 'projrowid' ] }}' );">
                                {{ $project[ 'title' ] }}
                            </button>
                        </div>
                    </div>
                @endforeach

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
        @include('modals.tasks.add')
        @include('modals.tasks.edit')
        @include('modals.hours.add')
        @include('modals.hours.edit')

    </div>
@endsection

@section('pagescripts')
    <script>
        var currentObjectPHP = {!! json_encode( $data[ 'results' ] ) !!};
    </script>

@endsection
