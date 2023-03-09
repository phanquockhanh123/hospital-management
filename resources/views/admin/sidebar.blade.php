
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="admin2/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Hospital Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('imgUser/'. Auth::user()->filename) }}" style="border-radius: 50%;vertical-align: middle;
                                          width: 40px;
                                          height: 40px;
                                          border-radius: 50%;" alt="{{ Auth::user()->name }}" title="">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Appointments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('appointments.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Appointments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('appointments.calendar') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Calender</p>
                </a>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('beds.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Beds
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Live
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Live Consultations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Live Meetings</p>
                </a>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Doctors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('doctors.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doctors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('doctor_departments.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doctor Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Schedules</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Prescription</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Patients
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('patients.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('addmission_patients.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patient Addmissions</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('ipds.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                IPD/OPD Patients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('ipds.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                IPD/OPD Patients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('medical_devices.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Inventories
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>