@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Clinic</h2>
    <form action="{{ route('clinic.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('clinic.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection