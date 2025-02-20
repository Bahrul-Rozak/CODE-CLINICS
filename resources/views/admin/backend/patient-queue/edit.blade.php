@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Edit Patient Queue</h2>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('patient-queue.update', $queue_data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="patient_id" value="{{ $queue_data->patient_id }}">
                <div class="form-group">
                    <label>Patient Code</label>
                    <input type="text" class="form-control" value="{{ $queue_data->patient->patient_code }}" readonly>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{ $queue_data->patient->name }}" readonly>
                </div>

                <div class="form-group">
                    <label>Birth Date</label>
                    <input type="text" class="form-control" value="{{ $queue_data->patient->birth_date }}" readonly>
                </div>

                <div class="form-group">
                    <label>Service</label>
                    <select name="service" id="service" class="form-control">
                        @foreach ($services as $service)
                        <option value="{{ $service }}" {{ $queue_data->service == $service ? 'selected' : '' }}>
                            {{ $service }}
                        </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label>Complaint</label>
                    <textarea class="form-control" name="complaint">{{ $queue_data->complaint }}</textarea>
                </div>

                <div class="form-group">
                    <label>Doctor</label>
                    <select class="form-control" id="doctor" name="doctor_id" required>
                        <option disabled>Select doctor</option>
                        @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $doctor->id == $queue_data->doctor_id ? 'selected' : '' }}>
                            Dr. {{ $doctor->name }} - {{ $doctor->clinic->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="Waiting" {{ $queue_data->status == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="In Progress" {{ $queue_data->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $queue_data->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('patient-queue.index') }}" class="btn btn-warning">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection