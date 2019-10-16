<table class="table">
    <thead>
        <tr>
            <th scope="col">Customer</th>
            <th scope="col">cid</th>
            <th scope="col">Project</th>
            <th scope="col">pid</th>
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
                                                                                        populatetaskmodal('10','8');">
                        {{ $project[ 'title' ] }}
                    </button>
                </th>
                <td>{{ $project[ 'projrowid' ] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
