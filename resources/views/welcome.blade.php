@include('modals.project')
@include('modals.tasks.add')
@include('modals.tasks.edit')
@include('modals.hours.add')
@include('modals.hours.edit')

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @include( 'partials.pfilter' )
                <pfilter-component :ctofilter="{{ json_encode( $ctofilter ) }}" v-bind:ctofilter="ctofilter"><pfilter-component>
            </div>
            <div class="col">
                <tasks-header-component :customers="{{ json_encode( $customers ) }}"
                                        :statuses="{{ json_encode( $statuses ) }}"
                                        v-bind:project="project"
                                        v-bind:customer="customer"
                                        v-bind:status="status">
                <tasks-header-component>
            </div>
        </div>
        <div class="row">
            <div class="col overflow-auto mb-3" style="max-height: 500;">
                @include( 'tables.projects', [ 'projects', $projects ] )
            </div>
            <div class="col overflow-auto mb-3" style="max-height: 500;">
                <tasks-component v-bind:tasks="tasks"></tasks-component>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal">
                Add Project
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">
                Add Task
                </button>
            </div>                    
        </div>
    </div>
@endsection
