@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Doctor</h2>
    <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
        </div>
        <div class="form-group">
            <label for="clinics">Clinics</label>
            <select class="form-control" id="clinics" name="clinic_id">
                @foreach ($clinics as $clinic)
                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" placeholder="Active phone number" name="phone">
        </div>
        <div class="form-group">
            <label for="schedule_id">Practice Schedule</label>
            <select class="form-control" id="schedule_id" name="schedule_id">
            @foreach ($schedules as $schedule)
                <option value="{{ $schedule->id }}">{{ $schedule->practice_schedule }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('doctor.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection