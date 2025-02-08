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
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Master Data Medication</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('medication.create') }}" class="btn btn-primary">Add Data</a>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">Medication Code</th>
                    <th style="width: 5%;">Stock</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 5%;">Dosage</th>
                    <th style="width: 10%; text-align:right;">Price</th>
                    <th style="width: 10%;">Created on</th>
                    <th style="width: 10%;">Expired on</th>
                    <th style="width: 10%;">Photo</th>
                    <th style="width: 25%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medication_data as $medications )
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $medications->medication_code }}</td>
                    <td>{{ $medications->stock }}</td>
                    <td>{{ $medications->name }}</td>
                    <td>{{ $medications->dosage }} mg</td>
                    <td style="text-align: right;">Rp. {{ $medications->price }}</td>
                    <td>{{ $medications->created_at->format('Y-m-d')}}</td>
                    <td>{{$medications->expiration_date}}</td>
                    <td>
                        <img src="{{ asset('uploads/medication' . $medications->photo) }}" alt="Medication Image">
                    </td>
                    <td>
                        <a href="{{ route('medication.edit', $medications->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('medication.edit_stock', $medications->id) }}" class="btn btn-warning">Change Stock</a>
                        <form action="{{ route('medication.destroy', $medications->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this medication?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection