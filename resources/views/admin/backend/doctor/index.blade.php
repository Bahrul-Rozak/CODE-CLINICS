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
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Master Data Doctor</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('doctor.create') }}" class="btn btn-primary">Add Data</a>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Clinics</th>
                    <th>Phone Number</th>
                    <th>Schedule</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctor_data as $doctors )
                <tr>
                    <td>{{ $doctors->name }}</td>
                    <td>{{ $doctors->address }}</td>
                    <td>{{ $doctors->clinic->name }}</td>
                    <td>{{ $doctors->phone }}</td>
                    <td>{{ $doctors->practice_schedule }}</td>
                    <td>
                        <a href="{{ route('doctor.edit', $doctors->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('doctor.destroy', $doctors->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection