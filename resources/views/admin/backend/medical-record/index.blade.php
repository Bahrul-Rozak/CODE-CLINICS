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
                    <h3 class="card-title">Medical Record</h3>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Queue Number</th>
                    <th>Diagnose</th>
                    <th>Patient Code</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Complaint</th>
                    <th>Doctor</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medical_data as $medicals)
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $medicals->queue_number }}</td>
                    <td>
                        <a href="{{ route('medical-record.edit',$medicals->id) }}" class="btn btn-primary">Diagnose</a>
                    </td>
                    <td>{{ $medicals->patient->patient_code }}</td>
                    <td>{{ $medicals->patient->name }}</td>
                    <td>{{ $medicals->patient->birth_date }}</td>
                    <td>{{ $medicals->complaint }}</td>
                    <td>dr. {{ $medicals->doctor->name }}</td>
                    <td>
                        @php
                        // Pastikan birth_date ada
                        if (isset($medicals->patient->birth_date) && !empty($medicals->patient->birth_date)) {
                        // Menggunakan DateTime untuk menghitung umur
                        $birthDate = new DateTime($medicals->patient->birth_date);
                        $currentDate = new DateTime(); // Tanggal saat ini

                        // Menghitung selisih antara tanggal lahir dan tanggal sekarang
                        $interval = $birthDate->diff($currentDate);

                        // Mendapatkan umur dalam tahun dan bulan
                        $years = $interval->y;
                        $months = $interval->m;

                        // Menampilkan umur dalam format: X tahun X bulan
                        $age = $years . ' age ' . $months . ' month';
                        } else {
                        $age = 'N/A'; // Jika tidak ada birth_date
                        }
                        @endphp

                        {{ $age }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection