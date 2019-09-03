<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Xtracker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Xtracker
                </div>

                <!-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> -->

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
                                        Company:
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

            </div>
        </div>
    </body>
</html>
