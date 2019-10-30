@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Are You Sure?</div>
                <div class="card-body">
                    Please Confirm Deletion
                    <a :href="'/delete/task/'+{{ $taskrowid }}" class="btn btn-primary">
                        Delete
                    </a>
                    <a href="/" class="btn btn-primary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
