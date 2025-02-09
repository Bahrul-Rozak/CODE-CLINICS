@extends('admin.master')

@section('content')
<div class="container-fluid">
    <!-- Header with image and current time -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center p-4 bg-primary text-white rounded">
                <div class="d-flex align-items-center">
                    <h2 class="mb-0">Welcome {{Auth::user()->name}}</h2>
                </div>
                <div class="text-end">
                    <h4 id="current-time"></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Full-width Header Image -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <img src="https://w0.peakpx.com/wallpaper/362/953/HD-wallpaper-medical-technology-surgical-technologist.jpg" alt="Medical Image" class="img-fluid" style="width: 100%; max-height: 300px; object-fit: cover;">
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="row">
        <!-- Total Doctors -->
        <div class="col-lg-6 col-md-6 col-12 mb-4">
            <div class="card bg-info shadow-lg border-0 h-100">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-md fa-4x me-3"></i> <!-- Icon dokter -->
                        <div>
                            <h3 class="card-title">{{ App\Models\Doctor::count() ?? '0' }}</h3>
                            <p class="card-text">Total Doctors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Patients -->
        <div class="col-lg-6 col-md-6 col-12 mb-4">
            <div class="card bg-success shadow-lg border-0 h-100">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-injured fa-4x me-3"></i> <!-- Icon pasien -->
                        <div>
                            <h3 class="card-title">{{ App\Models\Patient::count() ?? '0' }}</h3>
                            <p class="card-text">Total Patients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Employees -->
        <div class="col-lg-6 col-md-6 col-12 mb-4">
            <div class="card bg-warning shadow-lg border-0 h-100">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-4x me-3"></i> <!-- Icon karyawan -->
                        <div>
                            <h3 class="card-title">{{ App\Models\Employee::count() ?? '0' }}</h3>
                            <p class="card-text">Total Employees</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Clinics -->
        <div class="col-lg-6 col-md-6 col-12 mb-4">
            <div class="card bg-danger shadow-lg border-0 h-100">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-hospital fa-4x me-3"></i> <!-- Icon klinik -->
                        <div>
                            <h3 class="card-title">{{ App\Models\Clinic::count() ?? '0' }}</h3>
                            <p class="card-text">Total Clinics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Display current time
    function updateTime() {
        const currentDate = new Date();
        const hours = currentDate.getHours().toString().padStart(2, '0');
        const minutes = currentDate.getMinutes().toString().padStart(2, '0');
        const seconds = currentDate.getSeconds().toString().padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;
        document.getElementById("current-time").textContent = currentTime;
    }
    setInterval(updateTime, 1000);
    updateTime(); // Call immediately to display the time right away
</script>
@endsection
