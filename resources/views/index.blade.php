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
                    <option v-for="customer in currentobject.customers" :key="customer.custrowid" :label="customer.name">@{{ customer.custrowid }}</option>
                </select>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcustomerModal">
                +
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editcustomerModal">
                Edit
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#deletecustomerModal" @click="populate_delete_customer_modal( ctofilter )">
                Delete
                </button>
            </div>
            <div class="col">
                Project
                <select v-model="ptofilter" name="ptofilter" id="ptofilter" class="form-control" v-on:change="pfilter( ctofilter, ptofilter );">
                    <option v-for="project in customerprojects" :key="project.projrowid" :label="project.title">@{{ project.projrowid }}</option>
                </select>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal">
                +
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editprojectModal">
                Edit
                </button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#deleteprojectModal" @click="populate_delete_project_modal( ctofilter, ptofilter )">
                Delete
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include( 'partials.tasks' )
            </div>
        </div>

        @include('modals.customers.add')
        @include('modals.customers.edit')
        @include('modals.customers.delete')
        @include('modals.projects.add')
        @include('modals.projects.edit')
        @include('modals.projects.delete')
        @include('modals.tasks.add')
        @include('modals.tasks.edit')
        @include('modals.tasks.delete')
        @include('modals.hours.add')
        @include('modals.hours.edit')
        @include('modals.hours.delete')
        
    </div>
@endsection

@section('pagescripts')
    <script>

        var currentobjectPHP = {!! json_encode( $data[ 'results' ] ) !!};

    </script>
@endsection