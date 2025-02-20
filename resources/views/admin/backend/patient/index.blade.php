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
                    <h3 class="card-title">Master Data Patient</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('patient.create') }}" class="btn btn-primary">Add Data</a>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Patient Code</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Birth Date</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Religion</th>
                    <th>Education</th>
                    <th>Occupation</th>
                    <th>NIK</th>
                    <th style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($patient_data as $patients)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $patients->patient_code }}</td>
                    <td>{{$patients->name}}</td>
                    <td>{{$patients->address}}</td>
                    <td>{{$patients->birth_date}}</td>
                    <td>{{$patients->gender}}</td>
                    <td>{{$patients->phone}}</td>
                    <td>{{$patients->religion}}</td>
                    <td>{{$patients->education}}</td>
                    <td>{{$patients->occupation}}</td>
                    <td>{{$patients->national_id}}</td>
                    <td>
                        <a href="{{ route('patient.edit', $patients->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('patient.destroy', $patients->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this clinic?')">Delete</button>
                        </form>
                        <a href="" class="btn btn-warning">View </a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection