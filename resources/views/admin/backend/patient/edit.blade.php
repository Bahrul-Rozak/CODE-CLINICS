@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Edit Patient</h2>
    <form action="{{ route('patient.update', $patient_data->id) }} }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="patient_code">Patient Code</label>
                    <input type="text" class="form-control" id="patient_code" placeholder=" " name="patient_code" value="{{old('patient_code', $patient_data->patient_code)}}" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name', $patient_data->name)}}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{old('address', $patient_data->address)}}">
                </div>
                <div class="form-group">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{old('birth_date', $patient_data->birth_date)}}">
                </div>
                <div class="form-group">
                    <label for="national_id">National Id</label>
                    <input type="text" class="form-control" id="national_id" placeholder="National ID" name="national_id" value="{{old('national_id', $patient_data->national_id)}}">
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="gender" name="gender">
                            @foreach(['male', 'female'] as $gender)
                            <option value="{{ $gender }}" @if($patient_data->gender==$gender) selected @endif>{{$gender}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Active Phone Number" name="phone" value="{{old('phone', $patient_data->phone)}}">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <select class="form-control" id="religion" name="religion">
                        @foreach(['islam', 'kristen', 'hindu', 'budha', 'konghucu'] as $religion)
                        <option value="{{ $religion }}" @if($patient_data->religion==$religion) selected @endif>{{$religion}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="education">Education</label>
                    <select class="form-control" id="education" name="education">
                        @foreach(['sd', 'smp', 'sma', 'diploma', 'sarjana', 'magister', 'doktor'] as $education)
                        <option value="{{ $education }}" @if($patient_data->education==$education) selected @endif>{{$education}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="employment">Employment</label>
                    <select class="form-control" id="occupation" name="occupation">
                        @foreach(['employed', 'unemployed'] as $occupation)
                        <option value="{{ $occupation }}" @if($patient_data->occupation==$occupation) selected @endif>{{$occupation}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="complaint">Complaint</label>
                    <textarea class="form-control" id="complaint" rows="5" placeholder="What are you sick with, and how long have you been suffering?" name="complaint">{{ old('complaint', $medical_record->complaint) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="doctor">Doctor</label>
                    <select class="form-control" id="doctor" name="doctor_id" required>
                        <option disabled>Select doctor</option>
                        @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $doctor->id == $patient_data->doctor_id ? 'selected' : '' }}>
                            Dr. {{ $doctor->name }} - {{ $doctor->clinic->name }}
                        </option>
                        @endforeach
                    </select>


                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group text-center mt-3">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('patient.index') }}" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>





<hr>
<h3>Medical Record History</h3>

<!-- Tombol Tambah Rekam Medis -->
<a href="javascript:void(0)" class="btn btn-primary create-medical-btn" data-patient-id="{{ $patient_data->id }}" data-name="{{ $patient_data->name }}">
    Add
</a>

<table id="example" class="table table-striped table-bordered" width="100%;">
    <thead>
        <tr>
            <th>Date</th>
            <th>Complaint</th>
            <th>Service</th>
            <th>Diagnosis</th>
            <th>Notes</th>
            <th>Blood Type</th>
            <th>Height</th>
            <th>Waist</th>
            <th>Weight</th>
            <th>Treatment</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($medical_records as $record)
        <tr>
            <td>{{ $record->examination_date }}</td>
            <td>{{ $record->complaint }}</td>
            <td>{{ $record->service }}</td>
            <td>{{ $record->diagnosis }}</td>
            <td>{{ $record->notes }}</td>
            <td>{{ $record->blood_type }}</td>
            <td>{{ $record->height }} cm</td>
            <td>{{ $record->waist }} cm </td>
            <td>{{ $record->weight }} kg </td>
            <td>{{ $record->treatment }} </td>
            <td>
                <a href="{{ route('medical-record.edit', $record->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('medical-record.destroy', $record->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->

<div class="modal fade" id="createMedicalRecordModal" tabindex="-1" aria-labelledby="createMedicalRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMedicalRecordLabel">Create Medical Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createMedicalRecordForm" action="{{ route('patient.medical-record.store', $patient_data->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="patient_id" id="patient_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">Doctor</label>
                                <select class="form-control" name="doctor_id" required>
                                    @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">dr. {{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="patient_name" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Examination Date</label>
                                <input type="date" class="form-control" name="examination_date" value="{{ now()->format('Y-m-d') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Complaint</label>
                                <textarea class="form-control" name="complaint" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <select name="service" id="service" class="form-control">
                                    @foreach(["BPJS", "Jamkesda", "KIS", "Jampersal", "Prudential", "AXA Mandiri", "Allianz", "Manulife", "AIA", "Sinarmas MSIG", "Sequis Life", "Jasa Raharja", "BRI Life", "Puskesmas", "RSUD"] as $service)
                                    <option value="{{ $service }}">{{ $service }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diagnosis</label>
                                <textarea class="form-control" name="diagnosis"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label">Blood Type</label>
                                <select class="form-control" name="blood_type">
                                    @foreach(["A", "B", "AB", "O"] as $blood)
                                    <option value="{{ $blood }}">{{ $blood }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Height (cm)</label>
                                <input type="number" class="form-control" name="height" min="1">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Waist (cm)</label>
                                <input type="number" class="form-control" name="waits" min="1">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control" name="weight" min="1">
                            </div>

                            <div class="form-group">
                                <label>Treatment</label>
                                <select class="form-control" name="treatment">
                                @foreach(["outpatient","inpatient"] as $treatment)
                                    <option value="{{ $treatment }}">{{ $treatment }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save Record</button>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.create-medical-btn').click(function() {
            let patientId = $(this).data('patient-id');
            let patientName = $(this).data('name');

            $('#patient_id').val(patientId);
            $('#patient_name').val(patientName);
            $('#createMedicalRecordModal').modal('show');
        });
    });
</script>

@endsection