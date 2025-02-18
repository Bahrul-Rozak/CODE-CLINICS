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
                @foreach($queue_data as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->queue_number }}</td>
                    <td>{{ $record->created_at }}</td>
                    <td>{{ $record->patient->name ?? 'N/A' }}</td> <!-- Pastikan relasi 'patient' ada -->
                    <td>{{ $record->birth_date ?? 'N/A' }}</td> <!-- Pastikan kolom ini ada di model -->
                    <td>{{ $record->complaint }}</td>
                    <td>{{ $record->doctor->name ?? 'N/A' }}</td> <!-- Pastikan relasi 'doctor' ada -->
                    <td>{{ $record->national_id ?? 'N/A' }}</td> <!-- Pastikan kolom ini ada di model -->
                    <td>
                        <!-- Tambahkan tombol aksi di sini -->
                        <a href="{{ route('edit', $record->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('delete', $record->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection