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
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <p>☢ Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">General</li>
                <!-- Registration -->
                <li class="nav-item {{ Request::is('patient-register*', 'patient-queue*', 'medical-record*', 'daily-report*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <p>📝 Registration <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('patient-register.index') }}" class="nav-link {{ Request::is('patient-register*') ? 'active' : '' }}">
                                <p>😷 Patient Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('patient-queue.index') }}" class="nav-link {{ Request::is('patient-queue*') ? 'active' : '' }}">
                                <p>🙋‍♀️ Patient Queue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('medical-record.index') }}" class="nav-link {{ Request::is('medical-record*') ? 'active' : '' }}">
                                <p>🏥 Diagnose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('daily-report.index') }}" class="nav-link {{ Request::is('daily-report*') ? 'active' : '' }}">
                                <p>📈 Daily Report</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Patient -->
                <li class="nav-item">
                    <a href="{{ route('patient.index') }}" class="nav-link {{ Request::is('patient*') ? 'active' : '' }}">
                        <p>😷 Patient</p>
                    </a>
                </li>

                <li class="nav-header">Master Data</li>
                <!-- Doctor -->
                <li class="nav-item {{ Request::is('doctor*', 'schedule*', 'clinic*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <p>👩‍⚕️ Doctor <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('doctor.index') }}" class="nav-link {{ Request::is('doctor*') ? 'active' : '' }}">
                                <p>👨‍⚕️ Doctor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('schedule.index') }}" class="nav-link {{ Request::is('schedule*') ? 'active' : '' }}">
                                <p>📅 Doctor Schedule</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clinic.index') }}" class="nav-link {{ Request::is('clinic*') ? 'active' : '' }}">
                                <p>🩺 Clinics / Specialist</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Employee -->
                <li class="nav-item">
                    <a href="{{ route('employee.index') }}" class="nav-link {{ Request::is('employee*') ? 'active' : '' }}">
                        <p>💼 Employee</p>
                    </a>
                </li>

                <!-- Pharmacist -->
                <li class="nav-item {{ Request::is('medication*', 'medication-types*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <p>⚕ Pharmacist <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('medication.index') }}" class="nav-link {{ Request::is('medication*') ? 'active' : '' }}">
                                <p>💊 Medications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('medication-types.index') }}" class="nav-link {{ Request::is('medication-types*') ? 'active' : '' }}">
                                <p>🩺 Medications Type</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Super Admin Only -->
                @if(auth()->check() && auth()->user()->is_super_admin)
                <li class="nav-item">
                    <a href="{{ route('account-manager.index') }}" class="nav-link {{ Request::is('account-manager*') ? 'active' : '' }}">
                        <p>💻 Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clear-database.index') }}" class="nav-link {{ Request::is('clear-database*') ? 'active' : '' }}">
                        <p>☠ Clear Database</p>
                    </a>
                </li>
                @endif

                <!-- Logout -->
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <p>⭕ Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>