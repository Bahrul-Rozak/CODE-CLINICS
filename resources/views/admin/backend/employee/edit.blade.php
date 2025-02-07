@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Employee</h2>
    <form action="{{ route('employee.update', $employee_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_code">Employee Code</label>
            <input type="text" class="form-control" id="employee_code" placeholder="Enter Employee Code" name="employee_code" value="{{old('employee_code', $employee_data->employee_code)}}">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Employee name" name="name" value="{{old('name', $employee_data->name)}}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{old('address', $employee_data->address)}}">
        </div>
        <div class="form-group">
            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
                <select class="form-select" id="gender" name="gender">
                    @foreach(['male', 'female'] as $gender)
                    <option value="{{ $gender }}" @if($employee_data->gender==$gender) selected @endif>{{$gender}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" placeholder="Active phone number" name="phone" value="{{old('phone', $employee_data->phone)}}">
        </div>
        <div class="form-group">
            <label for="religion" class="col-sm-2 col-form-label">Religion</label>
            <div class="col-sm-10">
                <select class="form-select" id="religion" name="religion">
                    @foreach(['islam', 'kristen', 'hindu', 'budha', 'konghucu'] as $religion)
                    <option value="{{ $religion }}" @if($employee_data->religion==$religion) selected @endif>{{$religion}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="position" class="col-sm-2 col-form-label">Position</label>
            <div class="col-sm-10">
                <select class="form-select" id="position" name="position">
                    @foreach(['nurse', 'pharmacist', 'doctor', 'finance', 'security'] as $position)
                    <option value="{{ $position }}" @if($employee_data->position==$position) selected @endif>{{$position}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('employee.index') }}" class="btn btn-warning">Back</a>
    </form>
</div>
@endsection