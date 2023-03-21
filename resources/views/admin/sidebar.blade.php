<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.home') }}" class="brand-link">
    <img src="admin2/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">An Khánh</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('imgUser/'. Auth::user()->filename) }}" style="border-radius: 50%;vertical-align: middle;
                                          width: 40px;
                                          height: 40px;
                                          border-radius: 50%;" alt="{{ Auth::user()->name }}" title="">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div> --}}

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Lịch hẹn
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(Auth::user()->role == 0 || Auth::user()->role == 2)
            <li class="nav-item">
              <a href="{{ route('book_appointments.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lịch hẹn yêu cầu</p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{ route('appointments.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý lịch hẹn</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('appointments.calendar') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lịch</p>
              </a>
            </li>
            @if(Auth::user()->role == 1)
            <li class="nav-item">
              <a href="{{ route('appointments.get-appointment-by-doctor') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lịch trình</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('meetings.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Cuộc họp
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('doctors.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>Bác sĩ</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('doctor_departments.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>Phòng ban</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="pages/charts/uplot.html" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>Đơn thuốc</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('patients.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Bệnh nhân
            </p>
          </a>
        </li>
        @if (Auth::user()->role == 2)
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Tài khoản nhân viên
            </p>
          </a>
        </li>
        @endif
        @if (Auth::user()->role >= 1)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Trang thiết bị y tế
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('medical_devices.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý thiết bị</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('request_devices.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đơn yêu cầu thiết bị</p>
              </a>
            </li>
          </ul>
        </li>
        @endif

        @if (Auth::user()->role == 2)
        <li class="nav-item">
          <a href="{{ route('news.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              News
            </p>
          </a>
        </li>
        @endif

        @if (Auth::user()->role == 2)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Payroll
            </p>
          </a>
        </li>
        @endif

        @if (Auth::user()->role == 0 || Auth::user()->role == 2)
        <li class="nav-item">
          <a href="{{route('admin.get-bill-list')}}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Bills
            </p>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a href="{{ route('chats.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Messages
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('documents.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Quản lý File
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>