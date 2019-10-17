<table class="table">
    <thead>
        <tr>
            <th scope="col">Customer</th>
            <th scope="col">cid</th>
            <th scope="col">Project</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data[ 'results' ][ 'projects' ] as $project )
            <tr>
                <td>{{ $project[ 'customer' ][ 'name' ] }}</td>
                <td>{{ $project[ 'customer' ][ 'custrowid' ] }}</td>
                <th scope="row">
                    <button type="button" class="btn btn-link font-weight-bold" @click="gettasks( '{{ $project[ 'projrowid' ] }}' );
                                                                                        getprojectcustomer( '{{ $project[ 'projrowid' ] }}' );
                                                                                        getprojectstatus( '{{ $project[ 'projrowid' ] }}' );
                                                                                        setprojrowid( '{{ $project[ 'projrowid' ] }}' );
                                                                                        populatetaskmodal( '{{ $project[ 'projrowid' ] }}' );">
                        {{ $project[ 'title' ] }}
                    </button>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>
