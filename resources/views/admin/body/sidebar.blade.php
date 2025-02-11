<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <p>
                            ☢ Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">General</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            📝 Registration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('patient-register.index') }}" class="nav-link">
                                <p>😷 Patient Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <p>🙋‍♀️ Patient Queue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <p>🏥 Diagnose / Recipe</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <p>📈 Daily Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('patient.index') }}" class="nav-link">
                        <p>
                            😷 Patient
                        </p>
                    </a>
                </li>
                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            👩‍⚕️ Doctor
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="{{ route('doctor.index') }}" class="nav-link">
                                <p>👨‍⚕️ Doctor </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('schedule.index') }}" class="nav-link">
                                <p>📅 Doctor Schedule</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clinic.index') }}" class="nav-link">
                                <p>🩺 Clinics / Specialist</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('employee.index') }}" class="nav-link">
                        <p>
                            💼 Employee
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            ⚕ Pharmacist
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('medication.index') }}" class="nav-link">
                                <p>💊 Medications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('medication-types.index') }}" class="nav-link">
                                <p>🩺 Medications Type</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account-manager.index') }}" class="nav-link">
                        <p>
                            💻 Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <p>
                            ⭕ Logout
                        </p>
                    </a>
                </li>
              
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>