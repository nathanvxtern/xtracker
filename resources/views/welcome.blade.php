@include('modals.project')
@include('modals.tasks.add')
@include('modals.tasks.edit')
@include('modals.hours.add')
@include('modals.hours.edit')

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">Projects</div>
            <div class="col">Tasks</div>
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
                <tasks-header-component :customers="{{ json_encode( $customers ) }}"
                                        v-bind:currentproject="currentproject"
                                        v-bind:currentcustomer="currentcustomer">
                <tasks-header-component>
            </div>
        </div>
        <div class="row">
            <div class="col overflow-auto mb-3" style="max-height: 500;">
                @include( 'tables.projects', [ 'projects', $projects ] )
            </div>
            <div class="col overflow-auto mb-3" style="max-height: 500;">
                <tasks-component v-bind:currentprojecttasks="currentprojecttasks"></tasks-component>
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
