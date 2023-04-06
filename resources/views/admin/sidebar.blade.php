<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="https://scontent.fhan3-1.fna.fbcdn.net/v/t39.30808-6/302494543_501115628684397_602739320082206623_n.png?_nc_cat=105&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=gWSXdE-iCDcAX8ONLKV&_nc_ht=scontent.fhan3-1.fna&oh=00_AfA2T6engLV8TSneHwDSeaZSDQeV7JyLS9DuafymDN0Eog&oe=642C1AB2"
            alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">An Khánh</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role == 1 && Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('appointments.index') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Lịch hẹn
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('book_appointments.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch hẹn yêu cầu</p>
                            </a>
                        </li>
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

                        <li class="nav-item">
                            <a href="{{ route('appointments.get-appointment-by-doctor') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch trình</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- <li class="nav-item">
                    <a href="{{route('prescriptions.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Đơn thuốc</p>
                    </a>
                </li> --}}
                @if (Auth::user()->role == 3)
                <li class="nav-item">
                    <a href="{{ route('patients.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Bệnh nhân
                        </p>
                    </a>
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
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Tài khoản nhân viên
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
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Quản lý
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
                        <li class="nav-item">
                            <a href="{{ route('medicals.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thuốc</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dịch vụ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('doctor_departments.index') }}" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>Phòng ban</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Blog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Thanh toán lương
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 3)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Báo cáo thống kê
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('diagnosises.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Chẩn đoán/Xét nghiệm
                        </p>
                    </a>
                </li>
                @endif


                <li class="nav-item">
                    <a href="{{ route('bills.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Hóa đơn
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('chats.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Tin nhắn
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('documents.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Quản lý File
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>