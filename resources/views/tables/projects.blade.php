<table class="table">
    <thead>
        <tr>
            <th scope="col">Project</th>
            <th scope="col">Customer</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $projects as $project )
            <tr>
                <th scope="row">
                    <a href="#">
                        {{ $project->title }}
                    </a>
                </th>
                <td>{{ $project->customer }}</td>
                <td>{{ $project->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
