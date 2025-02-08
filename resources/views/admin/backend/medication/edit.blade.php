@extends('admin.master')

@section('content')
<div class="container-fluid">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <h2>Edit Medication</h2>
    <div class="row">
        <!-- KIRI: FORM INPUT -->
        <div class="col-md-6">
            <form action="{{ route('medication.update', $medication_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="medication_code">Medication Code</label>
                    <input type="text" class="form-control" id="medication_code" placeholder="Enter medication_code" name="medication_code" value="{{old('medication_code', $medication_data->medication_code)}}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" placeholder="Enter stock" name="stock" value="{{ old('stock', $medication_data->stock) }}">
                </div>
                <div class="form-group">
                    <label for="type_id">Medication Type</label>
                    <select class="form-control" id="type_id" name="type_id">
                        @foreach ($medication_types as $medication)
                        <option value="{{ $medication->id }}"
                            @if ($medication_data->type_id == $medication->id) selected @endif>
                            {{ $medication->medication_type }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Medication Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name', $medication_data->name) }}">
                </div>
                <div class="form-group">
                    <label for="dosage">Dosage</label>
                    <input type="number" class="form-control" id="dosage" placeholder="Enter dosage" name="dosage" value="{{ old('dosage', $medication_data->dosage) }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control text-end" id="price" placeholder="Enter price" name="price" value="{{ old('price', $medication_data->price) }}">
                </div>
                <div class="form-group">
                    <label for="expiration_date">Expiration Date</label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $medication_data->expiration_date) }}">
                </div>

                <button type="submit" class="btn btn-success mt-3">Update</button>
                <a href="{{ route('medication.index') }}" class="btn btn-warning mt-3">Back</a>
            </form>
        </div>

        <!-- KANAN: PREVIEW GAMBAR -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="photo">Photo</label>
                <input class="form-control" type="file" id="image" name="photo">
            </div>
            <div class="form-group text-center mt-3">
                <img id="showImage" class="rounded img-thumbnail" src="{{ asset('uploads/medication'.$medication->photo) }}" alt="Preview Image" style="max-width: 100%; height: auto; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection