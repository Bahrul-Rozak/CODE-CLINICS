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

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Insert Previous Patient Name..." name="name">
                </div>
                <div class="form-group">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Search Data Patient...</button>
                </div>
            </div>

            <div class="col-md-6">
                <img src="https://img.freepik.com/free-vector/hand-drawn-national-doctor-s-day-illustration-with-medics-essentials_23-2149447532.jpg?t=st=1739776176~exp=1739779776~hmac=b2bbd00f9cdda3f80e226f0d2461513994ff72ec5dfca135473d51ff478e0ff5&w=1380" alt="Login Image" class="img-fluid">
            </div>

    </form>
</div>

<!-- modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
        <div class="modal-content shadow-lg rounded-3">

            <div class="modal-header">
                <h5 class="modal-title" id="patientModalLabel">⚠ Patient Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-striped w-100">
                    <tbody>
                        <tr>
                            <th>Patient Code</th>
                            <td id="patientCode"></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td id="patientName"></td>
                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td id="patientBirthDate"></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td id="patientAddress"></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td id="patientGender"></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td id="patientPhone"></td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td id="patientReligion"></td>
                        </tr>
                        <tr>
                            <th>Education</th>
                            <td id="patientEducation"></td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td id="patientOccupation"></td>
                        </tr>
                        <tr>
                            <th>National ID</th>
                            <td id="patientNationalId"></td>
                        </tr>
                        <tr>
                            <th>Complaint</th>
                            <td>
                                <form action="{{ route('patient-register.store') }}" method="post">
                                    @csrf
                                    <input type="text" name="patient_id" id="patient_id" value="{{ $patient->id ?? '' }}" hidden>
                                    <textarea name="complaint" id="complaint" class="w-100 form-control" rows="3"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Doctor</th>
                            <td>
                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                    <option value="" disabled selected>Select a doctor</option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        {{ $doctor->name }} - {{ $doctor->clinic->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Service</th>
                            <td>
                                <select name="service" id="service" class="form-control">
                                    <option value="BPJS">BPJS</option>
                                    <option value="Jamkesda">Jamkesda</option>
                                    <option value="KIS">KIS</option>
                                    <option value="Jampersal">Jampersal</option>
                                    <option value="Prudential">Prudential</option>
                                    <option value="AXA Mandiri">AXA Mandiri</option>
                                    <option value="Allianz">Allianz</option>
                                    <option value="Manulife">Manulife</option>
                                    <option value="AIA">AIA</option>
                                    <option value="Sinarmas MSIG">Sinarmas MSIG</option>
                                    <option value="Sequis Life">Sequis Life</option>
                                    <option value="Jasa Raharja">Jasa Raharja</option>
                                    <option value="BRI Life">BRI Life</option>
                                    <option value="Puskesmas">Puskesmas</option>
                                    <option value="RSUD">RSUD</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure to create this data?')">Submit</button>
                                </form>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery script -->
<script>
    // $(document).ready(function() {
    //     $('form').on('submit', function(e) {
    //         e.preventDefault();

    //         $.ajax({
    //             url: $(this).attr('action'),
    //             method: 'POST',
    //             data: $(this).serialize(),
    //             success: function(response) {
    //                 if (response.success) {

    //                     $('#patientCode').text(response.data.patient_code);
    //                     $('#patientName').text(response.data.name);
    //                     $('#patientBirthDate').text(response.data.birth_date);
    //                     $('#patientAddress').text(response.data.address);
    //                     $('#patientGender').text(response.data.gender);
    //                     $('#patientPhone').text(response.data.phone);
    //                     $('#patientReligion').text(response.data.religion);
    //                     $('#patientEducation').text(response.data.education);
    //                     $('#patientOccupation').text(response.data.occupation);
    //                     $('#patientNationalId').text(response.data.national_id);

    //                     $('#patientModal').modal('show');
    //                 } else {
    //                     alert(response.failed);
    //                 }
    //             }
    //         });
    //     });
    // });

    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        // Set data pasien ke modal
                        $('#patientId').val(response.data.patient_id); // Tambahin ini!

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

                        $('#patientModal').modal('show');
                    } else {
                        alert(response.failed);
                    }
                }
            });
        });

        // Tambahin event listener buat form complaint
        $('#complaintForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            console.log(formData); // Debug: Pastikan patient_id gak null

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert('Complaint added successfully! ✅');
                        $('#patientModal').modal('hide');
                        $('#complaint').val('');
                    } else {
                        alert('Failed to add complaint! ❌');
                    }
                }
            });
        });
    });
</script>


@endsection