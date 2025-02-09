@extends('admin.master')

@section('content')
<div class="container-fluid">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <h2>Daily Patient Register</h2>
    <a href="{{ route('patient.create') }}" class="btn btn-primary">Add New Data Patient Register</a>

    @if(Session::has('message'))

    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif
</div>

<div class="container-fluid mt-5">
    <h2>Search Previous Patient</h2>
    <form action="{{ route('patient-register.checkpreviouspatient') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Search Data Patient...</button>
                </div>
            </div>
    </form>
</div>



<!-- modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="patientModalLabel">Patient Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Patient Code:</strong> <span id="patientCode"></span></p>
                <p><strong>Name:</strong> <span id="patientName"></span></p>
                <p><strong>Birth Date:</strong> <span id="patientBirthDate"></span></p>
                <p><strong>Address:</strong> <span id="patientAddress"></span></p>
                <p><strong>Gender:</strong> <span id="patientGender"></span></p>
                <p><strong>Phone:</strong> <span id="patientPhone"></span></p>
                <p><strong>Religion:</strong> <span id="patientReligion"></span></p>
                <p><strong>Education:</strong> <span id="patientEducation"></span></p>
                <p><strong>Occupation:</strong> <span id="patientOccupation"></span></p>
                <p><strong>National ID:</strong> <span id="patientNationalId"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery script -->
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        // Isi data modal dengan data pasien
                        $('#patientCode').text(response.data.patient_code);
                        $('#patientName').text(response.data.name);
                        $('#patientBirthDate').text(response.data.birth_date);
                        $('#patientAddress').text(response.data.address);
                        $('#patientGender').text(response.data.gender);
                        $('#patientPhone').text(response.data.phone);
                        $('#patientReligion').text(response.data.religion);
                        $('#patientEducation').text(response.data.education);
                        $('#patientOccupation').text(response.data.occupation);
                        $('#patientNationalId').text(response.data.national_id);

                        // Tampilkan modal
                        $('#patientModal').modal('show');
                    } else {
                        alert(response.failed); // Jika data tidak ditemukan
                    }
                }
            });
        });
    });
</script>



@endsection