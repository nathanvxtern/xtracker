<table class="table">
    <thead>
        <tr>
            <th scope="col">Project</th>
            <th scope="col">Customer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data[ 'results' ][ 'projects' ] as $project )
            <tr>
                <th scope="row">
                    <button type="button" class="btn btn-link font-weight-bold" @click="gettasks( '{{ $project[ 'projrowid' ] }}' );
                                                                                        getprojectcustomer( '{{ $project[ 'projrowid' ] }}' );
                                                                                        getprojectstatus( '{{ $project[ 'projrowid' ] }}' );">
                        {{ $project[ 'title' ] }}
                    </button>
                </th>
                <td>{{ $project[ 'customer' ][ 'name' ] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
