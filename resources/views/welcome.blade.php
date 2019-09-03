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
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown button
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>

                        <td>
                            Customer:
                        </td>

                    <tr>

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
                                    @foreach ( $titles as $title )
                                        <tr>
                                            <th scope="row">
                                                <a href="#" class="btn btn-primary">
                                                    {{ $title }}
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
                                    @foreach ( $titles as $title )
                                        <tr>
                                            <th scope="row">
                                                <a href="#" class="btn btn-primary">
                                                    {{ $title }}
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
                </tbody>
            </table>
        </div>
    </div>

@endsection
