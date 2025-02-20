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
                    <h3 class="card-title">Daily Patient Queue</h3>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Queue Number</th>
                    <th>Registration Time</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Complaint</th>
                    <th>Doctor</th>
                    <th>National ID (NIK)</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($queue_data as $queue)
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $queue->queue_number }}</td>
                    <td>{{ $queue->created_at }}</td>
                    <td>{{ $queue->patient->name }}</td> 
                    <td>{{ $queue->patient->birth_date }}</td> 
                    <td>{{ $queue->complaint }}</td>
                    <td>dr. {{ $queue->doctor->name }}</td> 
                    <td>{{ $queue->patient->national_id }}</td> 
                    <td>
                        <a href="#" class="btn btn-info">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection