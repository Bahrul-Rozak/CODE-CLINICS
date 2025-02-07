@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Type</h2>
    <form action="{{ route('medication-types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="medication_type">Type</label>
            <input type="text" class="form-control" id="medication_type" placeholder="Enter Type" name="medication_type">
        </div>
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('medication-types.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection