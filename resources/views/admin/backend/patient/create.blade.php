@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Patient</h2>
    <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Address" name="address">
                </div>
                <div class="form-group">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>
                <div class="form-group">
                    <label for="national_id">National Id</label>
                    <input type="text" class="form-control" id="national_id" placeholder="National ID" name="national_id">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option selected>Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Active Phone Number" name="phone">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <select class="form-control" id="religion" name="religion">
                        <option selected>Select Religion</option>
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen</option>
                        <option value="hindu">Hindu</option>
                        <option value="budha">Budha</option>
                        <option value="konghucu">Konghucu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="education">Education</label>
                    <select class="form-control" id="education" name="education">
                        <option selected>Select Education Level</option>
                        <option value="sd">SD</option>
                        <option value="smp">SMP</option>
                        <option value="sma">SMA</option>
                        <option value="diploma">Diploma</option>
                        <option value="sarjana">Sarjana (S1)</option>
                        <option value="magister">Magister (S2)</option>
                        <option value="doktor">Doktor (S3)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="employment">Employment</label>
                    <select class="form-control" id="employment" name="occupation">
                        <option selected></option>
                        <option value="employed">Employed</option>
                        <option value="unemployed">Unemployed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="complaint">Complaint</label>
                    <textarea class="form-control" id="complaint" rows="3" placeholder="What are you sick with, and how long have you been suffering?" name="complaint"></textarea>
                </div>
                <div class="form-group">
                    <label for="doctor">Doctor</label>
                    <select class="form-control" id="doctor" name="doctor">
                        <option selected>Select doctor</option>
                        <option value="doctor1">Doctor 1</option>
                        <option value="doctor2">Doctor 2</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group text-center mt-3">
            <button type="submit" class="btn btn-success">Add</button>
            <a href="{{ route('patient.index') }}" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>
@endsection