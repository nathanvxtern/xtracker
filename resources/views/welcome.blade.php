@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="table-responsive">

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
                            Customer:
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="customerFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Customer
                                </button>
                                <div class="dropdown-menu" aria-labelledby="customerFilter">
                                    <a class="dropdown-item" href="#">A Customer</a>
                                    <a class="dropdown-item" href="#">Another Customer</a>
                                    <a class="dropdown-item" href="#">Yet Another Customer</a>
                                </div>
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
                                <div class="form-group form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="archivedFilter">
                                    <label class="form-check-label" for="archivedFilter">Archived</label>
                                </div>
                            </div>
                            <a href="#" class="btn btn-primary">Filter</a>
                            <a href="#" class="btn btn-primary">Reset</a>
                        </td>

                        <td>
                            Project Customer:
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="projectCustomer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Current Customer
                                </button>
                                <div class="dropdown-menu" aria-labelledby="projectCustomer">
                                    <a class="dropdown-item" href="#">A Customer</a>
                                    <a class="dropdown-item" href="#">Another Customer</a>
                                    <a class="dropdown-item" href="#">Yet Another Customer</a>
                                </div>
                            </div>
                            Project Status:
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="projectStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Current Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="projectStatus">
                                    <a class="dropdown-item" href="#">Open</a>
                                    <a class="dropdown-item" href="#">Closed</a>
                                    <a class="dropdown-item" href="#">Archived</a>
                                </div>
                            </div>
                            <div>
                                Task Status:
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="taskStatus" id="openRadio" value="open">
                                    <label class="form-check-label" for="openRadio">Open</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="taskStatus" id="closedRadio" value="closed">
                                    <label class="form-check-label" for="closedRadio">Closed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="taskStatus" id="archivedRadio" value="archived">
                                    <label class="form-check-label" for="archivedRadio">Archived</label>
                                </div>
                            </div>
                            <a href="#" class="btn btn-primary">Update Project</a>
                        </td>

                    </tr>

                    <tr>

                        <td>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Project</th>
                                            <th scope="col">Client</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $projects as $project )
                                            <tr>
                                                <th scope="row">
                                                    <a href="#" class="btn btn-primary">
                                                        {{ $project->title }}
                                                    </a>
                                                </th>
                                                <td>Client</td>
                                                <td>Status</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                        </td>
                        <td>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Task</th>
                                        <th scope="col">Est. Hours</th>
                                        <th scope="col">Used Hours</th>
                                        <th scope="col">Rate/Hour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $tasks as $task )
                                        <tr>
                                            <th scope="row">
                                                <a href="#" class="btn btn-primary">
                                                    Task Title
                                                </a>
                                            </th>
                                            <td>Est Hours</td>
                                            <td>Used Hours</td>
                                            <td>Rate/Hour</td>
                                            <td>
                                                <a href="#" class="btn btn-primary">
                                                    Add Hours
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary">
                                                    Edit Hours
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary">
                                                    Delete Task
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        <td>

                    </tr>

                    <tr>
                        <td><a href="#" class="btn btn-primary">Add Project</a></td>
                        <td><a href="#" class="btn btn-primary">Add Task</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
