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
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $key => $report)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>{{ $report->patient->name }}</td>
                    <td>{{ $report->patient->national_id ?? '-' }}</td>
                    <td>{{ $report->patient->birth_date }}</td>
                    <td>{{ $report->patient->patient_code }}</td>
                    <td>{{ $report->patient->blood_type ?? '-' }}</td>
                    <td>{{ $report->diagnosis }}</td>
                    <td>
                        <a href="{{ route('daily-report.show', $report->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No Reports Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection