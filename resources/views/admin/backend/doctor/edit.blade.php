@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Edit Doctor</h2>
    <form action="{{ route('doctor.update', $doctor_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name', $doctor_data->name)}}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{old('name', $doctor_data->address)}}">
        </div>
        <div class="form-group">
            <label for="clinics">Clinics</label>
            <select class="form-control" id="clinics" name="clinic_id">
                @foreach ($clinics as $clinic)
                <option value="{{ $clinic->id }}"
                    @if ($doctor_data->clinic_id == $clinic->id) selected @endif>
                    {{ $clinic->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" placeholder="Active phone number" name="phone" value="{{old('name', $doctor_data->phone)}}">
        </div>
        <div class="form-group">
            <label for="practice_schedule">Practice Schedule</label>
            <select class="form-control" id="schedule_id" name="schedule_id">
                @foreach ($schedules as $schedule)
                <option value="{{ $schedule->id }}"
                    @if ($doctor_data->schedule_id == $schedule->id) selected @endif>
                    {{ $schedule->practice_schedule }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('doctor.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection