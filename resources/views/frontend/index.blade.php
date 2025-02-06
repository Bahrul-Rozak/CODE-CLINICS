<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Pintar</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
</head>

<body>

    <!-- Navbar start -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img src="{{ asset('frontend/assets/images/logo-klinik-pintar.png') }}" alt="logo-klinik-pintar" width="250px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="booking.html">Temukan dan Buat Janji</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <button class="btn button-secondary" type="submit">Masuk</button>
                    <button class="btn button-primary" type="submit">Daftar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->

    <!-- Header Start -->

    <header class="container">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6 header-title">
                    <h1 class="display-1"><b>Selamat <span>Datang!</span></b></h1>
                    <p class="display-6">Temukan Dokter, Buat Janji, Mudah</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Register as Patient
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Login as Employee
                    </button>
                </div>
                <div class="col-md-6">
                    <img src="https://img.freepik.com/free-photo/front-view-young-smiling-doctor-medical-suit-sitting-desk-white-wall_179666-27135.jpg?t=st=1738490950~exp=1738494550~hmac=db00d84d40057f5eb6112b69c6c5968537f5a594b6515c137d07d838a8cc926f&w=1380" alt="" width="100%;">
                </div>
            </div>
        </div>
    </header>

    <!-- End Header -->

    <!-- Tentang Kami Start -->

    <section class="about-us container">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <img src="https://img.freepik.com/free-photo/medical-pretty-cute-doctor-white-lab-coat-hat-with-computer-blessed-happy_140725-166924.jpg?t=st=1738491204~exp=1738494804~hmac=ed169979b6e7317d29ac80e2f145d585bee59546dfa1a74260bb462a616d4ddd&w=740" alt="" width="100%;">
                </div>
                <div class="col-md-6 mt-5">
                    <h1><b>Kenapa Harus <span>Kami?</span></b></h1>
                    <p> Bikin kamu lebih gampang buat booking janji temu dengan dokter pilihan.
                        dengan 3T #Tanpa antre panjang, #Tanpa drama cukup beberapa klik,
                        dan kamu langsung terhubung dengan #Tenaga medis profesional.</p>
                    <p class="display-6">Temukan Dokter dengan Mudah, Tanpa Ribet!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- End Tentang Kami -->

    <!-- Cara Kerja Start -->

    <section class="how-works container">
        <div class="col-12">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="mt-5 display-3"><b>Bagaimana Cara <span>Kerjanya?</span></b></h2>
                    <div class="mt-5">
                        <ul class="display-6">
                            <li>✅ Daftar</li>
                            <li>✅ Temukan</li>
                            <li>✅ Buat Janji</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <img src="https://img.freepik.com/free-photo/portrait-handsome-young-male-doctor_171337-5097.jpg?t=st=1738492188~exp=1738495788~hmac=c7b5091b1bc55b776d827e9da1373d41d51f9db62b909f99b59c8106634e8dee&w=1380" alt="" width="100%;">
                </div>
            </div>
    </section>
    <!-- End Cara Kerja -->

    <!-- banner start -->

    <section class="banner text-center">
        <p class="display-6 mb-5">Temukan Dokter dengan Mudah, Tanpa Ribet!</p>
        <img src="{{ asset('frontend/assets/images/logo-klinik-pintar.png') }}" alt="" width="40%;">
    </section>


    <!-- end banner -->



    <!-- Footer start -->

    <footer class="text-center mt-5">
        <p>Developed with 🧡 by Bahrul Rozak</p>
    </footer>

    <!-- End Footer -->

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Patient Registration Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('patient.store') }}" method="post">
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
                                <input type="text" class="form-control" id="religion" placeholder="Religion" name="religion">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="education" class="col-sm-2 col-form-label">Education</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="education" placeholder="-" name="education">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="employment" class="col-sm-2 col-form-label">Employment</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="employment" name="occupation">
                                    <option selected>Is currently employed/unemployed</option>
                                    <option value="employed">Employed</option>
                                    <option value="unemployed">Unemployed</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="complaint" class="col-sm-2 col-form-label">Complaint</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="complaint" rows="3" placeholder="What are you sick with, and how long have you been suffering?"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="doctor" class="col-sm-2 col-form-label">Doctor</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="doctor">
                                    <option selected>Select doctor</option>
                                    <option value="doctor1">Doctor 1</option>
                                    <option value="doctor2">Doctor 2</option>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <script src="{{ asset('frontend/assets/js/bootstrap.js') }}"></script>
</body>

</html>