<div class="row">
    <div class="col">Customer</div>
    <div class="col">cid</div>
    <div class="col">Project</div>
</div>

@foreach ( $data[ 'results' ][ 'projects' ] as $project )
    <div class="row">
        <div class="col">{{ $project[ 'customer' ][ 'name' ] }}</div>
        <div class="col">{{ $project[ 'customer' ][ 'custrowid' ] }}</div>
        <div class="col">
            <button type="button" class="btn btn-link font-weight-bold" @click="gettasks( '{{ $project[ 'projrowid' ] }}' );
                                                                                getprojectcustomer( '{{ $project[ 'projrowid' ] }}' );
                                                                                getprojectstatus( '{{ $project[ 'projrowid' ] }}' );
                                                                                setprojrowid( '{{ $project[ 'projrowid' ] }}' );
                                                                                populatetaskmodal( '{{ $project[ 'projrowid' ] }}' );">
                {{ $project[ 'title' ] }}
            </button>
        </div>
    </div>
@endforeach