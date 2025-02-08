@extends('admin.master')

@section('content')
<div class="container-fluid">

    <h2>Edit Medication Stock</h2>
    <div class="row">
        <!-- KIRI: FORM INPUT -->
        <div class="col-md-6">
            <form action="{{ route('medication.add_stock', $medication_data->id) }}" method="POST">
                @csrf
                <input type="hidden" name="medication_id" value="{{ $medication_data->id }}">
                <div class="form-group">
                    <label for="stock">Total Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" readonly value="{{ old('stock', $medication_data->stock) }}">
                </div>
                <div class="form-group">
                    <label for="add_stock">Add New Stock</label>
                    <input type="number" class="form-control" id="add_stock" name="add_stock" placeholder="Enter stock" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Expiration Date Before</label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" readonly value="{{ old('expiration_date', $medication_data->expiration_date) }}">
                </div>
                <div class="form-group">
                    <label for="new_expiration_date">Add new Expiration Date</label>
                    <input type="date" class="form-control" id="new_expiration_date" name="expiration_date">
                </div>
                <button type="submit" class="btn btn-success mt-3">Add</button>
                <a href="{{ route('medication.index') }}" class="btn btn-warning mt-3">Back</a>
            </form>

        </div>

    </div>
</div>

@endsection