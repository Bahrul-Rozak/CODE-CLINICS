@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h2>Add New Account</h2>
    <form action="{{ route('account-manager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Address" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Address" name="password">
                </div>
                <div class="form-group">
                    <label for="is_admin">Is Admin?</label>
                    <select class="form-control" id="is_admin" name="is_admin">
                        <option selected>Select</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_super_admin">Is Super Admin?</label>
                    <select class="form-control" id="is_super_admin" name="is_super_admin">
                        <option selected>Select</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <!-- Tombol Submit -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Add</button>
                    <a href="{{ route('account-manager.index') }}" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>


    </form>
</div>
@endsection