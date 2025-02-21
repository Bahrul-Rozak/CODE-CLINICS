@extends('admin.master')

@section('content')
<div class="container-fluid">
    @if(Session::has('message'))

    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Clear Database ☠☠</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                If you fire this action it will wipe your entire database
            </div>
            <form action="" class="mt-2">
                <button class="btn btn-danger" type="submit">Clear Database</button>
            </form>
        </div>

    </div>
</div>
@endsection