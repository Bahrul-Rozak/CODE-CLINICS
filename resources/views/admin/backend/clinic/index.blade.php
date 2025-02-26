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
                    <h3 class="card-title">Master Data Clinic</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('clinic.create') }}" class="btn btn-primary">Add Data</a>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Name</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clinic_data as $clinics)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$clinics->name}}</td>
                    <td>
                        <a href="{{ route('clinic.edit', $clinics->id) }}" class="btn btn-info">Edit</a>

                        <!-- Form untuk Delete -->
                        <form action="{{ route('clinic.destroy', $clinics->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this clinic?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection