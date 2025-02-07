@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Schedule</h2>
    <form action="{{ route('schedule.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="practice_schedule">Practice Schedule</label>
            <input type="text" class="form-control" id="practice_schedule" placeholder="Enter Practice Schedule" name="practice_schedule">
        </div>
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('schedule.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection