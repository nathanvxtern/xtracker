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
                Filter
            </div>
            <div class="col">
                Tasks Header
            </div>
        </div>
        <div class="row">
            <div class="col overflow-auto mb-3" style="max-height: 500;">
                @include( 'tables.projects' )
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

@section('pagescripts')

    <script>

        var currentObjectPHP = {!! json_encode( $data[ 'results' ] ) !!};

        {{--var myData = "{!!  json_encode($data) !!}";
            window.onload = function () {
                console.log(myData);
            }
        --}}

    </script>

@endsection
