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
            <h3 class="card-title">Edit Patient Diagnosis</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('medical-record.update', $medicalRecord->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom 1 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Patient Code</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->patient_code }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Complaint</label>
                            <textarea class="form-control" name="complaint">{{ $medicalRecord->complaint }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Doctor</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->doctor->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Birth Date</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->birth_date }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Diagnosis *</label>
                            <input type="text" class="form-control" name="diagnosis" value="{{ $medicalRecord->diagnosis }}" required>
                        </div>

                        <div class="form-group">
                            <label>Treatment</label>
                            <select class="form-control" name="treatment">
                                <option value="">Select...</option>
                                <option value="outpatient" {{ $medicalRecord->treatment == 'outpatient' ? 'selected' : '' }}>Out patient</option>
                                <option value="inpatient" {{ $medicalRecord->treatment == 'inpatient' ? 'selected' : '' }}>in patient</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Medication</label>
                            <select class="form-control" name="medication_id">
                                <option value="">Select medicine...</option>
                                @foreach($medications as $medicine)
                                <option value="{{ $medicine->id }}" {{ $medicalRecord->medication_id == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Medicine Amount</label>
                            <input type="number" class="form-control" name="medication_quantity" value="{{ $medicalRecord->medication_quantity }}">
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes">{{ $medicalRecord->notes }}</textarea>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label>Blood Type</label>
                            <select class="form-control" name="blood_type">
                                <option value="">Select...</option>
                                <option value="A" {{ $medicalRecord->blood_type == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $medicalRecord->blood_type == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ $medicalRecord->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ $medicalRecord->blood_type == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Height (cm)</label>
                            <input type="number" class="form-control" name="height" value="{{ $medicalRecord->height }}">
                        </div>

                        <div class="form-group">
                            <label>Waist (cm)</label>
                            <input type="number" class="form-control" name="waist" value="{{ $medicalRecord->waist }}">
                        </div>

                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input type="number" class="form-control" name="weight" value="{{ $medicalRecord->weight }}">
                        </div>

                        <div class="form-group">
                            <label>Service</label>
                            <select name="service" id="service" class="form-control">
                                @foreach(["BPJS", "Jamkesda", "KIS", "Jampersal", "Prudential", "AXA Mandiri", "Allianz", "Manulife", "AIA", "Sinarmas MSIG", "Sequis Life", "Jasa Raharja", "BRI Life", "Puskesmas", "RSUD"] as $service)
                                <option value="{{ $service }}" aria-readonly="true">{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>National ID</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->national_id }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->address }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->phone }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Education</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->education }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Occupation</label>
                            <input type="text" class="form-control" value="{{ $medicalRecord->patient->occupation }}" readonly>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('medical-record.index') }}" class="btn btn-warning">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection