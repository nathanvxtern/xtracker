<table class="table">
    <thead>
        <tr>
            <th scope="col">Customer</th>
            <th scope="col" class="table-secondary">Project</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data[ 'results' ][ 'projects' ] as $project )
            <tr>
                <td>{{ $project[ 'customer' ][ 'name' ] }}</td>
                <th scope="row">
                    <button type="button" class="btn btn-link font-weight-bold" @click="populatetaskcomponent( '{{ $project[ 'projrowid' ] }}' );">
                        {{ $project[ 'title' ] }}
                    </button>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>
