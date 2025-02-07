@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Edit Clinic</h2>
    <form action="{{ route('clinic.update', $clinic_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name', $clinic_data->name)}}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('clinic.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection