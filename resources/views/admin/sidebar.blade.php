<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="https://th.bing.com/th/id/R.7341cd8295fecb9385f968b1f56715a7?rik=mSAa%2bJFXDvBT7Q&pid=ImgRaw&r=0"
            alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">An Khang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if ( Auth::user()->role == 1 || Auth::user()->role == 2 )
                <li class="nav-item">
                    <a href="{{ route('patients.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'patients.index') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Bệnh nhân
                        </p>
                    </a>
                </li>
                @endif
                @if ( Auth::user()->role == 3)
                <li class="nav-item">
                    <a href="{{ route('doctors.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'doctors.index') active @endif">
                        <i class="nav-icon far fa-hospital"></i>
                        <p>Bác sĩ</p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role == 3)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Báo cáo thống kê
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.report-services') }}"
                                class="nav-link  @if (Request::route()->getName() == 'reports.report-services') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê dịch vụ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.report-medicals') }}"
                                class="nav-link @if (Request::route()->getName() == 'reports.report-medicals') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê thuốc</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.report-devices') }}"
                                class="nav-link @if (Request::route()->getName() == 'reports.report-devices') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê thiết bị y tế</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{route('reports.index')}}"
                        class="nav-link @if (Request::route()->getName() == 'reports.index') active @endif">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p>
                            Báo cáo thống kê
                        </p>
                    </a>
                </li> --}}
                @endif
                @if (Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('diagnosises.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'diagnosises.index') active @endif">
                        <i class="nav-icon far fa-heart"></i>
                        <p>
                            Chẩn đoán/Xét nghiệm
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('bills.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'bills.index') active @endif">
                        <i class="nav-icon far fa-dollar-sign"></i>
                        <p>
                            Hóa đơn
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('appointments.index') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Lịch hẹn
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ route('book_appointments.index') }}"
                                class="nav-link  @if (Request::route()->getName() == 'book_appointments.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch hẹn yêu cầu</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('appointments.index') }}"
                                class="nav-link @if (Request::route()->getName() == 'appointments.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý lịch hẹn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('appointments.calendar') }}"
                                class="nav-link  @if (Request::route()->getName() == 'appointments.calendar') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch</p>
                            </a>
                        </li>
                        @if (Auth::user()->role == 2)
                        <li class="nav-item">
                            <a href="{{ route('appointments.get-appointment-by-doctor') }}"
                                class="nav-link @if (Request::route()->getName() == 'appointments.get-appointment-by-doctor') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch trình</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('request_devices.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'request_devices.index') active @endif">
                        <i class="nav-icon far fa-paper-plane"></i>
                        <p>Yêu cầu thiết bị</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('prescriptions.index')}}"
                        class="nav-link @if (Request::route()->getName() == 'prescriptions.index') active @endif">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Đơn thuốc</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('meetings.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'meetings.index') active @endif">
                        <i class="nav-icon far fa-calendar"></i>
                        <p>
                            Cuộc họp
                        </p>
                    </a>
                </li>

                @if (Auth::user()->role == 3)
                
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'users.index') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Tài khoản người dùng
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('services.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'services.index') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dịch vụ</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('receptionists.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'receptionists.index') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>Lễ tân</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Quản lý
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('medical_devices.index') }}"
                                class="nav-link @if (Request::route()->getName() == 'medical_devices.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết bị y tế</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('medicals.index') }}"
                                class="nav-link @if (Request::route()->getName() == 'medicals.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thuốc</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('doctor_departments.index') }}"
                                class="nav-link @if (Request::route()->getName() == 'doctor_departments.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phòng ban</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'news.index') active @endif">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>
                            Blog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'attendances.index') active @endif">
                        <i class="nav-icon far fa-calendar-check"></i>
                        <p>
                            Điểm danh
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('salaries.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'salaries.index') active @endif">
                        <i class="nav-icon far fa-dollar-sign"></i>
                        <p>
                            Lương
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('chats.index') }}"
                        class="nav-link @if (Request::route()->getName() == 'chats.index') active @endif">
                        <i class="nav-icon far fa-comment"></i>
                        <p>
                            Tin nhắn
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>