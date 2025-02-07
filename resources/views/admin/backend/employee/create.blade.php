@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Employee</h2>
    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="employee_code">Employee Code</label>
            <input type="text" class="form-control" id="employee_code" placeholder="Enter Employee Code" name="employee_code">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Employee name" name="name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
        </div>
        <div class="form-group">
            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
                <select class="form-select" id="gender" name="gender">
                    <option selected>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" placeholder="Active phone number" name="phone">
        </div>
        <div class="form-group">
            <label for="religion" class="col-sm-2 col-form-label">Religion</label>
            <div class="col-sm-10">
                <select class="form-select" id="religion" name="religion">
                    <option selected>Select</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option>
                    <option value="konghucu">konghucu</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="position" class="col-sm-2 col-form-label">Position</label>
            <div class="col-sm-10">
                <select class="form-select" id="position" name="position">
                    <option selected>Select</option>
                    <option value="nurse">Nurse</option>
                    <option value="pharmacist">Pharmacist</option>
                    <option value="doctor">Doctor</option>
                    <option value="finance">Finance</option>
                    <option value="security">Security</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('doctor.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection