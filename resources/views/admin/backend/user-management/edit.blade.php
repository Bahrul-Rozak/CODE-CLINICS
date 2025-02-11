@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Edit User Account</h2>
    <form action="{{ route('account-manager.update', $user_data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name', $user_data->name) }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Address" name="email" value="{{ old('email', $user_data->email) }}">
                </div>
                <div class="form-group">
                    <label for="password">Old Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Old Password" name="password">
                </div>
                <div class="form-group">
                    <label for="is_admin">Is Admin?</label>
                    <select class="form-control" id="is_admin" name="is_admin">
                        <option value="0" @if($user_data->is_admin == 0) selected @endif>No</option>
                        <option value="1" @if($user_data->is_admin == 1) selected @endif>Yes</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="is_super_admin">Is Super Admin?</label>
                    <select class="form-control" id="is_super_admin" name="is_super_admin">
                        <option value="0" @if($user_data->is_super_admin == 0) selected @endif>No</option>
                        <option value="1" @if($user_data->is_super_admin == 1) selected @endif>Yes</option>
                    </select>
                </div>
                <!-- Tombol Submit -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('account-manager.index') }}" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection