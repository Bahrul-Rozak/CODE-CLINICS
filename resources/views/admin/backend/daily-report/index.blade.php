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
                    <h3 class="card-title">Daily Report</h3>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Examination Date</th>
                    <th>Name</th>
                    <th>National ID</th>
                    <th>Birth Date</th>
                    <th>Patient Code</th>
                    <th>Blood Type</th>
                    <th>Diagnose</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>{{ $report->patient->name }}</td>
                    <td>{{ $report->patient->national_id ?? '-' }}</td>
                    <td>{{ $report->patient->birth_date }}</td>
                    <td>{{ $report->patient->patient_code }}</td>
                    <td>{{ $report->blood_type ?? '-' }}</td>
                    <td>{{ $report->diagnosis }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection