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
                    <textarea class="form-control" id="complaint" rows="5" placeholder="What are you sick with, and how long have you been suffering?" name="complaint"
                        value="{{old('complaint', $patient_data->complaint)}}"></textarea>
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
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('patient.index') }}" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>
@endsection