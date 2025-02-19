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
                    <h3 class="card-title">Master Data Employee</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('employee.create') }}" class="btn btn-primary">Add Data</a>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employee Code</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Religion</th>
                    <th>Position</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employee_data as $employee)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$employee->employee_code}}</td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->address}}</td>
                    <td>{{$employee->gender}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->religion}}</td>
                    <td>{{$employee->position}}</td>
                    <td>
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection