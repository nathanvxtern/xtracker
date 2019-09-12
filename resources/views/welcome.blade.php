@include('modals.project')
@include('modals.tasks.add')
@include('modals.tasks.edit')
@include('modals.hours.add')
@include('modals.hours.edit')

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">Projects</th>
            <div class="col">Tasks</th>
        </div>
        <div class="row">
            <div class="col">    
                <div>          
                    Customer:
                    <div class="d-inline dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="customerFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Customer
                        </button>
                        <div class="dropdown-menu" aria-labelledby="customerFilter">
                            @foreach( $customers as $customer )
                            <a class="dropdown-item" href="#">{{ $customer->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#" class="d-inline btn btn-primary">Filter</a>
                    <a href="#" class="d-inline btn btn-primary">Reset</a>
                </div>
                <div>
                    Project Status:
                    <div class="form-group form-check-inline">
                        <input type="checkbox" class="form-check-input" id="openFilter">
                        <label class="form-check-label" for="openFilter">Open</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input type="checkbox" class="form-check-input" id="closedFilter">
                        <label class="form-check-label" for="closedFilter">Closed</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div>
                    <div class="d-inline">
                        Customer:
                        <div class="d-inline dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="projectCustomer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ is_null( $project ) ? "No Project Selected" : $project->customer }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="projectCustomer">
                                @foreach( $customers as $customer )
                                <a class="dropdown-item" href="#">{{ $customer->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-inline">
                        Project Status:
                        <div class="d-inline dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="projectStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ is_null( $project ) ? "No Project Selected" : $project->status }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="projectStatus">
                                <a class="dropdown-item" href="#">Open</a>
                                <a class="dropdown-item" href="#">Closed</a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="d-inline btn btn-primary">Update Project</a>
                </div>
                <div>
                    Task Status:
                    <div class="form-group form-check-inline">
                        <input type="checkbox" class="form-check-input" id="openFilter">
                        <label class="form-check-label" for="openFilter">Open</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input type="checkbox" class="form-check-input" id="closedFilter">
                        <label class="form-check-label" for="closedFilter">Closed</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input type="checkbox" class="form-check-input" id="archivedFilter">
                        <label class="form-check-label" for="archivedFilter">Archived</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col overflow-auto" style="max-height: 500;">
                @include( 'tables.projects', [ 'projects', $projects ] )
            </div>
            <div class="col overflow-auto" style="max-height: 500;">
                <!-- <tasks-component v-bind:tasks="{{ json_encode( App\Http\Controllers\ProjectCoreController::show( $projectId ) ) }}"></tasks-component> -->
                <!-- <tasks-component v-bind:projectId="{{ $projectId }}"></tasks-component> -->
                <tasks-component v-bind:tasks="currentProjectTasks"></tasks-component>
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
