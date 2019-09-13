<table class="table">
    <thead>
        <tr>
            <th scope="col">Project</th>
            <th scope="col">Customer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $projects as $project )
            <tr>
                <th scope="row">
                    <button type="button" class="btn btn-link font-weight-bold" @click="getProjectTasks( '{{ $project->id }}' ); getProjectCustomer( '{{ $project->id }}' );">
                        {{ $project->title }}
                    </button>
                </th>
                <td>{{ $project->customer }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
