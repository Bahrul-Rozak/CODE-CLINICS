@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Edit Type</h2>
    <form action="{{ route('medication-types.update', $medication_type_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="medication_type">Type</label>
            <input type="text" class="form-control" id="medication_type" placeholder="Enter Type" name="medication_type"
            value="{{old('medication_type', $medication_type_data->medication_type)}}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('medication-types.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection