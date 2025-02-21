<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Pintar</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }

        .navbar {
            background-color: #1e3a8a;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #ffffff;
            transition: color 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #93c5fd;
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .btn-secondary {
            background-color: #6366f1;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #4f46e5;
        }

        .banner {
            background: linear-gradient(rgba(30, 58, 138, 0.7), rgba(30, 58, 138, 0.7)), url('https://source.unsplash.com/1600x900/?medical,hospital');
            background-size: cover;
            color: white;
            padding: 80px 0;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
        }

        .header-title {
            font-size: 2.5rem;
            font-weight: bold;
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            transition: 0.3s ease-in-out;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        .text-primary {
            color: #4f46e5 !important;
        }

        footer {
            background-color: #1e293b;
            color: #ffffff;
            padding: 20px 0;
            font-size: 14px;
        }
    </style>

</head>

<body>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <header class="container mt-5 pt-5 text-center">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start">
                <h1 class="header-title">Selamat <span class="text-primary">Datang!</span></h1>
                <p class="lead">Temukan Dokter, Buat Janji, Mudah.</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Coba Mendaftar!</button>
                <button class="btn btn-secondary">Lihat Antrian</button>
            </div>
            <div class="col-md-6">
                <img src="https://img.freepik.com/free-photo/front-view-young-smiling-doctor_179666-27135.jpg" alt="doctor" class="img-fluid rounded">
            </div>
        </div>
    </header>

    <section class="container text-center my-5 p-3">
        <h2 class="fw-bold">Kenapa Harus <span class="text-primary">Kami?</span></h2>
        <p class="lead">Tanpa antre panjang, tanpa drama, langsung terhubung dengan tenaga medis profesional.</p>
    </section>

    <section class="container my-5 text-center p-3">
        <h2 class="fw-bold">Cara Menggunakan Klinik Pintar</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-4 text-center shadow-sm">
                    <i class="fa fa-user-plus text-success display-4"></i>
                    <h5 class="mt-3">Daftar</h5>
                    <p>Buat akun dengan mudah dan cepat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 text-center shadow-sm">
                    <i class="fa fa-search text-primary display-4"></i>
                    <h5 class="mt-3">Temukan</h5>
                    <p>Cari dokter yang sesuai dengan kebutuhanmu.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 text-center shadow-sm">
                    <i class="fa fa-calendar-check text-warning display-4"></i>
                    <h5 class="mt-3">Buat Janji</h5>
                    <p>Tentukan waktu konsultasi dengan mudah.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="banner text-center">
        <h3 class="fw-bold">Temukan Dokter dengan Mudah, Tanpa Ribet!</h3>
        <img src="{{ asset('frontend/assets/images/logo-klinik-pintar.png') }}" alt="logo" width="200px">
    </section>

    <footer class="text-center">
        <p>Developed with 🧡 by Bahrul Rozak</p>
    </footer>



    <!-- Modal -->
    <!-- Modal -->
    <form action="{{ route('patient.signup') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Patient Registration Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" placeholder="Address" name="address">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="birth_date" class="col-sm-2 col-form-label">Birth Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="national_id" class="col-sm-2 col-form-label">National Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="national_id" placeholder="national_id" name="national_id">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="gender" name="gender">
                                        <option selected>Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" placeholder="Active Phone Number" name="phone">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="religion" name="religion">
                                        <option selected>Select Religion</option>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="education" class="col-sm-2 col-form-label">Education</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="education" name="education">
                                        <option selected>Select Education Level</option>
                                        <option value="sd">SD</option>
                                        <option value="smp">SMP</option>
                                        <option value="sma">SMA</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="sarjana">Sarjana (S1)</option>
                                        <option value="magister">Magister (S2)</option>
                                        <option value="doktor">Doktor (S3)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="employment" class="col-sm-2 col-form-label">Employment</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="occupation" name="occupation">
                                        <option selected>Select Employment Status</option>
                                        <option value="employed">Employed</option>
                                        <option value="unemployed">Unemployed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="complaint" class="col-sm-2 col-form-label">Complaint</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="complaint" rows="3" placeholder="What are you sick with, and how long have you been suffering?" name="complaint"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="doctor" class="col-sm-2 col-form-label">Doctor</label>
                                <div class="col-sm-10">
                                    <select name="doctor_id" id="doctor_id" class="form-control" required>
                                        <option value="" disabled selected>Select a doctor</option>
                                        @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">
                                            {{ $doctor->name }} - {{ $doctor->clinic->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="button" class="btn btn-secondary">Previous Patient?</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- End Modal -->

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Registration Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Queue Number:</strong> {{ session('queueNumber') }}</p>
                    <p><strong>Name:</strong> {{ session('nama') }}</p>
                    <p><strong>Registration Time:</strong> {{ session('timestamps') }}</p>
                    <p><strong>Estimated Arrival:</strong> {{ session('arrival_schedule') }}</p>
                    <p><strong>Examination Date:</strong> {{ session('examination_date') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/assets/js/bootstrap.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var queueNumber = @json(session('queueNumber'));
            if (queueNumber) {
                var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
            }
        });
    </script>


</body>

</html>