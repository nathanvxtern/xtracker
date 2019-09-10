@include('modals.project')
@include('modals.tasks.add')
@include('modals.tasks.edit')
@include('modals.hours.add')
@include('modals.hours.edit')

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Projects</th>
                    <th scope="col">Tasks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>    
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
                    </td>
                    <td>
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
                    </td>
                </tr>
                <tr>
                    <td>
                        @include( 'tables.projects', [ 'projects', $projects ] )
                    </td>
                    <td>
                        <tasks></tasks>
                        <!-- @include( 'tables.tasks', [ 'tasks', $tasks ] ) -->
                    <td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal">
                        Add Project
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">
                        Add Task
                        </button>
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>

@endsection
